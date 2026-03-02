<?php
// database/factories/TaskFactory.php

namespace Database\Factories;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'user_id' => User::factory(),
            'status' => fake()->randomElement(['pending', 'in_progress', 'completed']),
            'priority' => fake()->numberBetween(1, 5),
            'due_date' => fake()->dateTimeBetween('now', '+30 days'),
        ];
    }
}