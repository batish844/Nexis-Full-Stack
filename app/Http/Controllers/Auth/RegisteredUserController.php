<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order; // Add this line to use the Order model
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB; // Add this line to use database transactions
use Illuminate\Support\Facades\Log; // For logging errors

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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'First_Name' => ['required', 'string', 'max:50'],
            'Last_Name' => ['required', 'string', 'max:50'],
            'Phone_Number' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Begin database transaction
        DB::beginTransaction();

        try {
            // Create the new user
            $user = User::create([
                'First_Name'   => $request->First_Name,
                'Last_Name'    => $request->Last_Name,
                'Phone_Number' => $request->Phone_Number,
                'email'        => $request->email,
                'password'     => Hash::make($request->password),
            ]);

            // Check for guest orders with matching guest_email
            $guestOrders = Order::where('guest_email', $user->email)->get();

            if ($guestOrders->isNotEmpty()) {
                foreach ($guestOrders as $order) {
                    // Update the order to belong to the new user
                    $order->update([
                        'OrderedBy'     => $user->UserID, // Assuming 'UserID' is the primary key in 'users' table
                        'is_guest'      => false,
                        'guest_email'   => null,
                        'guest_address' => null,
                    ]);
                }
            }

            // Fire the Registered event
            event(new Registered($user));

            // Log in the new user
            Auth::login($user);

            // Commit the transaction
            DB::commit();

            return redirect(route('profile.index'))
                ->with('success', 'Registration successful! Your previous orders have been linked to your account.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error during registration:', ['error' => $e->getMessage()]);

            return redirect()->back()
                ->with('error', 'An error occurred during registration. Please try again.');
        }
    }
}
