@extends('template.auth.bodyPages')
@section('sidebar')
    @include('template.auth.sidebar')
@endsection
@section('container')
@if (session()->has('delete'))
<div class="alert alert-success" role="alert">
    {{ session('delete') }}
</div>
@elseif (session()->has('update'))
<div class="alert alert-success" role="alert">
    {{ session('update') }}
</div>
@elseif (session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
    <h2>My Post</h2>
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-12 col-md-4 my-3">
            <div class="card pt-3">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="post-content mb-4">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->excerpt }}</p>
                    </div>
                    <div class="twoButtons">
                        <a href="/posts/{{ $post->slug }}" class="btn btn-primary w-100 mb-2">Detail</a>
                        <form action="/posts/{{ $post->slug }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger w-100" type="submit" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
