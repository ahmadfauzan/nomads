<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = TravelPackage::with(['galleries'])->get();
        $carts = '';

        if (Auth::check()) {
            $carts = Transaction::with(['travel_package', 'travel_package.galleries', 'user'])->where('user_id', '=', Auth::user()->id)->get();
        }

        return view('pages.home', [
            'items' => $items,
            'carts' => $carts,
        ]);
    }
}
