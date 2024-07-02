<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Gustavo',
            'email' => 'gustavo@gmail.com',
            'password' => Hash::make('123456a', ['rounds' => 12]),
        ]);
    
        User::create([
            'name' => 'Joao',
            'email' => 'joao@gmail.com',
            'password' => Hash::make('123456a', ['rounds' => 12]),
        ]);
        

    }
}
