<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Organizer Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Top Navbar -->
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-indigo-600">EventHub</h1>

        <div class="text-sm">
            <p class="font-semibold">{{ auth()->user()->name }}</p>
            <p class="text-gray-500">{{ auth()->user()->email }}</p>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>
