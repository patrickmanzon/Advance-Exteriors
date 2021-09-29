<?php

use App\Models\Photo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/photos');

        if($response->failed()){
            return;
        }

        $photos = collect($response->json());

        $photos->each(function($photo) {
            Photo::create([
                "album_id" => $photo['albumId'],
                "title" => $photo['title'],
                "url" => $photo['url'],
                "thumbnail_url" => $photo['thumbnailUrl']
            ]);
        });

    }
}
