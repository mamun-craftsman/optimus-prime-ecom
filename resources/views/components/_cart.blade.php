<button class="add-to-cart-btn cart-btn inline-flex items-center gap-2 px-3 py-2 rounded-lg text-white bg-gradient-to-r from-purple-600 to-cyan-500 hover:from-purple-700 hover:to-cyan-600 transition-all"
        data-product-id="{{ $product->id }}"
        {{ $product->stock <= 0 ? 'disabled' : '' }}>
    <i class="fas fa-shopping-cart"></i>
    <span class="hidden sm:inline">{{ $product->stock > 0 ? 'Add' : 'Out' }}</span>
</button>

@if($product->variations->isNotEmpty())
    @foreach($product->variations->take(1) as $variation)
        @foreach($variation->attributeValues as $attributeValue)
            <span class="hidden default-variation" 
                  data-product-id="{{ $product->id }}"
                  data-variation-id="{{ $variation->id }}"
                  data-attribute="{{ $attributeValue->attribute->name }}"></span>
        @endforeach
    @endforeach
@endif
