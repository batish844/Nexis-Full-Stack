// Here is the updated code, it'll be sent in 2 batches so wait
// web.php

// Route::middleware('auth')->group(function() {
//     // Registered user routes
//     Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist']);
// });

// Route::post('/wishlist/guest/add', [WishlistController::class, 'storeGuestWishlist']);
// Route::post('/wishlist/transfer', [WishlistController::class, 'transferGuestWishlistToDatabase']);


// Route::middleware(['auth'])->group(function () {
//     Route::get('/wishlist', [WishlistController::class, 'showWishlist'])->name('wishlist.show');
// });
// Wishlist.php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;


 

// class Wishlist extends Model
// {
//     use HasFactory;

//     protected $table = 'wishlist'; // Ensure this matches your database table name
//     protected $fillable = ['UserID', 'ItemID', 'DateTime', 'is_read'];

//     public function item()
//     {
//         return $this->belongsTo(Item::class, 'ItemID'); // Adjust foreign key if necessary
//     }
// }
// WishlistController.php

 
// namespace App\Http\Controllers;

// use App\Models\Wishlist;
// use App\Models\Item;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class WishlistController extends Controller
// {
//     public function showWishlist()
//     {
//         $user = Auth::user(); // Get the authenticated user

//         if ($user) {
//             // Fetch wishlist items for the authenticated user
//             $wishlistItems = Wishlist::with('item') // Assuming you have an item relationship in the Wishlist model
//                 ->where('UserID', $user->UserID)
//                 ->get();

//             // Pass the data to the view
//             return view('wishlist', compact('wishlistItems'));
//         }

//         // Redirect guests to the login page
//         return redirect()->route('login')->with('error', 'You need to log in to view your wishlist.');
//     }

  
//     public function addToWishlist(Request $request)
// {
//     if (auth()->check()) {
//         // Authenticated user: save to the database
//         $user = auth()->user();
//         $user->wishlist()->attach($request->itemID);
//         return response()->json(['success' => true, 'message' => 'Item added to your wishlist.']);
//     } else {
//         // Guest user: store in local storage (handled in JavaScript)
//         return response()->json(['success' => true, 'message' => 'Item added to your wishlist (Guest Mode).']);
//     }
// }


//     // For guest users to store items in local storage (on front end)
//     public function storeGuestWishlist(Request $request)
//     {
//         if ($request->has('wishlist')) {
//             session(['guest_wishlist' => $request->wishlist]);
//         }

//         return response()->json(['message' => 'Wishlist data saved']);
//     }

//     // Transfer guest wishlist to database after registration
//     public function transferGuestWishlistToDatabase()
//     {
//         $user = Auth::user();
//         $guestWishlist = session('guest_wishlist', []);

//         foreach ($guestWishlist as $itemID) {
//             Wishlist::create([
//                 'UserID' => $user->UserID,
//                 'ItemID' => $itemID,
//                 'DateTime' => now(),
//             ]);
//         }

//         // Clear the session after transferring the wishlist
//         session()->forget('guest_wishlist');

//         return response()->json(['message' => 'Wishlist transferred to database']);
//     }
// }
// User.php
// <?php

// namespace App\Models;

// // use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Illuminate\Support\Facades\Mail;

// class User extends Authenticatable
// {
//     /** @use HasFactory<\Database\Factories\UserFactory> */
//     use HasFactory, Notifiable;
    

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array<int, string>
//      */
//     protected $primaryKey = 'UserID';
//     protected $fillable = [
//         'First_Name',
//         'Last_Name',
//         'email',
//         'Phone_Number',
//         'password',
//         'Points',
//         'avatar',
//         'isAdmin',
//         'Address',
//         'google_id',
//     ];
//     protected $casts = [
//         'Address' => 'array',
//     ];
//     public function sendPasswordResetNotification($token)
//     {
//         $resetUrl = url('/reset-password/' . $token) . '?email=' . urlencode($this->email);
//         $userName = trim($this->First_Name . ' ' . $this->Last_Name) ?: 'Valued Customer';

//         Mail::to($this->email)->send(new \App\Mail\ResetPasswordMail($resetUrl, $userName, $this->email));
//     }




