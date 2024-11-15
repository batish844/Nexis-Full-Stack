<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="icon" type="image/png" href="storage/img/CommonImg/blacklogo.png">
    @vite('resources/css/app.css')
</head>
<body>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
        <img src="storage/img/CommonImg/BrandLogo.png" alt="Logo" class="h-20">

        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('register') }}">
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

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit" class="ml-4 inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
