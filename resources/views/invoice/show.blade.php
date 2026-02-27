@extends('layouts.app')

@section('content')
<div class="container col-md-8">
    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="text-center mb-4">INVOICE</h4>

            <p><strong>Merchant:</strong> {{ $order->merchant->company_name }}</p>
            <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
            <p><strong>Tanggal Kirim:</strong> {{ $order->delivery_date }}</p>

            <table class="table table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Menu</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->menu->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->price) }}</td>
                            <td>
                                Rp {{ number_format($item->price * $item->quantity) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h5 class="text-end mt-3">
                Total: Rp {{ number_format($order->total_price) }}
            </h5>

        </div>
    </div>
</div>
@endsection