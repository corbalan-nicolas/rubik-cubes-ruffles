<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            'email.exists' => 'Email does not exist.'
        ]);

        if (auth()->attempt($credentials)) {
            return to_route('dashboard.index');
        }

        return back(fallback: route('auth.login'))
            ->withInput()
            ->with([
                'feedback.message' => 'Email or password is incorrect.',
                'feedback.type' => 'danger'
            ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'terms' => 'required'
        ]);

        $data = $request->only('name', 'email', 'password', 'confirm_password', 'terms');

        $user = new User();
        $user->name = $data['name'];
        $user->display_name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        $this->login($request);

        return to_route('dashboard.index');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('auth.login.show');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'display_name' => 'required',
        ]);

        $data = $request->only('name', 'display_name', 'email', 'current_password', 'new_password', 'confirm_new_password');
        $user = auth()->user();

        $user->name = $data['name'];
        $user->display_name = $data['display_name'];
        $user->email = $data['email'];

        $user->save();

        if($request->anyFilled(['current_password', 'new_password', 'confirm_new_password'])) {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required',
                'confirm_new_password' => 'required|same:new_password',
            ]);

            Log::debug('[AuthController::update] Change password');
            $credentials = [
                'email' => $user->email,
                'password' => $data['current_password'],
            ];

            if (auth()->validate($credentials)) {
                Log::debug('[AuthController::update] Credentials are correct');
                $user->password = Hash::make($data['new_password']);
                $user->save();
            } else {
                Log::debug('[AuthController::update] Wrong credentials');
                return back()
                    ->withInput()
                    ->withErrors(['current_password' => 'Wrong password.']);
            }
        }

        return to_route('dashboard.user-profile.show', ['id' => auth()->user()->id]);
    }
}
