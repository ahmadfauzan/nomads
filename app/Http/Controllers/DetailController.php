<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function index(Request $request, $slug)
    {
        $item = TravelPackage::with(['galleries'])->where('slug', $slug)->firstOrFail();
        $carts = '';

        if (Auth::check()) {
            $carts = Transaction::with(['travel_package', 'travel_package.galleries', 'user'])->where('user_id', '=', Auth::user()->id)->get();
        }
        return view('pages.detail', [
            'item' => $item,
            'carts' => $carts,
        ]);
    }
}
