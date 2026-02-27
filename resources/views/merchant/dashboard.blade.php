@extends('layouts.app')

@section('title', 'Dashboard Merchant')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold">Daftar Menu</h4>

                <a href="/merchant/menus/create" class="btn btn-primary">
                    + Tambah Menu
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body table-responsive">

                {{-- ALERT --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($menus->isEmpty())
                    <div class="alert alert-info text-center">
                        Belum ada menu. Silakan tambah menu.
                    </div>
                @else
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th width="40">#</th>
                                <th width="100">Foto</th>
                                <th>Nama Menu</th>
                                <th width="130">Harga</th>
                                <th>Deskripsi</th>
                                <th width="180">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    {{-- FOTO --}}
                                    <td>
                                        @if ($menu->photo)
                                            <img src="{{ asset('storage/' . $menu->photo) }}" alt="{{ $menu->name }}"
                                                class="img-thumbnail" width="80" height="80"
                                                style="object-fit: cover;">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>

                                    {{-- NAMA --}}
                                    <td class="text-start fw-semibold">
                                        {{ $menu->name }}
                                    </td>

                                    {{-- HARGA --}}
                                    <td>
                                        Rp {{ number_format($menu->price) }}
                                    </td>

                                    {{-- DESKRIPSI --}}
                                    <td class="text-start">
                                        {{ Str::limit($menu->description, 80) }}
                                    </td>

                                    {{-- AKSI --}}
                                    <td>
                                        <a href="/merchant/menus/{{ $menu->id }}/edit"
                                            class="btn btn-sm btn-warning mb-1">
                                            Edit
                                        </a>

                                        <form action="/merchant/menus/{{ $menu->id }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                @endif

            </div>
        </div>
    </div>
@endsection
