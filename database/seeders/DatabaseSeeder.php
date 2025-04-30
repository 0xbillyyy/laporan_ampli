<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'billy',
            'email' => 'billy@billy.com',
            "password"=> Hash::make("billy")
        ]);
        
        User::factory()->create([
            'name' => 'gilby',
            'email' => 'gilby@gilby.com',
            "password"=> Hash::make("gilby")
        ]);
    }
}
