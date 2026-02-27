<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    //form order
    public function create(Menu $menu)
    {
        return view('customer.createOrder', compact('menu'));
    }

    //proses simpan order
    public function store(Request $request)
    {
        try {
            $request->validate([
                'merchant_id' => 'required|exists:merchants,id',
                // 'order_date' => 'required',
                'delivery_date' => 'required',
                'items' => 'required|array',
            ]);

            $total = 0;

            //menghitung total harga order
            foreach ($request->items as $item) {
                $menu = Menu::findOrFail($item['menu_id']);
                $total += $menu->price * $item['qty'];
            }

            //membuat orderan
            $order = Order::create([
                'customer_id' => Auth::id(),
                'merchant_id' => $request->merchant_id,
                'order_date' => Carbon::today(),
                'delivery_date' => $request->delivery_date,
                'total_price' => $total

            ]);

            foreach ($request->items as $item) {
                $menu = Menu::find($item['menu_id']);
                $order->items()->create([
                    'menu_id' => $menu->id,
                    'quantity' => $item['qty'],
                    'price' => $menu->price,
                ]);
            }

            return redirect('/invoice/' . $order->id)
                ->with('success', 'Order berhasil dibuat');
        } catch (\Throwable $e) {
            Log::error($e->getMessage(), ['exception' => $e]);
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }   
}
