@extends('layout')

@section('title', 'Contact Us')

@section('content')
<section class="flex flex-col md:flex-row items-center gap-6 mb-8 mx-auto p-8 md:p-12 bg-white text-gray-800 md:justify-between">
    <div class="flex flex-col space-y-4 w-full md:w-1/2">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Get in Touch</h1>
        <p class="text-md md:text-lg text-gray-600 mb-4">Have a question or want to work together? Drop us a message!</p>
        <form action="#" class="space-y-3">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <input type="text" placeholder="Full name" class="w-full p-3 rounded-full border border-gray-300 bg-white text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 transition duration-300 focus:outline-none">
                <input type="email" placeholder="Email" class="w-full p-3 rounded-full border border-gray-300 bg-white text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 transition duration-300 focus:outline-none">
            </div>
            <textarea placeholder="Message" class="w-full p-3 rounded-xl border border-gray-300 bg-white text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 transition duration-300 focus:outline-none" rows="4"></textarea>
            <button type="submit" class="py-2 px-6 w-full md:w-auto bg-gradient-to-r from-blue-600 to-blue-800 rounded-full font-semibold text-md text-white shadow-md transform transition-transform hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Submit</button>
        </form>
    </div>
    <div class="flex justify-center items-center w-full md:w-1/2 max-w-xs md:max-w-md mx-auto animate-bounce-custom">
        <img src="storage/img/CommonImg/Contact.png" alt="Contact" class="w-full rounded-lg">
    </div>
</section>

<div class="flex flex-col md:flex-row items-center gap-6 px-6 md:px-12 py-10 bg-white text-gray-800 rounded-lg shadow-lg">
    <div class="w-full md:w-1/2 rounded-lg overflow-hidden shadow-md transform transition-transform duration-300 hover:scale-105">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d212361.61152701065!2d35.3415633!3d33.7309325!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f1798849fcae3%3A0xcb7cf8d31d35ce1!2sCity%20Centre%20Beirut!5e0!3m2!1sen!2slb!4v1730239123142!5m2!1sen!2slb"
            width="100%"
            height="350"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    <div class="w-full md:w-1/2 text-center md:text-left space-y-3">
        <h2 class="text-2xl font-bold text-gray-900">Our Location</h2>
        <p class="text-md text-gray-600">Visit us at our office or contact us through the details below.</p>
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Lebanon Office</h3>
            <p class="text-gray-700 mb-1"><strong>Phone:</strong> +961 81777256</p>
            <p class="text-gray-700 mb-1"><strong>Address:</strong> Beirut, Lebanon 1600</p>
            <p class="text-gray-700"><strong>Email:</strong> <a href="mailto:support@nexis.com" class="text-blue-600 underline hover:text-blue-800 transition duration-200">support@nexis.com</a></p>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .animate-bounce-custom {
        animation: bounce-custom 2s infinite;
    }

    @keyframes bounce-custom {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }
</style>
@endpush