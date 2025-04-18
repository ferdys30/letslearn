<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Halaman Dashboard</title>
</head>
<body class="h-full">
    <!-- Navbar -->
    <x-navbar-guru></x-navbar-guru>

    <div class="flex">
        <!-- Sidebar -->
        <x-side-bar-guru></x-side-bar-guru>

        <!-- Main Content -->
        <main class="flex-1 md:ml-64 mt-12 p-6">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
