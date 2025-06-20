<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShipmentType;
use Carbon\Carbon;

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

        // Fecha base para los tipos de envío (hace 5 años)
        $baseDate = Carbon::now()->subYears(5);

        foreach ($shipmentTypes as $index => $type) {
            // Cada tipo de envío se crea con un pequeño intervalo
            $shipmentTypeDate = $baseDate->copy()->addDays($index * 10);
            
            ShipmentType::create([
                'nombre' => $type['nombre'],
                'created_at' => $shipmentTypeDate,
                'updated_at' => $shipmentTypeDate,
            ]);
        }
    }
}
