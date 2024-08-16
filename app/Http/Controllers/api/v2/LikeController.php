<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $user = $request->user();


            // Validate the incoming request data
            $validatedData = $request->validate([
                // 'user_id' => 'required|exists:users,id',
                'song_id' => 'required|exists:songs,id',
            ]);

            // Create a new like instance
            $like = Like::create([
                'user_id' => $user->id,
                'song_id' => $request->input('song_id') 
            ]);

            // Return a response indicating success
            return response()->json(['message' => 'Like created successfully', 'like' => $like], 201);

        } catch (ValidationException $e) {
            // Return a response with validation errors
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    
}