@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">User Task Statistics</h1>
    
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">User</th>
                    <th class="px-4 py-2 text-left">Department</th>
                    <th class="px-4 py-2 text-right">Total Tasks</th>
                    <th class="px-4 py-2 text-right">Completed</th>
                    <th class="px-4 py-2 text-right">In Progress</th>
                    <th class="px-4 py-2 text-right">Pending</th>
                    <th class="px-4 py-2 text-right">Avg Priority</th>
                    <th class="px-4 py-2 text-right">Dept Completion Rate</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats as $stat)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $stat->name }}</td>
                    <td class="px-4 py-2">{{ $stat->department }}</td>
                    <td class="px-4 py-2 text-right">{{ $stat->total_tasks }}</td>
                    <td class="px-4 py-2 text-right text-green-600">{{ $stat->completed_tasks }}</td>
                    <td class="px-4 py-2 text-right text-blue-600">{{ $stat->in_progress_tasks }}</td>
                    <td class="px-4 py-2 text-right text-yellow-600">{{ $stat->pending_tasks }}</td>
                    <td class="px-4 py-2 text-right">{{ number_format($stat->avg_priority, 1) }}</td>
                    <td class="px-4 py-2 text-right">{{ number_format($stat->department_completion_rate * 100, 1) }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection