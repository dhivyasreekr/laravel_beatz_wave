<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_id',
        'name',
        'image_path',
        'song_path'
        
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    public function GetImagePath()
    {
        return env('DOMAIN_URL') . Storage::url($this->image_path);
    }
    public function GetSongpath()
    {
        return env('DOMAIN_URL') . Storage::url($this->song_path);
    }
}
