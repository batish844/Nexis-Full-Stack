<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {



        try {
            $google_user = Socialite::driver('google')->stateless()->user();

            $user = User::firstOrCreate(
                ['google_id' => $google_user->getId()],
                [
                    'email' => $google_user->getEmail(),
                    'First_Name' => $google_user->user['given_name'] ?? 'N/A',
                    'Last_Name' => $google_user->user['family_name'] ?? 'N/A',
                    'Phone_Number' => 'N/A',
                    'isActive' => true,
                ]
            );

            Auth::login($user);
            $guestOrders = Order::where('guest_email', $user->email)->get();

            if ($guestOrders->isNotEmpty()) {
                session(['has_guest_orders' => true]);
            }
            
            return redirect('/home');
        } catch (\Exception $e) {
            return (['msg' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }
}
