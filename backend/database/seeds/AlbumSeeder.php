<?php

use App\Models\Album;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/albums');

        if($response->failed()){
            return;
        }

        $albums = collect($response->json());

        $albums->each(function($album) {
            Album::create([
                'user_id' => $album['userId'], 
                'title' => $album['title'], 
            ]);
        });
    }
}
