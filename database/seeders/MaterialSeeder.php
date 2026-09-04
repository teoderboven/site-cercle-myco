<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            ['name' => 'Chaussures de marche', 'icon' => 'walking_shoe.svg'],
            ['name' => 'Chaussures de marche imperméables (ou bottes si pluie)', 'icon' => 'rain_boot.svg'],
            ['name' => 'Loupe', 'icon' => 'magnifier.svg'],
            ['name' => 'Gourde et sac à dos', 'icon' => 'backpack_bottle.svg'],
        ];

        foreach ($materials as $material) {
            Material::updateOrCreate(['name' => $material['name']], $material);
        }
    }
}
