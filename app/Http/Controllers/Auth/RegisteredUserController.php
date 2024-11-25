<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request)
{
    $this->validator($request->all())->validate();

    // Create the user
    event(new Registered($user = $this->create($request->all())));

    // Log the user in
    Auth::login($user);

    // Transfer guest wishlist to database
    if (session()->has('guest_wishlist')) {
        // Call the method to transfer wishlist from session (or you can directly use ajax)
        $wishlist = session('guest_wishlist');
        foreach ($wishlist as $itemID) {
            Wishlist::create([
                'UserID' => $user->UserID,
                'ItemID' => $itemID,
                'DateTime' => now(),
            ]);
        }

        // Clear guest wishlist from session
        session()->forget('guest_wishlist');
    }

    // Redirect after successful registration
    return redirect()->route('home');
}
}