//     public function orders()
//     {
//         return $this->hasMany(Order::class, 'OrderedBy', 'UserID');
//     }

//     public function contacts()
//     {
//         return $this->hasMany(Contact::class, 'ContactedBy');
//     }

//     public function reviews()
//     {
//         return $this->hasMany(Review::class, 'UserID');
//     }

//     public function cartItems()
//     {
//         return $this->hasMany(Cart::class, 'UserID', 'UserID');
//     }


//     public function wishlist()
// {
//     return $this->hasMany(Wishlist::class, 'UserID');
// }

//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var array<int, string>
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     /**
//      * Get the attributes that should be cast.
//      *
//      * @return array<string, string>
//      */
//     protected function casts(): array
//     {
//         return [
//             'email_verified_at' => 'datetime',
//             'password' => 'hashed',
//         ];
//     }
// }
// RegisteredUserController.php
// <?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Rules;
// use Illuminate\View\View;

// class RegisteredUserController extends Controller
// {
//     /**
//      * Display the registration view.
//      */
//     public function create(): View
//     {
//         return view('auth.register');
//     }

//     /**
//      * Handle an incoming registration request.
//      *
//      * @throws \Illuminate\Validation\ValidationException
//      */

//     public function store(Request $request)
// {
//     $this->validator($request->all())->validate();

//     // Create the user
//     event(new Registered($user = $this->create($request->all())));

//     // Log the user in
//     Auth::login($user);

//     // Transfer guest wishlist to database
//     if (session()->has('guest_wishlist')) {
//         // Call the method to transfer wishlist from session (or you can directly use ajax)
//         $wishlist = session('guest_wishlist');
//         foreach ($wishlist as $itemID) {
//             Wishlist::create([
//                 'UserID' => $user->UserID,
//                 'ItemID' => $itemID,
//                 'DateTime' => now(),
//             ]);
//         }

//         // Clear guest wishlist from session
//         session()->forget('guest_wishlist');
//     }

//     // Redirect after successful registration
//     return redirect()->route('home');
// }
// }
//  Wishlist.blade.php
// @extends('layout')

// @section('title', 'Wishlist')

// @section('content')
// <div class="container mx-auto p-6">
//     <h1 class="text-3xl font-bold mb-6">Your Wishlist</h1>

//     @if($wishlistItems->isEmpty())
//         <p class="text-lg text-gray-500">Your wishlist is empty.</p>
//     @else
//         <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
//             @foreach($wishlistItems as $wishlist)
//                 <div class="bg-white border border-gray-300 rounded-lg shadow-md p-4">
//                     <img src="{{ asset('storage/img/' . $wishlist->item->image) }}" alt="{{ $wishlist->item->name }}" class="w-full h-48 object-cover rounded-md mb-4">
//                     <h2 class="text-xl font-semibold text-gray-800">{{ $wishlist->item->name }}</h2>
//                     <p class="text-gray-600">{{ $wishlist->item->description }}</p>
//                     <div class="flex justify-between items-center mt-4">
//                         <span class="text-lg font-bold text-indigo-600">{{ '$' . number_format($wishlist->item->price, 2) }}</span>
//                         <button class="text-indigo-600 hover:text-indigo-500" onclick="removeFromWishlist({{ $wishlist->id }})">
//                             Remove
//                         </button>
//                     </div>
//                 </div>
//             @endforeach
//         </div>
//     @endif
// </div>

// <script>
    
//     function removeFromWishlist(itemId) {
//         if(confirm('Are you sure you want to remove this item from your wishlist?')) {
//             fetch(/wishlist/remove/${itemId}, {
//                 method: 'DELETE',
//                 headers: {
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
//                 }
//             })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.success) {
//                     alert('Item removed from your wishlist.');
//                     location.reload(); // Reload the page to update the wishlist
//                 } else {
//                     alert('Something went wrong. Please try again.');
//                 }
//             });
//         }
//     }
// </script>
// @endsection
// cards.blade.php

// @foreach ($items as $item)


