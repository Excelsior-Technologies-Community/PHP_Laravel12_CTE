<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Laravel CTE Demo</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Smooth scrollbar */
        ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

</head>


<body class="bg-gray-100 text-gray-800 min-h-screen">


    {{-- ========================================================= --}}
    {{-- NAVBAR --}}
    {{-- ========================================================= --}}

    <nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between h-16">


                {{-- ================================================= --}}
                {{-- LOGO --}}
                {{-- ================================================= --}}

                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3 shrink-0">

                    <div
                        class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-sm">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />

                        </svg>

                    </div>

                    <div class="hidden sm:block">

                        <div class="font-bold text-gray-800 leading-tight">
                            Laravel CTE
                        </div>

                        <div class="text-xs text-gray-500">
                            Task Management
                        </div>

                    </div>

                </a>


                {{-- ================================================= --}}
                {{-- DESKTOP NAVIGATION --}}
                {{-- ================================================= --}}

                <div class="hidden lg:flex items-center gap-1 ml-8">


                    {{-- CTE GROUP --}}

                    <a
                        href="{{ route('cte.hierarchy') }}"
                        class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">

                        Hierarchy

                    </a>


                    <a
                        href="{{ route('cte.statistics') }}"
                        class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">

                        Statistics

                    </a>


                    <a
                        href="{{ route('cte.timeline') }}"
                        class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">

                        Timeline

                    </a>


                    <a
                        href="{{ route('cte.ranking') }}"
                        class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">

                        Ranking

                    </a>


                    <a
                        href="{{ route('cte.analysis') }}"
                        class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">

                        Analysis

                    </a>


                    <a
                        href="{{ route('cte.overdue-analysis') }}"
                        class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">

                        Overdue

                    </a>


                    <a
                        href="{{ route('cte.task-impact') }}"
                        class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">

                        Impact

                    </a>


                    {{-- DIVIDER --}}

                    <div class="h-7 w-px bg-gray-200 mx-2"></div>


                    {{-- TASKS --}}

                    <a
                        href="{{ route('tasks.index') }}"
                        class="px-3 py-2 rounded-lg text-sm font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 transition">

                        Tasks

                    </a>


                    {{-- ANALYTICS --}}

                    <a
                        href="{{ route('tasks.analytics') }}"
                        class="px-3 py-2 rounded-lg text-sm font-medium text-purple-600 hover:bg-purple-50 transition">

                        Analytics

                    </a>


                    {{-- TRASH --}}

                    <a
                        href="{{ route('tasks.trash') }}"
                        class="px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 transition">

                        Trash

                    </a>

                </div>


                {{-- ================================================= --}}
                {{-- MOBILE BUTTON --}}
                {{-- ================================================= --}}

                <button
                    type="button"
                    onclick="toggleMobileMenu()"
                    class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100">

                    <svg
                        id="menuIcon"
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                    </svg>

                </button>

            </div>


            {{-- ================================================= --}}
            {{-- MOBILE NAVIGATION --}}
            {{-- ================================================= --}}

            <div
                id="mobileMenu"
                class="hidden lg:hidden border-t border-gray-100 py-3">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-1">


                    <a
                        href="{{ route('cte.hierarchy') }}"
                        class="px-4 py-3 rounded-lg text-sm text-gray-600 hover:bg-gray-100">

                        Task Hierarchy

                    </a>


                    <a
                        href="{{ route('cte.statistics') }}"
                        class="px-4 py-3 rounded-lg text-sm text-gray-600 hover:bg-gray-100">

                        Statistics

                    </a>


                    <a
                        href="{{ route('cte.timeline') }}"
                        class="px-4 py-3 rounded-lg text-sm text-gray-600 hover:bg-gray-100">

                        Timeline

                    </a>


                    <a
                        href="{{ route('cte.ranking') }}"
                        class="px-4 py-3 rounded-lg text-sm text-gray-600 hover:bg-gray-100">

                        Ranking

                    </a>


                    <a
                        href="{{ route('cte.analysis') }}"
                        class="px-4 py-3 rounded-lg text-sm text-gray-600 hover:bg-gray-100">

                        Analysis

                    </a>


                    <a
                        href="{{ route('cte.overdue-analysis') }}"
                        class="px-4 py-3 rounded-lg text-sm text-gray-600 hover:bg-gray-100">

                        Overdue Analysis

                    </a>


                    <a
                        href="{{ route('cte.task-impact') }}"
                        class="px-4 py-3 rounded-lg text-sm text-gray-600 hover:bg-gray-100">

                        Task Impact

                    </a>


                    <div class="sm:col-span-2 border-t border-gray-100 my-1"></div>


                    <a
                        href="{{ route('tasks.index') }}"
                        class="px-4 py-3 rounded-lg text-sm font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100">

                        Tasks

                    </a>


                    <a
                        href="{{ route('tasks.analytics') }}"
                        class="px-4 py-3 rounded-lg text-sm font-semibold text-purple-600 bg-purple-50 hover:bg-purple-100">

                        Task Analytics

                    </a>


                    <a
                        href="{{ route('tasks.trash') }}"
                        class="px-4 py-3 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100">

                        Trash

                    </a>

                </div>

            </div>

        </div>

    </nav>


    {{-- ========================================================= --}}
    {{-- MAIN CONTENT --}}
    {{-- ========================================================= --}}

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Flash Success --}}

        @if(session('success'))

        <div
            class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 shrink-0"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 13l4 4L19 7" />

            </svg>

            <span>
                {{ session('success') }}
            </span>

        </div>

        @endif


        {{-- Validation Errors --}}

        @if($errors->any())

        <div
            class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">

            <div class="font-semibold mb-1">
                Please fix the following errors:
            </div>

            <ul class="list-disc list-inside text-sm">

                @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

                @endforeach

            </ul>

        </div>

        @endif


        @yield('content')

    </main>


    {{-- ========================================================= --}}
    {{-- FOOTER --}}
    {{-- ========================================================= --}}

    <footer class="border-t border-gray-200 bg-white mt-10">

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">

            <div
                class="flex flex-col sm:flex-row items-center justify-between gap-2 text-sm text-gray-500">

                <div>
                    Laravel CTE Demo
                </div>

                <div>
                    Task Management & CTE Analytics
                </div>

            </div>

        </div>

    </footer>


    {{-- ========================================================= --}}
    {{-- MOBILE MENU SCRIPT --}}
    {{-- ========================================================= --}}

    <script>
        function toggleMobileMenu() {

            const menu = document.getElementById('mobileMenu');

            menu.classList.toggle('hidden');

        }
    </script>

</body>

</html>