<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShipmentType;

class ShipmentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $shipmentTypes = [
            ['nombre' => 'Envío Estándar (3-5 días)'],
            ['nombre' => 'Envío Express (1-2 días)'],
            ['nombre' => 'Recojo en Tienda'],
            ['nombre' => 'Envío Gratis (7-10 días)'],
        ];

        foreach ($shipmentTypes as $type) {
            ShipmentType::create($type);
        }
    }
}
