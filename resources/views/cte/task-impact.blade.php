@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6">

    <div class="mb-6">

        <h1 class="text-2xl font-bold">
            Recursive Task Impact Analysis
        </h1>

        <p class="text-gray-500 mt-1">
            Explore a task and all of its descendants using
            a recursive CTE.
        </p>

    </div>


    {{-- Task Selection --}}
    <form
        method="GET"
        action="{{ route('cte.task-impact') }}"
        class="mb-8"
    >

        <label
            for="task_id"
            class="block text-sm font-medium text-gray-700 mb-2"
        >
            Select Task
        </label>


        <div class="flex flex-col md:flex-row gap-3">

            <select
                id="task_id"
                name="task_id"
                class="border border-gray-300 rounded px-3 py-2 flex-1"
            >

                <option value="">
                    Select a task
                </option>


                @foreach($tasks as $task)

                    <option
                        value="{{ $task->id }}"
                        @selected($selectedTaskId == $task->id)
                    >
                        {{ $task->title }}
                    </option>

                @endforeach

            </select>


            <button
                type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700"
            >
                Analyze Task
            </button>

        </div>

    </form>


    @if(!empty($impact))

        @php
            $summary = $impact[0];
        @endphp


        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">

            <div class="bg-gray-50 rounded-lg p-4">

                <p class="text-sm text-gray-500">
                    Total Tasks
                </p>

                <p class="text-2xl font-bold">
                    {{ $summary->total_tasks }}
                </p>

            </div>


            <div class="bg-yellow-50 rounded-lg p-4">

                <p class="text-sm text-gray-500">
                    Pending
                </p>

                <p class="text-2xl font-bold text-yellow-600">
                    {{ $summary->pending_tasks }}
                </p>

            </div>


            <div class="bg-blue-50 rounded-lg p-4">

                <p class="text-sm text-gray-500">
                    In Progress
                </p>

                <p class="text-2xl font-bold text-blue-600">
                    {{ $summary->in_progress_tasks }}
                </p>

            </div>


            <div class="bg-green-50 rounded-lg p-4">

                <p class="text-sm text-gray-500">
                    Completed
                </p>

                <p class="text-2xl font-bold text-green-600">
                    {{ $summary->completed_tasks }}
                </p>

            </div>


            <div class="bg-red-50 rounded-lg p-4">

                <p class="text-sm text-gray-500">
                    Overdue
                </p>

                <p class="text-2xl font-bold text-red-600">
                    {{ $summary->overdue_tasks }}
                </p>

            </div>

        </div>


        {{-- Maximum Depth --}}
        <div class="mb-6">

            <span class="text-gray-600">
                Maximum hierarchy depth:
            </span>

            <span class="font-bold">
                {{ $summary->max_depth }}
            </span>

        </div>


        {{-- Recursive Task Tree --}}
        <h2 class="text-xl font-semibold mb-4">
            Task Dependency Tree
        </h2>


        <div class="space-y-2">

            @foreach($impactTasks as $task)

                <div
                    class="border rounded p-3 hover:bg-gray-50"
                    style="margin-left: {{ $task->level * 30 }}px"
                >

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">

                        <div>

                            <span class="font-medium">
                                {{ $task->title }}
                            </span>


                            <span class="text-xs text-gray-500 ml-2">
                                Level {{ $task->level }}
                            </span>

                        </div>


                        <span
                            class="text-xs px-2 py-1 rounded

                            @if($task->status === 'completed')
                                bg-green-100 text-green-800

                            @elseif($task->status === 'in_progress')
                                bg-blue-100 text-blue-800

                            @else
                                bg-yellow-100 text-yellow-800
                            @endif
                            "
                        >
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>

                    </div>


                    <div class="text-sm text-gray-500 mt-2">

                        <span>
                            Priority: {{ $task->priority }}
                        </span>


                        @if($task->due_date)

                            <span class="ml-3">
                                Due:
                                {{ $task->due_date }}
                            </span>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    @elseif($selectedTaskId)

        <div class="bg-yellow-50 text-yellow-800 rounded p-4">

            No task hierarchy was found for the selected task.

        </div>

    @else

        <div class="bg-gray-50 text-gray-600 rounded p-4">

            Select a task above to analyze its complete
            recursive task hierarchy.

        </div>

    @endif

</div>

@endsection