@extends('layouts.home')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-white">Shopping Cart</h1>
        <a href="{{ url()->previous() }}" class="btn-secondary px-6 py-3 rounded-lg text-white">
            <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
        </a>
    </div>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="product-card neon-border p-6">
                    <div class="space-y-6">
                        @foreach($cartItems as $item)
                            <div class="cart-item flex items-center gap-4 p-4 border border-gray-700 rounded-lg" data-item-id="{{ $item->id }}">
                                <div class="w-20 h-20 rounded-lg overflow-hidden">
                                    <img src="{{ $item->product->primary_image ? '/storage/'.$item->product->primary_image : '/images/placeholder.png' }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-full h-full object-cover">
                                </div>
                                
                                <div class="flex-1">
                                    <h3 class="text-white font-semibold mb-1">{{ $item->product->name }}</h3>
                                    
                                    @if($item->variations->isNotEmpty())
                                        <div class="text-sm text-gray-400 mb-2">
                                            @foreach($item->variations as $variation)
                                                @foreach($variation->attributeValues as $attributeValue)
                                                    <span class="inline-block mr-2">
                                                        {{ $attributeValue->attribute->name }}: {{ $attributeValue->value }}
                                                    </span>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center border border-gray-600 rounded">
                                            <button class="quantity-btn px-3 py-1 text-white hover:bg-gray-700" data-action="decrease">-</button>
                                            <input type="number" value="{{ $item->quantity }}" min="1" 
                                                   class="w-16 text-center bg-transparent text-white border-0 outline-none quantity-input">
                                            <button class="quantity-btn px-3 py-1 text-white hover:bg-gray-700" data-action="increase">+</button>
                                        </div>
                                        
                                        <span class="text-lg font-semibold text-white item-total">
                                            ${{ number_format(($item->variations->isNotEmpty() ? $item->variations->sum('price') : $item->product->price) * $item->quantity, 2) }}
                                        </span>
                                        
                                        <button class="text-red-400 hover:text-red-300 ml-auto remove-item">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6 flex justify-between">
                        <button id="clear-cart" class="text-red-400 hover:text-red-300">
                            <i class="fas fa-trash mr-2"></i> Clear Cart
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-1">
                <div class="product-card neon-border p-6 sticky top-8">
                    <h3 class="text-xl font-bold text-white mb-6">Order Summary</h3>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between text-gray-300">
                            <span>Subtotal:</span>
                            <span class="cart-total">${{ number_format($total, 2) }}</span>
                        </div>
                        
                        <div class="flex justify-between text-gray-300">
                            <span>Shipping:</span>
                            <span>Free</span>
                        </div>
                        
                        <div class="border-t border-gray-700 pt-4">
                            <div class="flex justify-between text-white font-bold text-lg">
                                <span>Total:</span>
                                <span class="cart-total">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                        
                        <button class="btn-primary w-full py-3 rounded-lg text-white font-bold mt-6">
                            <i class="fas fa-credit-card mr-2"></i> Proceed to Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-16">
            <div class="text-gray-500 text-6xl mb-4">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h2 class="text-2xl font-bold text-white mb-4">Your cart is empty</h2>
            <p class="text-gray-400 mb-6">Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('home.index') }}" class="btn-primary px-8 py-3 rounded-lg text-white font-bold">
                Start Shopping
            </a>
        </div>
    @endif
</div>

@endsection
