<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_id',
        'name'
        
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
