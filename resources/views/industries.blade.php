@extends('layouts.app', ['htmlAttrs' => ' lang="en" class="lenis"'])

@section('head_inner')
    @include('partials.framer._head_industries')
@endsection

@section('body_inner')
    @include('partials.framer._body_industries')
@endsection
