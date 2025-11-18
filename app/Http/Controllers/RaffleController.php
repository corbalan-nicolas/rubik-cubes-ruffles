<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    //
    public function index() {
        $raffle = Raffle::currentRaffle();
        return view('home', ['raffle' => $raffle]);
    }

    public function my_raffles() {
        return view('dashboard.my-raffles');
    }
}
