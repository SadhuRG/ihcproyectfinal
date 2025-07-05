<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Editorial;
use App\Models\Edition;
use App\Models\Inventory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class LibrosPost extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'id';
    public $direction = 'asc';
    public $showEditModal = false;
    public $libroEditado = [];
    public $showDeleteModal = false;
    public $libroAEliminar = null;
    public $showNotification = false;
    public $notificationMessage = '';
    public $notificationType = 'success'; // success, error, warning
    public $selectedLibros = [];
    public $selectAll = false;
    public $eliminacionmode = 'unico';
    public $showCreateModal = false;
    public $nuevoLibro = [];
    public $showDetailModal = false;
    public $libroDetalle = null;
    
    // Modal de atención para ISBN duplicado
    public $showIsbnDuplicateModal = false;
    public $libroExistente = null;
    
    // Modal de advertencia para título similar
    public $showTitleSimilarModal = false;
    public $libroSimilar = null;

    // Para selects
    public $autores = [];
    public $categorias = [];
    public $editoriales = [];
    public $autorSeleccionado = [];
    public $categoriaSeleccionada = [];
    
    // Array estático de ediciones disponibles (formato exacto del seeder)
    public $edicionesDisponibles = [
        '1ra edición',
        '2da edición', 
        '3ra edición',
        '4ta edición',
        '5ta edición',
        '6ta edición',
        '7ma edición',
        '8va edición',
        '9na edición',
        '10ma edición',
        'edición especial'
    ];

    public function mount()
    {
        $this->autores = Author::all();
        $this->categorias = Category::all();
        $this->editoriales = Editorial::all();
        $this->resetNuevoLibro();
    }

    public function resetNuevoLibro()
    {
        $this->nuevoLibro = [
            'titulo' => '',
            'ISBN' => '',
            'descripcion' => '',
            'editorial_id' => '',
            'numero_edicion' => '',
            'precio' => '',
            'cantidad' => '',
            'umbral' => ''
        ];
        $this->autorSeleccionado = [];
        $this->categoriaSeleccionada = [];
    }

    public function order($sort)
    {
        if ($this->sort === $sort) {
            $this->direction = $this->direction === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
        $this->resetPage();
    }

    public function updatedSearch()
    {
        // Solo resetear la página, NO modificar el valor del search
        $this->resetPage();
    }

    /**
     * Normaliza el texto de búsqueda para hacerlo más amigable
     */
    private function normalizarBusqueda($texto)
    {
        if (empty($texto)) {
            return '';
        }
        
        // Eliminar espacios al inicio y final
        $texto = trim($texto);
        
        // Reemplazar múltiples espacios con un solo espacio
        $texto = preg_replace('/\s+/', ' ', $texto);
        
        return $texto;
    }

    public function editarLibro($id)
    {
        $libro = Book::with(['authors', 'categories'])->find($id);

        if ($libro) {
            $this->libroEditado = [
                'id' => $libro->id,
                'titulo' => $libro->titulo,
                'ISBN' => $libro->ISBN,
                'descripcion' => $libro->descripcion
            ];

            $this->autorSeleccionado = $libro->authors->pluck('id')->toArray();
            $this->categoriaSeleccionada = $libro->categories->pluck('id')->toArray();
            $this->showEditModal = true;
        }
    }

    public function verDetalleLibro($id)
    {
        $this->libroDetalle = Book::with(['authors', 'categories', 'editions.editorial', 'editions.inventory'])->find($id);
        $this->showDetailModal = true;
    }

    public function guardarLibro()
    {
        $this->validate([
            'libroEditado.titulo' => 'required|string|max:100',
            'libroEditado.ISBN' => 'required|string|max:50',
            'libroEditado.descripcion' => 'nullable|string|max:100'
        ]);
        // Normalizar ISBN
        $isbnNormalizado = $this->normalizarIsbn($this->libroEditado['ISBN']);
        // Verificar si el ISBN ya existe en otro libro (ignorando espacios y guiones)
        $libroExistente = Book::all()->first(function($libro) use ($isbnNormalizado) {
            return $libro->id != $this->libroEditado['id'] && $this->normalizarIsbn($libro->ISBN) === $isbnNormalizado;
        });
        if ($libroExistente) {
            $this->showNotification = true;
            $this->notificationMessage = 'El ISBN ya está registrado en otro libro.';
            $this->notificationType = 'error';
            return;
        }
        try {
            DB::transaction(function () use ($isbnNormalizado) {
                $libro = Book::find($this->libroEditado['id']);
                $libro->update([
                    'titulo' => $this->libroEditado['titulo'],
                    'ISBN' => $isbnNormalizado,
                    'descripcion' => $this->libroEditado['descripcion']
                ]);
                $libro->authors()->sync($this->autorSeleccionado);
                $libro->categories()->sync($this->categoriaSeleccionada);
            });
            $this->showEditModal = false;
            $this->libroEditado = [];
            $this->autorSeleccionado = [];
            $this->categoriaSeleccionada = [];
            $this->showNotification = true;
            $this->notificationMessage = 'Libro actualizado correctamente';
            $this->notificationType = 'success';
            $this->dispatch('libroActualizado');
        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al actualizar el libro';
            $this->notificationType = 'error';
        }
    }

    public function crearLibro()
    {
        // Validar todos los campos excepto el ISBN
        $this->validate([
            'nuevoLibro.titulo' => 'required|string|max:100',
            'nuevoLibro.descripcion' => 'nullable|string|max:100',
            'nuevoLibro.editorial_id' => 'required|exists:editorials,id',
            'nuevoLibro.numero_edicion' => 'required|string|max:50',
            'nuevoLibro.precio' => 'required|numeric|min:0',
            'nuevoLibro.cantidad' => 'required|integer|min:0',
            'nuevoLibro.umbral' => 'required|integer|min:0'
        ]);
        // Validar ISBN por separado
        $this->validate([
            'nuevoLibro.ISBN' => 'required|string|max:50'
        ]);
        // Normalizar ISBN
        $isbnNormalizado = $this->normalizarIsbn($this->nuevoLibro['ISBN']);
        // Verificar si el ISBN ya existe (ignorando espacios y guiones)
        $libroExistente = Book::all()->first(function($libro) use ($isbnNormalizado) {
            return $this->normalizarIsbn($libro->ISBN) === $isbnNormalizado;
        });
        if ($libroExistente) {
            $this->libroExistente = $libroExistente;
            $this->showIsbnDuplicateModal = true;
            return;
        }
        // Verificar similitud de título
        $libroSimilar = $this->detectarSimilitudTitulo($this->nuevoLibro['titulo']);
        if ($libroSimilar) {
            $this->libroSimilar = $libroSimilar;
            $this->showTitleSimilarModal = true;
            return;
        }
        // Guardar el ISBN normalizado
        $this->nuevoLibro['ISBN'] = $isbnNormalizado;
        $this->crearLibroConfirmado();
    }

    public function confirmarEliminacion($id)
    {
        $this->libroAEliminar = $id;
        $this->showDeleteModal = true;
        $this->eliminacionmode = 'unico';
    }

    public function eliminarLibro()
    {
        DB::transaction(function () {
            $libro = Book::find($this->libroAEliminar);

            if ($libro) {
                // Eliminar relaciones de tablas pivot (eliminación física)
                $libro->authors()->detach();
                $libro->categories()->detach();
                $libro->favoriteUsers()->detach();
                $libro->promotions()->detach();

                // Eliminar comentarios (eliminación física)
                DB::table('book_user_coment')->where('book_id', $libro->id)->delete();

                // Eliminar ediciones e inventarios (eliminación lógica)
                foreach ($libro->editions as $edicion) {
                    if ($edicion->inventory) {
                        $edicion->inventory->delete(); // Soft delete del inventario
                    }
                    $edicion->delete(); // Soft delete de la edición
                }

                // Eliminar libro (eliminación lógica)
                $libro->delete();
            }
        });

        $this->showDeleteModal = false;
        $this->libroAEliminar = null;
        $this->showNotification = true;
        $this->notificationMessage = 'Libro eliminado correctamente';
        $this->notificationType = 'success';

        // Emitir evento para actualizar otros componentes
        $this->dispatch('libroEliminado');
    }

    public function eliminarshowmodal()
    {
        if (count($this->selectedLibros) >= 2) {
            $this->showDeleteModal = true;
            $this->eliminacionmode = 'multiple';
        }
    }

    public function eliminarLibrosSeleccionados()
    {
        DB::transaction(function () {
            foreach ($this->selectedLibros as $libroId) {
                $libro = Book::find($libroId);

                if ($libro) {
                    // Eliminar relaciones de tablas pivot (eliminación física)
                    $libro->authors()->detach();
                    $libro->categories()->detach();
                    $libro->favoriteUsers()->detach();
                    $libro->promotions()->detach();

                    // Eliminar comentarios (eliminación física)
                    DB::table('book_user_coment')->where('book_id', $libro->id)->delete();

                    // Eliminar ediciones e inventarios (eliminación lógica)
                    foreach ($libro->editions as $edicion) {
                        if ($edicion->inventory) {
                            $edicion->inventory->delete(); // Soft delete del inventario
                        }
                        $edicion->delete(); // Soft delete de la edición
                    }

                    // Eliminar libro (eliminación lógica)
                    $libro->delete();
                }
            }
        });

        $this->selectedLibros = [];
        $this->selectAll = false;
        $this->showDeleteModal = false;
        $this->eliminacionmode = 'unico';
        $this->showNotification = true;
        $this->notificationMessage = 'Libros eliminados correctamente';
        $this->notificationType = 'success';

        // Emitir evento para actualizar otros componentes
        $this->dispatch('libroEliminado');
    }

    public function cancelarEliminacion()
    {
        $this->showDeleteModal = false;
        $this->libroAEliminar = null;
        $this->eliminacionmode = 'unico';
    }

    public function cerrarNotificacion()
    {
        $this->showNotification = false;
        $this->notificationMessage = '';
        $this->notificationType = 'success';
    }
    
    /**
     * Cerrar el modal de atención de ISBN duplicado
     */
    public function cerrarModalIsbnDuplicado()
    {
        $this->showIsbnDuplicateModal = false;
        $this->libroExistente = null;
    }
    
    /**
     * Ir a la sección de ediciones para agregar una nueva edición
     */
    public function irAEdiciones()
    {
        // Cerrar todos los modales
        $this->showCreateModal = false;
        $this->showIsbnDuplicateModal = false;
        $this->showTitleSimilarModal = false;
        $this->libroExistente = null;
        $this->libroSimilar = null;
    }
    
    /**
     * Cerrar el modal de similitud de título
     */
    public function cerrarModalTituloSimilar()
    {
        $this->showTitleSimilarModal = false;
        $this->libroSimilar = null;
    }
    
    /**
     * Continuar con la creación del libro a pesar de la similitud
     */
    public function continuarCreacionLibro()
    {
        // Cerrar el modal de similitud
        $this->showTitleSimilarModal = false;
        $this->libroSimilar = null;
        
        // Continuar con la creación del libro
        $this->crearLibroConfirmado();
    }
    
    /**
     * Crear el libro confirmado (sin validaciones de similitud)
     */
    private function crearLibroConfirmado()
    {
        try {
            DB::transaction(function () {
                // Crear libro
                $libro = Book::create([
                    'titulo' => $this->nuevoLibro['titulo'],
                    'ISBN' => $this->nuevoLibro['ISBN'],
                    'descripcion' => $this->nuevoLibro['descripcion']
                ]);

                // Crear inventario con los valores proporcionados
                $inventario = Inventory::create([
                    'cantidad' => $this->nuevoLibro['cantidad'],
                    'umbral' => $this->nuevoLibro['umbral']
                ]);

                // Crear edición
                Edition::create([
                    'editorial_id' => $this->nuevoLibro['editorial_id'],
                    'inventorie_id' => $inventario->id,
                    'book_id' => $libro->id,
                    'url_portada' => '/images/covers/default.jpg',
                    'numero_edicion' => $this->nuevoLibro['numero_edicion'],
                    'precio' => $this->nuevoLibro['precio']
                ]);

                // Asignar relaciones
                if (!empty($this->autorSeleccionado)) {
                    $libro->authors()->sync($this->autorSeleccionado);
                }
                if (!empty($this->categoriaSeleccionada)) {
                    $libro->categories()->sync($this->categoriaSeleccionada);
                }
            });

            $this->showCreateModal = false;
            $this->resetNuevoLibro();
            $this->showNotification = true;
            $this->notificationMessage = 'Libro creado correctamente con inventario inicial establecido.';
            $this->notificationType = 'success';

            // Emitir evento para actualizar otros componentes
            $this->dispatch('libroCreado');

        } catch (\Exception $e) {
            $this->showNotification = true;
            $this->notificationMessage = 'Error al crear el libro';
            $this->notificationType = 'error';
        }
    }
    
    /**
     * Detectar similitud de títulos
     */
    private function detectarSimilitudTitulo($tituloNuevo)
    {
        // Normalizar el título nuevo (quitar espacios extra, convertir a minúsculas)
        $tituloNormalizado = $this->normalizarTitulo($tituloNuevo);
        
        // Obtener todos los libros existentes
        $librosExistentes = Book::all();
        
        foreach ($librosExistentes as $libro) {
            $tituloExistente = $this->normalizarTitulo($libro->titulo);
            
            // Calcular similitud usando diferentes métodos
            $similitud = $this->calcularSimilitud($tituloNormalizado, $tituloExistente);
            
            // Si la similitud es mayor al 80%, considerar como similar
            if ($similitud >= 80) {
                return $libro;
            }
        }
        
        return null;
    }
    
    /**
     * Normalizar título para comparación
     */
    private function normalizarTitulo($titulo)
    {
        // Convertir a minúsculas
        $titulo = strtolower($titulo);
        
        // Quitar espacios extra y caracteres especiales
        $titulo = preg_replace('/\s+/', ' ', $titulo);
        $titulo = trim($titulo);
        
        // Quitar caracteres especiales comunes
        $titulo = str_replace(['á', 'é', 'í', 'ó', 'ú', 'ñ'], ['a', 'e', 'i', 'o', 'u', 'n'], $titulo);
        $titulo = preg_replace('/[^a-z0-9\s]/', '', $titulo);
        
        return $titulo;
    }
    
    /**
     * Calcular similitud entre dos títulos
     */
    private function calcularSimilitud($titulo1, $titulo2)
    {
        // Método 1: Similitud exacta después de normalización
        if ($titulo1 === $titulo2) {
            return 100;
        }
        
        // Método 2: Similitud de palabras
        $palabras1 = explode(' ', $titulo1);
        $palabras2 = explode(' ', $titulo2);
        
        $palabrasComunes = array_intersect($palabras1, $palabras2);
        $totalPalabras = max(count($palabras1), count($palabras2));
        
        if ($totalPalabras > 0) {
            $similitudPalabras = (count($palabrasComunes) / $totalPalabras) * 100;
        } else {
            $similitudPalabras = 0;
        }
        
        // Método 3: Similitud de caracteres (similar_text)
        similar_text($titulo1, $titulo2, $similitudCaracteres);
        
        // Método 4: Distancia de Levenshtein
        $maxLength = max(strlen($titulo1), strlen($titulo2));
        if ($maxLength > 0) {
            $distanciaLevenshtein = levenshtein($titulo1, $titulo2);
            $similitudLevenshtein = (($maxLength - $distanciaLevenshtein) / $maxLength) * 100;
        } else {
            $similitudLevenshtein = 0;
        }
        
        // Promedio ponderado de las similitudes
        $similitudFinal = ($similitudPalabras * 0.4) + ($similitudCaracteres * 0.3) + ($similitudLevenshtein * 0.3);
        
        return $similitudFinal;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedLibros = $this->getLibros()->pluck('id')->toArray();
        } else {
            $this->selectedLibros = [];
        }
    }

    public function updatedSelectedLibros()
    {
        $this->selectAll = count($this->selectedLibros) === $this->getLibros()->count();
    }

    public function getLibros()
    {
        return Book::with(['authors', 'categories', 'editions.editorial'])
            ->when($this->search, function ($query) {
                $searchNormalized = $this->normalizarBusqueda($this->search);
                $query->where(function ($q) use ($searchNormalized) {
                    $q->where('titulo', 'like', '%' . $searchNormalized . '%')
                      ->orWhere('ISBN', 'like', '%' . $searchNormalized . '%')
                      ->orWhere('descripcion', 'like', '%' . $searchNormalized . '%')
                      ->orWhereHas('authors', function ($authorQuery) use ($searchNormalized) {
                          $authorQuery->where('nombre', 'like', '%' . $searchNormalized . '%')
                                     ->orWhere('apellido', 'like', '%' . $searchNormalized . '%');
                      })
                      ->orWhereHas('categories', function ($categoryQuery) use ($searchNormalized) {
                          $categoryQuery->where('nombre', 'like', '%' . $searchNormalized . '%');
                      });
                });
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.libros-post', [
            'libros' => $this->getLibros()
        ]);
    }

    /**
     * Normaliza un ISBN eliminando espacios y guiones
     */
    private function normalizarIsbn($isbn)
    {
        return preg_replace('/[\s-]+/', '', $isbn);
    }
}
