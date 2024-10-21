@extends('layout')

@section('title', 'About Us')

@section('content')
    <!-- Slide Images on About Page -->
    <div class="image-slider">
        <div class="slide">
            <img src="{{ asset('storage/aboutus/NexusQuote.png') }}" alt="Slide 1">
        </div>
    </div>

    <!-- About Content Section -->
    <section class="Section">
        <div class="Desc aboutusDesc">
            <h1 class="headline">Nexis's History</h1>
            <p class="subheadline">Nexis, established in 1985, began with a vision to bring high-end fashion to every corner
                of the globe. What started as a small store has now expanded 
                into an international fashion house known for its daring designs, and commitment to sustainable fashion.
            </p>

            <h2>Our Promise</h2>
            <p class="subheadline">We pledge to continue bringing you the latest in fashion with integrity and passion. Nexis is not just about clothing; it's about building a legacy—one that's as timeless as style itself.</p>

            <h2>Fashion Forward</h2>
            <p class="subheadline">As we look to the future, Nexis is more than a brand; it's a lifestyle. We're constantly exploring new horizons, pushing boundaries, and setting trends. Our commitment to innovation is unwavering, ensuring every Nexis wearer stands out in the crowd.</p>
        </div>

        <!-- Status Section -->
        <div class="Desc aboutusDesc">
            <div class="subheadline">
                <h1><b>Diverse Clientele</b></h1>
                <p>Our fashion house serves an eclectic mix of discerning customers globally.</p>
            </div>
            <div class="subheadline">
                <h1><b>Endless Creations</b></h1>
                <p>Every piece tells a story. Our portfolio is a testament to our commitment to design excellence.</p>
            </div>
            <div class="subheadline">
                <h1><b>Global Footprint</b></h1>
                <p>Nexis styles are adored across continents, weaving a tapestry of diverse cultural expressions.</p>
            </div>
        </div>
    </section>

    <!-- CEO Section -->
    <section class="ceo-section">
        <h2>Meet Our CEOs</h2>
        <div class="ceo-container">
            <div class="ceo">
                <img src="{{ asset('storage/aboutus/CEO1.jpg') }}" alt="CEO Image 1" class="ceo-img">
                <h3>Samer Hariri</h3>
                <p>Co-Founder & CEO</p>
                <p>Samer has been at the forefront of fashion innovation, steering Nexis with her visionary leadership.</p>
            </div>
            <div class="ceo">
                <img src="{{ asset('storage/aboutus/CEO2.jpg') }}" alt="CEO Image 2" class="ceo-img">
                <h3>Mahmoud Batish</h3>
                <p>Co-Founder & CEO</p>
                <p>Mahmoud's business acumen and passion for design have been integral to Nexis's international success.</p>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    @vite('resources/css/about.css') <!-- About Us-specific CSS -->
@endpush


