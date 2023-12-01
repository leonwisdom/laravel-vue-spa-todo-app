<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create([
            'username' => 'example',
            'email' => 'example@example.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('example'),
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::factory(14)->create();
        \App\Models\Note::factory(100)->create();
    }
}
