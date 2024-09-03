@extends('template.auth.bodyPages')
@section('sidebar')
    @include('template.auth.sidebar')
@endsection
@section('container')
<div class="container">
    <div class="row my-5">
        <div class="col-lg-8 mx-auto">

            <div class="postHeader">
                <p>Published on {{ $tanggal }}</p>
                <h2 class="mb-3"><strong>{{ $post->title }}</strong></h2>
                <p><i>{{ $genres }}</i></p>
                <div class="theButtons">
                    <a href="/posts" class="btn btn-success mb-2"><span data-feather="arrow-left"></span>Back to my
                        post</a>
                    <a href="/posts/{{ $post->slug }}/edit" class="btn btn-warning mb-2">Edit this post <span
                            data-feather="edit"></span></a>
                    <form action="/posts/{{ $post->slug }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger mb-2 border-0" type="submit"
                            onclick="return confirm('Are you sure?')">Delete this post <span
                                data-feather="x-circle"></span></button>
                    </form>
                </div>
            </div>
            {{-- <a href="" class="btn btn-danger mb-2">Delete this post <span data-feather="x-circle"></span></a> --}}

            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" class="img-fluid">
            @else
                {{-- <img src="https://source.unsplash.com/1200x400?work" class="card-img-top"
                    alt="work" class="img-fluid mt-5"> --}}
            @endif
            <article>
                <p>{!! $post->content !!}</p>
            </article>
            {{-- kita pake kurung satu dan tanda kurung biar ga pake htmlspecialchars sehingga html yang diisi di database dapat dibaca --}}

            <a class="d-block my-2" href="/posts">Back to post</a>
        </div>
    </div>
</div>
@endsection
