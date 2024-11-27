<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/png" href="storage/img/CommonImg/blacklogo.png">
    @vite('resources/css/app.css')
</head>
<body>
<div class="absolute top-4 left-4 z-10">
    <button onclick="window.location.href='{{ url('/') }}'" 
            class="flex items-center justify-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-full shadow-md hover:bg-indigo-500 transition duration-200">
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
            <form id="register-form" method="POST" action="{{ route('register') }}">
                @csrf
                <div>
                    <label for="First_Name" class="block font-medium text-sm text-gray-700">
                        {{ __('First Name') }}
                    </label>
                    <input id="First_Name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                           type="text"
                           name="First_Name"
                           value="{{ old('First_Name') }}"
                           autofocus />
                    @error('First_Name')
                        <div class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="Last_Name" class="block font-medium text-sm text-gray-700">
                        {{ __('Last Name') }}
                    </label>
                    <input id="Last_Name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                           type="text"
                           name="Last_Name"
                           value="{{ old('Last_Name') }}"
                            />
                    @error('Last_Name')
                        <div class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="email" class="block font-medium text-sm text-gray-700">
                        {{ __('Email') }}
                    </label>
                    <input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                            />
                    @error('email')
                        <div class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="Phone_Number" class="block font-medium text-sm text-gray-700">
                        {{ __('Phone Number') }}
                    </label>
                    <input id="Phone_Number" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                           type="text"
                           name="Phone_Number"
                           value="{{ old('Phone_Number') }}"
                            />
                    @error('Phone_Number')
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
                            autocomplete="new-password" />
                    @error('password')
                        <div class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="password_confirmation" class="block font-medium text-sm text-gray-700">
                        {{ __('Confirm Password') }}
                    </label>
                    <input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                           type="password"
                           name="password_confirmation"
                            />
                    @error('password_confirmation')
                        <div class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </div>
                    @enderror
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
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit" class="ml-4 inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.querySelector('#register-form').addEventListener('submit', function (event) {
    const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
    const wishlistInput = document.createElement('input');
    wishlistInput.type = 'hidden';
    wishlistInput.name = 'wishlist';
    wishlistInput.value = JSON.stringify(wishlist);
    this.appendChild(wishlistInput);
});

</script>


<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <div id="particles-js" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
    <script src="{{ mix('resources/js/particles-config.js') }}"></script> 
</body>
</html>
