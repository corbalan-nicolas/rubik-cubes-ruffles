<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            return to_route('dashboard.index');
        }

        return back(fallback: route('auth.login'))
            ->withInput();
    }

    public function register(Request $request) {
        // TODO: [AuthController register()] method
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('auth.login.show');
    }
}
