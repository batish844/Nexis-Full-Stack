<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    /**
     * Display the user's profile.
     */
    public function index(): View
    {
        $user = Auth::user();
        if ($user->address) {
            $user->street_address = json_decode($user->address)->street_address;
            $user->building = json_decode($user->address)->building;
            $user->city = json_decode($user->address)->city;
        }
        return view('profile.profile', compact('user'));
    }
    public function order()
    {
        return view('profile.order');
    }

    public function edit(Request $request): View
    {
        return view('profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->except(['city', 'street_address', 'building']));

        if ($request->filled(['city', 'street_address', 'building'])) {
            $Address = [
                'city' => $request->input('city'),
                'street_address' => $request->input('street_address'),
                'building' => $request->input('building'),
            ];
            $user->address = json_encode($Address);
        }


        $user->save();

        return Redirect::route('profile.index')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}