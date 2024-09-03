@extends('template.auth.bodyPages')
@section('sidebar')
    @include('template.auth.sidebar')
@endsection
@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create New User</h6>
    </div>
    <form method="POST" action="/users" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6 col-12">
                    <label for="username">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username') }}" name="username" required autofocus>
                    @error('username')
                        <div class="invalid-feedback mb-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-md-6 col-12">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{ old('password') }}" name="password" required autofocus>
                    @error('password')
                        <div class="invalid-feedback mb-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 col-12">
                    <label for="email">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" name="email" required>
                    @error('email')
                        <div class="invalid-feedback mb-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-md-6 col-12">
                    <label for="name">Display Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name" required>
                    @error('name')
                        <div class="invalid-feedback mb-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 col-12">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option value="1">Author</option>
                        <option value="2">Admin</option>
                    </select>
                </div>
                <div class="form-group col-md-6 col-12">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1">Aktif</option>
                        <option value="2">Non-Aktif</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" id="submitBtn" class="btn btn-primary my-3">Create User</button>
        </div>
    </form>
</div>
@endsection
