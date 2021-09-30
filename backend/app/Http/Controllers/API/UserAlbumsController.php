<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAlbumsController extends Controller
{
    public function index(User $user) {
        
        $albums = $user->albums()->with(['user', 'photos'])->latest()->paginate(10);

        return response()->json([
            'albums' => $albums
        ], 200);
    }
}
