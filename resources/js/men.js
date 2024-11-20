$(document).ready(function () {
    let currentPage = 1;
    const itemsPerPage = 12;

    let slideIndex = 0;
    let $slides = $(".slide");
    showSlides();

    $.getJSON('/men')
        .done(renderItems)
        .fail(() => {
            console.error('Failed to load items.');
            $('#dynamic-products').html('<p>Failed to load items. Please try again later.</p>');
        });

    function showCategories(categories) {
        const $categoryContainer = $('#category-checkboxes');
        $categoryContainer.empty(); // Ensure no duplicate checkboxes
        categories.forEach(category => {
            $categoryContainer.append(`
                <label>
                    <input type="checkbox" class="category-filter" value="${category}" /> ${category}
                </label><br>
            `);
        });

        // Handle changes to category filters
        $('.category-filter').off('change').on('change', function () {
            currentPage = 1; // Reset pagination to the first page
            applyFiltersAndRender();
        });
    }

    function renderItems(items) {
        // Collect categories and render items initially
        const categories = new Set();
        items.forEach(item => {
            categories.add(item.Category);
        });
        showCategories([...categories]); // Show all categories initially

        applyFiltersAndRender(items); // Apply any active filters
    }

    function applyFiltersAndRender(allItems) {
        // If items aren't passed, fetch all items from the backend
        if (!allItems) {
            $.getJSON('/men')
                .done(items => applyFiltersAndRender(items))
                .fail(() => console.error('Failed to reload items.'));
            return;
        }

        // Apply filters
        const minPrice = parseFloat($('#price-range').val());
        const selectedCategories = $('.category-filter:checked').map(function () {
            return this.value;
        }).get();

        const filteredItems = allItems.filter(item => {
            return (
                item.Price >= minPrice &&
                (selectedCategories.length === 0 || selectedCategories.includes(item.Category))
            );
        });

        // Paginate and display filtered items
        const paginatedItems = paginateItems(filteredItems, currentPage);
        const $itemsContainer = $('#dynamic-products');
        $itemsContainer.empty();

        paginatedItems.forEach(item => {
            $itemsContainer.append(createItemHtml(item));
        });

        // Update pagination
        updatePagination(filteredItems.length);
    }

    function paginateItems(items, page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = page * itemsPerPage;
        return items.slice(startIndex, endIndex);
    }

    function updatePagination(totalItems) {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        let paginationHtml = '';

        for (let i = 1; i <= totalPages; i++) {
            paginationHtml += `<button class="pagination-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`;
        }

        $('#pagination').html(paginationHtml);

        // Handle pagination button clicks
        $('.pagination-btn').off('click').on('click', function () {
            currentPage = $(this).data('page');
            applyFiltersAndRender();
        });
    }

    function createItemHtml(item) {
        return `
            <div class="item rounded overflow-hidden shadow-lg bg-white">
                <div class="item-image relative group">
                    <div class="carousel relative">
                        ${item.Photos.map((photo, index) => `
                            <img src="${photo}" 
                                 alt="${item.Name}" 
                                 class="carousel-img object-cover w-full h-64 ${index === 0 ? 'active' : 'hidden'}">
                        `).join('')}
                    </div>
                    <button class="carousel-btn left"></button>
                    <button class="carousel-btn right"></button>
                </div>
                <div class="item-info p-4">
                    <h3 class="text-lg font-semibold text-gray-800">${item.Name}</h3>
                    <p class="text-gray-600">Price: $${item.Price}</p>
                    <p class="text-gray-600">Points: ${item.Points}</p>
                    <button class="add-to-cart mt-4 py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 transition" data-item-id="${item.ItemID}">Add to Cart</button>
                </div>
            </div>`;
    }

    // Handle price range slider change
    $('#price-range').on('input', function () {
        $('#min-price').text(this.value);
        currentPage = 1; // Reset to first page when price filter changes
        applyFiltersAndRender();
    });

    function showSlides() {
        let nextSlideIndex = (slideIndex + 1) % $slides.length; // Calculate the index of the next slide
        $slides.eq(slideIndex).removeClass("active"); // Hide the current slide
        $slides.eq(nextSlideIndex).addClass("active"); // Display the next slide
        slideIndex = nextSlideIndex; // Update slideIndex for the next iteration
        setTimeout(showSlides, 3000); // Change image every 3 seconds
    }
});
