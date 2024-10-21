<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Nexus')</title> <!-- Dynamic title section -->

  <!-- Favicon Icon of our Logo on the tab -->
  <link rel="icon" type="image/png" href="{{ asset('storage/CommonImg/BrandLogo.png') }}"> <!-- Corrected favicon path -->

  <!-- Common Stylesheets (Add any stylesheets needed across all pages) -->
  @vite('resources/css/commonStyle.css') <!-- Common style across all pages -->
  <script src="https://cdn.lordicon.com/lordicon-1.2.0.js"></script> <!-- Load once globally -->
  <!-- Dynamic styles that will be pushed by individual pages -->
  @stack('styles') <!-- In case you need to add additional styles in child views -->
</head>

<body>
  <header>
    <!-- Hamburger Icon for responsiveness on mobile -->
    <div class="hamburger-menu" onclick="toggleMenu()">
      <div class="bar"></div>
      <div class="bar"></div>
      <div class="bar"></div>
    </div>

    <!-- Navigation Bar menu for a friendly interface -->
    <nav class="nav" id="navMenu">
      <a href="{{ url('/') }}"> <!-- Using Laravel's url helper for homepage -->
        <img src="{{ asset('storage/CommonImg/BrandLogo.png') }}" alt="Logo" class="nav-logo"> <!-- Corrected logo path -->
      </a>
      <a href="{{ url('/') }}" class="nav-items">Home</a>
      <a href="{{ url('/About') }}" class="nav-items">About</a>
      <a href="{{ url('/Women') }}" class="nav-items">Women</a>
      <a href="{{ url('/Men') }}" class="nav-items">Men</a>
      <a href="{{ url('/ContactUs') }}" class="nav-items">Contact us</a>
      <a href="{{ url('/Login') }}" class="nav-items">Sign In</a>

      <!-- Cart with cart animation on hover -->
      <div id="icon">
        <a href="{{ url('Cart') }}" id="cart-icon">
          <lord-icon src="https://cdn.lordicon.com/mfmkufkr.json" trigger="hover" style="width:50px;height:50px"></lord-icon>
          <span id="cart-count">0</span> <!-- Added span for cart count -->
        </a>
      </div>
    </nav>
  </header>

  <!-- JavaScript for toggling the hamburger menu -->
  <script>
    function toggleMenu() {
      var navMenu = document.getElementById("navMenu");
      navMenu.classList.toggle("active");
    }
  </script>

  <main>
    @yield('content') <!-- Dynamic content section -->
  </main>

  <footer>
    <div class="footer-container">
      <p class="footer-find-us">Find us on:</p>

      <!-- Social Links Section -->
      <div class="footer-social-links">
        <a href="https://www.facebook.com" target="_blank" class="social-link">
          <img src="{{ asset('storage/CommonImg/facebook logo.png') }}" alt="Facebook"> <!-- Corrected image paths -->
        </a>
        <a href="https://www.pinterest.com" target="_blank" class="social-link">
          <img src="{{ asset('storage/CommonImg/pinterest logo.png') }}" alt="Pinterest">
        </a>
        <a href="https://www.instagram.com" target="_blank" class="social-link">
          <img src="{{ asset('storage/CommonImg/instagram logo.png') }}" alt="Instagram">
        </a>
        <a href="https://www.tiktok.com" target="_blank" class="social-link">
          <img src="{{ asset('storage/CommonImg/tiktok logo.png') }}" alt="TikTok">
        </a>
      </div>
    </div>

    <!-- Subscription Section -->
    <div class="signup">
      <p class="subscribe-text">Subscribe to stay updated with our latest trends!</p>
      <div class="signup-form">
        <input type="email" id="email" placeholder="Your email address">
        <span id="email-error" class="error-message"></span>
        <input type="tel" id="tel" placeholder="Your phone number">
        <span id="tel-error" class="error-message"></span>
        <button>Subscribe</button>
        <span class="thank-you-message"></span>
      </div>
    </div>
  </footer>

  <!-- Common Scripts for all pages -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  @vite('resources/js/common.js') <!-- Common JS across all pages -->

  <!-- Dynamic scripts pushed by individual pages -->
  @stack('scripts') <!-- Will load additional scripts added by child views -->
</body>

</html>
