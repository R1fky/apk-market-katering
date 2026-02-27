@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('title', 'Daftar Menu')

@section('content')
    <div class="container">

        <div class="row mb-4">
            <div class="col-12 text-center">
                <h3 class="fw-bold">Daftar Menu Katering</h3>
                <p class="text-muted">Pilih menu favorit untuk dipesan</p>
            </div>
        </div>

        <div class="row">

            @forelse ($menus as $menu)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">

                        {{-- FOTO MENU --}}
                        @if ($menu->photo)
                            <img src="{{ asset('storage/' . $menu->photo) }}" class="card-img-top" alt="{{ $menu->name }}"
                                style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top"
                                alt="No Image">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $menu->name }}</h5>

                            <p class="card-text text-muted small">
                                {{ Str::limit($menu->description, 80) }}
                            </p>

                            <h6 class="fw-bold mt-auto">
                                Rp {{ number_format($menu->price) }}
                            </h6>

                            <a href="/menus/{{ $menu->id }}/order" class="btn btn-success mt-2">
                                Pesan
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada menu tersedia.
                    </div>
                </div>
            @endforelse

        </div>
    </div>
@endsection
