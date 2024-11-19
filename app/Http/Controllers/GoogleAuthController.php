<?php

namespace App\Http\Controllers;

use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        $googleUser = Socialite::driver('google')->user();

// Get first name from `given_name` or fallback to a default
$firstName = $googleUser->user['given_name'] ?? 'FirstName'; 
$lastName = $googleUser->user['family_name'] ?? 'LastName'; 

// Create or update the user
$user = User::firstOrCreate(
    ['email' => $googleUser->getEmail()],
    [
        'name' => $googleUser->getName(),
        'google_id' => $googleUser->getId(),
        'avatar' => $googleUser->getAvatar(),
        'Phone_Number' => 'N/A',
        'First_Name' => $firstName,
        'Last_Name' => $lastName,
    ]
);

        // Log the user in
        Auth::login($user, true);

        return redirect()->intended('/home'); 
    }
}
