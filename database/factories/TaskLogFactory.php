<?php
// database/factories/TaskLogFactory.php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskLogFactory extends Factory
{
    public function definition()
    {
        return [
            'task_id' => Task::factory(),
            'action' => fake()->randomElement(['created', 'updated', 'status_changed', 'commented']),
            'details' => fake()->sentence(),
        ];
    }
}