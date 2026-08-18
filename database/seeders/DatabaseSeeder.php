<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskLog;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        /*
         * Create 10 users.
         */
        User::factory(10)->create();

        /*
         * Create 20 main/root tasks.
         */
        $mainTasks = Task::factory(20)->create([
            'parent_task_id' => null,
        ]);

        /*
         * Create 30 subtasks.
         *
         * Each subtask receives a random
         * existing main task as its parent.
         */
        Task::factory(30)->create()->each(function ($task) use ($mainTasks) {
            $task->update([
                'parent_task_id' => $mainTasks->random()->id,
            ]);
        });

        /*
         * Create 3 logs for every task.
         */
        Task::all()->each(function ($task) {
            TaskLog::factory(3)->create([
                'task_id' => $task->id,
            ]);
        });
    }
}