<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // Get the user_id from the request or any other source
            $user = $request->user(); 

            // Fetch playlists based on user_id
            $playlists = Playlist::where('user_id', $user->id)->get();

            // Transform playlists
            $transformedPlaylists = $playlists->map(function ($playlist) {
                return [
                    'id' => $playlist->id,
                    'name' => $playlist->name,
                    // Add more fields if needed
                ];
            });

            return response()->json(['data' => $transformedPlaylists], 200);
        } catch (ValidationException $e) {
            // Return a response with validation errors
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $user = $request->user(); 

            $request->validate([
                // 'user_id' => 'required',
                'name' => 'required'
            ]);

            $playlist = Playlist::create([
                'user_id' => $user->id,
                'name' => $request->input('name'),
            ]);

            return response()->json(['message' => 'playlist created successfully'], 201);

        } catch (ValidationException $e) {
            // Return a response with validation errors
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $playlist = Playlist::findOrFail($id);
        return response()->json($playlist);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required'
        ]);

        $playlist = Playlist::findOrFail($id);
        $playlist->update($request->all());

        return response()->json($playlist, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $user = $request->user(); 

            $id = $request->input('id');

            $playlist = Playlist::where('user_id', $user->id)->findOrFail($id);
            $playlist->delete();

            // return response()->json(null, 204);

            return response()->json(['message' => 'playlist deleted successfully'], 200);

        } catch (ValidationException $e) {
            // Return a response with validation errors
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}