@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>

                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-xl bg-purple-100 flex items-center justify-center">

                        <svg
                            class="w-6 h-6 text-purple-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 19V6l12-3v13M9 19c0 1.657-1.79 3-4 3s-4-1.343-4-3 1.79-3 4-3 4 1.343 4 3zm12-3c0 1.657-1.79 3-4 3s-4-1.343-4-3 1.79-3 4-3 4 1.343 4 3z" />
                        </svg>

                    </div>

                    <div>

                        <h1 class="text-2xl font-bold text-gray-900">
                            Task Analytics
                        </h1>

                        <p class="text-sm text-gray-500 mt-1">
                            Overview of task performance and statistics.
                        </p>

                    </div>

                </div>

            </div>

            <a
                href="{{ route('tasks.index') }}"
                class="inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-4 py-2.5 rounded-xl text-sm font-medium transition">

                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>

                Back to Tasks

            </a>

        </div>

    </div>


    {{-- Statistics Cards --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

        {{-- Total --}}

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Tasks
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $totalTasks }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center">

                    <svg
                        class="w-6 h-6 text-blue-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5a3 3 0 006 0" />

                    </svg>

                </div>

            </div>

        </div>


        {{-- Completed --}}

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Completed
                    </p>

                    <h2 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $completedTasks }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-green-100 flex items-center justify-center">

                    <svg
                        class="w-6 h-6 text-green-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Pending --}}

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Pending
                    </p>

                    <h2 class="text-3xl font-bold text-gray-600 mt-2">
                        {{ $pendingTasks }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-gray-100 flex items-center justify-center">

                    <svg
                        class="w-6 h-6 text-gray-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                </div>

            </div>

        </div>


        {{-- In Progress --}}

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        In Progress
                    </p>

                    <h2 class="text-3xl font-bold text-yellow-600 mt-2">
                        {{ $inProgressTasks }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-yellow-100 flex items-center justify-center">

                    <svg
                        class="w-6 h-6 text-yellow-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4l3 3" />

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                            stroke-width="2" />

                    </svg>

                </div>

            </div>

        </div>


        {{-- Overdue --}}

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Overdue
                    </p>

                    <h2 class="text-3xl font-bold text-red-600 mt-2">
                        {{ $overdueTasks }}
                    </h2>

                </div>

                <div class="w-11 h-11 rounded-xl bg-red-100 flex items-center justify-center">

                    <svg
                        class="w-6 h-6 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z" />
                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- Completion Rate --}}

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>

                <h2 class="text-lg font-semibold text-gray-900">
                    Completion Rate
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Percentage of tasks that have been completed.
                </p>

            </div>

            <div class="text-3xl font-bold text-purple-600">
                {{ number_format($completionRate, 1) }}%
            </div>

        </div>

        <div class="w-full bg-gray-100 rounded-full h-3 mt-5">

            <div
                class="bg-purple-600 h-3 rounded-full transition-all"
                style="width: {{ min(100, max(0, $completionRate)) }}%"></div>

        </div>

    </div>


    {{-- User Statistics --}}

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-gray-100">

            <h2 class="text-lg font-semibold text-gray-900">
                User Performance
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Task performance by user.
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            User
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Department
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">
                            Total
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">
                            Completed
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">
                            Pending
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">
                            In Progress
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($userStats as $user)

                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4">

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center">

                                    <span class="text-sm font-bold text-blue-600">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>

                                </div>

                                <span class="font-medium text-gray-900">
                                    {{ $user->name }}
                                </span>

                            </div>

                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $user->department ?? 'N/A' }}
                        </td>

                        <td class="px-6 py-4 text-center font-semibold">
                            {{ $user->total_tasks }}
                        </td>

                        <td class="px-6 py-4 text-center">

                            <span class="px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                {{ $user->completed_tasks }}
                            </span>

                        </td>

                        <td class="px-6 py-4 text-center">

                            <span class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">
                                {{ $user->pending_tasks }}
                            </span>

                        </td>

                        <td class="px-6 py-4 text-center">

                            <span class="px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                {{ $user->in_progress_tasks }}
                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="6"
                            class="px-6 py-10 text-center text-gray-500">
                            No user statistics available.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Department Statistics --}}

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-gray-100">

            <h2 class="text-lg font-semibold text-gray-900">
                Department Statistics
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Task distribution by department.
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Department
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">
                            Total Tasks
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">
                            Completed
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">
                            Pending
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($departmentStats as $department)

                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $department->department }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ $department->total_tasks }}
                        </td>

                        <td class="px-6 py-4 text-center">

                            <span class="px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                {{ $department->completed_tasks }}
                            </span>

                        </td>

                        <td class="px-6 py-4 text-center">

                            <span class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">
                                {{ $department->pending_tasks }}
                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="4"
                            class="px-6 py-10 text-center text-gray-500">
                            No department statistics available.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Priority Statistics --}}

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-gray-100">

            <h2 class="text-lg font-semibold text-gray-900">
                Priority Distribution
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Number of tasks by priority level.
            </p>

        </div>

        <div class="p-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

                @foreach($priorityStats as $priority)

                <div class="border border-gray-100 rounded-xl p-4 bg-gray-50">

                    <div class="flex items-center justify-between">

                        <span class="text-sm font-medium text-gray-600">
                            Priority {{ $priority->priority }}
                        </span>

                        <span class="text-lg font-bold text-gray-900">
                            {{ $priority->total }}
                        </span>

                    </div>

                    <div class="flex gap-1 mt-3">

                        @for($i = 1; $i <= 5; $i++)

                            <span
                            class="h-2 flex-1 rounded
                                    {{ $i <= $priority->priority ? 'bg-blue-500' : 'bg-gray-200' }}"></span>

                            @endfor

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </div>


    {{-- Recent Tasks --}}

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-gray-100">

            <h2 class="text-lg font-semibold text-gray-900">
                Recent Tasks
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Recently created tasks.
            </p>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Task
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            User
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($recentTasks as $task)

                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4">

                            <span class="font-medium text-gray-900">
                                {{ $task->title }}
                            </span>

                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ optional($task->user)->name ?? 'N/A' }}
                        </td>

                        <td class="px-6 py-4">

                            @if($task->status === 'completed')

                            <span class="px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                Completed
                            </span>

                            @elseif($task->status === 'in_progress')

                            <span class="px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                In Progress
                            </span>

                            @else

                            <span class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">
                                Pending
                            </span>

                            @endif

                        </td>

                        <td class="px-6 py-4 text-right">

                            <a
                                href="{{ route('tasks.show', $task) }}"
                                class="text-blue-600 hover:text-blue-700 text-sm font-semibold">
                                View
                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="4"
                            class="px-6 py-10 text-center text-gray-500">
                            No recent tasks available.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection