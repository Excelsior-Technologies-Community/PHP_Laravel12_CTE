@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">

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

                <div>

                    <div class="flex items-center gap-2">

                        <h1 class="text-2xl font-bold text-gray-900">
                            Task Details
                        </h1>

                        <span class="text-sm text-gray-400">
                            ID{{ $task->id }}
                        </span>

                    </div>

                    <p class="text-sm text-gray-500 mt-1">
                        Complete information about this task.
                    </p>

                </div>

            </div>


            {{-- Header Actions --}}
            <div class="flex flex-wrap gap-2">

                <a
                    href="{{ route('tasks.index') }}"
                    class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2.5 rounded-xl text-sm font-medium transition">

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

                    Back

                </a>


                <form
                    method="POST"
                    action="{{ route('tasks.destroy', $task) }}"
                    onsubmit="return confirm('Move this task to trash?')">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2.5 rounded-xl text-sm font-medium transition">

                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7" />
                        </svg>

                        Delete

                    </button>

                </form>

            </div>

        </div>

    </div>


    {{-- Main Information Cards --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Basic Information --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-100">

                <h2 class="text-lg font-semibold text-gray-900">
                    Basic Information
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    General information about this task.
                </p>

            </div>

            <div class="p-6 space-y-5">

                {{-- ID --}}
                <div class="flex items-start justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Task ID
                    </span>

                    <span class="text-sm font-semibold text-gray-900">
                        #{{ $task->id }}
                    </span>

                </div>


                {{-- Title --}}
                <div>

                    <span class="text-sm text-gray-500">
                        Title
                    </span>

                    <p class="text-base font-semibold text-gray-900 mt-1">
                        {{ $task->title }}
                    </p>

                </div>


                {{-- Description --}}
                <div>

                    <span class="text-sm text-gray-500">
                        Description
                    </span>

                    <div class="mt-2 bg-gray-50 rounded-xl p-4 text-sm text-gray-700 leading-relaxed">

                        {{ $task->description ?: 'No description available.' }}

                    </div>

                </div>


                {{-- Status --}}
                <div class="flex items-center justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Status
                    </span>

                    @if($task->status === 'completed')

                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-green-100 text-green-700 text-xs font-semibold">

                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>

                        Completed

                    </span>

                    @elseif($task->status === 'in_progress')

                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">

                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>

                        In Progress

                    </span>

                    @else

                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">

                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>

                        Pending

                    </span>

                    @endif

                </div>


                {{-- Priority --}}
                <div class="flex items-center justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Priority
                    </span>

                    <div class="flex items-center gap-1">

                        @for($i = 1; $i <= 5; $i++)

                            <span
                            class="w-2 h-5 rounded
                                {{ $i <= $task->priority ? 'bg-blue-500' : 'bg-gray-200' }}"></span>

                            @endfor

                            <span class="ml-2 text-sm font-semibold text-gray-700">
                                {{ $task->priority }}/5
                            </span>

                    </div>

                </div>


                {{-- Due Date --}}
                <div class="flex items-center justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Due Date
                    </span>

                    <span class="text-sm font-medium text-gray-900">

                        {{ optional($task->due_date)->format('Y-m-d') ?? 'No due date' }}

                    </span>

                </div>

            </div>

        </div>


        {{-- Relationships --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-100">

                <h2 class="text-lg font-semibold text-gray-900">
                    Relationships
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Users and related task information.
                </p>

            </div>

            <div class="p-6 space-y-5">

                {{-- User --}}
                <div>

                    <span class="text-sm text-gray-500">
                        Assigned User
                    </span>

                    <div class="flex items-center gap-3 mt-2">

                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">

                            <span class="text-sm font-bold text-blue-600">

                                {{ strtoupper(substr(optional($task->user)->name ?? 'N', 0, 1)) }}

                            </span>

                        </div>

                        <div>

                            <p class="font-semibold text-gray-900">
                                {{ optional($task->user)->name ?? 'N/A' }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ optional($task->user)->email ?? '' }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Department --}}
                <div class="flex items-center justify-between">

                    <span class="text-sm text-gray-500">
                        Department
                    </span>

                    <span class="text-sm font-medium text-gray-900">

                        {{ optional($task->user)->department ?? 'N/A' }}

                    </span>

                </div>


                {{-- Parent --}}
                <div>

                    <span class="text-sm text-gray-500">
                        Parent Task
                    </span>

                    <div class="mt-2">

                        @if($task->parent)

                        <a
                            href="{{ route('tasks.show', $task->parent) }}"
                            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium text-sm">

                            <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 5h6v6m-1-5L10 14" />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 13v5a1 1 0 01-1 1H6a1 1 0 01-1-1V6a1 1 0 011-1h5" />

                                </svg>

                            </span>

                            {{ $task->parent->title }}

                        </a>

                        @else

                        <span class="text-sm text-gray-400">
                            No parent task
                        </span>

                        @endif

                    </div>

                </div>


                {{-- Children --}}
                <div class="flex items-center justify-between">

                    <span class="text-sm text-gray-500">
                        Child Tasks
                    </span>

                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">
                        {{ $task->children->count() }}
                    </span>

                </div>


                {{-- Logs --}}
                <div class="flex items-center justify-between">

                    <span class="text-sm text-gray-500">
                        Task Logs
                    </span>

                    <span class="px-3 py-1 rounded-full bg-purple-50 text-purple-700 text-xs font-semibold">
                        {{ $task->logs->count() }}
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- Child Tasks --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-lg font-semibold text-gray-900">
                        Child Tasks
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Tasks associated with this parent task.
                    </p>

                </div>

                <span class="bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full text-sm font-semibold">

                    {{ $task->children->count() }}

                </span>

            </div>

        </div>


        @if($task->children->count())

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            ID
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Title
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

                    @foreach($task->children as $child)

                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 text-sm font-semibold text-gray-700">
                            #{{ $child->id }}
                        </td>

                        <td class="px-6 py-4">

                            <span class="font-medium text-gray-900">
                                {{ $child->title }}
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            @if($child->status === 'completed')

                            <span class="px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                Completed
                            </span>

                            @elseif($child->status === 'in_progress')

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
                                href="{{ route('tasks.show', $child) }}"
                                class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 text-sm font-semibold">

                                View

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>

                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @else

        <div class="p-12 text-center">

            <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center mx-auto mb-3">

                <svg
                    class="w-6 h-6 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v12m-6-6h12" />
                </svg>

            </div>

            <p class="font-medium text-gray-700">
                No child tasks
            </p>

            <p class="text-sm text-gray-500 mt-1">
                This task doesn't have any child tasks.
            </p>

        </div>

        @endif

    </div>


    {{-- Task Logs --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-lg font-semibold text-gray-900">
                        Task Logs
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Activity history for this task.
                    </p>

                </div>

                <span class="bg-purple-50 text-purple-700 px-3 py-1.5 rounded-full text-sm font-semibold">

                    {{ $task->logs->count() }}

                </span>

            </div>

        </div>


        @if($task->logs->count())

        <div class="divide-y divide-gray-100">

            @foreach($task->logs as $log)

            <div class="p-6 hover:bg-gray-50 transition">

                <div class="flex gap-4">

                    <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0">

                        <svg
                            class="w-5 h-5 text-purple-600"
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

                    <div class="flex-1">

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

                            <h3 class="font-semibold text-gray-900">
                                {{ $log->action }}
                            </h3>

                            <span class="text-xs text-gray-400">
                                {{ optional($log->created_at)->format('Y-m-d H:i:s') }}
                            </span>

                        </div>

                        <p class="text-sm text-gray-600 mt-2">
                            {{ $log->details }}
                        </p>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

        @else

        <div class="p-12 text-center">

            <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center mx-auto mb-3">

                <svg
                    class="w-6 h-6 text-gray-400"
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

            <p class="font-medium text-gray-700">
                No logs available
            </p>

            <p class="text-sm text-gray-500 mt-1">
                Activity for this task will appear here.
            </p>

        </div>

        @endif

    </div>

</div>

@endsection