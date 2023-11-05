<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin3@gmail.com',
            'role' => 'admin',
            'gender' => 'male',
            'password' => Hash::make('admin123')
        ]);
    }
}
