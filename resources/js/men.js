$(document).ready(function () {
    let slideIndex = 0;
    let $slides = $(".slide");
    // const itemsPerPage = 8; // Define items per page for pagination
    // let currentPage = 1;
    // let allItems = []; // Store all fetched items

    showSlides();

    // function showCategories(categories) {
    //     const $categoryContainer = $('#category-checkboxes');
    //     $categoryContainer.empty(); // Ensur e no duplicate checkboxes
    //     categories.forEach(category => {
    //         $categoryContainer.append(`
    //             <label>
    //                 <input type="checkbox" class="category-filter" value="${category}" /> ${category}
    //             </label><br>
    //         `);
    //     });

    //     // Handle changes to category filters
    //     $('.category-filter').off('change').on('change', function () {
    //         currentPage = 1; // Reset pagination to the first page
    //         applyFiltersAndRender();
    //     });
    // }

    // function renderItems(items) {
    //     // Collect categories and render items initially
    //     const categories = new Set();
    //     items.forEach(item => {
    //         categories.add(item.Category);
    //     });
    //     showCategories([...categories]); // Show all categories initially

    //     applyFiltersAndRender(items); // Apply any active filters
    // }

    // function applyFiltersAndRender() {
    //     // Apply filters
    //     const minPrice = parseFloat($('#price-range').val());
    //     const selectedCategories = $('.category-filter:checked').map(function () {
    //         return this.value;
    //     }).get();

    //     const filteredItems = allItems.filter(item => {
    //         return (
    //             item.Price >= minPrice &&
    //             (selectedCategories.length === 0 || selectedCategories.includes(item.Category))
    //         );
    //     });

    //     // Paginate filtered items
    //     const paginatedItems = paginateItems(filteredItems, currentPage);

    //     // Render the items for the current page
    //     const $itemContainer = $('#dynamic-products');
    //     $itemContainer.empty(); // Clear previous items
    //     paginatedItems.forEach(item => {
    //         $itemContainer.append(createItemHtml(item));
    //     });

    //     // Update pagination buttons
    //     updatePagination(filteredItems.length);
    // }

    // function paginateItems(items, page) {
    //     const startIndex = (page - 1) * itemsPerPage;
    //     const endIndex = page * itemsPerPage;
    //     return items.slice(startIndex, endIndex);
    // }

    // function updatePagination(totalItems) {
    //     const totalPages = Math.ceil(totalItems / itemsPerPage);
    //     let paginationHtml = '';

    //     for (let i = 1; i <= totalPages; i++) {
    //         paginationHtml += `<button class="pagination-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`;
    //     }

    //     $('#pagination').html(paginationHtml);

    //     // Handle pagination button clicks
    //     $('.pagination-btn').off('click').on('click', function () {
    //         currentPage = $(this).data('page');
    //         applyFiltersAndRender();
    //     });
    // }

    // // Handle price range slider change
    // $('#price-range').on('input', function () {
    //     $('#min-price').text(this.value);
    //     currentPage = 1; // Reset to first page when price filter changes
    //     applyFiltersAndRender();
    // });

    function showSlides() {
        let nextSlideIndex = (slideIndex + 1) % $slides.length; // Calculate the index of the next slide
        $slides.eq(slideIndex).removeClass("active"); // Hide the current slide
        $slides.eq(nextSlideIndex).addClass("active"); // Display the next slide
        slideIndex = nextSlideIndex; // Update slideIndex for the next iteration
        setTimeout(showSlides, 3000); // Change image every 3 seconds
    }
});
