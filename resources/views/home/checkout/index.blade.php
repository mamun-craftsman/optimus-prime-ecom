@extends('layouts.home')

@push('styles')
<style>
    .checkout-card {
        background: rgba(15, 23, 42, 0.8);
        border-radius: 16px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(129, 140, 153, 0.3);
        transition: all 0.3s ease;
    }

    .checkout-card:hover {
        border-color: #00f7ff;
        box-shadow: 0 8px 25px rgba(0, 247, 255, 0.15);
    }

    .form-input {
        background: rgba(30, 41, 59, 0.8);
        border: 1px solid rgba(129, 140, 153, 0.3);
        color: white;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #00f7ff;
        box-shadow: 0 0 0 3px rgba(0, 247, 255, 0.2);
        background: rgba(30, 41, 59, 0.9);
    }

    .payment-option {
        background: rgba(30, 41, 59, 0.6);
        border: 1px solid rgba(129, 140, 153, 0.3);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .payment-option:hover {
        border-color: #00f7ff;
        background: rgba(0, 247, 255, 0.1);
    }

    .payment-option.selected {
        border-color: #00f7ff;
        background: rgba(0, 247, 255, 0.15);
    }

    .order-item {
        background: rgba(30, 41, 59, 0.6);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .order-item:hover {
        background: rgba(30, 41, 59, 0.8);
    }

    .btn-checkout {
        background: linear-gradient(45deg, #00f7ff, #8b5cf6);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .btn-checkout:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(0, 247, 255, 0.3);
    }

    .btn-checkout::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -60%;
        width: 20px;
        height: 200%;
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(30deg);
        transition: all 0.6s;
    }

    .btn-checkout:hover::after {
        left: 120%;
    }

    .use-address-btn {
        background: rgba(0, 247, 255, 0.1);
        border: 1px solid rgba(0, 247, 255, 0.3);
        color: #00f7ff;
        transition: all 0.3s ease;
    }

    .use-address-btn:hover {
        background: rgba(0, 247, 255, 0.2);
        border-color: #00f7ff;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Secure Checkout</h1>
            <p class="text-gray-400">Complete your order with our secure payment system</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
            <div class="lg:col-span-2">
                <div class="checkout-card p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 bg-gradient-to-r from-neon to-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-3">1</div>
                        <h2 class="text-2xl font-bold text-white">Billing Information</h2>
                    </div>
                    
                    <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-300 mb-2 font-medium">
                                    <i class="fas fa-user mr-2 text-neon"></i>Full Name *
                                </label>
                                <input type="text" name="full_name" value="{{ $user->name ?? '' }}" 
                                       class="form-input w-full px-4 py-3 rounded-lg" required
                                       placeholder="Enter your full name">
                                @error('full_name')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-gray-300 mb-2 font-medium">
                                    <i class="fas fa-phone mr-2 text-neon"></i>Phone Number *
                                </label>
                                <input type="tel" name="phone" value="{{ $user->phone ?? '' }}" 
                                       class="form-input w-full px-4 py-3 rounded-lg" required
                                       placeholder="Enter your phone number">
                                @error('phone')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-gray-300 mb-2 font-medium">
                                <i class="fas fa-envelope mr-2 text-neon"></i>Email Address *
                            </label>
                            <input type="email" name="email" value="{{ $user->email ?? '' }}" 
                                   class="form-input w-full px-4 py-3 rounded-lg" required
                                   placeholder="Enter your email address">
                            @error('email')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-8">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-r from-neon to-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-3">2</div>
                                    <h3 class="text-xl font-bold text-white">Shipping Address</h3>
                                </div>
                                @if($shippingAddress)
                                    <button type="button" id="useShippingAddr" class="use-address-btn px-4 py-2 rounded-lg text-sm font-medium">
                                        <i class="fas fa-copy mr-2"></i>Use Saved Address
                                    </button>
                                @endif
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-300 mb-2 font-medium">
                                    <i class="fas fa-map-marker-alt mr-2 text-neon"></i>Complete Address *
                                </label>
                                <textarea name="address" rows="4" 
                                          class="form-input w-full px-4 py-3 rounded-lg resize-none" required
                                          placeholder="Enter your complete address (House/Flat, Road, Area, City, District)">{{ $shippingAddress }}</textarea>
                                @error('address')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="save_shipping_address" id="saveAddress" 
                                       class="w-4 h-4 text-neon bg-gray-800 border-gray-600 rounded focus:ring-neon focus:ring-2">
                                <label for="saveAddress" class="ml-3 text-gray-300 text-sm">
                                    <i class="fas fa-save mr-2 text-neon"></i>Save this as my default shipping address
                                </label>
                            </div>
                        </div>

                        <div class="mb-8">
                            <div class="flex items-center mb-6">
                                <div class="w-8 h-8 bg-gradient-to-r from-neon to-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-3">3</div>
                                <h3 class="text-xl font-bold text-white">Payment Method</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <label class="payment-option block p-6 rounded-xl">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="surjopay" class="w-5 h-5 text-neon bg-gray-800 border-gray-600 focus:ring-neon focus:ring-2">
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center">
                                                <img src="{{asset('surjo.jpeg')}}" alt="surjopay" class="w-9 h-9 rounded mr-2">
                                                <div>
                                                    <h4 class="text-white font-semibold text-lg">SurjoPay</h4>
                                                    <p class="text-gray-400 text-sm">Pay securely with card or mobile banking</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center mt-2 space-x-2">
                                                <img src="{{asset('visa.png')}}" alt="Visa" class="rounded">
                                                <img src="{{asset('mc.png')}}" alt="Mastercard" class="rounded">
                                                <img src="{{asset('bkash.png')}}" alt="bKash" class="rounded">
                                                <img src="{{asset('nagad.png')}}" alt="Nagad" class="rounded">
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                
                                <label class="payment-option block p-6 rounded-xl selected">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="cash_on_delivery" class="w-5 h-5 text-neon bg-gray-800 border-gray-600 focus:ring-neon focus:ring-2" checked>
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center">
                                                <i class="fas fa-money-bill-wave text-2xl text-green-500 mr-4"></i>
                                                <div>
                                                    <h4 class="text-white font-semibold text-lg">Cash on Delivery</h4>
                                                    <p class="text-gray-400 text-sm">Pay when you receive your order</p>
                                                </div>
                                            </div>
                                            <div class="bg-green-500/20 text-green-400 text-xs px-3 py-1 rounded-full inline-block mt-2">
                                                <i class="fas fa-shield-alt mr-1"></i>Most Popular
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn-checkout w-full px-8 py-4 rounded-xl text-white font-bold text-lg">
                            <i class="fas fa-lock mr-3"></i>
                            Place Order Securely
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="checkout-card p-4 sticky top-8">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                        <i class="fas fa-receipt mr-3 text-neon"></i>Order Summary
                    </h2>
                    
                    <div class="space-y-3 mb-6 max-h-64 overflow-y-auto">
                        @foreach($cartItems as $item)
                        <div class="order-item p-4">
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                    <img src="{{ $item->product->primary_image ? '/storage/' . $item->product->primary_image : 'https://via.placeholder.com/64x64/1e293b/ffffff?text=No+Image' }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-16 h-16 object-cover rounded-lg">
                                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-neon text-black text-xs font-bold rounded-full flex items-center justify-center">
                                        {{ $item->quantity }}
                                    </div>
                                </div>
                                
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-white text-sm truncate">{{ $item->product->name }}</h4>
                                    @if($item->variations->count() > 0)
                                        <div class="flex flex-wrap gap-1 mt-1">
                                            @foreach($item->variations as $variation)
                                                <span class="bg-neon/20 text-neon text-xs px-2 py-1 rounded-full">
                                                    {{ $variation->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="text-right">
                                    <p class="font-bold text-white">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                                    <p class="text-xs text-gray-400">${{ number_format($item->product->price, 2) }} each</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pricing Breakdown -->
                    <div class="border-t border-gray-700 pt-6 space-y-4">
                        <div class="flex justify-between text-gray-300">
                            <span class="flex items-center">
                                <i class="fas fa-shopping-bag mr-2 text-neon"></i>Subtotal:
                            </span>
                            <span class="font-semibold">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        
                        <div class="flex justify-between text-gray-300">
                            <span class="flex items-center">
                                <i class="fas fa-truck mr-2 text-neon"></i>Shipping:
                            </span>
                            <span class="font-semibold">
                                @if($shipping == 0)
                                    <span class="text-green-400">FREE</span>
                                @else
                                    ${{ number_format($shipping, 2) }}
                                @endif
                            </span>
                        </div>
                        
                        <div class="flex justify-between text-gray-300">
                            <span class="flex items-center">
                                <i class="fas fa-percent mr-2 text-neon"></i>Tax (10%):
                            </span>
                            <span class="font-semibold">${{ number_format($tax, 2) }}</span>
                        </div>
                        
                        @if($subtotal < 50)
                            <div class="bg-orange-500/20 text-orange-400 p-3 rounded-lg text-sm">
                                <i class="fas fa-info-circle mr-2"></i>
                                Add ${{ number_format(50 - $subtotal, 2) }} more for free shipping!
                            </div>
                        @endif
                        
                        <div class="flex justify-between text-2xl font-bold text-white pt-4 border-t border-gray-700">
                            <span class="flex items-center">
                                <i class="fas fa-tags mr-2 text-neon"></i>Total:
                            </span>
                            <span class="text-neon">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <!-- Security Badge -->
                    <div class="mt-6 p-4 bg-green-500/10 rounded-lg border border-green-500/20">
                        <div class="flex items-center text-green-400 text-sm">
                            <i class="fas fa-shield-alt mr-2"></i>
                            <span>Your payment information is secure and encrypted</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle payment method selection visual feedback
    const paymentOptions = document.querySelectorAll('.payment-option');
    const radioInputs = document.querySelectorAll('input[name="payment_method"]');
    
    radioInputs.forEach(radio => {
        radio.addEventListener('change', function() {
            paymentOptions.forEach(option => option.classList.remove('selected'));
            this.closest('.payment-option').classList.add('selected');
        });
    });
    
    // Use saved address functionality
    document.getElementById('useShippingAddr')?.addEventListener('click', function() {
        const shippingAddr = @json($shippingAddress);
        if (shippingAddr) {
            document.querySelector('textarea[name="address"]').value = shippingAddr;
            
            // Show feedback
            this.innerHTML = '<i class="fas fa-check mr-2"></i>Address Used';
            this.classList.add('bg-green-500/20', 'border-green-500', 'text-green-400');
            
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-copy mr-2"></i>Use Saved Address';
                this.classList.remove('bg-green-500/20', 'border-green-500', 'text-green-400');
            }, 2000);
        }
    });
    
    // Form submission handling
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Processing Order...';
        submitBtn.disabled = true;
    });
});
</script>
@endsection
