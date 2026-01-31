<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        * Usuário master
        User::factory()->create([
            'name' => 'USUÁRIO MASTER',
            'email' => 'master123@gmail.com',
            'password' => Hash::make('usuariomaster$$'),
            'is_master' => true,
        ]);
        */

        User::factory()->count(5)->create([
            'password' => Hash::make('password123'),
        ]);

        $this->call(RequestSeeder::class);
    }
}
