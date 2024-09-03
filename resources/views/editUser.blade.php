@extends('template.auth.bodyPages')
@section('sidebar')
    @include('template.auth.sidebar')
@endsection
@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
    </div>
    <form method="POST" action="/users/{{ $user->id }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6 col-12">
                    <label for="username">Username</label>
                    <input type="text" value="{{ $user->username }}" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username') }}" name="username" required autofocus>
                    @error('username')
                        <div class="invalid-feedback mb-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-md-6 col-12">
                    <label for="email">Email</label>
                    <input type="text" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" name="email" required>
                    @error('email')
                        <div class="invalid-feedback mb-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4 col-12">
                    <label for="name">Display Name</label>
                    <input type="text" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name" required>
                    @error('name')
                        <div class="invalid-feedback mb-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-md-4 col-12">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Author</option>
                        <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div class="form-group col-md-4 col-12">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" id="submitBtn" class="btn btn-primary my-3">Edit User</button>
        </div>
    </form>
</div>
@endsection
