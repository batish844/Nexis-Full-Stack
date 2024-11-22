<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" type="image/png" href="/storage/img/CommonImg/blacklogo.png">
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex h-screen">
        <div x-data="{ open: false }" class="flex">
            <div
                id="mobile-menu-overlay"
                x-show="open"
                @click="open = false"
                class="fixed inset-0 z-20 bg-black opacity-50 lg:hidden hidden">
            </div>
            <div
                class="fixed z-30 h-screen inset-y-0 left-0 w-64 bg-blue-800 text-white transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
                <div class="flex flex-col items-center justify-center h-32 bg-blue-900">
                    <img src="/storage/img/CommonImg/blacklogo.png" alt="Logo" class="h-20">
                    <span>Welcome, {{ Auth::user()->First_Name }}!</span>
                </div>
                <nav class="flex flex-col mt-4 space-y-2 px-2">
                    @php
                    $navItems = [
                    ['name' => 'Analytics',
                    'icon' => '/storage/img/icons/analytics.png',
                    'route' => 'analytics.index',],
                    ['name' => 'Categories',
                    'icon' => '/storage/img/icons/categories.png',
                    'route' => 'categories.index',],
                    ['name' => 'Products',
                    'icon' => '/storage/img/icons/item.png',
                    'route' => 'products.index',],
                    ['name' => 'Users',
                    'icon' => '/storage/img/icons/users.png',
                    'route' => 'users.index',],
                    ['name' => 'Orders',
                    'icon' => '/storage/img/icons/orders.png',
                    'route' => 'orders.index',],
                    ['name' => 'Messages',
                    'icon' => '/storage/img/icons/messages.png',
                    'route' => 'messages.index',],
                    ];
                    @endphp

                    @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                        class="{{ request()->routeIs($item['route']) ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }} 
               flex items-center px-6 py-3 rounded-md transition-colors">
                        <img src="{{ $item['icon'] }}" alt="{{ $item['name'] }} Icon" class="h-6 w-6 mr-4">
                        <span class="text-lg font-bold text-white">{{ $item['name'] }}</span>
                    </a>
                    @endforeach
                </nav>
                <div class="mt-14 mx-2">
                    <a href="{{ route('home') }}" class="flex items-center px-4 py-2 bg-blue-600 text-white hover:bg-blue-900 rounded-full transition-colors shadow-lg w-full">
                        Return to Home
                    </a>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="my-4 mx-2">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 bg-red-600 text-white hover:bg-red-700 rounded-full transition-colors shadow-lg w-full">
                        <img src="/storage/img/icons/logout.png" alt="Logout Icon" class="h-5 w-5 mr-3">
                        Logout
                    </button>
                </form>
            </div>
        </div>
        <div class="flex flex-col flex-grow overflow-hidden">
            <header class="bg-blue-800 text-white h-16 flex items-center justify-between px-6 shadow-md flex-shrink-0">
                <div class="flex items-center">
                    <button id="mobile-menu-button" class="lg:hidden mr-4 focus:outline-none">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h2 class="font-semibold text-xl sm:text-2xl">Nexis Admin Panel</h2>
                </div>
            </header>

            <main class="flex-grow overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mobile-menu-button').on('click', function(e) {
                e.stopPropagation();
                console.log('Hamburger menu clicked');
                $('.fixed.z-30').toggleClass('-translate-x-full');
                $('#mobile-menu-overlay').toggleClass('hidden lg:hidden');
            });

            $('#mobile-menu-overlay').on('click', function() {
                $('.fixed.z-30').addClass('-translate-x-full');
                $(this).addClass('hidden');
            });

        });
    </script>
</body>

</html>