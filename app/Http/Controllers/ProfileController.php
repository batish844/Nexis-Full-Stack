<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
    //upload avatar function
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->file('avatar')->isValid()) {
            $fileName = time() . '.' . $request->file('avatar')->extension();

            $filePath = public_path('storage/img/avatar');

            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }

            $request->file('avatar')->move($filePath, $fileName);

            $user = Auth::user();

            // Remove old avatar if it exists
            if ($user->avatar && file_exists(public_path('storage/img/avatar/' . $user->avatar))) {
                unlink(public_path('storage/img/avatar/' . $user->avatar));
            }

            // Save new avatar in DB
            $user->avatar = $fileName;
            $user->save();
        }

        return redirect()->back()->with('status', 'avatar-updated');
    }

    //Delete avatar
    public function deleteAvatar()
    {
        $user = Auth::user();

        if ($user->avatar) {

            $filePath = public_path('storage/img/avatar/' . $user->avatar);

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $user->avatar = null;
            $user->save();
        }

        return redirect()->back()->with('status', 'avatar-deleted');
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
