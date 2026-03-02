<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskLog;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create users
        User::factory(10)->create();

        // Create main tasks
        Task::factory(20)->create();

        // Create subtasks
        Task::factory(30)->create([
            'parent_task_id' => Task::inRandomOrder()->first()->id
        ]);

        // Create task logs
        Task::all()->each(function ($task) {
            TaskLog::factory(3)->create([
                'task_id' => $task->id
            ]);
        });
    }
}