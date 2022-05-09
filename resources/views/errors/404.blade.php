@extends('layouts.frontend.master')
@section('title', '404')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/not-found.css') }}">
@endsection
@section('content')
<section class="not_found py-120">
    <div class="container">
        <div class="not_found_inner">
            <img src="{{asset('frontend/assets/not-found/page-not-found.svg')}}" alt="" class="img-fluid w-100">
        </div>
    </div>
</sect

@endsection

