@extends('layouts.app')

@section('title', 'Profil Merchant')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h4 class="mb-3">Profil Merchant</h4>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="/merchant/profile">
                @csrf

                <div class="mb-3">
                    <label>Nama Perusahaan</label>
                    <input type="text" name="company_name" class="form-control"
                        value="{{ old('company_name', $profile->company_name ?? '') }}">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="address" class="form-control">{{ old('address', $profile->address ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Kontak</label>
                    <input type="tel" name="phone" class="form-control"
                        value="{{ old('phone', $profile->phone ?? '') }}">

                </div>


                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control">{{ old('description', $profile->description ?? '') }}</textarea>
                </div>

                <button class="btn btn-primary">Simpan Profil</button>
            </form>

        </div>
    </div>
@endsection
