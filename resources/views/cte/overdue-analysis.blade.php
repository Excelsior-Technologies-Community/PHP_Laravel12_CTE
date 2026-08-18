@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold">
            Overdue Task Workload Analysis
        </h1>

        <p class="text-gray-500 mt-1">
            Analyze overdue tasks, upcoming deadlines,
            completion rates and workload status using layered CTEs.
        </p>
    </div>


    @php
        $totalTasks = $analysis->sum('total_tasks');
        $totalCompleted = $analysis->sum('completed_tasks');
        $totalOverdue = $analysis->sum('overdue_tasks');
        $totalDueSoon = $analysis->sum('due_soon_tasks');
    @endphp


    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">

        <div class="bg-gray-50 rounded-lg p-4">
            <p class="text-sm text-gray-500">
                Total Tasks
            </p>

            <p class="text-3xl font-bold">
                {{ $totalTasks }}
            </p>
        </div>


        <div class="bg-green-50 rounded-lg p-4">
            <p class="text-sm text-gray-500">
                Completed
            </p>

            <p class="text-3xl font-bold text-green-600">
                {{ $totalCompleted }}
            </p>
        </div>


        <div class="bg-red-50 rounded-lg p-4">
            <p class="text-sm text-gray-500">
                Overdue
            </p>

            <p class="text-3xl font-bold text-red-600">
                {{ $totalOverdue }}
            </p>
        </div>


        <div class="bg-yellow-50 rounded-lg p-4">
            <p class="text-sm text-gray-500">
                Due Soon
            </p>

            <p class="text-3xl font-bold text-yellow-600">
                {{ $totalDueSoon }}
            </p>
        </div>

    </div>


    {{-- User Workload Table --}}
    <div class="overflow-x-auto">

        <table class="min-w-full table-auto">

            <thead class="bg-gray-50">

                <tr>

                    <th class="px-4 py-3 text-left">
                        User
                    </th>

                    <th class="px-4 py-3 text-left">
                        Department
                    </th>

                    <th class="px-4 py-3 text-right">
                        Total
                    </th>

                    <th class="px-4 py-3 text-right">
                        Completed
                    </th>

                    <th class="px-4 py-3 text-right">
                        Overdue
                    </th>

                    <th class="px-4 py-3 text-right">
                        Due Soon
                    </th>

                    <th class="px-4 py-3 text-right">
                        Avg Priority
                    </th>

                    <th class="px-4 py-3 text-right">
                        Completion
                    </th>

                    <th class="px-4 py-3 text-left">
                        Workload
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($analysis as $user)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-4 py-3 font-medium">
                            {{ $user->name }}
                        </td>


                        <td class="px-4 py-3">
                            {{ $user->department }}
                        </td>


                        <td class="px-4 py-3 text-right">
                            {{ $user->total_tasks }}
                        </td>


                        <td class="px-4 py-3 text-right text-green-600">
                            {{ $user->completed_tasks }}
                        </td>


                        <td class="px-4 py-3 text-right font-bold text-red-600">
                            {{ $user->overdue_tasks }}
                        </td>


                        <td class="px-4 py-3 text-right text-yellow-600">
                            {{ $user->due_soon_tasks }}
                        </td>


                        <td class="px-4 py-3 text-right">
                            {{ number_format($user->avg_priority, 1) }}
                        </td>


                        <td class="px-4 py-3 text-right">
                            {{ number_format($user->completion_rate, 1) }}%
                        </td>


                        <td class="px-4 py-3">

                            <span
                                class="px-2 py-1 rounded text-xs font-medium

                                @if($user->workload_status === 'Critical')
                                    bg-red-100 text-red-800

                                @elseif($user->workload_status === 'High')
                                    bg-orange-100 text-orange-800

                                @elseif($user->workload_status === 'Attention Required')
                                    bg-yellow-100 text-yellow-800

                                @else
                                    bg-green-100 text-green-800
                                @endif
                            "
                            >
                                {{ $user->workload_status }}
                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="9"
                            class="px-4 py-8 text-center text-gray-500"
                        >
                            No task workload data found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection