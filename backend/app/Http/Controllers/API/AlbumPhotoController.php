<?php

namespace App\Http\Controllers\API;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Photo;

class AlbumPhotoController extends Controller
{
    public function index(Album $album)
    {
        $photos = $album->photos()->with('album.user')->latest()->paginate(10);

        return response()->json([
            'photos' => $photos
        ], 200);

    }
}