// <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-transform transform hover:scale-105 flex flex-col h-full relative group">
//     <!-- Wishlist Icon -->
//     <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"> 
//         <button class="wishlist-btn text-gray-400 hover:text-red-500 focus:outline-none" data-item-id="{{ $item->ItemID }}" data-authenticated="{{ auth()->check() }}">
//             <i class="fas fa-heart text-2xl"></i>
//         </button>
//     </div>

//     <!-- Product Image Carousel -->
//     <div class="carousel relative">
//         @foreach ($item->Photo as $index => $photo)
//             <img src="{{ $photo }}" alt="{{ $item->Name }}" class="carousel-img object-cover w-full h-64 {{ $index === 0 ? 'active' : 'hidden' }}" data-index="{{ $index }}">
//         @endforeach

//         <!-- Navigation Arrows (only show if there are multiple images) -->
//         @if(count($item->Photo) > 1)
//         <button class="carousel-btn left">
//             <i class="fas fa-chevron-left text-black"></i>
//         </button>
//         <button class="carousel-btn right">
//             <i class="fas fa-chevron-right text-black"></i>
//         </button>
//         @endif
//     </div>

//     <a href="{{ route('store.show', ['id' => $item->ItemID, 'photos' => json_encode($item->Photo)]) }}">
//         <!-- Product Details -->
//         <div class="p-4 flex flex-col flex-grow">
//             <h3 class="font-semibold text-lg text-gray-800">{{ $item->Name }}</h3>
//             <p class="text-xl font-medium text-gray-600">${{ number_format($item->Price, 2) }}</p>
//         </div>
//     </a>

//     <div class="mt-auto">
//         <button class="add-to-cart-btn py-2 px-4 w-full bg-blue-700 text-white rounded-lg hover:bg-blue-600 transition-all flex items-center justify-between space-x-2" type="button" data-item-id="{{ $item->ItemID }}" data-item-points="{{ $item->Points }}">
//             <span class="text-lg font-semibold">Add to Cart</span>
//             <div class="flex items-center space-x-1">
//                 <i class="fas fa-trophy text-yellow-400"></i>
//                 <span class="text-sm font-semibold text-yellow-400">{{ $item->Points }}</span>
//             </div>
//         </button>
//     </div>

// </div>

// @endforeach


// @if ($items->isEmpty())
// <div class="flex items-center justify-center w-full h-full bg-gray-100">
//     <div class="text-center">
//         <p class="text-lg text-gray-600 font-medium">
//             Unfortunately, no items match your search criteria.
//         </p>
//         <p class="text-sm text-gray-500 mt-2">
//             Please try adjusting your filters or price range to explore more options.
//         </p>
//     </div>
// </div>
// @endif
// @section('scripts')
//     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
//     <script>
//         $(document).ready(function () {
//             alert('jQuery is working!');
//         });
//     </script>
// @endsection
// @vite('resources/js/wishlist.js')


// create_wishlist_table
// <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
    

//     public function up()
// {
//     Schema::create('wishlists', function (Blueprint $table) {
        
//         $table->unsignedBigInteger('UserID');
//         $table->unsignedBigInteger('ItemID');
//         $table->timestamp('DateTime')->useCurrent();  // Save the time when the item is added
//         $table->boolean('is_read')->default(false);  // Assuming a flag to mark read/unread status
//         $table->timestamps();

//         $table->foreign('UserID')->references('UserID')->on('users')->onDelete('cascade');
//         $table->foreign('ItemID')->references('ItemID')->on('items')->onDelete('cascade');
//     });
// }



//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('wishlist');
//     }
// };
// index.blade.php
// @extends('layout')

// @section('title', 'Women Store')

// @section('content')
// <!-- Image Slider for Women Store -->
// <!-- <div class="image-slider">
//     <div class="slide">
//         <img src="{{ asset('storage/img/slides/g1.webp') }}" alt="Slide 1">
//     </div>
//     <div class="slide">
//         <img src="{{ asset('storage/img/slides/g2.webp') }}" alt="Slide 3">
//     </div>
//     <div class="slide">
//         <img src="{{ asset('storage/img/slides/g3.jpg') }}" alt="Slide 1">
//     </div>
// </div> -->
// <div class="container mx-auto px-4 py-10">
//     <div class="flex justify-center items-center mb-6">
//         <div class="w-full sm:w-3/4 md:w-1/2 lg:w-1/3">
//             <input type="text" id="search-input" class="w-full p-3 rounded-full border-2 border-gray-300 focus:ring-2 focus:ring-blue-500 text-lg" placeholder="Search for items...">
//         </div>
//     </div>


