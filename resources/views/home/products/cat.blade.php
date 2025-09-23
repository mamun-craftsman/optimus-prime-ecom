@extends('layouts.home')

@section('title', $category->name . ' Products')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-900">
    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home.index') }}" class="text-gray-400 hover:text-white transition">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-600 mx-2"></i>
                        <span class="text-white font-medium">{{ $category->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Category Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                {{ $category->name }}
            </h1>
            @if($category->description)
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    {{ $category->description }}
                </p>
            @endif
        </div>

        <!-- Filter Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 space-y-4 md:space-y-0">
            <div class="text-gray-400">
                Showing {{ $products->count() }} of {{ $products->total() }} products
            </div>
            
            <form method="GET" class="flex items-center space-x-4">
                <label for="sort" class="text-gray-400 whitespace-nowrap">Sort by:</label>
                <select name="sort" id="sort" 
                        class="bg-gray-800 border border-gray-600 text-white px-4 py-2 rounded-lg focus:border-neon focus:outline-none"
                        onchange="this.form.submit()">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                </select>
            </form>
        </div>

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                @foreach($products as $product)
                    <article class="product-card neon-border bg-white/5 border border-white/10 backdrop-blur rounded-xl overflow-hidden flex flex-col hover:bg-white/10 transition-all duration-300">
                        <a href="{{ route('products.show', $product) }}" class="block">
                            <div class="bg-gray-800 aspect-[4/3] w-full overflow-hidden">
                                @if($product->primary_image)
                                    <img src="{{ asset('storage/'.$product->primary_image) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-500">
                                        <i class="fas fa-mobile-alt text-4xl"></i>
                                    </div>
                                @endif
                            </div>
                        </a>

                        <div class="p-4 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg sm:text-xl font-bold text-white leading-snug line-clamp-2 flex-1 mr-2">
                                    {{ $product->name }}
                                </h3>
                                <span class="price-tag text-emerald-600 text-lg font-semibold whitespace-nowrap">
                                    &#2547;{{ is_numeric($product->price) ? number_format($product->price, 2) : $product->price }}
                                </span>
                            </div>

                            @if($product->key_feature_left)
                                <div class="prose prose-invert prose-sm max-w-none text-gray-400 mb-4 line-clamp-3">
                                    {!! $product->key_feature_left !!}
                                </div>
                            @endif

                            <div class="flex justify-between items-center mt-auto">
                                <div class="flex items-center text-yellow-400">
                                    @php
                                        $averageRating = $product->reviews->avg('rating') ?? 0;
                                        $fullStars = floor($averageRating);
                                        $hasHalfStar = $averageRating - $fullStars >= 0.5;
                                        $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                                    @endphp
                                    
                                    @for ($i = 1; $i <= $fullStars; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    
                                    @if ($hasHalfStar)
                                        <i class="fas fa-star-half-alt"></i>
                                    @endif
                                    
                                    @for ($i = 1; $i <= $emptyStars; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                    
                                    <span class="text-white ml-1">{{ number_format($averageRating, 1) }}</span>
                                </div>

                                @include('components._cart', ['product' => $product])
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="flex justify-center">
                {{ $products->links('partials.custom') }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="bg-white/5 border border-white/10 backdrop-blur rounded-xl p-12 max-w-md mx-auto">
                    <i class="fas fa-box-open text-6xl text-gray-500 mb-6"></i>
                    <h3 class="text-2xl font-bold text-white mb-4">No Products Found</h3>
                    <p class="text-gray-400 mb-6">There are currently no products in this category.</p>
                    <a href="{{ route('home.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Home
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
