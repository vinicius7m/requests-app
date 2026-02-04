<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['open', 'approved', 'rejected']);

        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'category' => fake()->randomElement(['ti', 'financeiro', 'manutencao']),
            'status' => $status,
            'reason' => in_array($status, ['approved', 'rejected']) ? fake()->sentence(12) : null,
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
