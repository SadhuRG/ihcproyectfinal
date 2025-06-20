<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentType;
use Carbon\Carbon;

class PaymentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $paymentTypes = [
            ['nombre' => 'Tarjeta de Crédito', 'estado' => true],
            ['nombre' => 'Tarjeta de Débito', 'estado' => true],
            ['nombre' => 'PayPal', 'estado' => true],
            ['nombre' => 'Transferencia Bancaria', 'estado' => true],
            ['nombre' => 'Pago Contra Entrega', 'estado' => true],
            ['nombre' => 'Yape', 'estado' => true],
            ['nombre' => 'Plin', 'estado' => true],
        ];

        // Fecha base para los tipos de pago (hace 5 años)
        $baseDate = Carbon::now()->subYears(5);

        foreach ($paymentTypes as $index => $type) {
            // Cada tipo de pago se crea con un pequeño intervalo
            $paymentTypeDate = $baseDate->copy()->addDays($index * 7);
            
            PaymentType::create([
                'nombre' => $type['nombre'],
                'estado' => $type['estado'],
                'created_at' => $paymentTypeDate,
                'updated_at' => $paymentTypeDate,
            ]);
        }
    }
}
