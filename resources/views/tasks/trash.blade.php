@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- Page Header --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">

                    <svg
                        class="w-6 h-6 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-8 0h10" />
                    </svg>

                </div>

                <div>

                    <h1 class="text-2xl font-bold text-gray-900">
                        Trash
                    </h1>

                    <p class="text-sm text-gray-500 mt-1">
                        Manage deleted tasks and restore them when needed.
                    </p>

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


    {{-- Success Message --}}
    @if(session('success'))

    <div class="bg-green-50 border border-green-200 rounded-xl p-4">

        <div class="flex items-center gap-3">

            <div class="w-9 h-9 rounded-full bg-green-100 flex items-center justify-center">

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

            <p class="text-sm font-medium text-green-700">
                {{ session('success') }}
            </p>

        </div>

    </div>

    @endif


    {{-- Trash Table --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        {{-- Table Header --}}
        <div class="px-6 py-5 border-b border-gray-100">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-lg font-semibold text-gray-900">
                        Deleted Tasks
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        These tasks are currently in the trash.
                    </p>

                </div>

                <div class="bg-red-50 text-red-700 px-3 py-1.5 rounded-full text-sm font-semibold">

                    {{ $tasks->total() }} {{ $tasks->total() == 1 ? 'Task' : 'Tasks' }}

                </div>

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            ID
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Task
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            User
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Deleted At
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
                        <td class="px-6 py-4">

                            <span class="text-sm font-semibold text-gray-700">
                                ID{{ $task->id }}
                            </span>

                        </td>


                        {{-- Title --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center">

                                    <svg
                                        class="w-5 h-5 text-gray-500"
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

                                    <p class="font-semibold text-gray-900">
                                        {{ $task->title }}
                                    </p>

                                    @if($task->description)

                                    <p class="text-xs text-gray-500 mt-1 max-w-xs truncate">
                                        {{ $task->description }}
                                    </p>

                                    @endif

                                </div>

                            </div>

                        </td>


                        {{-- User --}}
                        <td class="px-6 py-4">

                            <div class="flex items-center gap-2">

                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">

                                    <span class="text-xs font-bold text-blue-600">

                                        {{ strtoupper(substr(optional($task->user)->name ?? 'N', 0, 1)) }}

                                    </span>

                                </div>

                                <span class="text-sm text-gray-700">

                                    {{ optional($task->user)->name ?? 'N/A' }}

                                </span>

                            </div>

                        </td>


                        {{-- Deleted At --}}
                        <td class="px-6 py-4">

                            <div class="text-sm text-gray-700">

                                {{ optional($task->deleted_at)->format('Y-m-d') }}

                            </div>

                            <div class="text-xs text-gray-400 mt-1">

                                {{ optional($task->deleted_at)->format('H:i:s') }}

                            </div>

                        </td>


                        {{-- Actions --}}
                        <td class="px-6 py-4">

                            <div class="flex justify-end gap-2">

                                {{-- Restore --}}
                                <form
                                    method="POST"
                                    action="{{ route('tasks.restore', $task->id) }}"
                                    onsubmit="return confirm('Restore this task?')">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                                        Restore
                                    </button>

                                </form>


                                {{-- Permanent Delete --}}
                                <form
                                    method="POST"
                                    action="{{ route('tasks.force-delete', $task->id) }}"
                                    onsubmit="return confirm('Permanently delete this task? This action cannot be undone.')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="inline-flex items-center gap-1.5 bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 px-3 py-2 rounded-lg text-sm font-medium transition">

                                        <svg
                                            class="w-4 h-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-8 0h10" />
                                        </svg>

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="5"
                            class="px-6 py-16 text-center">

                            <div class="flex flex-col items-center">

                                <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">

                                    <svg
                                        class="w-8 h-8 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-8 0h10" />
                                    </svg>

                                </div>

                                <h3 class="text-lg font-semibold text-gray-700">
                                    Trash is empty
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Deleted tasks will appear here.
                                </p>

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

            {{ $tasks->links() }}

        </div>

        @endif

    </div>

</div>

@endsection