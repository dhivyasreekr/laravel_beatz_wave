<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Retrieve the authenticated user
        $user = $request->user();

        // Retrieve all posts with their comments
        $commentsForPost = Comment::Where('song_id', $request->song_id)->get();

        // Return the posts with comments
        return response()->json(['data' => $commentsForPost ], 200);
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
                'comment_text' => 'required'
            ]);

            // Create a new Comment instance
            $comment = Comment::create([
                'user_id' => $user->id,
                'song_id' => $request->input('song_id'),
                'comment_text' => $request->input('comment_text'),
            ]);

            // Return a response indicating success
            return response()->json(['message' => 'Comment created successfully', 'comment' => $comment], 201);

        } catch (ValidationException $e) {
            // Return a response with validation errors
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

}