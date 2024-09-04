@extends('template.content')
@section('container')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">

            <h2>{{ $post->title }}</h2>
            @if ($post->cover)
                <img src="{{ asset('storage/' . $post->cover) }}" class="card-img-top" class="img-fluid">
                @else
                <img src="{{ asset('img/default.jpeg') }}" class="card-img-top" class="img-fluid">
            @endif
            <i><p>By <a class="text-decoration-none"
                href="/?author={{ $post->user->name }}">{{ $post->user->name }}</a> In {{ $genre }}</p></i>
            <article>
                <p>{!! $post->content !!}</p>
            </article>
            {{-- kita pake kurung satu dan tanda kurung biar ga pake htmlspecialchars sehingga html yang diisi di database dapat dibaca --}}
            <style>
                article img {
                    max-width: 100%; /* Ensure images do not exceed the width of the parent container */
                    height: auto; /* Maintain the aspect ratio */
                    display: block; /* Remove bottom space (optional) */
                    margin-left: auto; /* Center align if needed */
                    margin-right: auto; /* Center align if needed */
                }
            </style>
            <a class="d-block my-2" href="/">Back to post</a>
        </div>
    </div>
</div>
@endsection
