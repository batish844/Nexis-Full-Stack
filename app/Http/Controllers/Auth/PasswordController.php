<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function create(Request $request): RedirectResponse
    {
        try {
            $validation = $request->validate([
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            $user = $request->user();
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('profile.index', ['#password-section'])->with('update-password')->with('status', 'password-created');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('profile.index', ['#password-section'])
                ->withErrors($e->errors(), 'updatePassword')
                ->with('status', 'password-failed');
        }
    }
    public function update(Request $request): RedirectResponse
    {
        try {
            // Validate the request
            $validated = $request->validateWithBag('updatePassword', [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);

            // Update the user's password
            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);

            // Redirect with success message
            return redirect()->route('profile.index', ['#password-section'])
                ->with('status', 'password-updated');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with validation errors
            return redirect()->route('profile.index', ['#password-section'])
                ->withErrors($e->errors(), 'updatePassword')
                ->with('status', 'password-update-failed');
        }
    }
    

}
