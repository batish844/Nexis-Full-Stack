<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        {{-- <header
            class="bg-blue-700 h-auto py-4 lg:h-32 flex lg:flex-row items-center justify-between px-4 lg:px-8 shadow-md">
            <!-- Logo and Welcome Message -->
            <div
                class="flex items-center space-x-2 mb-4 lg:mb-0 lg:space-x-4 flex-wrap 2xl:max-w-fit md:max-w-sm lg:max-w-30">
                <a href="{{ route('home') }}">
                    <img src="/storage/img/CommonImg/blacklogo.png" alt="Logo" class="h-16 lg:h-24">
                </a>
                <span
                    class="text-sm md:text-base lg:text-lg 2xl:text-2xl font-semibold text-white max-w-34 text-center lg:text-left">
                    Welcome, {{ Auth::user()->First_Name }}!
                </span>
            </div>
            <!-- Burger Menu Button -->
            <button id="burger-menu-btn"
                class="block lg:hidden text-white focus:outline-none focus:ring-2 focus:ring-white rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
            <!-- Navigation Links -->
            <nav id="navbar-menu"
                class="lg:flex justify-center content-center lg:items-center space-x-4 mb-4 lg:mb-0 text-center md:space-x-1 lg:space-x-2 xl:space-x-8 md:hidden">
                <a href="{{ route('profile.index') }}"
                    class="p-2 flex items-center space-x-2 lg:space-x-3 2xl:space-x-4 text-gray-700 hover:bg-blue-300 hover:rounded transition duration-200 {{ request()->routeIs('profile.index') ? 'border-b-2 border-white' : '' }}">
                    <img src="/storage/img/icons/profile-user-icon.png" alt="Profile" class="h-8 lg:h-10 w-8 lg:w-10">
                    <span class="text-xs sm:text-sm md:text-base lg:text-lg 2xl:text-2xl text-white">Profile Info</span>
                </a>
                <a href="{{ route('profile.orders') }}"
                    class="p-2 flex items-center space-x-2 lg:space-x-3 text-gray-700 hover:bg-blue-300 hover:rounded transition duration-200 {{ request()->routeIs('profile.orders') ? 'border-b-2 border-white' : '' }}">
                    <img src="/storage/img/icons/order-icon.png" alt="Orders" class="h-8 lg:h-10 w-8 lg:w-10">
                    <span class="text-xs sm:text-sm md:text-base lg:text-lg 2xl:text-2xl text-white">Orders</span>
                </a>

            <a href="{{ route('profile.wishlist') }}"
                    class="p-2 flex items-center space-x-4 text-gray-700 hover:bg-blue-300 hover:rounded transition duration-200">
                    <img src="/storage/img/icons/wishlist-icon.png" alt="Wishlist" class="h-10 w-10">
                    <span class="xl:font-semibold text-2xl text-white">Wishlist</span>

            </nav>
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden bg-blue-700 lg:hidden mt-4 p-4 rounded-lg shadow-md space-y-4">
                <nav class="flex flex-col items-start space-y-4">
                    <a href="{{ route('profile.index') }}"
                        class="flex items-center space-x-4 text-gray-700 hover:bg-blue-300 hover:rounded p-2 transition duration-200 {{ request()->routeIs('profile.index') ? 'border-b-2 border-white' : '' }}">
                        <img src="/storage/img/icons/profile-user-icon.png" alt="Profile" class="h-8 w-8">
                        <span class="text-white text-sm">Profile Info</span>
                    </a>
                    <a href="{{ route('profile.orders') }}"
                        class="flex items-center space-x-4 text-gray-700 hover:bg-blue-300 hover:rounded p-2 transition duration-200 {{ request()->routeIs('profile.orders') ? 'border-b-2 border-white' : '' }}">
                        <img src="/storage/img/icons/order-icon.png" alt="Orders" class="h-8 w-8">
                        <span class="text-white text-sm">Orders</span>
                    </a>
                    <a href="#"
                        class="flex items-center space-x-4 text-gray-700 hover:bg-blue-300 hover:rounded p-2 transition duration-200">
                        <img src="/storage/img/icons/wishlist-icon.png" alt="Wishlist" class="h-8 w-8">
                        <span class="text-white text-sm">Wishlist</span>
                    </a>
                </nav>

                <!-- Return Home and Log Out Buttons -->
                <div class="mt-4 flex flex-col space-y-4">
                    <a href="{{ route('home') }}"
                        class="flex items-center justify-center text-white bg-blue-400 hover:bg-blue-300 px-4 py-2 rounded-md font-semibold transition duration-300">
                        Return Home
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="flex">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-center text-white bg-red-600 hover:bg-red-400 px-4 py-2 rounded-md font-semibold transition duration-300">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
            <!-- Log Out and Return Home Buttons -->
            <div id="logout-return" class="lg:flex justify-center space-x-2 lg:space-x-4 2xl:space-x-4 lg:w-sm md:hidden">
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

        </header> --}}
        <header class="bg-blue-700 shadow-md relative">
            <div class="container mx-auto px-4 py-4 flex items-center justify-between">
                <!-- Logo and Welcome Message -->
                <div class="flex items-center space-x-2 mb-4 lg:mb-0 lg:space-x-4 flex-wrap 2xl:max-w-fit lg:max-w-30">
                    <a href="{{ route('home') }}">
                        <img src="/storage/img/CommonImg/blacklogo.png" alt="Logo" class="h-24 lg:h-24">
                    </a>
                    <span
                        class="text-xl sm:text-2xl md:text-xl lg:text-lg 2xl:text-2xl font-semibold text-white max-w-34 text-center lg:text-left">
                        Welcome, {{ Auth::user()->First_Name }}!
                    </span>
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
                            <a href="{{ route('profile.wishlist') }}"
                                class="p-2 flex items-center space-x-2 lg:space-x-3 text-gray-700 hover:bg-blue-300 hover:rounded transition duration-200">
                                <img src="/storage/img/icons/wishlist-icon.png" alt="Wishlist"
                                    class="h-8 lg:h-10 w-8 lg:w-10">
                                <span
                                    class="text-xs sm:text-sm md:text-base lg:text-lg 2xl:text-2xl text-white">Wishlist</span>
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
                    <a href="{{ route('profile.wishlist') }}"
                        class="p-2 flex items-center space-x-2 lg:space-x-3 text-gray-700 hover:bg-blue-300 hover:rounded transition duration-200">
                        <img src="/storage/img/icons/wishlist-icon.png" alt="Wishlist" class="h-8 lg:h-10 w-8 lg:w-10">
                        <span class="text-xs sm:text-sm md:text-base lg:text-lg 2xl:text-2xl text-white">Wishlist</span>
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
        <main class="flex-1 bg-gray-100">
            <div class="px-3 sm:px-8 md:px-12 lg:px-20">
                @yield('content')
            </div>
        </main>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x/dist/cdn.min.js" defer></script>
    <script>
        $(document).ready(function() {

            let $editBtn = $("#edit-profile-btn");
            let $cancelBtn = $("#cancel-edit");
            let $formInputs = $("#profile-form input");
            let $editActions = $("#edit-actions");

            let $updateBtn = $("#edit-pass-btn")
            let $cancelPassBtn = $("#cancel-pass");
            let $passForm = $("#update-password-form input");
            let $updateActions = $("#update-actions");

            // const $burgerMenuBtn = $('#burger-menu-btn');
            // const $mobileMenu = $('#mobile-menu');

            // // Toggle mobile menu
            // $burgerMenuBtn.on('click', function() {
            //     $mobileMenu.toggleClass('hidden');
            // });



            // Enable edit mode
            $editBtn.on("click", function() {
                $formInputs.prop("disabled", false); // Enable inputs
                $editActions.removeClass("hidden"); // Show save and cancel buttons
                $editBtn.addClass("hidden"); // Hide edit button
            });

            // Cancel edit mode
            $cancelBtn.on("click", function() {
                $formInputs.prop("disabled", true); // Disable inputs
                $editActions.addClass("hidden"); // Hide save and cancel buttons
                $editBtn.removeClass("hidden"); // Show edit button
            });

            // Enable Password Update mode
            $updateBtn.on("click", function() {
                $passForm.prop("disabled", false); // Enable inputs
                $updateActions.removeClass("hidden"); // Show save and cancel buttons
                $updateBtn.addClass("hidden"); // Hide edit button
            });

            // Cancel Password Update mode
            $cancelPassBtn.on("click", function() {
                $passForm.prop("disabled", true); // Disable inputs
                $updateActions.addClass("hidden"); // Hide save and cancel buttons
                $updateBtn.removeClass("hidden"); // Show edit button
            });

        });

        function showPasswordNotification(message, type = 'success') {
            const $notification = $('#password-notification');
            const $message = $('#password-notification-message');

            // Set the message and apply styles based on the type
            $message.text(message);
            $notification
                .addClass(
                    type === 'success' ?
                    'bg-green-100 border-green-400 text-green-700' :
                    'bg-red-100 border-red-400 text-red-700'
                );

            // Slide notification up into view
            $notification
                .css('transform', 'translate(0, -100%)') // Move to visible position
                .removeClass('hidden');

            // Hide notification after 5 seconds
            setTimeout(function() {
                $notification.css('transform', 'translate(0, 100%)'); // Move back down
                setTimeout(function() {
                    $notification
                        .addClass('hidden'), 2000
                })
            }, 5000);
        }
        if (window.location.hash) {
            const target = $(window.location.hash);
            if (target.length) {
                $('html, body').animate({
                        scrollTop: target.offset().top,
                    },
                    800 // Smooth scroll duration in milliseconds
                );
            }
        }

        function showProfileNotification(message, type = 'success') {
            const $notification = $('#profile-notification');
            const $messageSpan = $('#profile-notification-message');

            // Set the notification message
            $messageSpan.text(message);

            // Apply styles based on the type
            const notificationClass = type === 'success' ?
                'bg-green-100 border-green-400 text-green-700' :
                'bg-red-100 border-red-400 text-red-700';

            $notification
                .attr('class',
                    `relative top-1 transform -translate-x-1/2 max-w-fit whitespace-nowrap px-4 py-2 rounded shadow-md z-50 transition-transform transition-opacity duration-500 ease-in-out ${notificationClass}`
                )
                .css('transform', 'translateY(0)')
                .removeClass('hidden');

            // Hide the notification after 5 seconds
            setTimeout(() => {
                $notification
                    .css('transform', 'translateY(-150%)')
                    .addClass('hidden');
            }, 5000);
        }
    </script>
</body>

</html>
