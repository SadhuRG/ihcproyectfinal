@props(['edition', 'size' => 'md', 'showModal' => true])

@php
    $sizes = [
        'sm' => 'h-10 w-10',
        'md' => 'h-20 w-16',
        'lg' => 'h-32 w-24',
        'xl' => 'h-40 w-32'
    ];
    
    $iconSizes = [
        'sm' => 'w-5 h-5 -top-1 -right-1',
        'md' => 'w-8 h-8 -top-2 -right-2',
        'lg' => 'w-10 h-10 -top-2 -right-2',
        'xl' => 'w-12 h-12 -top-3 -right-3'
    ];
    
    $coverSize = $sizes[$size] ?? $sizes['md'];
    $iconSize = $iconSizes[$size] ?? $iconSizes['md'];
@endphp

@if($edition->hasCover())
    <div class="relative group cursor-pointer {{ $showModal ? 'cursor-pointer' : '' }}" 
         @if($showModal) onclick="openImageModal('{{ $edition->url_portada }}', '{{ $edition->book->titulo }} - {{ $edition->numero_edicion }}')" @endif>
        <img src="{{ $edition->url_portada }}" 
             alt="Carátula de {{ $edition->book->titulo }}" 
             class="{{ $coverSize }} object-cover rounded shadow-lg transition-transform duration-200 group-hover:scale-105">
        
        <!-- Icono de edición en la esquina superior derecha -->
        <div class="absolute {{ $iconSize }}">
            <img src="{{ $edition->getEditionIconUrl('dark') }}" 
                 alt="{{ $edition->numero_edicion }}" 
                 class="w-full h-full drop-shadow-lg">
        </div>
        
        @if($showModal)
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-800 opacity-0 group-hover:opacity-100 transition-opacity duration-200 drop-shadow-lg" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                </svg>
            </div>
        @endif
    </div>
@else
    <div class="{{ $coverSize }} bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center">
        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
        </svg>
    </div>
@endif 