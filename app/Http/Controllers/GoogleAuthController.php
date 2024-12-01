<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
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
        


        try {
            $google_user = Socialite::driver('google')->user();

            $user = User::firstOrCreate(
                ['google_id' => $google_user->getId()],
                [
                    'email' => $google_user->getEmail(),
                    'First_Name' => $google_user->user['given_name'] ?? 'N/A',
                    'Last_Name' => $google_user->user['family_name'] ?? 'N/A',
                    'Phone_Number' => 'N/A', 
                    'password' => null, 
                    'isActive' => true,
                ]
            );
            
            Auth::login($user);
            
            return redirect('/home');
        } catch (\Exception $e) {
            return (['msg' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }
    
}
   