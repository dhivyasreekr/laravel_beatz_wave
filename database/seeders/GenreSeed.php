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
            ['name' => 'Classical'],
            ['name' => 'Devotional'],
            ['name' => 'Free Style'],
            ['name' => 'Flok Music'],
            ['name' => 'Hip Hop'],
            ['name' => 'Instrumental'],
            ['name' => 'Motivational'],
            ['name' => 'Others'],
            ['name' => 'Pop'],
            ['name' => 'Rock'],
            ['name' => 'Western'],
        ];

        foreach ($genres as $row) 
        {
            Genre::create($row);
        }
    }
}
