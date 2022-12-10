<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::factory()->create([
            'name' => fake()->name(),
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);
        
        // User::factory()->create();
    }
}
