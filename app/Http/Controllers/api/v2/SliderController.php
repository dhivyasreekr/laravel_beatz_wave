<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        try {

            // Retrieve movies by genre using whereHas
            $sliders = Slider::all();

            // Add the full URL path for poster to each movie
            foreach ($sliders as $row) 
            {
                if ($row->image_path != null) 
                {
                    $row->image_path = Slider::getIconFullPath($row->image_path);
                }
                else 
                {
                    $row->image_path = "";
                }
            }            

            // Return the list of movies as JSON response
            return response()->json(['data' => $sliders], 200);

        } catch (\Exception $e) {
            // Handle any exceptions, e.g., database errors
            return response()->json(['error' => 'Internal Server Error' . $e], 500);
        }

    }
}