//     <div class="flex flex-col lg:flex-row gap-6">
//         <div id="filter-panel" class="w-full sm:w-64 p-6 bg-gray-50 rounded-lg shadow-md mb-6 lg:mb-0">
//             <h3 class="text-xl font-semibold text-gray-800 mb-4">Filters</h3>
//             <div class="price-filter mt-6">
//                 <h4 class="font-medium text-gray-700">Price</h4>
//                 <div class="flex justify-between mb-2">
//                     <span id="min-price-display">0</span>
//                     <span>&dash;</span>
//                     <span id="max-price-display">150</span>
//                 </div>
//                 <div class="relative">
//                     <div class="slider-track bg-gray-200 h-2 rounded-full"></div>
//                     <input type="range" min="0" max="150" value="0" id="slider-1" class="absolute left-0 w-full cursor-pointer opacity-0">
//                     <input type="range" min="0" max="150" value="150" id="slider-2" class="absolute right-0 w-full cursor-pointer opacity-0">
//                 </div>
//             </div>

//             <div class="category-filter mt-6">
//                 <h4 class="font-medium text-gray-700">Category</h4>
//                 <select id="category-dropdown" class="w-full mt-2 p-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
//                     <option value="">All Items</option>
//                     @foreach ($categories as $category)
//                     <option value="{{ $category->CategoryID }}">{{ $category->Name }}</option>
//                     @endforeach
//                 </select>
//             </div>
//         </div>

//         <div class="w-full flex-1 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="dynamic-products">

//         </div>




//     </div>
// </div>
// @endsection

// @push('styles')
// @vite('resources/css/men.css')
// @endpush

// @push('scripts')
// @vite('resources/js/men.js')

// <!-- Font Awesome -->
// <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
// <script>
//     document.addEventListener("DOMContentLoaded", () => {
//         let sliderOne = document.getElementById("slider-1");
//         let sliderTwo = document.getElementById("slider-2");
//         let minPriceDisplay = document.getElementById("min-price-display");
//         let maxPriceDisplay = document.getElementById("max-price-display");
//         let categoryDropdown = document.getElementById("category-dropdown");
//         let searchInput = document.getElementById("search-input");
//         let sliderTrack = document.querySelector(".slider-track");
//         let sliderMaxValue = parseInt(sliderOne.max);
//         let minGap = 5;
//         let productsContainer = document.getElementById("dynamic-products");

//         const updateSliderValues = () => {
//             if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
//                 if (sliderOne === document.activeElement) {
//                     sliderOne.value = parseInt(sliderTwo.value) - minGap;
//                 } else {
//                     sliderTwo.value = parseInt(sliderOne.value) + minGap;
//                 }
//             }
//             minPriceDisplay.textContent = sliderOne.value;
//             maxPriceDisplay.textContent = sliderTwo.value;
//             fillColor();
//             updateProducts();
//         };

//         const fillColor = () => {
//             let percent1 = (sliderOne.value / sliderMaxValue) * 100;
//             let percent2 = (sliderTwo.value / sliderMaxValue) * 100;
//             sliderTrack.style.background = linear-gradient(to right, #dadae5 ${percent1}%, #3264fe ${percent1}%, #3264fe ${percent2}%, #dadae5 ${percent2}%);
//         };

//         const updateProducts = () => {
//             let minPrice = sliderOne.value;
//             let maxPrice = sliderTwo.value;
//             let categoryId = categoryDropdown.value;
//             let searchQuery = searchInput.value;

//             const url = new URL('{{ route("women.filter.products") }}', window.location.origin);
//             url.searchParams.append('minPrice', minPrice);
//             url.searchParams.append('maxPrice', maxPrice);
//             url.searchParams.append('category', categoryId);
//             url.searchParams.append('search', searchQuery);

