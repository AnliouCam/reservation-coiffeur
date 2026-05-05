<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['nom' => 'Coupe homme',   'duree' => 30, 'prix' => 20.00],
            ['nom' => 'Coupe femme',   'duree' => 60, 'prix' => 40.00],
            ['nom' => 'Coupe enfant',  'duree' => 20, 'prix' => 15.00],
            ['nom' => 'Barbe',         'duree' => 20, 'prix' => 15.00],
            ['nom' => 'Coupe + Barbe', 'duree' => 45, 'prix' => 30.00],
            ['nom' => 'Coloration',    'duree' => 90, 'prix' => 60.00],
            ['nom' => 'Brushing',      'duree' => 45, 'prix' => 25.00],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
