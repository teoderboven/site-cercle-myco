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
            ['name' => 'Chaussures de marche', 'icon' => ''],
            ['name' => 'Chaussures de marche imperméables (ou bottes si pluie)', 'icon' => ''],
            ['name' => 'Loupe', 'icon' => ''],
            ['name' => 'Gourde et sac à dos', 'icon' => ''],
        ];

        foreach ($materials as $material) {
            Material::updateOrCreate(['name' => $material['name']], $material);
        }
    }
}
