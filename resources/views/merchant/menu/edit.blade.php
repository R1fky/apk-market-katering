@extends('layouts.app')

@section('content')
    <div class="container col-md-6">
        <h4>Edit Menu</h4>

        <form method="POST" action="/merchant/menus/{{ $menu->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Menu</label>
                <input name="name" class="form-control" value="{{ $menu->name }}">
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control">{{ $menu->description }}</textarea>
            </div>

            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="price" class="form-control" value="{{ $menu->price }}">
            </div>

            <div class="mb-3">
                <label>Foto Baru (opsional)</label>
                <input type="file" name="photo" class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
