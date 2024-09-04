@extends('template.content')
@section('container')
<div class="title text-center my-5">
    <h1 class="">Welcome to The News App</h1>
    @auth
    <p>What do you want to read today, {{ Auth::user()->name }} ?</p>
    @else
    <p>What do you want to read today?</p>
    @endauth
</div>
<div class="row justify-content-center mb-3">
    <div class="col-md-6">
        <form action="/">
            <div class="input-group mb-3">
                @if (request('tag'))
                    <input type="hidden" class="form-control" placeholder="Search..." name="tag"
                        value="{{ request('tag') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" class="form-control" placeholder="Search..." name="author"
                        value="{{ request('author') }}">
                @endif
                <input type="text" class="form-control" placeholder="Search..." name="search"
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12 text-center">
        <h4><strong>{{ $judul }}</strong></h4>
    </div>
    @if($posts->count())
        @foreach ($posts as $post)
        <div class="col-12 col-md-4 my-3 d-flex align-items-stretch">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/' . $post->cover) }}" class="card-img-top" alt="Post Image">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p>
                        <small>
                            By <a class="text-decoration-none" href="/?author={{ $post->user->name }}">{{ $post->user->name }}</a>
                            {{ $post->created_at->diffForHumans() }}
                        </small>
                    </p>
                    <p class="card-text">{{ $post->excerpt }}</p>
                    <div class="mt-auto">
                        <a href="/{{ $post->slug }}" class="btn btn-primary w-100">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @else
    <p class="col-12 text-center fs-4"><strong>No Post Found.</strong></p>
    @endif
    <style>
        .card-img-top {
            max-height: 200px;
            object-fit: cover;
        }
    </style>
</div>
<div class=" my-4 d-flex justify-content-center">
    {{ $posts->links() }}
</div>
@endsection
