<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path'
    ];

    /**
     * Get the full URL path for the icon.
     *
     * @param string $iconPath
     * @return string
     */
    public static function getIconFullPath($poster)
    {
        // Assuming your images are stored in the public directory
        
        // $basePath = config('app.url') . '/storage/';

        $basePath = env('APP_URL') . '/storage/';

        return $basePath . $poster;
    }
}
