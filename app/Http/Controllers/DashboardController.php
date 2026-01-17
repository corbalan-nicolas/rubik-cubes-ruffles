<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Raffle;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        Log::info('------------------------------------------------------------------------------------------');
        Log::info('[DashboardController index()] Method is being executed...');

        if (auth()->user()->role_id < 4) {
            // If you're not admin...
            return view('dashboard.index');
        }

        $totalOfTicketsSold = Ticket::count();
        $totalOfUsers = User::count();
        $totalOfRaffles = Raffle::count();
        $totalOfBlogs = Blog::where('status', 'published')->count();

        Log::info('------------------------------------------------------------------------------------------');
        return view('dashboard.index', [
            'totalOfTicketsSold' => $totalOfTicketsSold,
            'totalOfUsers' => $totalOfUsers,
            'totalOfRaffles' => $totalOfRaffles,
            'totalOfBlogs' => $totalOfBlogs,
        ]);
    }
}
