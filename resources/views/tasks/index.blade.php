@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <div class="flex items-center gap-3">

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
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>

                    </div>

                    <div>

                        <h1 class="text-2xl font-bold text-gray-900">
                            Task Management
                        </h1>

                        <p class="text-sm text-gray-500 mt-1">
                            Search, filter, analyze and manage your tasks.
                        </p>

                    </div>

                </div>

            </div>

            <div class="flex flex-wrap gap-2">

                <a
                    href="{{ route('tasks.analytics') }}"
                    class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2.5 rounded-xl text-sm font-medium transition shadow-sm">

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14" />
                    </svg>

                    Analytics

                </a>

                <a
                    href="{{ route('tasks.trash') }}"
                    class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-4 py-2.5 rounded-xl text-sm font-medium transition shadow-sm">

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14" />
                    </svg>

                    Trash

                </a>

            </div>

        </div>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

    <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl p-4 flex items-center gap-3">

        <div class="w-9 h-9 bg-green-100 rounded-full flex items-center justify-center">

            <svg
                class="w-5 h-5 text-green-600"
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

        <div>

            <p class="font-semibold">
                Success
            </p>

            <p class="text-sm">
                {{ session('success') }}
            </p>

        </div>

    </div>

    @endif


    {{-- =========================================================
        SEARCH + FILTERS
    ========================================================== --}}

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-100">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                <div>

                    <h2 class="text-lg font-semibold text-gray-900">
                        Search & Filters
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Find exactly the tasks you need.
                    </p>

                </div>

                @if(request()->hasAny([
                'search',
                'status',
                'priority',
                'user_id',
                'due_from',
                'due_to'
                ]))

                <a
                    href="{{ route('tasks.index') }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-red-600 hover:text-red-700">

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>

                    Clear Filters

                </a>

                @endif

            </div>

        </div>


        <form
            method="GET"
            action="{{ route('tasks.index') }}"
            class="p-6">

            {{-- Search Bar --}}

            <div class="mb-5">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Search Tasks
                </label>

                <div class="relative">

                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">

                        <svg
                            class="w-5 h-5 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z" />
                        </svg>

                    </div>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by task title, description or user name..."
                        class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">

                </div>

            </div>


            {{-- Filters --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Status --}}

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                        <option value="">
                            All Status
                        </option>

                        <option
                            value="pending"
                            @selected(request('status')==='pending' )>
                            Pending
                        </option>

                        <option
                            value="in_progress"
                            @selected(request('status')==='in_progress' )>
                            In Progress
                        </option>

                        <option
                            value="completed"
                            @selected(request('status')==='completed' )>
                            Completed
                        </option>

                    </select>

                </div>


                {{-- Priority --}}

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Priority
                    </label>

                    <select
                        name="priority"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                        <option value="">
                            All Priorities
                        </option>

                        @for($priority = 1; $priority <= 5; $priority++)

                            <option
                            value="{{ $priority }}"
                            @selected((string) request('priority')===(string) $priority)>
                            Priority {{ $priority }}
                            </option>

                            @endfor

                    </select>

                </div>


                {{-- User --}}

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Assigned User
                    </label>

                    <select
                        name="user_id"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                        <option value="">
                            All Users
                        </option>

                        @foreach($users as $user)

                        <option
                            value="{{ $user->id }}"
                            @selected((string) request('user_id')===(string) $user->id)
                            >
                            {{ $user->name }}
                        </option>

                        @endforeach

                    </select>

                </div>


                {{-- Per Page --}}

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Records Per Page
                    </label>

                    <select
                        name="per_page"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                        @foreach([5, 10, 15, 25, 50] as $number)

                        <option
                            value="{{ $number }}"
                            @selected((int) $perPage===$number)>
                            {{ $number }} Records
                        </option>

                        @endforeach

                    </select>

                </div>


                {{-- Due From --}}

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Due Date From
                    </label>

                    <input
                        type="date"
                        name="due_from"
                        value="{{ request('due_from') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                </div>


                {{-- Due To --}}

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Due Date To
                    </label>

                    <input
                        type="date"
                        name="due_to"
                        value="{{ request('due_to') }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                </div>


                {{-- Sort By --}}

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Sort By
                    </label>

                    <select
                        name="sort_by"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                        @foreach([
                        'id' => 'ID',
                        'title' => 'Title',
                        'status' => 'Status',
                        'priority' => 'Priority',
                        'due_date' => 'Due Date',
                        'created_at' => 'Created Date'
                        ] as $value => $label)

                        <option
                            value="{{ $value }}"
                            @selected($sortBy===$value)>
                            {{ $label }}
                        </option>

                        @endforeach

                    </select>

                </div>


                {{-- Sort Direction --}}

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Sort Direction
                    </label>

                    <select
                        name="sort_direction"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                        <option
                            value="asc"
                            @selected($sortDirection==='asc' )>
                            Ascending
                        </option>

                        <option
                            value="desc"
                            @selected($sortDirection==='desc' )>
                            Descending
                        </option>

                    </select>

                </div>

            </div>


            {{-- Filter Buttons --}}

            <div class="flex flex-wrap items-center gap-3 mt-6 pt-5 border-t border-gray-100">

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition shadow-sm">

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 12.414V19a1 1 0 01-.553.894l-4 2A1 1 0 018 21v-8.586L3.293 6.707A1 1 0 013 6V4z" />
                    </svg>

                    Apply Filters

                </button>


                <a
                    href="{{ route('tasks.index') }}"
                    class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-semibold transition">
                    Reset
                </a>


                <a
                    href="{{ route('tasks.export', request()->query()) }}"
                    class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition shadow-sm">

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>

                    Export CSV

                </a>

            </div>

        </form>

    </div>


    {{-- =========================================================
        TASK TABLE
    ========================================================== --}}

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        {{-- Table Header --}}

        <div class="px-6 py-5 border-b border-gray-100">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                <div>

                    <h2 class="text-lg font-semibold text-gray-900">
                        All Tasks
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $tasks->total() }} total tasks found
                    </p>

                </div>

                <div class="text-sm text-gray-500">

                    @if($tasks->total() > 0)

                    Showing
                    <span class="font-semibold text-gray-800">
                        {{ $tasks->firstItem() }}
                    </span>

                    -
                    <span class="font-semibold text-gray-800">
                        {{ $tasks->lastItem() }}
                    </span>

                    @else

                    No results

                    @endif

                </div>

            </div>

        </div>


        {{-- Table --}}

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-gray-50 border-b border-gray-100">

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            ID
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Task
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Assigned To
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Priority
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Due Date
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($tasks as $task)

                    <tr class="hover:bg-gray-50 transition">

                        {{-- ID --}}

                        <td class="px-6 py-4 whitespace-nowrap">

                            <span class="text-sm font-semibold text-gray-500">
                                {{ $task->id }}
                            </span>

                        </td>


                        {{-- Task --}}

                        <td class="px-6 py-4">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">

                                    <svg
                                        class="w-5 h-5 text-blue-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>

                                </div>

                                <div class="min-w-0">

                                    <p class="font-semibold text-gray-900 truncate max-w-xs">
                                        {{ $task->title }}
                                    </p>

                                    @if($task->description)

                                    <p class="text-xs text-gray-500 truncate max-w-xs mt-1">
                                        {{ $task->description }}
                                    </p>

                                    @endif

                                </div>

                            </div>

                        </td>


                        {{-- User --}}

                        <td class="px-6 py-4 whitespace-nowrap">

                            @if($task->user)

                            <div class="flex items-center gap-2">

                                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">

                                    <span class="text-xs font-bold text-gray-600">
                                        {{ strtoupper(substr($task->user->name, 0, 1)) }}
                                    </span>

                                </div>

                                <span class="text-sm text-gray-700">
                                    {{ $task->user->name }}
                                </span>

                            </div>

                            @else

                            <span class="text-sm text-gray-400">
                                Unassigned
                            </span>

                            @endif

                        </td>


                        {{-- Status --}}

                        <td class="px-6 py-4 whitespace-nowrap">

                            @if($task->status === 'completed')

                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">

                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>

                                Completed

                            </span>

                            @elseif($task->status === 'in_progress')

                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">

                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>

                                In Progress

                            </span>

                            @else

                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">

                                <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>

                                Pending

                            </span>

                            @endif

                        </td>


                        {{-- Priority --}}

                        <td class="px-6 py-4 whitespace-nowrap">

                            @php

                            $priority = (int) $task->priority;

                            @endphp

                            <div class="flex items-center gap-1">

                                @for($i = 1; $i <= 5; $i++)

                                    <span
                                    class="w-1.5 h-4 rounded-sm
                                            {{ $i <= $priority ? 'bg-blue-500' : 'bg-gray-200' }}"></span>

                                    @endfor

                                    <span class="ml-2 text-xs font-medium text-gray-500">
                                        P{{ $priority }}
                                    </span>

                            </div>

                        </td>


                        {{-- Due Date --}}

                        <td class="px-6 py-4 whitespace-nowrap">

                            @if($task->due_date)

                            @php

                            $isOverdue =
                            $task->due_date->isPast()
                            && $task->status !== 'completed';

                            @endphp

                            <div class="flex items-center gap-2">

                                <svg
                                    class="w-4 h-4 {{ $isOverdue ? 'text-red-500' : 'text-gray-400' }}"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>

                                <span class="text-sm {{ $isOverdue ? 'text-red-600 font-semibold' : 'text-gray-600' }}">

                                    {{ $task->due_date->format('M d, Y') }}

                                </span>

                            </div>

                            @if($isOverdue)

                            <span class="text-xs text-red-500 ml-6">
                                Overdue
                            </span>

                            @endif

                            @else

                            <span class="text-sm text-gray-400">
                                No due date
                            </span>

                            @endif

                        </td>


                        {{-- Actions --}}

                        <td class="px-6 py-4 whitespace-nowrap">

                            <div class="flex items-center justify-end gap-2">

                                {{-- View --}}

                                <a
                                    href="{{ route('tasks.show', $task) }}"
                                    title="View Task"
                                    class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition">

                                    <svg
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                                    </svg>

                                </a>


                                {{-- Delete --}}

                                <form
                                    method="POST"
                                    action="{{ route('tasks.destroy', $task) }}"
                                    onsubmit="return confirm('Move this task to trash?')">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        title="Move to Trash"
                                        class="w-9 h-9 inline-flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition">

                                        <svg
                                            class="w-4 h-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862A2 2 0 015.867 19.142L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14" />
                                        </svg>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="7"
                            class="px-6 py-16 text-center">

                            <div class="flex flex-col items-center">

                                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">

                                    <svg
                                        class="w-8 h-8 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>

                                </div>

                                <h3 class="text-lg font-semibold text-gray-900">
                                    No tasks found
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Try changing your search or filter criteria.
                                </p>

                                <a
                                    href="{{ route('tasks.index') }}"
                                    class="mt-4 text-sm font-semibold text-blue-600 hover:text-blue-700">
                                    Clear all filters
                                </a>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}

        @if($tasks->hasPages())

        <div class="px-6 py-5 border-t border-gray-100">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <p class="text-sm text-gray-500">

                    Showing
                    <span class="font-semibold text-gray-800">
                        {{ $tasks->firstItem() }}
                    </span>

                    to

                    <span class="font-semibold text-gray-800">
                        {{ $tasks->lastItem() }}
                    </span>

                    of

                    <span class="font-semibold text-gray-800">
                        {{ $tasks->total() }}
                    </span>

                    tasks

                </p>

                <div>
                    {{ $tasks->links() }}
                </div>

            </div>

        </div>

        @else

        <div class="px-6 py-4 border-t border-gray-100">

            <p class="text-sm text-gray-500">

                Showing
                <span class="font-semibold text-gray-800">
                    {{ $tasks->total() }}
                </span>
                {{ Str::plural('task', $tasks->total()) }}

            </p>

        </div>

        @endif

    </div>

</div>

@endsection