//             fetch(url)
//                 .then(response => response.text())
//                 .then(html => {
//                     productsContainer.innerHTML = html;
//                     initializeCarousel();
//                 })
//                 .catch(error => {
//                     console.error("Error fetching filtered products:", error);
//                 });
//         };

//         let debounceTimer;
//         searchInput.addEventListener("input", () => {
//             clearTimeout(debounceTimer);
//             debounceTimer = setTimeout(updateProducts, 300);
//         });

//         const initializeCarousel = () => {
//             const carousels = document.querySelectorAll(".carousel");
//             carousels.forEach((carousel) => {
//                 let currentIndex = 0;
//                 let images = carousel.querySelectorAll(".carousel-img");
//                 let leftButton = carousel.querySelector(".carousel-btn.left");
//                 let rightButton = carousel.querySelector(".carousel-btn.right");

//                 const updateImage = () => {
//                     images.forEach((img, idx) => {
//                         if (idx === currentIndex) {
//                             img.classList.remove("hidden");
//                             img.classList.add("active");
//                         } else {
//                             img.classList.remove("active");
//                             img.classList.add("hidden");
//                         }
//                     });
//                 };

//                 if (leftButton) {
//                     leftButton.addEventListener("click", () => {
//                         currentIndex = (currentIndex - 1 + images.length) % images.length;
//                         updateImage();
//                     });
//                 }
//                 if (rightButton) {
//                     rightButton.addEventListener("click", () => {
//                         currentIndex = (currentIndex + 1) % images.length;
//                         updateImage();
//                     });
//                 }

//                 updateImage();
//             });
//         };

//         fillColor();
//         sliderOne.addEventListener("input", updateSliderValues);
//         sliderTwo.addEventListener("input", updateSliderValues);
//         categoryDropdown.addEventListener("change", updateProducts);

//         updateProducts();
//         initializeCarousel();

//         // Event delegation for dynamically added products
//         productsContainer.addEventListener('click', function(event) {
//             const button = event.target.closest('.add-to-cart-btn');
//             if (button) {
//                 const itemId = button.dataset.itemId;
//                 const quantity = 1; // Default quantity

//                 fetch('{{ route("cart.add") }}', {
//                         method: 'POST',
//                         headers: {
//                             'Content-Type': 'application/json',
//                             'X-CSRF-TOKEN': '{{ csrf_token() }}',
//                             'Accept': 'application/json'
//                         },
//                         body: JSON.stringify({
//                             ItemID: itemId,
//                             Quantity: quantity
//                         })
//                     })
//                     .then(response => response.json())
//                     .then(data => {
//                         if (data.success) {
//                             alert(data.message);
//                             // Optionally update cart count or UI
//                         } else {
//                             alert('Error adding to cart: ' + data.message);
//                         }
//                     })
//                     .catch(error => {
//                         console.error('Error adding to cart:', error);
//                         alert('Error adding to cart');
//                     });
//             }
//         });
//     });

//     document.addEventListener("DOMContentLoaded", () => {
//     // Event delegation for dynamically added wishlist buttons
//     document.querySelector('#dynamic-products').addEventListener('click', function(event) {
//         console.log("Wishlist button detected:");
//         const button = event.target.closest('.wishlist-btn'); // Declare the button here
//         if (button) {
//             const itemId = button.dataset.itemId; // Safely access after declaration
//             console.log("Wishlist button clicked with ID:", itemId);

//             // Example action for wishlist
//             if (button.dataset.authenticated === "1") {
//                 // Handle authenticated user wishlist logic (e.g., send to server)
//                 fetch('{{ route("wishlist.add") }}', {
//                     method: 'POST',
//                     headers: {
//                         'Content-Type': 'application/json',
//                         'X-CSRF-TOKEN': '{{ csrf_token() }}'
//                     },
//                     body: JSON.stringify({ ItemID: itemId })
//                 })
//                 .then(response => response.json())
//                 .then(data => {
//                     if (data.success) {
//                         alert('Item added to wishlist!');
//                     } else {
//                         alert('Error adding to wishlist: ' + data.message);
//                     }
//                 })
//                 .catch(error => console.error("Error:", error));
//             } else {
//                 // Handle guest user logic (e.g., save to localStorage)
//                 let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
//                 if (!wishlist.includes(itemId)) {
//                     wishlist.push(itemId);
//                     localStorage.setItem('wishlist', JSON.stringify(wishlist));
//                     alert('Item added to wishlist (Guest User)!');
//                 } else {
//                     alert('Item already in wishlist.');
//                 }
//             }
//         }
//     });
// });

