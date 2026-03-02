@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">User Performance Ranking</h1>
    
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">Overall Rank</th>
                    <th class="px-4 py-2 text-left">Dept Rank</th>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Department</th>
                    <th class="px-4 py-2 text-right">Experience</th>
                    <th class="px-4 py-2 text-right">Tasks</th>
                    <th class="px-4 py-2 text-right">Performance Score</th>
                    <th class="px-4 py-2 text-right">Dept Avg</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ranking as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2 font-mono">#{{ $user->overall_rank }}</td>
                    <td class="px-4 py-2 font-mono">#{{ $user->dept_rank }}</td>
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->department }}</td>
                    <td class="px-4 py-2 text-right">{{ $user->experience_years }} yrs</td>
                    <td class="px-4 py-2 text-right">{{ $user->task_count }}</td>
                    <td class="px-4 py-2 text-right font-bold 
                        @if($user->performance_score > 7) text-green-600
                        @elseif($user->performance_score > 4) text-yellow-600
                        @else text-red-600
                        @endif">
                        {{ number_format($user->performance_score, 2) }}
                    </td>
                    <td class="px-4 py-2 text-right">{{ number_format($user->avg_dept_score, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection