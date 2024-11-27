<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Order;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = Auth::user();

        if (!$user->isActive) {
            Auth::logout();
            return redirect()->back()->with(['error' => 'Your account is inactive.']);
        }

        $request->session()->regenerate();

        $guestOrders = Order::where('guest_email', $user->email)->get();

        if ($guestOrders->isNotEmpty()) {
            session(['has_guest_orders' => true]);
        }

        // Redirect based on user role
        if ($user->isAdmin) {
            return redirect()->intended('/admin/analytics');
        } else {
            return redirect()->intended('/home');
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
