<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Lato link-->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <title>@yield('title', 'Nexis')</title>

    <link rel="icon" type="image/png" href="{{ Storage::disk('s3')->url('img/CommonImg/blacklogo.png') }}">

    @vite('resources/css/app.css')
    @stack('styles')
    @stack('scripts')
    <script src="https://cdn.lordicon.com/lordicon.js"></script>


    <style>
        @keyframes navBarSparkle {
            0% {
                box-shadow: 0 0 10px #d7ebf9, 0 0 20px #d7ebf9, 0 0 30px #d7ebf9, 0 0 40px #d7ebf9;
                background-image: linear-gradient(45deg, #d7ebf9, #d7ebf9);
            }

            100% {
                box-shadow: 0 0 5px #d7ebf9, 0 0 10px #d7ebf9, 0 0 15px #d7ebf9, 0 0 20px #d7ebf9;
                background-image: linear-gradient(135deg, #d7ebf9, #d7ebf9);
            }
        }

        .nav:hover {
            animation: navBarSparkle 1.5s infinite alternate;
        }

        * {
            font-family: 'Georgia', serif;
        }

        #mobileMenu {
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }

        .mobile-menu-hidden {
            transform: scale(0.95);
            opacity: 0;
        }

        .mobile-menu-visible {
            transform: scale(1);
            opacity: 1;
        }
    </style>
</head>

<body class="font-lato bg-[#F9FFFE]">



    <header class="flex justify-center p-4">
        <nav
            class="nav hidden lg:flex items-center bg-white rounded-full shadow-lg w-4/5 max-w-5xl justify-center transition duration-300 ease-in-out py-4 px-10">
            <a href="/home" class="mr-6">
                <img src="{{ Storage::url('img/CommonImg/BrandLogo.png') }}" alt="Logo" class="h-20">
            </a>

            <div id="navMenu" class="flex items-center text-lg text-black font-normal space-x-8">
                <a href="/home" class="nav-items transition-colors hover:text-white">Home</a>
                <a href="/about-us" class="nav-items transition-colors hover:text-white">About</a>
                <a href="/women" class="nav-items transition-colors hover:text-white">Women</a>
                <a href="/men" class="nav-items transition-colors hover:text-white">Men</a>
                <a href="/contact-us" class="nav-items transition-colors hover:text-white">Contact us</a>
                @if (Auth::check())
                @if (Auth::user()->isAdmin)
                <a href="{{ route('analytics.index') }}"
                    class="nav-items transition-colors hover:text-white">Admin Dashboard</a>
                @else
                <div class="relative inline-block text-left">
                    <button onclick="toggleDropdown()"
                        class="nav-items flex items-center transition-colors hover:text-white">
                        <span>{{ Auth::user()->First_Name }}</span>
                        @if (Auth::user()->avatar)
                        <img src="{{ Storage::url('img/avatar/' . Auth::user()->UserID . '/' . Auth::user()->avatar) }}"
                            alt="User Avatar"
                            class="w-10 h-10 rounded-full ml-2 border border-gray-300 object-cover">
                        @else
                        <img src="{{ Storage::url('img/icons/Default-Avatar.png') }}" alt="Default Avatar"
                            class="w-10 h-10 rounded-full ml-2 border border-gray-300 object-cover">
                        @endif
                    </button>
                    <div id="userDropdown"
                        class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg z-20">
                        <a href="{{ route('profile.orders') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Orders</a>
                        <a href="{{ route('profile.index') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @endif
                @else
                <a href="{{ route('login') }}" class="nav-items transition-colors hover:text-white">Sign In</a>
                @endif
            </div>
            <div id="icon" class="ml-6">
                <a href="/wishlist" id="wishlist-icon" class="relative inline-block">
                    <lord-icon src="https://cdn.lordicon.com/ulnswmkk.json" trigger="morph"
                        state="morph-heart" colors="primary:#c71f16"
                        style="width:35px;height:35px"></lord-icon>
                    <span id="wishlist-count-desktop"
                        class="absolute -top-2 -right-2 bg-blue-600 text-white rounded-full px-1 text-xs font-bold text-center"></span>
                </a>
            </div>
            <div id="icon" class="ml-6">
                <a href="{{ route('cart.view') }}" id="cart-icon" class="relative inline-block">
                    <lord-icon src="https://cdn.lordicon.com/mfmkufkr.json" id="cart-icon-desktop"
                        trigger="hover"
                        style="width:35px;height:35px"></lord-icon>
                    <span id="cart-count-desktop"
                        class="absolute -top-2 -right-2 bg-blue-600 text-white rounded-full px-1 text-xs font-bold text-center"></span>
                </a>
            </div>
        </nav>
        <div class="flex items-center justify-between w-full lg:hidden">
            <div class="cursor-pointer">
                <a href="/home">
                    <img src="{{ Storage::url('img/CommonImg/BrandLogo.png') }}" alt="Logo" class="h-16">
                </a>
            </div>
            <div class="ml-auto cursor-pointer" onclick="toggleMenu()">
                <div class="w-6 h-0.5 bg-gray-800 mb-1"></div>
                <div class="w-6 h-0.5 bg-gray-800 mb-1"></div>
                <div class="w-6 h-0.5 bg-gray-800"></div>
            </div>
        </div>
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40" onclick="toggleMenu()"></div>
        <div id="mobileMenu" class="fixed inset-0 flex justify-center items-center z-50 hidden mobile-menu-hidden">
            <div
                class="bg-white rounded-3xl shadow-2xl overflow-y-auto flex flex-col items-center py-10 px-6 w-11/12 max-w-md relative">
                <button class="absolute top-4 right-4 text-gray-800 hover:text-gray-900" onclick="toggleMenu()">
                    <lord-icon src="{{ Storage::url('xicon.json') }}" trigger="hover" style="width:32px;height:32px" mode="no-cors"></lord-icon>
                </button>
                <a href="/home" class="mb-8">
                    <img src="{{ Storage::url('img/CommonImg/BrandLogo.png') }}" alt="Logo" class="h-24 mx-auto">
                </a>
                <div class="flex flex-col items-center space-y-6 text-lg font-medium text-black">
                    <a href="/home" class="mobile-menu-link hover:text-blue-800" onclick="toggleMenu()">Home</a>
                    <a href="/about-us" class="mobile-menu-link hover:text-blue-800" onclick="toggleMenu()">About</a>
                    <a href="/women" class="mobile-menu-link hover:text-blue-800" onclick="toggleMenu()">Women</a>
                    <a href="/men" class="mobile-menu-link hover:text-blue-800" onclick="toggleMenu()">Men</a>
                    <a href="/contact-us" class="mobile-menu-link hover:text-blue-800" onclick="toggleMenu()">Contact
                        us</a>
                    @if (Auth::check())
                    @if (Auth::user()->isAdmin)
                    <a href="{{ route('analytics.index') }}" class="mobile-menu-link hover:text-white"
                        onclick="toggleMenu()">Admin Dashboard</a>
                    @else
                    <a href="{{ route('profile.index') }}" class="mobile-menu-link flex flex-row items-center justify-center mr-7 hover:text-white"
                        onclick="toggleMenu()">
                        @if (Auth::user()->avatar)
                        <img src="{{ Storage::url('img/avatar/' . Auth::user()->UserID . '/' . Auth::user()->avatar) }}"
                            alt="User Avatar"
                            class="w-10 h-10 rounded-full mr-3 border border-gray-300 object-cover">
                        @else
                        <img src="{{ Storage::url('img/icons/Default-Avatar.png') }}" alt="Default Avatar"
                            class="w-10 h-10 rounded-full ml-2 border border-gray-300 object-cover">
                        @endif
                        Profile
                    </a>
                    <a href="{{ route('profile.orders') }}" class="mobile-menu-link hover:text-white"
                        onclick="toggleMenu()">Orders</a>
                    @endif
                    @else
                    <a href="{{ route('login') }}" class="mobile-menu-link hover:text-blue-800"
                        onclick="toggleMenu()">Sign In</a>
                    @endif
                </div>

                <div class="mt-8 mb-4 flex justify-center">
                    <a href="{{ url('wishlist') }}" id="wishlist-icon" class="relative inline-block">
                        <lord-icon src="https://cdn.lordicon.com/ulnswmkk.json" trigger="morph"
                            state="morph-heart" colors="primary:#c71f16"
                            style="width:35px;height:35px"></lord-icon>
                        <span id="wishlist-count-hamburger"
                            class="absolute -top-2 -right-2 bg-blue-600 text-white rounded-full px-1 text-xs font-bold text-center">1</span>
                    </a>
                </div>
                <div class="mt-8 mb-4 flex justify-center">
                    <a href="{{ route('cart.view') }}" id="cart-icon" class="relative inline-block">
                        <lord-icon src="https://cdn.lordicon.com/mfmkufkr.json" id="cart-icon-mobile" trigger="hover"
                            style="width:48px;height:48px"></lord-icon>
                        <span id="cart-count-hamburger"
                            class="absolute -top-2 -right-2 bg-blue-600 text-white rounded-full px-1 text-xs font-bold text-center"> 0
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="mt-8">
        @yield('content')
    </main>
    @if (!Request::is('cart'))
    <footer class="bg-gray-900 text-white pt-10 pb-6">
        <div class="container mx-auto px-6 lg:px-12">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-10 md:space-y-0">
                <div class="text-center md:text-left md:flex-1">
                    <h2 class="text-3xl font-semibold mb-3">Stay Connected</h2>
                    <p class="text-gray-400 leading-relaxed max-w-md mx-auto md:mx-0">
                        Join us on social media and keep up-to-date with our latest updates and exclusive offers.
                    </p>
                </div>

                <div class="flex justify-center md:justify-center space-x-8 md:flex-1">
                    <a href="https://www.facebook.com" target="_blank" class="transform transition hover:scale-110">
                        <img src="{{ Storage::url('img/CommonImg/facebook logo.png') }}" alt="Facebook" class="h-12 w-12">
                    </a>
                    <a href="https://www.pinterest.com" target="_blank" class="transform transition hover:scale-110">
                        <img src="{{ Storage::url('img/CommonImg/pinterest logo.png') }}" alt="Pinterest" class="h-12 w-12">
                    </a>
                    <a href="https://www.instagram.com" target="_blank" class="transform transition hover:scale-110">
                        <img src="{{ Storage::url('img/CommonImg/instagram logo.png') }}" alt="Instagram" class="h-12 w-12">
                    </a>
                    <a href="https://www.tiktok.com" target="_blank" class="transform transition hover:scale-110">
                        <img src="{{ Storage::url('img/CommonImg/tiktok logo.png') }}" alt="TikTok" class="h-12 w-12">
                    </a>
                </div>

                <div class="text-center md:text-right md:mr-20 md:flex-1">
                    <h3 class="text-xl font-medium mr-0 sm:mr-12 mb-4">We Accept</h3>
                    <div class="flex justify-center md:justify-end items-center space-x-6">
                        <img src="{{ Storage::url('img/CommonImg/visa.png') }}" alt="Visa" class="h-14 w-auto">
                        <img src="{{ Storage::url('img/CommonImg/mastercard.webp') }}" alt="Mastercard" class="h-14 w-auto">
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-10 pt-6 text-center">
            <ul class="flex flex-wrap justify-center space-x-6 text-gray-400 text-sm">
                <li><a href="/home" class="hover:text-white transition duration-300">Home</a></li>
                <li><a href="/about-us" class="hover:text-white transition duration-300">About Us</a></li>
                <li><a href="/contact-us" class="hover:text-white transition duration-300">Contact Us</a></li>
            </ul>
            <p class="mt-4 text-gray-500 text-sm">&copy; 2024 Nexis. All rights reserved.</p>
        </div>
    </footer>
    @endif
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function toggleMenu() {
            let overlay = $("#overlay");
            let mobileMenu = $("#mobileMenu");

            overlay.toggleClass("hidden");
            mobileMenu.toggleClass("hidden mobile-menu-visible mobile-menu-hidden");
        }

        function toggleDropdown() {
            $("#userDropdown").toggleClass('hidden');
        }

        $(window).click(function(event) {
            if (!$(event.target).closest('.relative').length) {
                let dropdown = $("#userDropdown");
                if (!dropdown.hasClass('hidden')) {
                    dropdown.addClass('hidden');
                }
            }
            //  !! DOESNT WORK ||Close the mobile menu if clicked outside
            $('#overlay').on('click', function(e) {
                if ($(e.target).is('#overlay')) {
                    $('#overlay').addClass('hidden');
                }
            });

        });
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


            const updateCartCounters = () => {
                fetch('/cart/count', {
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        const desktopCounter = document.getElementById('cart-count-desktop');
                        const hamburgerCounter = document.getElementById('cart-count-hamburger');
                        let updateCartIcon = document.getElementById('cart-icon-desktop');
                        if (desktopCounter) {
                            desktopCounter.textContent = data.cartCount;
                        }
                        if (hamburgerCounter) {
                            hamburgerCounter.textContent = data.cartCount;
                        }
                        if (updateCartIcon) {
                            updateCartIcon.dispatchEvent(new MouseEvent('mouseover')); // Simulate hover
                            setTimeout(() => {
                                updateCartIcon.dispatchEvent(new MouseEvent('mouseout')); // End hover after animation
                            }, 1000);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching cart count:', error);
                    });
            };

            updateCartCounters();

            window.updateCartCounters = updateCartCounters;
            const updateWishlistCounters = () => {
                fetch('/wishlist/count', {
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        const desktopWishlistCounter = document.getElementById('wishlist-count-desktop');
                        const hamburgerWishlistCounter = document.getElementById('wishlist-count-hamburger');

                        if (desktopWishlistCounter) {
                            desktopWishlistCounter.textContent = data.wishlistCount;
                        }
                        if (hamburgerWishlistCounter) {
                            hamburgerWishlistCounter.textContent = data.wishlistCount;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching wishlist count:', error);
                    });
            };

            updateWishlistCounters();

            window.updateWishlistCounters = updateWishlistCounters;
        });
    </script>
</body>

</html>