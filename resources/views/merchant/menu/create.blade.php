@extends('layouts.app')

@section('content')
<div class="container col-md-6">
    <h4>Tambah Menu</h4>

    <form method="POST" action="/merchant/menus" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Menu</label>
            <input name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection