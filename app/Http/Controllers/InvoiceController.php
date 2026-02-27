<?php

namespace App\Http\Controllers;

use App\Models\Order;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    //
    public function show(Order $order)
    {
        // Security: hanya customer & merchant terkait
        if (
            Auth::id() !== $order->customer_id &&
            Auth::user()->merchant?->id !== $order->merchant_id
        ) {
            abort(403);
        }

        $order->load('items.menu', 'merchant', 'customer');

        return view('invoice.show', compact('order'));
    }
}
