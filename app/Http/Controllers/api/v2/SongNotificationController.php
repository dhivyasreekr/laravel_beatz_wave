<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\SongNotification;
use Illuminate\Http\Request;

class SongNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $songNotification = SongNotification::all();
    
        
        return response()->json(['data' => $songNotification], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SongNotification $songNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SongNotification $songNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SongNotification $songNotification)
    {
        //
    }
}
