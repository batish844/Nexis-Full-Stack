@extends('layout')

@section('title', 'About Us')

@section('content')
<div class="relative flex flex-col md:flex-row items-center justify-center h-[600px] bg-gradient-to-br from-gray-900 to-gray-700 text-white overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-transparent to-gray-900 opacity-70 animate-gradient"></div>
    <div class="relative z-10 p-8 md:w-1/2 text-center md:text-left">
        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-wider mb-4 animate-fade-in">
            Welcome to Nexis
        </h1>
        <p class="text-lg md:text-2xl font-light text-gray-200 mb-8 animate-fade-in-delay">
            A legacy of fashion, innovation, and sustainability that transcends time.
        </p>
        <a href="#our-journey" class="inline-block px-8 py-3 bg-blue-500 text-white font-semibold rounded-full shadow-xl hover:bg-blue-600 transition transform hover:scale-105 duration-300 animate-fade-in-delay-long">
            Discover Our Story
        </a>
    </div>
    <div class="relative z-0 md:w-1/2 h-full">
        <img src="{{ Storage::url('img/aboutus/banner.jpg') }}" alt="Nexis Fashion" class="object-cover w-full h-full transform scale-105 opacity-90 animate-parallax">
    </div>
</div>
<section id="our-journey" class="py-20 px-8 md:px-16 lg:px-24 text-gray-800 bg-gray-50">
    <div class="max-w-4xl mx-auto text-center mb-12">
        <h2 class="text-4xl font-extrabold mb-6 text-gray-800">Our Journey</h2>
        <p class="text-lg md:text-xl text-gray-600">Since 1985, Nexis has led the way in fashion innovation. From a small boutique to a global brand, our mission remains the same: to inspire, to create, and to embody timeless style with sustainable practices.</p>
    </div>
</section>
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto text-center">
        <h2 class="text-4xl font-extrabold mb-12">Our Core Values</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 bg-gray-100 rounded-xl shadow-lg hover:bg-gray-200 transition duration-300">
                <h3 class="text-2xl font-bold mb-4">Innovation</h3>
                <p class="text-gray-600">At Nexis, we’re constantly pushing the boundaries of fashion with innovative designs.</p>
            </div>
            <div class="p-8 bg-gray-100 rounded-xl shadow-lg hover:bg-gray-200 transition duration-300">
                <h3 class="text-2xl font-bold mb-4">Sustainability</h3>
                <p class="text-gray-600">We are committed to ethical practices, ensuring a sustainable future for fashion.</p>
            </div>
            <div class="p-8 bg-gray-100 rounded-xl shadow-lg hover:bg-gray-200 transition duration-300">
                <h3 class="text-2xl font-bold mb-4">Integrity</h3>
                <p class="text-gray-600">Honesty and transparency are at the core of everything we do.</p>
            </div>
        </div>
    </div>
</section>
@php
$founders = [
[
'name' => 'Mahmoud Batish',
'title' => 'Co-Founder & CEO',
'image' => 'img/aboutus/about1.jpg',
'description' => 'Mahmoud’s vision and strategic acumen have been pivotal in establishing Nexis’s presence.'
],
[
'name' => 'Ahmad Sharara',
'title' => 'Co-Founder & CTO',
'image' => 'img/aboutus/about2.png',
'description' => 'Ahmad has led Nexis toward fashion excellence and innovation with a focus on sustainable practices.'
],
[
'name' => 'Jamal Hamd',
'title' => 'Chief Marketing Officer',
'image' => 'img/aboutus/about3.png',
'description' => 'Jamal’s expertise in marketing has driven Nexis to reach broader audiences and enhance brand presence.'
], [
'name' => 'Samia Majzoub',
'title' => 'Chief Operations Officer',
'image' => 'img/aboutus/about4.png',
'description' => 'Samia ensures smooth operations and efficient processes, maintaining Nexis’s commitment to quality and excellence.'
]
];

@endphp

