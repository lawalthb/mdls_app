<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Merit Datalight School - Excellence in Education')</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Merit Datalight School" class="h-10 sm:h-12 w-auto">
                    <div class="ml-2 sm:ml-4">
                        <h1 class="text-sm sm:text-xl font-bold text-blue-900">Merit Datalight School</h1>
                        <p class="text-xs text-gray-600 hidden sm:block">Excellence in Education</p>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 font-medium">Home</a>
                    <a href="#about" class="text-gray-700 hover:text-blue-600 font-medium">About</a>
                    <a href="#admissions" class="text-gray-700 hover:text-blue-600 font-medium">Admissions</a>
                    <a href="#events" class="text-gray-700 hover:text-blue-600 font-medium">Events</a>
                    <a href="{{ url('/contact') }}" class="text-gray-700 hover:text-blue-600 font-medium">Contact</a>
                    <a href="{{ url('/login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Portal Login</a>
                </div>
                <button id="mobile-menu-btn" class="md:hidden flex items-center text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ url('/') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-2">Home</a>
                <a href="#about" class="block text-gray-700 hover:text-blue-600 font-medium py-2">About</a>
                <a href="#admissions" class="block text-gray-700 hover:text-blue-600 font-medium py-2">Admissions</a>
                <a href="#events" class="block text-gray-700 hover:text-blue-600 font-medium py-2">Events</a>
                <a href="{{ url('/contact') }}" class="block text-gray-700 hover:text-blue-600 font-medium py-2">Contact</a>
                <a href="{{ url('/login') }}" class="block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition text-center">Portal Login</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">Merit Datalight School</h3>
                    <p class="text-gray-400 text-sm">Excellence in Education</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#about" class="hover:text-white">About Us</a></li>
                        <li><a href="#admissions" class="hover:text-white">Admissions</a></li>
                        <li><a href="#events" class="hover:text-white">Events</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Email: info@meritdatalight.com</li>
                        <li>Phone: +234 XXX XXX XXXX</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">Facebook</a>
                        <a href="#" class="text-gray-400 hover:text-white">Twitter</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} Merit Datalight School. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
