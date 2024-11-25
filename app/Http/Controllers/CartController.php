<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Item;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Your index logic if needed
    }

    public function addToCart(Request $request)
    {
        $validatedData = $request->validate([
            'ItemID'   => 'required|exists:items,ItemID',
            'Size'     => 'required|string|in:S,M,L,XL',
            'Quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $item = Item::findOrFail($validatedData['ItemID']);

        // Calculate the total quantity already in the cart for this item across all sizes
        $totalQuantityInCart = Cart::where('UserID', $user->UserID)
            ->where('ItemID', $validatedData['ItemID'])
            ->sum('Quantity');

        // Check if adding the new quantity exceeds the item's stock quantity
        $newTotalQuantity = $totalQuantityInCart + $validatedData['Quantity'];

        if ($newTotalQuantity > $item->Quantity) {
            $remainingStock = $item->Quantity - $totalQuantityInCart;
            return response()->json([
                'success' => false,
                'message' => "Only $remainingStock items remaining in stock.",
            ]);
        }

        // Check if this size is already in the cart
        $cartEntry = Cart::where('UserID', $user->UserID)
            ->where('ItemID', $validatedData['ItemID'])
            ->where('Size', $validatedData['Size'])
            ->first();

        if ($cartEntry) {
            // Update existing entry
            $cartEntry->Quantity += $validatedData['Quantity'];
            $cartEntry->save();
        } else {
            // Add new entry
            Cart::create([
                'UserID'   => $user->UserID,
                'ItemID'   => $validatedData['ItemID'],
                'Size'     => $validatedData['Size'],
                'Quantity' => $validatedData['Quantity'],
            ]);
        }

        // Calculate total cart count for all items
        $totalCartCount = Cart::where('UserID', $user->UserID)->sum('Quantity');

        $remainingStock = $item->Quantity - $newTotalQuantity;

        return response()->json([
            'success'        => true,
            'message'        => "Successfully added {$validatedData['Quantity']} items of size {$validatedData['Size']} to the cart.",
            'remainingStock' => $remainingStock,
            'cartCount'      => $totalCartCount, // Total cart count for syncing frontend
        ]);
    }

    public function viewCart()
    {
        $user = Auth::user();

        $cartItems = Cart::with('item')->where('UserID', $user->UserID)->get();

        // Calculate total price
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->Quantity * $cartItem->item->Price;
        });

        // Calculate total points
        $totalPoints = $cartItems->sum(function ($cartItem) {
            return $cartItem->Quantity * $cartItem->item->Points;
        });

        // Decode the address JSON field
        $addressJson = $user->address; // Assuming 'address' is the column name
        $address = json_decode($addressJson, true);
        $Phone_Number = $user->Phone_Number;

        // Get user's available points
        $availablePoints = $user->Points;

        return view('cart', compact(
            'cartItems',
            'Phone_Number',
            'totalPrice',
            'totalPoints',
            'address',
            'availablePoints'
        ));
    }

    public function getRemainingStock($itemID)
    {
        $user = Auth::user();
        $item = Item::findOrFail($itemID);

        // Total quantity already in the cart for this item (all sizes combined)
        $totalQuantityInCart = Cart::where('UserID', $user->UserID)
            ->where('ItemID', $itemID)
            ->sum('Quantity');

        $remainingStock = $item->Quantity - $totalQuantityInCart;

        return response()->json([
            'success'        => true,
            'remainingStock' => $remainingStock,
        ]);
    }

    public function updateCart(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated.'], 401);
        }

        try {
            $validatedData = $request->validate([
                'itemID' => 'required|integer|exists:items,ItemID',
                'size'   => 'required|string|in:S,M,L,XL',
                'action' => 'required|in:increment,decrement',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error.',
                'errors'  => $e->errors(),
            ], 422);
        }

        $cartEntry = Cart::where('UserID', $user->UserID)
            ->where('ItemID', $validatedData['itemID'])
            ->where('Size', $validatedData['size'])
            ->first();

        if (!$cartEntry) {
            return response()->json(['success' => false, 'message' => 'Cart item not found.'], 404);
        }

        $item = Item::findOrFail($validatedData['itemID']);

        // Total quantity of this item in cart (all sizes combined)
        $totalQuantityInCart = Cart::where('UserID', $user->UserID)
            ->where('ItemID', $item->ItemID)
            ->sum('Quantity');

        if ($validatedData['action'] === 'increment') {
            if ($totalQuantityInCart < $item->Quantity) {
                $cartEntry->Quantity++;
                $cartEntry->save();

                // Recalculate total cart count
                $totalCartCount = Cart::where('UserID', $user->UserID)->sum('Quantity');

                return response()->json([
                    'success'       => true,
                    'newQuantity'   => $cartEntry->Quantity,
                    'itemPrice'     => $item->Price,
                    'cartCount'     => $totalCartCount,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot add more items. Stock limit reached.',
                ]);
            }
        }

        if ($validatedData['action'] === 'decrement') {
            if ($cartEntry->Quantity > 1) {
                $cartEntry->Quantity--;
                $cartEntry->save();

                // Recalculate total cart count
                $totalCartCount = Cart::where('UserID', $user->UserID)->sum('Quantity');

                return response()->json([
                    'success'       => true,
                    'newQuantity'   => $cartEntry->Quantity,
                    'itemPrice'     => $item->Price,
                    'cartCount'     => $totalCartCount,
                ]);
            } else {
                $cartEntry->delete(); // Remove the entry if quantity is 0

                // Recalculate total cart count
                $totalCartCount = Cart::where('UserID', $user->UserID)->sum('Quantity');

                return response()->json([
                    'success'       => true,
                    'newQuantity'   => 0,
                    'itemPrice'     => $item->Price,
                    'cartCount'     => $totalCartCount,
                ]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Invalid action.'], 400);
    }

    public function getCartCount()
    {
        $user = Auth::user();

        // Default count is 0 for unauthenticated users
        if (!$user) {
            return response()->json(['cartCount' => 0]);
        }

        // Calculate total cart count
        $totalCartCount = Cart::where('UserID', $user->UserID)->sum('Quantity');

        return response()->json(['cartCount' => $totalCartCount]);
    }
}
