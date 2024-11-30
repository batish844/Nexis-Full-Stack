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
        
    // try {
    //     $google_user = Socialite::driver('google')->user();
    //     dd($google_user); // Debugging step
    // } catch (\Exception $e) {
    //     return redirect('/login')->withErrors(['msg' => 'Something went wrong: ' . $e->getMessage()]);
    // }


        try {
            $google_user = Socialite::driver('google')->user();

            // Check if the user already exists
            $user = User::where('google_id', $google_user->getId())->orWhere('email', $google_user->getEmail())->first();

            if (!$user) {
                // Create a new user
                $user = User::create([
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'First_Name' => $google_user->user['given_name'] ?? 'N/A',
                    'Last_Name' => $google_user->user['family_name'] ?? 'N/A',
                    'Phone_Number' => 'N/A', 
                    'password' => null, 
                    'isActive' => true,

                ]);
                
            }

            // Log in the user
            Auth::login($user);

            return redirect('/home');
        } catch (\Exception $e) {
            return (['msg' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }
    
}
    //  $google_user = Socialite::driver('google')->user();
    //  $user = User:: where('google_id', $google_user->getId())->first();
    //     if (!$user) {
    //     $new_user = User::create([
    //     'name' => $google_user->getName(),
    //     'email' => $google_user->getEmail(),
    //     'google_id' => $google_user->getId() ?? null, 
    //     'Phone_Number' => $google_user->user['phone'] ?? 'N/A', // Fetch phone or default to 'N/A'
    //     'First_Name' => $google_user->user['given_name'] ?? 'N/A',
    //     'Last_Name' => $google_user->user['family_name'] ?? 'N/A',
    //     ]);
    //     Auth:: login($new_user);
    //     return redirect()->intended('home');
    //      }
    //      else {
    //         Auth:: login($user);
    //         return redirect()->intended('home');
    //      } 
    //     }

    //     catch(\Throwable $th){
    //         dd('Something went wrong' . $th->getMessage());
    //     }
 
