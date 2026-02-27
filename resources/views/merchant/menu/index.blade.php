@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h4>Daftar Menu</h4>
            <a href="/merchant/menus/create" class="btn btn-primary">+ Tambah Menu</a>
        </div>

        <div class="row">
            @forelse ($menus as $menu)
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="row g-0">
                            <div class="col-4">
                                @if ($menu->photo)
                                    <img src="{{ asset('storage/' . $menu->photo) }}" class="img-fluid rounded-start"
                                        alt="{{ $menu->name }}">
                                @else
                                    <img src="https://via.placeholder.com/150" class="img-fluid rounded-start"
                                        alt="No Image">
                                @endif
                            </div>

                            <div class="col-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $menu->name }}</h5>
                                    <p class="card-text">Rp {{ number_format($menu->price) }}</p>

                                    <a href="/merchant/menus/{{ $menu->id }}/edit" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>Tidak ada menu.</p>
            @endforelse
        </div>
    </div>
@endsection
