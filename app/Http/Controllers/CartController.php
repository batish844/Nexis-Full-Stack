<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

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
            'Quantity' => 'nullable|integer|min:1',
        ]);

        $user = Auth::user();
        $quantity = $validatedData['Quantity'] ?? 1;

        $cartEntry = Cart::where('UserID', $user->UserID)
            ->where('ItemID', $validatedData['ItemID'])
            ->first();

        if ($cartEntry) {
            $cartEntry->Quantity += $quantity;
            $cartEntry->save();
        } else {
            Cart::create([
                'UserID' => $user->UserID,
                'ItemID' => $validatedData['ItemID'],
                'Quantity' => $quantity,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart successfully!',
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

        return view('cart', compact('cartItems','Phone_Number', 'totalPrice', 'totalPoints', 'address', 'availablePoints'));
    }
    
}
