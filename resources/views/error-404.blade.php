@extends('layouts.app', ['htmlAttrs' => ' lang="en" class="lenis"'])

@section('head_inner')
    @include('partials.framer._head_error-404')
@endsection

@section('body_inner')
    @include('partials.framer._body_error-404')
@endsection
