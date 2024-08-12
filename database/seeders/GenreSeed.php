<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Genre;

class GenreSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $genres = [
            ['name' => 'Classic'],
            ['name' => 'Western'],
            ['name' => 'Devotional'],
            ['name' => 'Flok'],
            ['name' => 'Melody'],
            ['name' => 'Love'],
        ];

        foreach ($genres as $row) 
        {
            Genre::create($row);
        }
    }
}
