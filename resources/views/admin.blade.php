@extends('template.auth.bodyPages')
@section('sidebar')
    @include('template.auth.sidebar')
@endsection
@section('container')
<h2 class="mt-4">List User</h2>
@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@elseif (session()->has('update'))
    <div class="alert alert-success" role="alert">
        {{ session('update') }}
    </div>
@elseif (session()->has('delete'))
    <div class="alert alert-success" role="alert">
        {{ session('delete') }}
    </div>
@endif
<div class="card shadow mt-4">
    <div class="card-body">
        <div class="table-responsive">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered display" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>User's Id</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="">
                                <td class="sorting_1 text-center">{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role == 1)
                                        <span class="badge text-lg-center text-bg-success">{{ "Author" }}</span>
                                    @else
                                        <span class="badge text-lg-center text-bg-info">{{ "Admin" }}</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->timezone('Asia/Bangkok')->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $user->updated_at->timezone('Asia/Bangkok')->format('Y-m-d H:i:s') }}</td>
                                <td class="text-center">
                                    <a href="/users/{{ $user->id }}/edit"
                                        class="btn btn-warning btn-circle mx-2 my-2">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <form action="/users/{{ $user->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-circle" type="submit"
                                            onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
