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

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $paymentTypes = PaymentType::all();
        $shipmentTypes = ShipmentType::all();
        $editions = Edition::all();

        // Crear 15-20 órdenes de ejemplo de los últimos 7 días
        for ($i = 0; $i < 18; $i++) {
            $user = $users->random();
            $userAddress = $user->addresses->first();

            if (!$userAddress) continue; // Skip si el usuario no tiene direcciones

            // Generar fecha aleatoria de los últimos 7 días
            $orderDate = Carbon::now()->subDays(rand(0, 6))->subHours(rand(0, 23))->subMinutes(rand(0, 59));
            
            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $userAddress->id,
                'payment_type_id' => $paymentTypes->random()->id,
                'shipment_type_id' => $shipmentTypes->random()->id,
                'fecha_orden' => $orderDate->format('Y-m-d'),
                'estado' => rand(0, 1),
                'total' => 0, // Se calculará después
                'created_at' => $orderDate,
                'updated_at' => $orderDate,
            ]);

            // Agregar 1-4 ediciones a la orden
            $numEditions = rand(1, 4);
            $total = 0;

            $addedEditionIds = [];

            for ($j = 0; $j < $numEditions; $j++) {
                // Obtener una edición que aún no haya sido añadida
                $availableEditions = $editions->whereNotIn('id', $addedEditionIds);

                if ($availableEditions->isEmpty()) break;

                $edition = $availableEditions->random();
                $cantidad = rand(1, 3);

                $order->editions()->attach($edition->id, [
                    'cantidad' => $cantidad,
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate,
                ]);

                $addedEditionIds[] = $edition->id;
                $total += $edition->precio * $cantidad;
            }

            // Actualizar total con timestamp
            $order->update([
                'total' => $total,
                'updated_at' => $orderDate,
            ]);
        }
    }
}
