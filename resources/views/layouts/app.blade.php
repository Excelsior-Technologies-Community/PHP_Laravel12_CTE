<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CTE Demo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg mb-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="/" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-gray-500 text-lg">Laravel CTE Demo</span>
                        </a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('cte.hierarchy') }}" class="py-4 px-2 text-gray-500 hover:text-gray-900">Task Hierarchy</a>
                        <a href="{{ route('cte.statistics') }}" class="py-4 px-2 text-gray-500 hover:text-gray-900">Statistics</a>
                        <a href="{{ route('cte.timeline') }}" class="py-4 px-2 text-gray-500 hover:text-gray-900">Timeline</a>
                        <a href="{{ route('cte.ranking') }}" class="py-4 px-2 text-gray-500 hover:text-gray-900">Ranking</a>
                        <a href="{{ route('cte.analysis') }}" class="py-4 px-2 text-gray-500 hover:text-gray-900">Analysis</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4">
        @yield('content')
    </main>
</body>
</html>