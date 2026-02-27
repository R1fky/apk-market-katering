@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="fw-bold">Marketplace Katering</h1>
            <p class="text-muted">
                Temukan katering terbaik untuk acara Anda atau jual menu terbaikmu.
            </p>

            <a href="/register" class="btn btn-primary me-2">Daftar Sekarang</a>
            <a href="/login" class="btn btn-outline-secondary">Login</a>
        </div>

        {{-- <div class="col-md-6 text-center">
            <img src="https://via.placeholder.com/400" class="img-fluid" alt="Katering">
        </div> --}}
    </div>
@endsection
