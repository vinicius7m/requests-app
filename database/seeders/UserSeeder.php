<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::firstOrCreate(
            ['is_admin' => true],
            [
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'password' => Hash::make(config('app.admin_user_password')),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );

        \App\Models\User::factory()->count(5)->create();
    }
}
