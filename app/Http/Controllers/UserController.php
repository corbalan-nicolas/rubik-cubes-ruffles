<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_profile(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $user = User::with(['role', 'tickets'])->findOrFail($id);
        return view('dashboard.user-profile', ['user' => $user]);
    }

    public function all_users(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $users = User::all();
        return view('dashboard.all-users', ['users' => $users]);
    }
}
