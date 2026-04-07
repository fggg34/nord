@extends('layouts.app', ['htmlAttrs' => ' lang="en"'])

@section('head_inner')
    @include('partials.framer._head_search')
@endsection

@section('body_inner')
    @include('partials.framer._body_search')
@endsection
