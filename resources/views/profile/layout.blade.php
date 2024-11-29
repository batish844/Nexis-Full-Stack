<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" type="image/png" href="/storage/img/CommonImg/blacklogo.png">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 max-w-screen overflow-x-hidden">
    <div class="min-h-screen flex flex-col">
        <header class="bg-blue-800 shadow-md relative">
            <div class="container mx-auto px-4 py-4 flex items-center justify-between">
                <!-- Logo and Welcome Message -->
                <div class="flex items-center space-x-2 mb-4 lg:mb-0 lg:space-x-4 flex-wrap 2xl:max-w-fit lg:w-26">
                    <a href="{{ route('home') }}">
                        <img src="/storage/img/CommonImg/blacklogo.png" alt="Logo" class="h-24 lg:h-24">
                    </a>
                    <span
                        class="text-xl sm:text-2xl md:text-xl lg:text-lg 2xl:text-2xl font-semibold text-white max-w-34 text-center lg:text-left">
                        Welcome, {{ Auth::user()->First_Name }}!
                    </span>
                    <p class="text-lg sm:text-xl font-medium text-yellow-400">
                        <i class="fas fa-trophy text-yellow-400 text-xl"></i>
                        Points: {{ number_format($totalPoints) }}
                    </p>
                </div>

                <!-- Mobile Menu Button -->
                <div x-data="{ open: false }" class="lg:hidden relative">
                    <button @click="open = !open"
                        class="text-white focus:outline-none focus:ring-2 focus:ring-white rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round"
                                d="M4 6h16M4 12h16m-7 6h7" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-64 bg-blue-700 p-4 rounded-lg shadow-md space-y-4 z-50">
                        <nav id="navbar-menu" class="text-center">
                            <a href="{{ route('profile.index') }}"
                                class="p-2 flex items-center space-x-2 lg:space-x-3 2xl:space-x-4 text-gray-700 hover:bg-blue-300 hover:rounded transition duration-200 {{ request()->routeIs('profile.index') ? 'border-b-2 border-white' : '' }}">
                                <img src="/storage/img/icons/profile-user-icon.png" alt="Profile"
                                    class="h-8 lg:h-10 w-8 lg:w-10">
                                <span class="text-xs sm:text-sm md:text-base lg:text-lg 2xl:text-2xl text-white">Profile
                                    Info</span>
                            </a>
                            <a href="{{ route('profile.orders') }}"
                                class="p-2 flex items-center space-x-2 lg:space-x-3 text-gray-700 hover:bg-blue-300 hover:rounded transition duration-200 {{ request()->routeIs('profile.orders') ? 'border-b-2 border-white' : '' }}">
                                <img src="/storage/img/icons/order-icon.png" alt="Orders"
                                    class="h-8 lg:h-10 w-8 lg:w-10">
                                <span
                                    class="text-xs sm:text-sm md:text-base lg:text-lg 2xl:text-2xl text-white">Orders</span>
                            </a>
                        </nav>

                        {{-- Return Home and Log Out Buttons  --}}
                        <div class="mt-4 flex flex-col space-y-4">
                            <a href="{{ route('home') }}"
                                class="flex items-center justify-center text-white bg-blue-400 hover:bg-blue-300 px-4 py-2 rounded-md font-semibold transition duration-300">
                                Return Home
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="flex justify-end">
                                @csrf

                                <button type="submit"
                                    class="flex items-center justify-center text-white bg-red-600 hover:bg-red-400 px-4 py-2 rounded-md font-semibold transition duration-300">
                                    <img src="/storage/img/icons/user-logout-icon.png" alt="Logout"
                                        class="w-6 h-6 mr-3">

                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav id="navbar-menu"
                    class="hidden lg:flex justify-center content-center lg:items-center space-x-4 mb-4 lg:mb-0 text-center md:space-x-1 lg:space-x-2 xl:space-x-8">
                    <a href="{{ route('profile.index') }}"
                        class="p-2 flex items-center space-x-2 lg:space-x-3 2xl:space-x-4 text-gray-700 hover:bg-blue-300 hover:rounded transition duration-200 {{ request()->routeIs('profile.index') ? 'border-b-2 border-white' : '' }}">
                        <img src="/storage/img/icons/profile-user-icon.png" alt="Profile"
                            class="h-8 lg:h-10 w-8 lg:w-10">
                        <span class="text-xs sm:text-sm md:text-base lg:text-lg 2xl:text-2xl text-white">Profile
                            Info</span>
                    </a>
                    <a href="{{ route('profile.orders') }}"
                        class="p-2 flex items-center space-x-2 lg:space-x-3 text-gray-700 hover:bg-blue-300 hover:rounded transition duration-200 {{ request()->routeIs('profile.orders') ? 'border-b-2 border-white' : '' }}">
                        <img src="/storage/img/icons/order-icon.png" alt="Orders" class="h-8 lg:h-10 w-8 lg:w-10">
                        <span class="text-xs sm:text-sm md:text-base lg:text-lg 2xl:text-2xl text-white">Orders</span>
                    </a>
                </nav>
                <!-- Log Out and Return Home Buttons -->
                <div id="logout-return"
                    class="lg:flex justify-center space-x-2 lg:space-x-4 2xl:space-x-4 lg:w-sm hidden">
                    <!-- Return Home Button -->
                    <a href="{{ route('home') }}"
                        class="flex items-center justify-center space-x-4 text-white bg-blue-400 hover:bg-blue-300 px-3 sm:px-2 lg:px-4 xl:px-5 py-2 rounded-md font-semibold transition duration-300 
                text-xs sm:text-sm lg:text-sm xl:text-lg 2xl:text-xl">
                        Return Home
                    </a>

                    <!-- Log Out Button -->
                    <form method="POST" action="{{ route('logout') }}" class="flex">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-center space-x-4 text-white bg-red-600 hover:bg-red-400 px-3 lg:px-4 py-2 rounded-md font-semibold transition duration-300 
                    text-xs sm:text-sm lg:text-sm xl:text-lg 2xl:text-xl">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 w-screen">
            @yield('content')
        </main>
    </div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x/dist/cdn.min.js" defer></script>
    <script>
        $(document).ready(function() {
            if ($('.flash-message').length) {
            $('.flash-message').delay(3000).fadeOut(500, function() {
                $(this).remove();
            });}
            
        });
    </script>
</body>

</html>
