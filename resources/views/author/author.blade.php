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
                @if ($post->cover)
                    <img src="{{ asset('storage/' . $post->cover) }}" class="card-img-top mt-4 d-block mx-auto" class="img-fluid">
                @else
                    <img src="{{ asset('img/default.jpeg') }}" class="card-img-top mt-4 d-block mx-auto"
                        alt="default" class="img-fluid mt-5">
                @endif
                <div class="card-body">
                    <div class="post-content mb-4">
                        <h5 class="card-title"><strong>{{ $post->title }}</strong></h5>
                        <p class="card-text">{{ $post->excerpt }}</p>
                        <p>{{ $post->created_at->diffForHumans() }}</p>
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
