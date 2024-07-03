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
            'phone_number' => '41988885555',
            'password' => Hash::make('123456a', ['rounds' => 12]),
            'cpf' => '12345678901',
        ]);
    
        User::create([
            'name' => 'Joao',
            'email' => 'joao@gmail.com',
            'phone_number' => '41988885554',
            'password' => Hash::make('123456a', ['rounds' => 12]),
            'cpf' => '12345678901',
        ]);
        
    }
}
