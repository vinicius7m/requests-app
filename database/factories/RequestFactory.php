<?php

namespace Database\Factories;

use App\Enums\RequestStatus;
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
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'category' => fake()->randomElement(['ti', 'financeiro', 'manutencao']),
            'status' => RequestStatus::OPEN,
            'reason' => null,
            'user_id' => User::factory(),
        ];
    }

    public function approved(): static
    {
        return $this->state(fn () => [
            'status' => RequestStatus::APPROVED,
            'reason' => fake()->sentence(),
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn () => [
            'status' => RequestStatus::REJECTED,
            'reason' => fake()->sentence(),
        ]);
    }

}
