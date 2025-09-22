@extends('layouts.home')

@push('styles')
<style>
    .cancel-card {
        background: rgba(15, 23, 42, 0.9);
        border-radius: 24px;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(239, 68, 68, 0.3);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    }

    .cancel-icon {
        animation: shake 0.8s ease-in-out;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }

    .retry-btn {
        background: linear-gradient(45deg, #00f7ff, #8b5cf6);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .retry-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 40px rgba(0, 247, 255, 0.3);
    }

    .secondary-btn {
        background: rgba(107, 114, 128, 0.8);
        border: 1px solid rgba(156, 163, 175, 0.3);
        transition: all 0.3s ease;
    }

    .secondary-btn:hover {
        background: rgba(107, 114, 128, 1);
        border-color: #ef4444;
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-lg mx-auto">
        <div class="cancel-card p-12 text-center">
            <!-- Cancel Icon -->
            <div class="cancel-icon mb-8">
                <div class="w-32 h-32 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                    <i class="fas fa-times text-6xl text-white"></i>
                    
                    <!-- Pulse rings -->
                    <div class="absolute inset-0 rounded-full border-4 border-red-400 animate-ping opacity-20"></div>
                    <div class="absolute inset-4 rounded-full border-2 border-red-300 animate-ping opacity-30 animation-delay-75"></div>
                </div>
            </div>

            <!-- Cancel Message -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-white mb-4">Payment Cancelled</h1>
                <p class="text-xl text-gray-300 mb-2">Your order was not completed</p>
                <p class="text-gray-400">Don't worry, your cart items are still saved and ready for checkout.</p>
            </div>

            <!-- Error Details -->
            @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/20 rounded-xl p-6 mb-8">
                <div class="flex items-center justify-center text-red-400 mb-2">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <span class="font-semibold">Payment Issue</span>
                </div>
                <p class="text-red-300 text-sm">{{ session('error') }}</p>
            </div>
            @endif

            <!-- Common Reasons -->
            <div class="bg-gray-800/50 rounded-xl p-6 mb-8">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center justify-center">
                    <i class="fas fa-info-circle mr-2 text-yellow-500"></i>Common Reasons
                </h3>
                
                <div class="space-y-3 text-left">
                    <div class="flex items-start">
                        <i class="fas fa-circle text-yellow-500 text-xs mt-2 mr-3 flex-shrink-0"></i>
                        <div>
                            <p class="text-white text-sm">Payment gateway timeout</p>
                            <p class="text-gray-400 text-xs">The payment took too long to process</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <i class="fas fa-circle text-yellow-500 text-xs mt-2 mr-3 flex-shrink-0"></i>
                        <div>
                            <p class="text-white text-sm">Insufficient funds or declined card</p>
                            <p class="text-gray-400 text-xs">Check your payment method and try again</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <i class="fas fa-circle text-yellow-500 text-xs mt-2 mr-3 flex-shrink-0"></i>
                        <div>
                            <p class="text-white text-sm">Cancelled by user</p>
                            <p class="text-gray-400 text-xs">You chose to cancel the payment</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <i class="fas fa-circle text-yellow-500 text-xs mt-2 mr-3 flex-shrink-0"></i>
                        <div>
                            <p class="text-white text-sm">Network connectivity issues</p>
                            <p class="text-gray-400 text-xs">Internet connection was unstable</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-4">
                <a href="{{ route('checkout.index') }}" class="retry-btn w-full block px-8 py-4 text-white font-bold text-lg rounded-xl">
                    <i class="fas fa-redo mr-3"></i>
                    Try Payment Again
                </a>
                
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('cart.index') }}" class="secondary-btn px-6 py-3 text-white text-center font-semibold rounded-lg">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        View Cart
                    </a>
                    
                    <a href="{{ route('home.index') }}" class="secondary-btn px-6 py-3 text-white text-center font-semibold rounded-lg">
                        <i class="fas fa-home mr-2"></i>
                        Go Home
                    </a>
                </div>
            </div>

            <!-- Alternative Payment Methods -->
            <div class="mt-8 pt-6 border-t border-gray-700">
                <h4 class="text-white font-semibold mb-4">Try Different Payment Method</h4>
                <div class="flex justify-center space-x-4">
                    <button class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg text-white text-sm transition-all">
                        <i class="fas fa-money-bill mr-2"></i>Cash on Delivery
                    </button>
                    <button class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-white text-sm transition-all">
                        <i class="fas fa-credit-card mr-2"></i>Different Card
                    </button>
                </div>
            </div>

            <!-- Support Info -->
            <div class="mt-8 pt-6 border-t border-gray-700">
                <p class="text-gray-400 text-sm mb-2">Still having trouble?</p>
                <div class="flex justify-center space-x-4">
                    <a href="#" class="text-red-400 hover:text-red-300 text-sm">
                        <i class="fas fa-phone mr-1"></i>Call Support
                    </a>
                    <a href="#" class="text-red-400 hover:text-red-300 text-sm">
                        <i class="fas fa-envelope mr-1"></i>Email Us
                    </a>
                    <a href="#" class="text-red-400 hover:text-red-300 text-sm">
                        <i class="fas fa-comments mr-1"></i>Live Chat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let countdown = 60;
    const countdownElement = document.createElement('div');
    countdownElement.className = 'mt-4 text-gray-500 text-sm';
    countdownElement.innerHTML = `Redirecting to cart in <span class="text-red-400 font-bold">${countdown}</span> seconds`;
    document.querySelector('.cancel-card').appendChild(countdownElement);
    
    const timer = setInterval(() => {
        countdown--;
        countdownElement.querySelector('span').textContent = countdown;
        
        if (countdown <= 0) {
            window.location.href = '{{ route("cart.index") }}';
        }
    }, 1000);
    
    document.querySelectorAll('a, button').forEach(element => {
        element.addEventListener('click', () => clearInterval(timer));
    });
});
</script>
@endsection
