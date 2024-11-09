<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Sony Music'],
            ['name' => 'Think Music'],
            ['name' => 'AVM Music'],
            ['name' => 'UNG'],
            ['name' => 'WMG']
        ];

        foreach ($brands as $row) {
            Brand::create($row);
        }
    }
}