<section class="py-20 px-8 md:px-16 lg:px-24 bg-gray-50">
    <h2 class="text-4xl font-extrabold text-center mb-12">Meet Our Founders</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 justify-center items-center">
        @foreach ($founders as $founder)
        <div class="bg-white p-10 rounded-3xl shadow-lg max-w-sm mx-auto text-center transform transition duration-300 hover:scale-105 hover:shadow-2xl flex flex-col">
            <div class="w-32 h-32 mx-auto mb-6">
                <img src="{{ Storage::url($founder['image']) }}" alt="CEO {{ $founder['name'] }}" class="rounded-full shadow-md border-4 border-gray-100 object-cover w-full h-full">
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $founder['name'] }}</h3>
            <p class="text-md text-gray-500 mb-4">{{ $founder['title'] }}</p>
            <p class="text-lg text-gray-600 flex-grow">{{ $founder['description'] }}</p>
        </div>
        @endforeach
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto text-center mb-12">
        <h2 class="text-4xl font-extrabold">Milestones</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-8 md:px-16 lg:px-24">
        <div class="bg-gray-50 p-8 rounded-lg shadow-lg">
            <h3 class="text-2xl font-bold mb-4">1985</h3>
            <p class="text-gray-600">Nexis was founded with a vision to redefine fashion.</p>
        </div>
        <div class="bg-gray-50 p-8 rounded-lg shadow-lg">
            <h3 class="text-2xl font-bold mb-4">2005</h3>
            <p class="text-gray-600">Expanded internationally, becoming a global fashion brand.</p>
        </div>
        <div class="bg-gray-50 p-8 rounded-lg shadow-lg">
            <h3 class="text-2xl font-bold mb-4">2020</h3>
            <p class="text-gray-600">Recognized as a leader in sustainable fashion innovation.</p>
        </div>
    </div>
</section>
<section class="py-20 px-8 md:px-16 lg:px-24 bg-gray-50">
    <h2 class="text-4xl font-extrabold text-center mb-12">What Our Customers Say</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="p-8 bg-white rounded-lg shadow-lg">
            <p class="text-gray-600 mb-4">"Nexis offers a perfect blend of elegance and sustainability. I feel proud wearing their collections!"</p>
            <h3 class="text-lg font-semibold">- Emily R.</h3>
        </div>
        <div class="p-8 bg-white rounded-lg shadow-lg">
            <p class="text-gray-600 mb-4">"Their commitment to innovation is unmatched. Every piece feels unique and timeless."</p>
            <h3 class="text-lg font-semibold">- Mark T.</h3>
        </div>
        <div class="p-8 bg-white rounded-lg shadow-lg">
            <p class="text-gray-600 mb-4">"Nexis truly cares about the environment. It’s inspiring to see a brand making real efforts."</p>
            <h3 class="text-lg font-semibold">- Sarah K.</h3>
        </div>
    </div>
</section>
<section class="py-20 bg-gray-800 text-white text-center">
    <h2 class="text-4xl font-extrabold mb-6">Join Us on Our Journey</h2>
    <p class="text-lg mb-12">Be part of a brand that values innovation, sustainability, and style.</p>
    <a href="/contact-us" class="px-8 py-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-300">Contact Us</a>
</section>
@endsection

<style>
    .animate-gradient {
        background-size: 400% 400%;
        animation: gradientAnimation 15s ease infinite;
    }

    @keyframes gradientAnimation {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .animate-fade-in {
        animation: fadeIn 1s ease forwards;
        opacity: 0;
    }

    .animate-fade-in-delay {
        animation: fadeIn 1.5s ease forwards;
        opacity: 0;
    }

    .animate-fade-in-delay-long {
        animation: fadeIn 2s ease forwards;
        opacity: 0;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-parallax {
        animation: parallaxMove 20s ease-in-out infinite alternate;
    }

    @keyframes parallaxMove {
        0% {
            transform: translateY(0) scale(1.05);
        }

        100% {
            transform: translateY(-20px) scale(1.1);
        }
    }
</style>