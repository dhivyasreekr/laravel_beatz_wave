<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path'
    ];

    public function song()
    {
        return $this->hasMany(Song::class);
    }
    public function GetLogoImage()
    {
        return env('DOMAIN_URL') . Storage::url($this->image_path);
    }
    public function DeleteLogoImage()
    {
        if (Storage::exists($this->image_path))
        {
            Storage::delete($this->image_path);
        }
    }
}
