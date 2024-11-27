<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="storage/img/CommonImg/blacklogo.png">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <!-- Mobile navigation button (for smaller screens) -->
    <div class="absolute top-4 left-4 z-10">
        <button onclick="window.location.href='{{ url('/') }}'"
            class="flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-medium rounded-full shadow-md hover:bg-indigo-500 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
        </button>
    </div>

    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <img src="storage/img/CommonImg/BrandLogo.png" alt="Logo" class="h-20">

        </div>


        <div class="w-full max-w-[80%] sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg z-10">


            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif
            @if(session('success'))
            <div class="flash-message fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500 ease-in-out">
                {{ session('success') }}
            </div>
            @elseif(session('error'))
            <div class="flash-message fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500 ease-in-out">
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block font-medium text-sm text-gray-700">
                        {{ __('Email') }}
                    </label>
                    <input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        autofocus autocomplete="username" />
                    @error('email')
                    <div class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="password" class="block font-medium text-sm text-gray-700">
                        {{ __('Password') }}
                    </label>
                    <input id="password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        type="password"
                        name="password"
                        autocomplete="current-password" />
                    @error('password')
                    <div class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer"
                            name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Forgot Password -->
                <div class="mt-4 text-left">
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>

                <div class="mt-4 flex justify-center">
                    <a href="{{ route('google-auth') }}"
                        class="flex items-center justify-center sm:w-3/4 px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-full shadow hover:bg-gray-300 transition z-10">
                        <img src="{{ asset('storage/img/login/google-icon-logo.svg') }}"
                            alt="Google Logo"
                            class="w-5 h-5 mr-2">
                        Continue with Google
                    </a>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 z-10"
                        href="{{ route('register') }}">
                        {{ __('New Customer? Register Here!') }}
                    </a>

                    <button type="submit" class="ml-3 inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition z-10">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <div id="particles-js" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
    <script src="{{ mix('resources/js/particles-config.js') }}"></script>
    <script>
        if (document.querySelector('.flash-message')) {
            setTimeout(function() {
                const flashMessage = document.querySelector('.flash-message');
                flashMessage.style.transition = 'opacity 0.5s';
                flashMessage.style.opacity = '0';
                setTimeout(function() {
                    flashMessage.remove();
                }, 500);
            }, 3000);
        }
    </script>
</body>

</html>