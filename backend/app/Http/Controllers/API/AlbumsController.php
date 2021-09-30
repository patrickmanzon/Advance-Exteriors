<?php

namespace App\Http\Controllers\API;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrUpdateAlbumRequest;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $albums = Album::with(['user', 'photos'])->latest()->paginate(10);
        
        if($request->has('all')){
            $albums = Album::with(['user', 'photos'])->latest()->get();
        }   


        return response()->json([
            'albums' => $albums
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrUpdateAlbumRequest $request)
    {
        $album = Album::create($request->validated());

        return response()->json([
            'album' => $album
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        return response()->json([
            'album' => $album->fresh()
        ], 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateOrUpdateAlbumRequest $request, Album $album)
    {
        $album->update($request->validated());

        return response()->json([
            'album' => $album->fresh()
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->photos->each->delete();

        $album->delete();

        return response()->json([
            'album' => $album
        ], 201);

    }
}
