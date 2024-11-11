<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nexus')</title>

    <link rel="icon" type="image/png" href="{{ asset('storage/CommonImg/BrandLogo.png') }}">

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

<body class>
    <header class="flex justify-center p-4">
        <nav class="nav hidden lg:flex items-center bg-white rounded-full shadow-lg w-4/5 max-w-5xl justify-center transition duration-300 ease-in-out py-4 px-10">
            <a href="/home" class="mr-6">
                <img src="storage/CommonImg/BrandLogo.png" alt="Logo" class="h-20">
            </a>

            <div id="navMenu" class="flex items-center text-lg text-black font-normal space-x-8">
                <a href="/home" class="nav-items transition-colors hover:text-white">Home</a>
                <a href="/about-us" class="nav-items transition-colors hover:text-white">About</a>
                <a href="/women" class="nav-items transition-colors hover:text-white">Women</a>
                <a href="/men" class="nav-items transition-colors hover:text-white">Men</a>
                <a href="/contact-us" class="nav-items transition-colors hover:text-white">Contact us</a>
                <a href="/login" class="nav-items transition-colors hover:text-white">Sign In</a>
            </div>
            <div id="icon" class="ml-6">
                <a href="/cart" id="cart-icon" class="relative inline-block">
                    <lord-icon src="https://cdn.lordicon.com/mfmkufkr.json" trigger="hover" style="width:35px;height:35px"></lord-icon> 
                    <span id="cart-count" class="absolute -top-2 -right-2 bg-blue-600 text-white rounded-full px-1 text-xs font-bold text-center">1</span>
                </a>
            </div>
        </nav>
        <div class="flex items-center justify-between w-full lg:hidden">
            <div class="ml-auto cursor-pointer p-2" onclick="toggleMenu()">
                <div class="w-6 h-0.5 bg-gray-800 mb-1"></div>
                <div class="w-6 h-0.5 bg-gray-800 mb-1"></div>
                <div class="w-6 h-0.5 bg-gray-800"></div>
            </div>
        </div>
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40" onclick="toggleMenu()"></div>
        <div id="mobileMenu" class="fixed inset-0 justify-center items-center z-50 hidden mobile-menu-hidden">
            <div class="bg-white rounded-3xl shadow-2xl overflow-y-auto flex flex-col items-center py-10 px-6 w-11/12 max-w-md relative">
                <button class="absolute top-4 right-4 text-gray-800 hover:text-gray-900" onclick="toggleMenu()">
                    <lord-icon src="storage/xicon.json" trigger="hover" style="width:32px;height:32px"></lord-icon>
                </button>
                <a href="/home" class="mb-8">
                    <img src="storage/CommonImg/BrandLogo.png" alt="Logo" class="h-24 mx-auto">
                </a>
                <div class="flex flex-col items-center space-y-6 text-lg font-medium text-black">
                    <a href="/home" class="mobile-menu-link hover:text-white" onclick="toggleMenu()">Home</a>
                    <a href="/about-us" class="mobile-menu-link hover:text-white" onclick="toggleMenu()">About</a>
                    <a href="/women" class="mobile-menu-link hover:text-white" onclick="toggleMenu()">Women</a>
                    <a href="/men" class="mobile-menu-link hover:text-white" onclick="toggleMenu()">Men</a>
                    <a href="/contact-us" class="mobile-menu-link hover:text-white" onclick="toggleMenu()">Contact us</a>
                    <a href="/login" class="mobile-menu-link hover:text-white" onclick="toggleMenu()">Sign In</a>
                </div>
                <div class="mt-8 mb-4">
                    <a href="{{ url('Cart') }}" id="cart-icon" class="relative inline-block">
                        <lord-icon src="https://cdn.lordicon.com/mfmkufkr.json" trigger="hover" style="width:48px;height:48px"></lord-icon>
                        <span id="cart-count" class="absolute -top-2 -right-2 bg-blue-600 text-white rounded-full px-1 text-xs font-bold text-center">1</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="mt-8">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white pt-10 pb-4 md:pt-16 md:pb-4">
        <div class="container mx-auto px-4 md:flex md:justify-between">
            <div class="mb-8 md:mb-0">
                <p class="text-3xl font-semibold mb-2">Stay Connected</p>
                <p class="text-gray-400 max-w-sm leading-relaxed">
                    Join us on social media and keep up-to-date with our latest updates and exclusive offers.
                </p>
            </div>
            <div class="flex justify-center md:justify-start space-x-6 mb-8 md:mb-0">
                <a href="https://www.facebook.com" target="_blank" class="transform transition hover:scale-110">
                    <img src="storage/CommonImg/facebook logo.png" alt="Facebook" class="h-10 w-10 md:h-12 md:w-12">
                </a>
                <a href="https://www.pinterest.com" target="_blank" class="transform transition hover:scale-110">
                    <img src="storage/CommonImg/pinterest logo.png" alt="Pinterest" class="h-10 w-10 md:h-12 md:w-12">
                </a>
                <a href="https://www.instagram.com" target="_blank" class="transform transition hover:scale-110">
                    <img src="storage/CommonImg/instagram logo.png" alt="Instagram" class="h-10 w-10 md:h-12 md:w-12">
                </a>
                <a href="https://www.tiktok.com" target="_blank" class="transform transition hover:scale-110">
                    <img src="storage/CommonImg/tiktok logo.png" alt="TikTok" class="h-10 w-10 md:h-12 md:w-12">
                </a>
            </div>
            <div class="text-center md:text-left max-w-sm">
                <p class="text-lg mb-4 font-semibold">Subscribe to Our Newsletter</p>
                <div class="flex flex-col space-y-3 md:space-y-0 md:flex-row md:space-x-3">
                    <input type="email" id="email" placeholder="Email address" class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:outline-none focus:border-blue-500">
                    <input type="tel" id="tel" placeholder="Phone number" class="w-full p-3 rounded-lg bg-gray-800 border border-gray-600 text-white focus:outline-none focus:border-blue-500">
                </div>
                <button class="w-full mt-4 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition duration-300 focus:outline-none">
                    Subscribe
                </button>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-10 pt-6 text-center">
            <ul class="flex flex-wrap justify-center space-x-4 text-gray-400 text-sm">
                <li><a href="/home" class="hover:text-white transition duration-300">Home</a></li>
                <li><a href="/about-us" class="hover:text-white transition duration-300">About Us</a></li>
                <li><a href="/contact-us" class="hover:text-white transition duration-300">Contact Us</a></li>
            </ul>
            <p class="mt-4 text-gray-500 text-sm">&copy; 2024 Nexis. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @vite('resources/js/common.js')
    <script>
        function toggleMenu() {
            const overlay = document.getElementById("overlay");
            const mobileMenu = document.getElementById("mobileMenu");

            overlay.classList.toggle("hidden");
            mobileMenu.classList.toggle("hidden");
            mobileMenu.classList.toggle("mobile-menu-visible");
            mobileMenu.classList.toggle("mobile-menu-hidden");
        }
    </script>
</body>

</html>