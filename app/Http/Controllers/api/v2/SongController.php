<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Models\SongHistory;

class SongController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('genre_id'))
        {
            $song=Song::where('genre_id',$request->input('genre_id'))
                            ->orderBy('name', 'asc')
                            ->get();
        }
        elseif ($request->has('brand_id'))
        {
            $song=Song::where('brand_id',$request->input('brand_id'))
                            ->orderBy('name', 'asc')
                            ->get();
        }
        else
        {
            $songs = Song::orderby('name', 'asc')->get();
        }

        $transformedSongs =$songs->map(function($row) {
            return [
                'id'=>$row->id,
                'name'=>$row->name,
                'image_path'=>$row->GetImagePath(),
                'song_path'=>$row->GetSongPath()
            ];
        });

        return response()->json(['data' => $transformedSongs], 200);
    }


    /**
     * Get a list of movies by genre.
     *
     * @param  int  $genreId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSongsByGenre($genreId)
    {
        try {

            // Retrieve songs by genre using whereHas
            $songs = Song::whereHas('genres', function ($query) use ($genreId) {
                $query->where('genres.id', $genreId);
            })->get();

            // Add the full URL path for poster to each movie
            foreach ($songs as $row) 
            {
                if ($row->song_path != null) 
                {
                    $row->song_path = Song::getFullPath($row->song_path);
                }
                else 
                {
                    $row->song_path = "";
                }

                if ($row->poster != null) 
                {
                    $row->poster = Song::getFullPath($row->poster);
                }
                else 
                {
                    $row->poster = "";
                }
            }    


            // Return the list of movies as JSON response
            return response()->json(['data' => $songs], 200);

        } catch (\Exception $e) {
            // Handle any exceptions, e.g., database errors
            return response()->json(['error' => 'Internal Server Error' . $e], 500);
        }
    }

    /**
     * Get the songs uploaded by a specific user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function songsByUser(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $songs = $user->songs()->with('genres')->get();

        // Add the full URL path for poster to each movie
        foreach ($songs as $row) 
        {
            if ($row->song_path != null) 
            {
                $row->song_path = Song::getFullPath($row->song_path);
            }
            else 
            {
                $row->song_path = "";
            }

            if ($row->poster != null) 
            {
                $row->poster = Song::getFullPath($row->poster);
            }
            else 
            {
                $row->poster = "";
            }
        }

        return response()->json(['data' => $songs], 200);
    }

    public function playSong(Request $request)
    {
        $user = $request->user();

        $song_id = $request->song_id;

        // Find the song by its ID
        $song = Song::findOrFail($song_id);

        // Increment the views count
        $song->increment('views');

        // Create a new SongHistory record
        SongHistory::create([
            'song_id' => $song->id,
            'user_id' => $user->id, // Assuming the user is authenticated
        ]);

        // Transform the output as needed
        $transformedData = [
            'id' => $song->id,
            'name' => $song->name,
            'genres_id' => $song->genres_id,
            'song_path' => Song::getFullPath($song->song_path),
            'poster' => Song::getFullPath($song->poster),

            // Add more attributes as needed
            'views' => $song->views,
             
            // Get the count of likes for the song
            'likes_count' => $song->likes()->count(),

            // Get the count of comments for the song
            'comments_count' => $song->comments()->count(),

            'created_at' => $song->created_at,
            'updated_at' => $song->updated_at,
        ];

        return response()->json(['data' => $transformedData], 200);
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

            // $request->validate([
            //     'name' => 'required|string',
            //     'genres_id' => 'required|exists:genres,id',
            //     'song' => 'required|file|mimes:mp3',
            //     'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //     // 'user_id' => 'nullable|exists:users,id',
            // ]);

            $request->validate([
                'name' => 'nullable|string',
                'genres_id' => 'nullable|exists:genres,id',
                'song' => 'required|file',
                'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'user_id' => 'nullable|exists:users,id',
            ]);


            // Upload song file
            // $songPath = $request->file('song')->store('songs');

            // $songPath = Storage::putFile('songs', $request->file('song'));
            $songPath = Storage::disk('public')->putFile('songs', $request->file('song'));

            // Upload poster if provided
            $posterPath = null;

            if ($request->hasFile('poster')) {
                // $posterPath = $request->file('poster')->store('poster');
                $posterPath = Storage::disk('public')->putFile('songs/poster', $request->file('poster'));
            }

            // Create song record
            $song = new Song();
            $song->name = $request->name;
            $song->genres_id = $request->genres_id;
            $song->song_path = $songPath;
            $song->poster = $posterPath;
            $song->user_id = $user->id;
            $song->save();

            // return response()->json(['message' => 'Song uploaded successfully'], 201);

            return response()->json(['message' => 'Song uploaded successfully' . $posterPath], 201);

        } catch (ValidationException $e) {
            print($e->validator->errors());
            return response()->json(['error' => $e->validator->errors()], 200);
        }
    }

    public function homePageData(Request $request)
    {
        // Fetch recent songs based on views
        $recentSongs = Song::orderBy('views', 'asc')->take(100)->get();

        return response()->json(['songs' => $recentSongs]);
    }
}