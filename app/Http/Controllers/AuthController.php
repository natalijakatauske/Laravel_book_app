<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function show(): View
    {
        return view('auth/login');
    }

    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // autifikavimo logiką įsidėsime

        // dd($request->get('remember'));

        if(Auth::attempt($data, 1)) {
            $request->session()->regenerate();

            return redirect (route('profile')); //vartotojo profilis
        };

        return back()->withErrors(['email' => 'Invalid data provided']);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // TODO chenge to homepage url
        return redirect('categories');
    }
}
