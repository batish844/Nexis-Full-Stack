<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
  <!-- Favicon Icon of our Logo on the tab  -->
  <link rel="icon" type="image/png" href="{{ asset('storage/CommonImg/BrandLogo.png') }}">
  
  <!-- Vite CSS Files -->
  @vite(['resources/css/commonStyle.css', 'resources/css/cart.css'])
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
      <a href="{{ url('/') }}">
        <img src="{{ asset('storage/CommonImg/BrandLogo.png') }}" alt="Logo" class="nav-logo">
      </a>
      <a href="{{ url('/') }}" class="nav-items">Home</a>
      <a href="{{ url('/About') }}" class="nav-items">About</a>
      <a href="{{ url('/Women') }}" class="nav-items">Women</a>
      <a href="{{ url('/Men') }}" class="nav-items">Men</a>
      <a href="{{ url('/ContactUs') }}" class="nav-items">Contact us</a>
      <a href="{{ url('/Login') }}" class="nav-items">Sign In</a>

      <!-- cart + cart animation on hovering -->
      <div id="icon">
        <a href="{{ url('Cart') }}" id="cart-icon">
          <lord-icon src="https://cdn.lordicon.com/mfmkufkr.json" trigger="hover" style="width:50px;height:50px"></lord-icon>
          <span id="cart-count">0</span> <!-- Added span for cart count -->
        </a>
      </div>
    </nav>
  </header>

  <!-- LordIcon Script -->
  <script src="https://cdn.lordicon.com/lordicon-1.2.0.js"></script>

  <!-- Function for Hamburger Menu -->
  <script>
    function toggleMenu() {
      var navMenu = document.getElementById("navMenu");
      navMenu.classList.toggle("active");
    }
  </script>

  <!-- Cart Items Section -->
  <div class="cart-container">
    <!-- Cart items will be dynamically added here -->
  </div>

  <!-- Checkout button added below the cart items -->
  <div class="checkout-container">
  <a href="{{ url('Checkout') }}" class="checkout-a"> <button id="checkout-button" class="checkout-button"> Checkout</button></a>
  </div>

  <!-- Vite JS Files -->
  @vite(['resources/js/cart.js', 'resources/js/common.js'])
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>

</html>
