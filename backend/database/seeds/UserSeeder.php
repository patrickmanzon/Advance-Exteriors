<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/users');

        if($response->failed()){
            return;
        }

        $users = collect($response->json());

        $statuses = collect([
            'delivered',
            'info',
            'pending',
            'danger'
        ]);

        $users->each(function($user) use($statuses){
            User::create([
                'name' => $user['name'], 
                'username' => $user['username'], 
                'email' => $user['email'], 
                'phone' => $user['phone'], 
                'website' => $user['website'], 
                'status' => $statuses->random(),
                'company' => $user['company']['name'],
                'password' => 'secret'
            ]);
        });


    }
}
