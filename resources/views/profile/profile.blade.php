@extends('profile.layout')
@section('content')
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            {{-- Avatar Section --}}
            <div class="px-12 sm:px-32 py-6 sm:py-10 mx-8 sm:mx-8 bg-white shadow-md rounded-lg">
                <div class="w-88 mx-auto">
                    <section>
                        {{-- Avatar Display --}}
                        <div class="relative">
                            {{-- Display Avatar --}}
                            @if ($user->avatar === null)
                                {{-- Display default icon --}}
                                <div
                                    class="overflow-hidden w-36 h-36 sm:w-52 sm:h-52 md:w-56 md:h-56 lg:w-60 lg:h-60 mx-auto rounded-full bg-gray-300 flex items-center justify-center border-4 border-blue-600 shadow-md">
                                    <img src="/storage/img/icons/Default-Avatar.png" alt="USER AVATAR">
                                </div>

                                {{-- Upload Button --}}
                                <form id="avatar-upload-form" class="flex justify-center flex-row  mt-12" method="POST"
                                    action="{{ route('profile.avatar.upload') }}" enctype="multipart/form-data">
                                    @csrf
                                    <label for="avatar-upload"
                                        class="w-fit inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm font-medium rounded-full shadow-md hover:from-blue-600 hover:to-indigo-700 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5 12h14M12 5l7 7-7 7" />
                                        </svg>
                                        Upload Avatar
                                    </label>
                                    <input type="file" id="avatar-upload" name="avatar" accept="image/*" class="hidden"
                                        onchange="document.getElementById('avatar-upload-form').submit();">
                                </form>
                            @else
                                {{-- Display uploaded avatar --}}
                                <div
                                    class="overflow-hidden w-36 h-36 sm:w-52 sm:h-52 md:w-56 md:h-56 lg:w-60 lg:h-60 mx-auto rounded-full bg-gray-300 flex items-center justify-center border-4 border-blue-600 shadow-md">
                                    <img src="{{ asset('storage/img/avatar/' . $user->avatar) }}" alt="User Avatar">
                                </div>

                                {{-- Update and Delete Buttons --}}
                                <div class="flex mt-12 justify-center mt-10 gap-2 md:gap-4">
                                    {{-- Update Avatar Form --}}
                                    <form id="avatar-update-form" method="POST"
                                        action="{{ route('profile.avatar.upload') }}" enctype="multipart/form-data">
                                        @csrf
                                        <label for="avatar-update"
                                            class="inline-flex items-center justify-center px-2 sm:px-3 md:px-4 py-2 sm:py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-xs md:text-sm font-medium rounded-full shadow-md hover:from-blue-600 hover:to-indigo-700 transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 md:mr-2 rotate-180"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5 12h14M12 5l7 7-7 7" />
                                            </svg>
                                            Update
                                        </label>
                                        <input type="file" id="avatar-update" name="avatar" accept="image/*"
                                            class="hidden"
                                            onchange="document.getElementById('avatar-update-form').submit();">
                                    </form>

                                    {{-- Delete Avatar Form --}}
                                    <form id="avatar-delete-form" method="POST"
                                        action="{{ route('profile.avatar.delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center px-2 sm:px-3 md:px-4 py-2 sm:py-3 bg-gradient-to-r from-red-600 to-red-800 text-white text-xs sm:text:sm md:text-sm font-medium rounded-full shadow-md hover:from-red-700 hover:to-red-900 focus:outline-none focus:ring-4 focus:ring-red-300 transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:mr-2"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Delete
                                        </button>

                                    </form>
                                </div>
                            @endif
                        </div>
                    </section>
                </div>
            </div>
            {{-- Profile Information Section --}}
            <div class="px-12 sm:px-20 md:32 py-6 sm:py-10 mx-6 sm:mx-8 bg-white shadow-md rounded-lg">
                <div class="w-88 mx-auto">
                    <section>
                        <header class="border-b pb-4 mb-6">
                            <h2 class="text-2xl font-semibold text-blue-900">{{ __('Profile Information') }}</h2>
                            <p class="mt-2 text-sm text-blue-800">
                                {{ __("Update your account's profile information and email address.") }}
                            </p>
                        </header>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        {{-- Profile Notification --}}
                        <div id="profile-notification"
                            class="relative top-1 hidden transform -translate-x-1/2 translate-y-full max-w-fit whitespace-nowrap bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded shadow-md z-50 transition-transform transition-opacity duration-500 ease-in-out">
                            <span id="profile-notification-message"></span>
                        </div>
                        <form id="profile-form" method="post" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('patch')

                            {{-- First Name and Last Name --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label class="text-blue-800" for="First_Name" :value="__('First Name')" />
                                    <x-text-input id="First_Name" class="block mt-1 w-full" type="text" name="First_Name"
                                        :value="old('First_Name', $user->First_Name)" required autofocus disabled />
                                    <x-input-error :messages="$errors->get('First_Name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label class="text-blue-800" for="Last_Name" :value="__('Last Name')" />
                                    <x-text-input id="Last_Name" class="block mt-1 w-full" type="text" name="Last_Name"
                                        :value="old('Last_Name', $user->Last_Name)" required disabled />
                                    <x-input-error :messages="$errors->get('Last_Name')" class="mt-2" />
                                </div>
                            </div>

                            {{-- Email and Phone Number --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label class="text-blue-800" for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                        :value="old('email', $user->email)" required autocomplete="username" disabled />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label class="text-blue-800" for="Phone_Number" :value="__('Phone Number')" />
                                    <x-text-input id="Phone_Number" class="block mt-1 w-full disabled" type="text"
                                        name="Phone_Number" :value="old('Phone_Number', $user->Phone_Number)" required disabled />
                                    <x-input-error :messages="$errors->get('Phone_Number')" class="mt-2" />
                                </div>
                            </div>

                            {{-- City, Street Address, and Building --}}
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                                <div>
                                    <x-input-label for="city" :value="__('City')" />
                                    <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                                        :value="old('city', $user->city)" disabled/>

                                </div>
                                <div>
                                    <x-input-label class="text-blue-800" for="street_address" :value="__('Street Address')" />
                                    <x-text-input id="street_address" class="block mt-1 w-full" type="text"
                                        name="street_address" :value="old('street_address', $user->street_address)" disabled />


                                </div>
                                <div>
                                    <x-input-label class="text-blue-800" for="building" :value="__('Building')" />
                                    <x-text-input id="building" class="block mt-1 w-full" type="text"
                                        name="building" :value="old('building', $user->building)" disabled />

                                </div>
                            </div>

                            {{-- Save, Cancel, and Edit Buttons --}}

                            <div class="flex justify-end">
                                <button id="edit-profile-btn" type="button"
                                    class="w-fit flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm font-medium rounded-full shadow-md hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300">
                                    <img src="/storage/img/icons/edit-icon.svg" alt="Edit" class="w-4 h-4 mr-2">
                                    Edit
                                </button>

                                <div id="edit-actions" class="hidden space-x-1 sm:space-x-3 md:space-x-4 flex flex-row">
                                    <button type="submit"
                                        class="w-fit mx-auto flex items-center justify-center px-2 sm:px-3 md:px-6 py-2 sm:py-3 bg-gradient-to-r from-green-500 to-green-600 text-white text-sm font-medium rounded-full shadow-md hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"></path>
                                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                            <polyline points="7 3 7 8 15 8"></polyline>
                                        </svg>
                                        Save
                                    </button>
                                    <button type="button" id="cancel-edit"
                                        class="inline-flex items-center justify-center px-2 sm:px-3 md:px-6 py-2 sm:py-3 bg-gradient-to-r from-red-600 to-red-800 text-white text-sm font-medium rounded-full shadow-md hover:from-red-700 hover:to-red-900 focus:outline-none focus:ring-4 focus:ring-red-300 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                            </path>
                                        </svg>
                                        Cancel
                                    </button>
                                    @if (session('status') === 'profile-updated')
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                showProfileNotification('Profile updated successfully.', 'success');
                                            });
                                        </script>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            {{-- Update Password Section --}}
            <div class="px-12 sm:px-20 md:32 py-6 sm:py-10 mx-6 sm:mx-8 bg-white shadow-md rounded-lg">
                <div class="w-88 mx-auto">
                    <section>
                        <header class="border-b pb-4 mb-6">
                            <h2 class="text-2xl font-semibold text-blue-900">{{ __('Update Password') }}</h2>
                            <p class="mt-2 text-sm text-blue-800">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}
                            </p>
                        </header>
                        <div id="password-notification"
                            class="relative top-12 hidden transform -translate-x-1/2 translate-y-full max-w-fit whitespace-nowrap bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded shadow-md z-50 transition-transform transition-opacity duration-500 ease-in-out">
                            <span id="password-notification-message"></span>
                        </div>
                        <form id="update-password-form" method="post" action="{{ route('password.update') }}"
                            class="space-y-6">
                            @csrf
                            @method('put')

                            {{-- Current Password --}}
                            <div>
                                <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                                <x-text-input id="update_password_current_password" name="current_password"
                                    type="password" class="mt-1 block w-full" autocomplete="current-password" disabled />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>

                            {{-- New Password and Confirm Password --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="update_password_password" :value="__('New Password')" />
                                    <x-text-input id="update_password_password" name="password" type="password"
                                        class="mt-1 block w-full" autocomplete="new-password" disabled />
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                                    <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                                        type="password" class="mt-1 block w-full" autocomplete="new-password" disabled />
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>

                            {{-- Save, Cancel, and Edit Buttons --}}
                            <div class="flex justify-end">
                                <button id="edit-pass-btn" type="button"
                                    class="w-fit flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-sm font-medium rounded-full shadow-md hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300">
                                    <img src="/storage/img/icons/edit-icon.svg" alt="Edit" class="w-4 h-4 mr-2">
                                    Edit
                                </button>

                                <div id="update-actions" class="hidden space-x-1 sm:space-x-3 md:space-x-4 flex flex-row">
                                    <button type="submit"
                                        class="w-fit mx-auto flex items-center justify-center px-2 sm:px-3 md:px-6 py-2 sm:py-3 bg-gradient-to-r from-green-500 to-green-600 text-white text-sm font-medium rounded-full shadow-md hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"></path>
                                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                            <polyline points="7 3 7 8 15 8"></polyline>
                                        </svg>
                                        Save
                                    </button>
                                    <button type="button" id="cancel-pass"
                                        class="inline-flex items-center justify-center px-2 sm:px-3 md:px-6 py-2 sm:py-3 bg-gradient-to-r from-red-600 to-red-800 text-white text-sm font-medium rounded-full shadow-md hover:from-red-700 hover:to-red-900 focus:outline-none focus:ring-4 focus:ring-red-300 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                            </path>
                                        </svg>
                                        Cancel
                                    </button>
                                    @if (session('status') === 'password-updated')
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                showPasswordNotification('Password updated successfully.', 'success');
                                            });
                                        </script>
                                    @endif
                                </div>
                        </form>
                    </section>
                </div>
            </div>

            {{-- Delete Account Section --}}
            <div class="px-12 sm:px-20 md:32 py-6 sm:py-10 mx-6 sm:mx-8 bg-white shadow-md rounded-lg">
                <div class="max-w-2xl">
                    <section>
                        <header class="border-b pb-4 mb-6">
                            <h2 class="text-2xl font-semibold text-gray-900">{{ __('Delete Account') }}</h2>
                            <p class="mt-2 text-sm text-gray-600">
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                            </p>
                        </header>

                        <x-danger-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                            class="bg-gradient-to-r from-red-600 to-red-800 text-white">
                            {{ __('Delete Account') }}
                        </x-danger-button>
                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                @csrf
                                @method('delete')
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Are you sure you want to delete your account?') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                </p>

                                <div class="mt-6">
                                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                                    <x-text-input id="password" name="password" type="password"
                                        class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" />

                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ms-3">
                                        {{ __('Delete Account') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </section>
                    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
                </div>
            </div>
        </div>
    </div>
@endsection
