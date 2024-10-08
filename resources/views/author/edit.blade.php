@extends('template.auth.bodyPages')
@section('sidebar')
    @include('template.auth.sidebar')
@endsection
@section('container')
@if (session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Post</h6>
    </div>
    <form method="POST" action="/posts/{{ $post->slug }}" enctype="multipart/form-data" id="formAdd">
        @method('put')
        @csrf
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="title"><strong>Judul Berita</strong></label>
                    <input placeholder="Buatlah judul beritamu disini" type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $post->title) }}" name="title" required autofocus>
                    @error('title')
                        <div class="invalid-feedback mb-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-12" style="display: none">
                    <label for="slug"><strong>Slug</strong></label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" value="{{ old('slug', $post->slug) }}" name="slug" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12" style="display: none">
                    <label for="excerpt"><strong>Ringkasan / Sinopsis</strong></label>
                    <input placeholder="Buatlah ringkasan dari tulisanmu disini" type="text" class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" value="{{ old('excerpt', $post->excerpt) }}" name="excerpt">
                    @error('excerpt')
                        <div class="invalid-feedback mb-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="selectMultipleStatus"><strong>Genre / Tag</strong></label>
                    <select name="selectMultipleStatus[]" multiple class="form-control selectpicker" id="selectMultipleStatus"
                        data-live-search="true" required>
                        @foreach ($tags as $tag)
                            @if (in_array($tag->id, $selectedTags))
                                <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @else
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('selectMultipleStatus')
                        <div class="invalid-feedback mb-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="cover"><strong>Upload Cover Image</strong></label>
                    @if ($post->cover)
                    <img src="{{ asset('storage/' . $post->cover) }}" class="img-preview img-fluid d-block w-50 mb-2">
                    @else
                    <img src="" class="img-preview img-fluid d-block w-50 mb-2">
                    @endif

                    <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover" onchange="previewImage()">
                    @error('cover')
                        <div class="invalid-feedback mb-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="form-group col-12">
                    <label for="x"><strong>Content</strong></label>
                    @error('content')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="x" type="hidden" name="content" value="{{ old('content', $post->content) }}">
                    <trix-editor input="x"></trix-editor>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" id="submitBtn" class="btn btn-primary my-3">Edit Post</button>
        </div>
    </form>
</div>
@endsection
