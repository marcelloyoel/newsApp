@extends('template.nonauth.main')
@section('navbar')
    @include('template.nonauth.navbar')
@endsection
@section('container')
    @yield('content')
@endsection
