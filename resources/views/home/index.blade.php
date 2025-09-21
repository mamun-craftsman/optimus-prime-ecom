@extends('layouts.home')
@section('content')
	@include('components.home_navigation', ['globalCategories' => $subcategories])
    @include('home.feature_products')
@endsection