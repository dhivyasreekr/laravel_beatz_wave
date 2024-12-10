<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Genre;
use App\Models\Song;

class SongSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = Genre::all();

        $songs = [
            [
                'name' => 'Badass',
                'genre_id' => $genres->where('name', 'Rock')->first()->id,
                'song_path' => 'Badass-MassTamilan.dev.mp3'
            ],
            [
                'name' => 'Bloody Sweet',
                'genre_id' => $genres->where('name', 'Rock')->first()->id
            ],
            [
                'name' => 'Entha Thottavai Eduthalum',
                'genre_id' => $genres->where('name', 'Rock')->first()->id
            ],
            [
                'name' => 'Kaaki Sattai Theme ',
                'genre_id' => $genres->where('name', 'Rock')->first()->id
            ],
            [
                'name' => 'Right Polam Right',
                'genre_id' => $genres->where('name', 'Rock')->first()->id
            ],
            [
                'name' => 'Ulagam Oruvanukka',
                'genre_id' => $genres->where('name', 'Rock')->first()->id
            ],
            [
                'name' => 'Ungalukku India Gate',
                'genre_id' => $genres->where('name', 'Rock')->first()->id
            ],
            [
                'name' => 'Osaka Osaka',
                'genre_id' => $genres->where('name', 'Classical')->first()->id
            ],
            [
                'name' => 'Un Kaigal Korthu',
                'genre_id' => $genres->where('name', 'Classical')->first()->id
            ],
            [
                'name' => 'Kadhal Kan Kattuthe',
                'genre_id' => $genres->where('name', 'Classical')->first()->id
            ],
            [
                'name' => 'Kannazhaga',
                'genre_id' => $genres->where('name', 'Classical')->first()->id
            ],
            [
                'name' => 'Right Polam Right',
                'genre_id' => $genres->where('name', 'Classical')->first()->id
            ],
            [
                'name' => 'Minnalai Pidithu',
                'genre_id' => $genres->where('name', 'Classical')->first()->id
            ],
            [
                'name' => 'Melliname Melliname',
                'genre_id' => $genres->where('name', 'Classical')->first()->id
            ],
            [
                'name' => 'Innisai Paadi Varum',
                'genre_id' => $genres->where('name', 'Classical')->first()->id
            ],
        ];

        foreach ($songs as $row) 
        {
            Song::create($row);
        }


    }
}
