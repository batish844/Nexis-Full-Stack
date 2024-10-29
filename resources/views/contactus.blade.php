@extends('layout')

@section('title', 'Contact Us')

@section('content')
    <!-- Contact Section -->
    <section class="flex flex-col md:flex-row justify-center w-full py-16 px-6 md:px-12 gap-8">
        <!-- Contact Form Container -->
        <div class="bg-white p-8 rounded-lg shadow-lg transition-transform transform hover:scale-105 duration-300">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">Get in Touch</h1>
            
            <!-- Frontend Form -->
            <form action="#" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input 
                        type="text" 
                        name="full_name" 
                        placeholder="Full Name" 
                        class="border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md p-3" 
                        required
                    >
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        class="border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md p-3" 
                        required
                    >
                </div>
                
                <textarea 
                    name="message" 
                    cols="30" 
                    rows="5" 
                    placeholder="Message" 
                    class="border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md p-3 w-full" 
                    required
                ></textarea>
                
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-md font-semibold transition duration-300">
                    Submit
                </button>
            </form>
        </div>

        <!-- Contact Image with Bounce Animation -->
        <div class="sectionPic bouncepic contactPic overflow-hidden flex justify-center items-center h-64 md:h-auto">
            <img src="{{ asset('storage/CommonImg/Contact.png') }}" alt="Contact Image" class="transform transition-transform duration-500 animate-bounce">
        </div>
    </section>

    <!-- Addresses Section -->
    <div class="flex flex-col items-center my-16 space-y-10">
        <h2 class="text-3xl font-semibold text-gray-800 tracking-tight">
            <a href="https://maps.app.goo.gl/x4SZWf5XkhLzoRKW9" target="_blank" class="text-blue-600 hover:text-blue-700 transition duration-200">
                Visit Our Office
            </a>
        </h2>

        <div class="bg-white p-10 rounded-xl shadow-md w-full md:w-3/5 lg:w-2/5 text-center">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Lebanon Office</h3>
            <p class="text-gray-700 mb-2"><span class="font-semibold">Phone:</span> +961 76/063922</p>
            <p class="text-gray-700 mb-2"><span class="font-semibold">Address:</span> Beirut, Lebanon 1600</p>
            <p class="text-gray-700"><span class="font-semibold">Email:</span> <a href="mailto:support@nexis.com" class="text-blue-600 hover:underline">support@nexis.com</a></p>
        </div>
    </div>
@endsection

@push('styles')
    {{-- You can add any additional custom styles here --}}
    <style>
        /* Bounce animation for the contact image */
        .bouncepic img {
            animation: bounce 3s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
    </style>
@endpush
