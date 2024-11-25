<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Item;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function addToCart(Request $request)
    {
        $validatedData = $request->validate([
            'ItemID' => 'required|exists:items,ItemID',
            'Size' => 'required|string|in:S,M,L,XL',
            'Quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $item = Item::findOrFail($validatedData['ItemID']);

        // Calculate the total quantity already in the cart for this item
        $totalAddedToCart = Cart::where('UserID', $user->UserID)
            ->where('ItemID', $validatedData['ItemID'])
            ->sum('Quantity');

        $remainingStock = $item->Quantity - $totalAddedToCart;

        if ($validatedData['Quantity'] > $remainingStock) {
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
                'UserID' => $user->UserID,
                'ItemID' => $validatedData['ItemID'],
                'Size' => $validatedData['Size'],
                'Quantity' => $validatedData['Quantity'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully added {$validatedData['Quantity']} items of size {$validatedData['Size']} to the cart.",
            'remainingStock' => $item->Quantity - Cart::where('UserID', $user->UserID)
                ->where('ItemID', $validatedData['ItemID'])
                ->sum('Quantity'),
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
        $Phone_Number = $user->Phone_Number; // Assuming 'address' is the column name

        // Get user's available points
        $availablePoints = $user->Points;

        return view('cart', compact('cartItems', 'Phone_Number', 'totalPrice', 'totalPoints', 'address', 'availablePoints'));
    }
    public function fetchRemainingStock($itemID)
    {
        $user = Auth::user();

        $item = Item::findOrFail($itemID);
        $totalAddedToCart = Cart::where('UserID', $user->UserID)
            ->where('ItemID', $itemID)
            ->sum('Quantity');

        $remainingStock = $item->Quantity - $totalAddedToCart;

        return response()->json([
            'remainingStock' => $remainingStock,
            'success' => true,
        ]);
    }
}
