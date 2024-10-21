@extends('layout')

@section('title', 'Contact Us')

@section('content')
    <!-- Contact Section -->
    <section class="gridSection contactSection">
        <div class="contactformContainer">
            <h1 class="sectionHeader">Get in touch</h1>
            <!-- Frontend Form -->
            <form action="#" class="contactForm">
                <div>
                    <input type="text" name="full_name" placeholder="Full Name" class="contactInput" required>
                    <input type="email" name="email" placeholder="Email" class="contactInput" required>
                </div>
                <textarea name="message" cols="30" rows="5" placeholder="Message" class="contactInput" required></textarea>
                <button type="submit" class="btn primaryBtn contactBtn">Submit</button>
            </form>
        </div>

        <!-- Contact Image -->
        <div class="sectionPic bouncepic contactPic" id="sectionPic">
            <img src="{{ asset('storage/CommonImg/Contact.png') }}" alt="Contact Image">
        </div>
    </section>

    <!-- Addresses Section -->
    <div class="address-container">
        <h1 class="addressHeader">
            <a href="https://maps.app.goo.gl/x4SZWf5XkhLzoRKW9" target="_blank">Our Location</a>
        </h1>
    </div>

    <div class="address">
        <div class="eachAddress">
            <h1>Lebanon</h1>
            <p>Phone: +961 76/063922</p>
            <p>Address: Beirut, Lebanon 1600</p>
            <p>Email: support@nexis.com</p>
        </div>
    </div>
@endsection

@push('styles')
    @vite('resources/css/contactus.css') <!-- Contact Us-specific CSS -->
@endpush
