<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::all()->each(function ($user) {
            \App\Models\Request::factory()
            ->count(rand(3, 10))
            ->create([
                'user_id' => $user->id,
            ]);
        });

    }
}
