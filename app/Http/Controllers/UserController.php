<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user_profile(int $id)
    {
        $user = User::with(['role'])->findOrFail($id);
        $totalPaid = Payment::where('user_id', $id)->sum('amount');
        $history = Payment::with('tickets.raffle')
            ->where('user_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard.other-user-profile', [
            'user' => $user,
            'history' => $history,
            'totalPaid' => $totalPaid,
        ]);
    }

    public function all_users()
    {
        $users = User::all();
        return view('dashboard.all-users', ['users' => $users]);
    }
}
