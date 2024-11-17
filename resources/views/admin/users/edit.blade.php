@extends('admin.layouts.sidebar')

@section('content')
<div class="mx-auto">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-extrabold text-gray-900">
            {{ __('User:') }} <span class="text-blue-600">{{ $user->First_Name }} {{ $user->Last_Name }}</span>
        </h1>
        <a href="{{ route('users.index') }}"
           class="text-gray-700 bg-gray-100 px-5 py-2 rounded-lg shadow hover:bg-gray-200 transition-all focus:outline-none focus:ring-2 focus:ring-blue-400">
            ← {{ __('Back to Users') }}
        </a>
    </div>

    {{-- <!-- User Information -->
    <div class="bg-white rounded-xl shadow-lg border mb-10 p-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-10">
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">{{ __('First Name') }}</h2>
                <p class="text-xl font-bold text-gray-800">{{ $user->First_Name }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">{{ __('Last Name') }}</h2>
                <p class="text-xl font-bold text-gray-800">{{ $user->Last_Name }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">{{ __('Email Address') }}</h2>
                <p class="text-gray-700">{{ $user->email }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">{{ __('Phone Number') }}</h2>
                <p class="text-gray-700">{{ $user->Phone_Number ?? __('Not Provided') }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">{{ __('Created At') }}</h2>
                <p class="text-gray-700">{{ $user->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">{{ __('Last Updated') }}</h2>
                <p class="text-gray-700">{{ $user->updated_at->format('d M Y, h:i A') }}</p>
            </div>
        </div>
    </div> --}}

    <!-- Edit Form -->
    <div class="bg-white rounded-xl shadow-lg border p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ __('Edit User') }}</h2>
        <form action="{{ route('users.update', $user->UserID) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            @csrf
            @method('PUT')
        
            <!-- First Name Field -->
            <div>
                <label for="userFirstName" class="block text-blue-700 font-semibold mb-2">{{ __('First Name') }}</label>
                <input type="text" id="userFirstName" name="First_Name" placeholder="{{ __('Enter first name') }}"
                       value="{{ old('First_Name', $user->First_Name) }}"
                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400 shadow">
                @error('First_Name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        
            <!-- Last Name Field -->
            <div>
                <label for="userLastName" class="block text-blue-700 font-semibold mb-2">{{ __('Last Name') }}</label>
                <input type="text" id="userLastName" name="Last_Name" placeholder="{{ __('Enter last name') }}"
                       value="{{ old('Last_Name', $user->Last_Name) }}"
                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400 shadow">
                @error('Last_Name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        
            <!-- Email Field -->
            <div>
                <label for="userEmail" class="block text-blue-700 font-semibold mb-2">{{ __('Email') }}</label>
                <input type="email" id="userEmail" name="email" placeholder="{{ __('Enter user email') }}"
                       value="{{ old('email', $user->email) }}"
                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400 shadow">
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        
            <!-- Phone Number Field -->
            <div>
                <label for="userPhone" class="block text-blue-700 font-semibold mb-2">{{ __('Phone Number') }}</label>
                <input type="text" id="userPhone" name="Phone_Number" placeholder="{{ __('Enter phone number') }}"
                       value="{{ old('Phone_Number', $user->Phone_Number) }}"
                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400 shadow">
                @error('Phone_Number')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        
            {{-- <!-- Password Field -->
            <div>
                <label for="userPassword" class="block text-blue-700 font-semibold mb-2">{{ __('Password') }}</label>
                <input type="password" id="userPassword" name="password" placeholder="{{ __('Enter new password (optional)') }}"
                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400 shadow">
                @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        
            <!-- Confirm Password Field -->
            <div>
                <label for="userPasswordConfirm" class="block text-blue-700 font-semibold mb-2">{{ __('Confirm Password') }}</label>
                <input type="password" id="userPasswordConfirm" name="password_confirmation"
                       placeholder="{{ __('Confirm new password') }}"
                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400 shadow">
                @error('password_confirmation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div> --}}
        
            <!-- Submit Button -->
            <div class="col-span-1 sm:col-span-2 flex justify-end">
                <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </form>        
    </div>
</div>
@endsection
