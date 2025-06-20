<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Address;
use App\Models\PaymentType;
use App\Models\ShipmentType;
use App\Models\Edition;
use Carbon\Carbon;

class RealisticOrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $paymentTypes = PaymentType::all();
        $shipmentTypes = ShipmentType::all();
        $editions = Edition::all();

        // Configuración de ventas realistas
        $startDate = Carbon::create(2025, 4, 1); // 1 de abril de 2025
        $endDate = Carbon::now();
        
        // Patrones de ventas realistas
        $salesPatterns = [
            // Abril 2025 - Mes de inicio, ventas moderadas
            ['start' => '2025-04-01', 'end' => '2025-04-30', 'orders_per_day' => [2, 5], 'weekend_boost' => 1.5],
            
            // Mayo 2025 - Crecimiento de ventas
            ['start' => '2025-05-01', 'end' => '2025-05-31', 'orders_per_day' => [3, 7], 'weekend_boost' => 1.8],
            
            // Junio 2025 - Pico de ventas (inicio de verano)
            ['start' => '2025-06-01', 'end' => '2025-06-30', 'orders_per_day' => [5, 12], 'weekend_boost' => 2.2],
            
            // Julio 2025 - Mantenimiento de ventas altas
            ['start' => '2025-07-01', 'end' => '2025-07-31', 'orders_per_day' => [4, 10], 'weekend_boost' => 2.0],
            
            // Agosto 2025 - Preparación para regreso a clases
            ['start' => '2025-08-01', 'end' => '2025-08-31', 'orders_per_day' => [6, 15], 'weekend_boost' => 2.5],
            
            // Septiembre 2025 - Regreso a clases (pico máximo)
            ['start' => '2025-09-01', 'end' => '2025-09-30', 'orders_per_day' => [8, 20], 'weekend_boost' => 3.0],
            
            // Octubre 2025 - Estabilización post-regreso
            ['start' => '2025-10-01', 'end' => '2025-10-31', 'orders_per_day' => [5, 12], 'weekend_boost' => 2.0],
            
            // Noviembre 2025 - Preparación para navidad
            ['start' => '2025-11-01', 'end' => '2025-11-30', 'orders_per_day' => [7, 18], 'weekend_boost' => 2.8],
            
            // Diciembre 2025 - Temporada navideña
            ['start' => '2025-12-01', 'end' => '2025-12-31', 'orders_per_day' => [10, 25], 'weekend_boost' => 3.5],
            
            // Enero 2025 - Post-navidad
            ['start' => '2025-01-01', 'end' => '2025-01-31', 'orders_per_day' => [3, 8], 'weekend_boost' => 1.5],
            
            // Febrero 2025 - Mes bajo
            ['start' => '2025-02-01', 'end' => '2025-02-28', 'orders_per_day' => [2, 6], 'weekend_boost' => 1.3],
            
            // Marzo 2025 - Recuperación
            ['start' => '2025-03-01', 'end' => '2025-03-31', 'orders_per_day' => [4, 9], 'weekend_boost' => 1.7],
            
            // Abril 2025 - Crecimiento anual
            ['start' => '2025-04-01', 'end' => '2025-04-30', 'orders_per_day' => [5, 11], 'weekend_boost' => 2.0],
            
            // Mayo 2025 - Continuación del crecimiento
            ['start' => '2025-05-01', 'end' => '2025-05-31', 'orders_per_day' => [6, 13], 'weekend_boost' => 2.2],
            
            // Junio 2025 (actual) - Hasta hoy
            ['start' => '2025-06-01', 'end' => '2025-06-20', 'orders_per_day' => [7, 15], 'weekend_boost' => 2.5],
        ];

        $totalOrders = 0;

        foreach ($salesPatterns as $pattern) {
            $periodStart = Carbon::parse($pattern['start']);
            $periodEnd = Carbon::parse($pattern['end']);
            
            // Ajustar el final si es después de hoy
            if ($periodEnd->isAfter($endDate)) {
                $periodEnd = $endDate;
            }
            
            $currentDate = $periodStart->copy();
            
            while ($currentDate->lte($periodEnd)) {
                // Determinar número de órdenes para este día
                $baseOrders = rand($pattern['orders_per_day'][0], $pattern['orders_per_day'][1]);
                
                // Aplicar boost de fin de semana
                $isWeekend = $currentDate->isWeekend();
                $multiplier = $isWeekend ? $pattern['weekend_boost'] : 1.0;
                
                // Aplicar variación aleatoria (±20%)
                $variation = rand(80, 120) / 100;
                
                $ordersToday = max(0, round($baseOrders * $multiplier * $variation));
                
                // Crear órdenes para este día
                for ($i = 0; $i < $ordersToday; $i++) {
                    $user = $users->random();
                    $userAddress = $user->addresses->first();
                    
                    if (!$userAddress) continue;
                    
                    // Hora aleatoria del día
                    $orderTime = $currentDate->copy()
                        ->addHours(rand(8, 22)) // Horario comercial
                        ->addMinutes(rand(0, 59))
                        ->addSeconds(rand(0, 59));
                    
                    // Crear la orden
                    $order = Order::create([
                        'user_id' => $user->id,
                        'address_id' => $userAddress->id,
                        'payment_type_id' => $paymentTypes->random()->id,
                        'shipment_type_id' => $shipmentTypes->random()->id,
                        'fecha_orden' => $orderTime->format('Y-m-d'),
                        'estado' => $this->getRealisticOrderStatus($orderTime),
                        'total' => 0,
                        'created_at' => $orderTime,
                        'updated_at' => $orderTime,
                    ]);
                    
                    // Agregar productos a la orden
                    $numEditions = $this->getRealisticOrderSize();
                    $total = 0;
                    $addedEditionIds = [];
                    
                    for ($j = 0; $j < $numEditions; $j++) {
                        $availableEditions = $editions->whereNotIn('id', $addedEditionIds);
                        
                        if ($availableEditions->isEmpty()) break;
                        
                        $edition = $availableEditions->random();
                        $cantidad = $this->getRealisticQuantity();
                        
                        $order->editions()->attach($edition->id, [
                            'cantidad' => $cantidad,
                            'created_at' => $orderTime,
                            'updated_at' => $orderTime,
                        ]);
                        
                        $addedEditionIds[] = $edition->id;
                        $total += $edition->precio * $cantidad;
                    }
                    
                    // Actualizar total
                    $order->update([
                        'total' => round($total, 2),
                        'updated_at' => $orderTime,
                    ]);
                    
                    $totalOrders++;
                }
                
                $currentDate->addDay();
            }
        }
        
        $this->command->info("Se crearon {$totalOrders} órdenes realistas desde abril de 2025.");
    }
    
    /**
     * Obtiene un estado de orden realista basado en la fecha
     */
    private function getRealisticOrderStatus($orderTime): int
    {
        $daysSinceOrder = Carbon::now()->diffInDays($orderTime);
        
        if ($daysSinceOrder <= 1) {
            // Órdenes muy recientes: 80% pendientes, 20% procesando
            return rand(1, 10) <= 8 ? 0 : 1;
        } elseif ($daysSinceOrder <= 3) {
            // Órdenes recientes: 60% procesando, 30% completadas, 10% pendientes
            $rand = rand(1, 10);
            if ($rand <= 6) return 1; // Procesando
            elseif ($rand <= 9) return 1; // Completada (usamos 1 para completada)
            else return 0; // Pendiente
        } else {
            // Órdenes antiguas: 90% completadas, 10% procesando
            return rand(1, 10) <= 9 ? 1 : 1;
        }
    }
    
    /**
     * Obtiene un tamaño de orden realista
     */
    private function getRealisticOrderSize(): int
    {
        // Distribución realista: 60% 1-2 items, 30% 3-4 items, 10% 5+ items
        $rand = rand(1, 100);
        
        if ($rand <= 60) return rand(1, 2);
        elseif ($rand <= 90) return rand(3, 4);
        else return rand(5, 7);
    }
    
    /**
     * Obtiene una cantidad realista por item
     */
    private function getRealisticQuantity(): int
    {
        // Distribución realista: 80% 1 item, 15% 2 items, 5% 3+ items
        $rand = rand(1, 100);
        
        if ($rand <= 80) return 1;
        elseif ($rand <= 95) return 2;
        else return rand(3, 5);
    }
} 