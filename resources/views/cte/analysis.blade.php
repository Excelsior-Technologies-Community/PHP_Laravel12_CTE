@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Complex Task Analysis</h1>
    
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">User</th>
                    <th class="px-4 py-2 text-left">Department</th>
                    <th class="px-4 py-2 text-right">Completed Tasks</th>
                    <th class="px-4 py-2 text-right">Avg Hours</th>
                    <th class="px-4 py-2 text-right">Main Task Hours</th>
                    <th class="px-4 py-2 text-right">Subtask Hours</th>
                    <th class="px-4 py-2 text-right">Efficiency %</th>
                    <th class="px-4 py-2 text-left">Performance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($analysis as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->department }}</td>
                    <td class="px-4 py-2 text-right">{{ $user->completed_tasks }}</td>
                    <td class="px-4 py-2 text-right">{{ number_format($user->avg_completion_hours, 1) }}h</td>
                    <td class="px-4 py-2 text-right">{{ number_format($user->avg_maintask_hours ?? 0, 1) }}h</td>
                    <td class="px-4 py-2 text-right">{{ number_format($user->avg_subtask_hours ?? 0, 1) }}h</td>
                    <td class="px-4 py-2 text-right">{{ $user->efficiency_ratio }}%</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded text-xs 
                            @if($user->performance_category == 'Above Average') bg-green-100 text-green-800
                            @elseif($user->performance_category == 'Average') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ $user->performance_category }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection