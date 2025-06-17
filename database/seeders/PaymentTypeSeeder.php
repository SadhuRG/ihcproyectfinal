<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentType;

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

        foreach ($paymentTypes as $type) {
            PaymentType::create($type);
        }
    }
}
