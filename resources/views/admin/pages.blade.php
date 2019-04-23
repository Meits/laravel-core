@extends('administrator::layouts.admin')

@section('header')
    @include('administrator::layouts.parts.header')
@endsection

@section('navigation')
    {!! $sidebar !!}
@endsection

@section('content')
    {!! $content !!}
@endsection

@section('footer')
    @include('administrator::layouts.parts.footer')
@endsection