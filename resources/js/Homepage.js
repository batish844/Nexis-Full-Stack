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
});
