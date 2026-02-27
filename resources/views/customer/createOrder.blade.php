@extends('layouts.app')

@section('title', 'Pesan Menu')

@section('content')
    <div class="container">
        {{-- ALERT --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $err)
                    {{ $err }} <br>
                @endforeach
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Form Pemesanan</h5>
                    </div>

                    <div class="card-body">
                        <form action="/order" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Menu</label>
                                <input type="text" class="form-control" value="{{ $menu->name }}" disabled>
                                <input type="hidden" name="items[0][menu_id]" value="{{ $menu->id }}">
                                <input type="hidden" name="merchant_id" value="{{ $menu->merchant_id }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <input type="text" class="form-control" value="Rp {{ number_format($menu->price) }}"
                                    disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" name="items[0][qty]" class="form-control" min="1"
                                    value="1" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Pengiriman</label>
                                <input type="date" name="delivery_date" class="form-control" required>
                            </div>

                            <button class="btn btn-success w-100">
                                Buat Pesanan
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
