@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h3 class="mb-3 text-center">Register</h3>

            <form method="POST" action="/register">
                @csrf

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="merchant">Merchant</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>

                <button class="btn btn-success w-100">Register</button>
            </form>

        </div>
    </div>
@endsection
