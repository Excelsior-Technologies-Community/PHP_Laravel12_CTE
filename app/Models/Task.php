<?php
// app/Models/Task.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'user_id', 'parent_task_id', 
        'status', 'priority', 'due_date'
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Task::class, 'parent_task_id');
    }

    public function children()
    {
        return $this->hasMany(Task::class, 'parent_task_id');
    }

    public function logs()
    {
        return $this->hasMany(TaskLog::class);
    }
}