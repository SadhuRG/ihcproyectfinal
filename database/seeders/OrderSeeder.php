<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Address;
use App\Models\PaymentType;
use App\Models\ShipmentType;
use App\Models\Edition;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $paymentTypes = PaymentType::all();
        $shipmentTypes = ShipmentType::all();
        $editions = Edition::all();

        // Crear 5-10 órdenes de ejemplo
        for ($i = 0; $i < 8; $i++) {
            $user = $users->random();
            $userAddress = $user->addresses->first();

            if (!$userAddress) continue; // Skip si el usuario no tiene direcciones

            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $userAddress->id,
                'payment_type_id' => $paymentTypes->random()->id,
                'shipment_type_id' => $shipmentTypes->random()->id,
                'fecha_orden' => fake()->dateTimeBetween('-6 months', 'now'),
                'estado' => rand(0, 1),
                'total' => 0, // Se calculará después
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
                    'cantidad' => $cantidad
                ]);

                $addedEditionIds[] = $edition->id;
                $total += $edition->precio * $cantidad;
            }


            // Actualizar total
            $order->update(['total' => $total]);
        }
    }
}
