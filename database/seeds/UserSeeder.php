<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = \App\User::create([
            'name' => 'Tester',
            'email' => 'ay232@ya.ru',
            'password' => 'ay232@ya.ru',
            'api_token' => "UYqKfnFVEddt6ZunWpQPN7lYu1eZK37F0a0l5RCfBxeJMMsstTjBQYEO7mE4",
        ]);

        // OAuth user for a passport
        \Laravel\Passport\Client::query()->create([
            'id' => 1,
            'name' => 'Laravel Password Grant Client',
            'secret' => 'CyQaejvE9Tq2ykXW1aCz4aYpxU8OEpJngkVWjpHj',
            'redirect' => 'http://localhost',
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' => 0,
        ]);

    }
}
