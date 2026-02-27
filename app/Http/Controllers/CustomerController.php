<?php

namespace App\Http\Controllers;

use App\Models\Menu;

// use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index()
    {
        return view('customer');
    }

    //get menu page 
    public function getMenu()
    {
        $menus = Menu::latest()->get();
        
        return view('customer.menu.index', compact('menus'));
    }
}
