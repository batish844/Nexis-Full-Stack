<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white border-b border-gray-200">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex-shrink-0">
                        <a href="{{ route('home') }}" class="text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-md font-semibold">
                            Return to Home
                        </a>
                    </div>
                    <div class="hidden md:flex space-x-8 items-center">
                        <a href="{{ route('profile.orders') }}" class="text-gray-900 font-bold text-lg hover:text-indigo-600">
                            Orders
                        </a>
                        <a href="{{ route('profile.index') }}" class="text-gray-900 font-bold text-lg hover:text-indigo-600">
                            Account Settings
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-6">
                        <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-indigo-600 font-medium focus:outline-none">
                                Log Out
                            </button>
                        </form>
                    </div>
                    <div class="md:hidden flex items-center">
                        <button id="mobileMenuBtn" type="button" class="text-gray-700 hover:text-gray-900 focus:outline-none">
                            <svg id="menuOpen" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 8h16M4 16h16" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            </svg>
                            <svg id="menuClose" class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div id="mobileMenu" class="md:hidden hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-semibold text-white bg-indigo-600 hover:bg-indigo-700">
                        Return to Home
                    </a>
                    <a href="{{ route('profile.orders') }}" class="block px-3 py-2 rounded-md text-base font-bold text-gray-900 hover:text-indigo-600">
                        Orders
                    </a>
                    <a href="{{ route('profile.index') }}" class="block px-3 py-2 rounded-md text-base font-bold text-gray-900 hover:text-indigo-600">
                        Account Settings
                    </a>
                    <div class="border-t border-gray-200 mt-2"></div>
                    <div class="px-5 py-3">
                        <span class="block text-base font-medium text-gray-800">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="mt-1">
                            @csrf
                            <button type="submit" class="w-full text-left text-base font-medium text-gray-700 hover:text-indigo-600 focus:outline-none">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x/dist/cdn.min.js" defer></script>
    <script>
        $(document).ready(function() {
            let $mobileMenuBtn = $('#mobileMenuBtn');
            let $mobileMenu = $('#mobileMenu');
            let $menuOpen = $('#menuOpen');
            let $menuClose = $('#menuClose');

            $mobileMenuBtn.on('click', function() {
            $mobileMenu.toggleClass('hidden');
            $menuOpen.toggleClass('hidden');
            $menuClose.toggleClass('hidden');
            });

            $(document).on('click', function(event) {
            if (!$mobileMenu.is(event.target) && 
                !$mobileMenuBtn.is(event.target) && 
                $mobileMenu.has(event.target).length === 0) {
                $mobileMenu.addClass('hidden');
                $menuOpen.removeClass('hidden');
                $menuClose.addClass('hidden');
            }
            });
        });
    </script>
</body>
</html>