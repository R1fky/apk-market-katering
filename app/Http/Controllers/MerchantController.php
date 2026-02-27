<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

// use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // CEK: merchant profile sudah ada atau belum

        $menus = $user->merchant
            ->menus()
            ->latest()
            ->get();

        return view('merchant.dashboard', compact('menus'));
    }   
}
