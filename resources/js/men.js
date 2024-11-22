$(document).ready(function() {
    let slideIndex = 0;
    let $slides = $(".slide");  // Select all slides
    let totalSlides = $slides.length;

    // Function to show the next slide
    function showSlides() {
        let nextSlideIndex = (slideIndex + 1) % totalSlides; // Calculate the index of the next slide

        // Remove the 'active' class from the current slide
        $slides.eq(slideIndex).removeClass("active");

        // Add the 'active' class to the next slide
        $slides.eq(nextSlideIndex).addClass("active");

        // Update slideIndex for the next iteration
        slideIndex = nextSlideIndex;
    }

    // Set the interval for automatic slide transitions (every 3 seconds)
    setInterval(showSlides, 3000);  // Change image every 3 seconds
});
