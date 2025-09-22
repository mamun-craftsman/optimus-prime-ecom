@foreach($products as $product)
<article class="product-card neon-border bg-white/5 border border-white/10 backdrop-blur rounded-xl overflow-hidden flex flex-col">
    <a href="{{route('products.show', $product)}}" class="block">
        <div class="bg-gray-800 aspect-[4/3] w-full overflow-hidden">
            @if($product->primary_image)
                <img src="{{ 'storage/'.$product->primary_image }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover">
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
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span class="text-white ml-1">4.7</span>
            </div>
             @include('components._cart', ['product' => $product])
        </div>
    </div>
</article>
@endforeach
