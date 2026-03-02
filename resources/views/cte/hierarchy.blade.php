@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Task Hierarchy Tree</h1>
    
    <div class="space-y-2">
        @foreach($hierarchy as $task)
            <div class="p-2 {{ $task->level == 0 ? 'bg-blue-50' : 'bg-gray-50 ml-' . ($task->level * 4) }}">
                <div class="flex items-center">
                    <span class="font-mono text-sm text-gray-500 mr-2">
                        {{ str_repeat('└─ ', $task->level) }}
                    </span>
                    <span class="font-medium">{{ $task->title }}</span>
                    <span class="ml-2 text-xs text-gray-500">
                        (Level {{ $task->level }})
                    </span>
                </div>
                <div class="text-xs text-gray-400 mt-1">
                    Path: {{ $task->path_names }}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection