@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6">Task Timeline Analysis</h1>
    
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-right">Tasks Created</th>
                    <th class="px-4 py-2 text-right">Tasks Completed</th>
                    <th class="px-4 py-2 text-right">Cumulative Created</th>
                    <th class="px-4 py-2 text-right">Cumulative Completed</th>
                    <th class="px-4 py-2 text-right">Completion Rate</th>
                </tr>
            </thead>
            <tbody>
                @foreach($timeline as $day)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $day->date }}</td>
                    <td class="px-4 py-2 text-right">{{ $day->tasks_created }}</td>
                    <td class="px-4 py-2 text-right text-green-600">{{ $day->tasks_completed }}</td>
                    <td class="px-4 py-2 text-right">{{ $day->cumulative_created }}</td>
                    <td class="px-4 py-2 text-right">{{ $day->cumulative_completed }}</td>
                    <td class="px-4 py-2 text-right">
                        @if($day->cumulative_created > 0)
                            {{ number_format(($day->cumulative_completed / $day->cumulative_created) * 100, 1) }}%
                        @else
                            0%
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection