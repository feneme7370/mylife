<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create(
            array('id' => '1','name' => 'Federico Marasco','birthdate' => NULL,'sex' => NULL,'description' => NULL,'adress' => NULL,'city' => NULL,'country' => NULL,'email' => 'marascofederico95@gmail.com','email_verified_at' => NULL,'password' => '$2y$12$EV7p27L5guCp6t/eih7dpeiqU127.5TDQ0uFynneSC.4RtlNciQmW','two_factor_secret' => NULL,'two_factor_recovery_codes' => NULL,'two_factor_confirmed_at' => NULL,'remember_token' => NULL,'current_team_id' => NULL,'profile_photo_path' => NULL,'created_at' => '2025-02-24 09:21:05','updated_at' => '2025-02-24 09:21:05')
        );
    }
}
