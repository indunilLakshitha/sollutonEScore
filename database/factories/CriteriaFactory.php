<?php

namespace Database\Factories;

use App\Models\Criteria;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Criteria>
 */
class CriteriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'count' => fake()->numberBetween(1, 100),
            'added_by' => User::factory(),
            'status' => fake()->boolean(80), // 80% chance of being active
        ];
    }

    /**
     * Indicate that the criteria is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => true,
        ]);
    }

    /**
     * Indicate that the criteria is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => false,
        ]);
    }
}
