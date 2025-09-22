@extends('layouts.home')
@section('content')
    @include('home.feature_products', ['featuredProducts' => $featuredProducts])
@endsection