<?php

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

            'parent_task_id' => null,

            'status' => fake()->randomElement([
                'pending',
                'in_progress',
                'completed',
            ]),

            'priority' => fake()->numberBetween(1, 5),

            /*
             * Generate both past and future due dates
             * so overdue analysis has useful data.
             */
            'due_date' => fake()->dateTimeBetween(
                '-30 days',
                '+30 days'
            ),
        ];
    }
}