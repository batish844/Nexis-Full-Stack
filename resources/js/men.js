$(document).ready(function() {
    let slideIndex = 0;
    let $slides = $(".slide");
    showSlides();
  
    function showSlides() {
      let nextSlideIndex = (slideIndex + 1) % $slides.length;// Calculate the index of the next slide
      $slides.eq(slideIndex).removeClass("active");// Hide the current slide
      $slides.eq(nextSlideIndex).addClass("active");// Display the next slide
      slideIndex = nextSlideIndex;    // Update slideIndex for the next iteration
      setTimeout(showSlides, 3000);   // Change image every 3 seconds
    }
  
  
    // Fetching product data from men.json and rendering products
    $.getJSON('Men/men.json', function(productsData) {
        renderProducts(productsData);
    });
  
    // Function to render products
    function renderProducts(products) {
        const $productsContainer = $('#dynamic-products');
        $productsContainer.empty();
  
        products.forEach(product => {
            const productHtml = `
                <div class="product">
                    <img src="${product.src}" alt="${product.alt}" class="product-image">
                    <div class="product-info">
                        <span class="price">${product.price}</span>
                        <select class="size-select">
                            ${product.sizes.map(size => `<option value="${size}">${size}</option>`).join('')}
                        </select>
                        <button class="add-to-cart">Add to Cart</button>
                    </div>
                </div>`;
            $productsContainer.append(productHtml);
        });
        $('.add-to-cart').on('click', addToCart);
    }
  
    // Add-to-cart functionality
    function addToCart(event) {
        const $product = $(event.target).closest('.product');
        const imgSrc = $product.find('.product-image').attr('src');
        const price = $product.find('.price').text();
        const $sizeSelect = $product.find('.size-select');
        const size = $sizeSelect.val();
        const item = { imgSrc, price, size, quantity: 1 };
        saveItemToCart(item); 
        updateCartCount(); // Increment cart count by 1
    }
  
    function saveItemToCart(item) {
        let cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];
        cart.push(item);
        localStorage.setItem('cart', JSON.stringify(cart));
    }
    function updateCartCount() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let count = cart.length;
        document.getElementById('cart-count').innerText = count;
    }
    
    // Function to reset the cart count
    function resetCartCount() {
        document.getElementById('cart-count').innerText = '0';
        localStorage.removeItem('cart'); // Clear the cart
    }
  });
  