// </script>
// @endpush





// register AbortController

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Rules;
// use Illuminate\View\View;

// class RegisteredUserController extends Controller
// {
//     /**
//      * Display the registration view.
//      */
//     public function create(): View
//     {
//         return view('auth.register');
//     }

//     /**
//      * Handle an incoming registration request.
//      *
//      * @throws \Illuminate\Validation\ValidationException
//      */
//     // public function store(Request $request): RedirectResponse
//     // {
//     //     $request->validate([
//     //         'First_Name' => ['required', 'string', 'max:50'],
//     //         'Last_Name' => ['required', 'string', 'max:50'],
//     //         'Phone_Number' => ['required', 'string', 'max:20'],
//     //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
//     //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
//     //     ]);

//     //     $user = User::create([
//     //         'First_Name' => $request->First_Name,
//     //         'Last_Name'   => $request->Last_Name,
//     //         'Phone_Number' => $request->Phone_Number,
//     //         'email'       => $request->email,
//     //         'password'    => Hash::make($request->password),
//     //     ]);

//     //     event(new Registered($user));

//     //     Auth::login($user);

//     //     return redirect(route('profile.index'));
//     // }
//     public function store(Request $request)
// {
//     $this->validator($request->all())->validate();

//     // Create the user
//     event(new Registered($user = $this->create($request->all())));

//     // Log the user in
//     Auth::login($user);

//     // Transfer guest wishlist to database
//     if (session()->has('guest_wishlist')) {
//         // Call the method to transfer wishlist from session (or you can directly use ajax)
//         $wishlist = session('guest_wishlist');
//         foreach ($wishlist as $itemID) {
//             Wishlist::create([
//                 'UserID' => $user->UserID,
//                 'ItemID' => $itemID,
//                 'DateTime' => now(),
//             ]);
//         }

//         // Clear guest wishlist from session
//         session()->forget('guest_wishlist');
//     }

//     // Redirect after successful registration
//     return redirect()->route('home');
// }
// } -->



// use App\Http\Controllers\Controller;
// use App\Models\User;
// use App\Models\Wishlist;
// use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Rules;
// use Illuminate\View\View;

// class RegisteredUserController extends Controller
// {
//     /**
//      * Display the registration view.
//      */
//     public function create(): View
//     {
//         return view('auth.register');
//     }

//     /**
//      * Handle an incoming registration request.
//      */
//     public function store(Request $request): RedirectResponse
//     {
//         // Validate the registration input
//         $request->validate([
//             'First_Name' => ['required', 'string', 'max:50'],
//             'Last_Name' => ['required', 'string', 'max:50'],
//             'Phone_Number' => ['required', 'string', 'max:20'],
//             'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
//             'password' => ['required', 'confirmed', Rules\Password::defaults()],
//         ]);

//         // Create the user
//         $user = User::create([
//             'First_Name' => $request->First_Name,
//             'Last_Name' => $request->Last_Name,
//             'Phone_Number' => $request->Phone_Number,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//         ]);

//         // Fire the registered event
//         event(new Registered($user));

//         // Log the user in
//         Auth::login($user);

//         // Transfer guest wishlist to database if it exists
//         if (session()->has('guest_wishlist')) {
//             $wishlist = session('guest_wishlist');
//             foreach ($wishlist as $itemID) {
//                 Wishlist::create([
//                     'user_id' => $user->id, // Use snake_case
//                     'item_id' => $itemID,
//                     'added_at' => now(),
//                 ]);
//             }

//             // Clear guest wishlist from session
//             session()->forget('guest_wishlist');
//         }

//         // Redirect the user after successful registration
//         return redirect()->route('home');
//     }
// }
