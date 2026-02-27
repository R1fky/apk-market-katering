<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

// use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // cek apakah user sudah punya merchant
        if (!$user->merchant) {
            return redirect('/merchant/profile'); 
        }

        $menus = $user->merchant->menus()->latest()->get();

        return view('merchant.dashboard', compact('menus'));
    }
}
