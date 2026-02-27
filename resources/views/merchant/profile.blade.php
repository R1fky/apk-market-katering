@extends('layouts.app')

@section('title', 'Profil Merchant')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Profil Merchant</strong>

                    <a href="/merchant/profile/edit" class="btn btn-sm btn-primary">
                        Edit Profil
                    </a>
                </div>

                <div class="card-body">

                    @if (!$profile)
                        <div class="alert alert-warning">
                            Profil belum dibuat.
                            <a href="/merchant/profile/edit" class="alert-link">
                                Buat Profil Sekarang
                            </a>
                        </div>
                    @else
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">Nama Perusahaan</th>
                                <td>{{ $profile->company_name }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $profile->address }}</td>
                            </tr>
                            <tr>
                                <th>Kontak</th>
                                <td>{{ $profile->phone }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $profile->description }}</td>
                            </tr>
                        </table>
                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection
