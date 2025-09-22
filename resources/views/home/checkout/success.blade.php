@extends('layouts.home')

@push('styles')
<style>
    .success-card {
        background: rgba(15, 23, 42, 0.9);
        border-radius: 24px;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(16, 185, 129, 0.3);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    }

    .success-icon {
        animation: success-bounce 0.8s ease-out;
    }

    @keyframes success-bounce {
        0% { transform: scale(0); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    .checkmark {
        animation: checkmark-draw 0.8s ease-out 0.3s both;
    }

    @keyframes checkmark-draw {
        0% { stroke-dasharray: 0 100; }
        100% { stroke-dasharray: 100 0; }
    }

    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        background: #00f7ff;
        animation: confetti-fall 3s linear infinite;
    }

    .confetti:nth-child(odd) {
        background: #8b5cf6;
        animation-delay: -0.5s;
    }

    .confetti:nth-child(3n) {
        background: #10b981;
        animation-delay: -1s;
    }

    @keyframes confetti-fall {
        0% {
            transform: translateY(-100vh) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) rotate(360deg);
            opacity: 0;
        }
    }

    .success-btn {
        background: linear-gradient(45deg, #00f7ff, #8b5cf6);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .success-btn:hover {
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
        border-color: #00f7ff;
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-16 relative overflow-hidden">
    <!-- Confetti Animation -->
    <div class="fixed inset-0 pointer-events-none">
        @for($i = 0; $i < 20; $i++)
        <div class="confetti" style="left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 3) }}s;"></div>
        @endfor
    </div>

    <div class="max-w-lg mx-auto">
        <div class="success-card p-12 text-center">
            <!-- Success Icon -->
            <div class="success-icon mb-8">
                <div class="w-32 h-32 bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path class="checkmark" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                    
                    <!-- Pulse rings -->
                    <div class="absolute inset-0 rounded-full border-4 border-green-400 animate-ping opacity-20"></div>
                    <div class="absolute inset-4 rounded-full border-2 border-green-300 animate-ping opacity-30 animation-delay-75"></div>
                </div>
            </div>

            <!-- Success Message -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-white mb-4">Order Successful!</h1>
                <p class="text-xl text-gray-300 mb-2">Thank you for your purchase</p>
                <p class="text-gray-400">Your order has been placed successfully and will be processed soon.</p>
            </div>

            <!-- Success Details -->
            @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/20 rounded-xl p-6 mb-8">
                <div class="flex items-center justify-center text-green-400 mb-2">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span class="font-semibold">Payment Confirmed</span>
                </div>
                <p class="text-green-300 text-sm">{{ session('success') }}</p>
            </div>
            @endif

            <!-- Next Steps -->
            <div class="bg-gray-800/50 rounded-xl p-6 mb-8">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center justify-center">
                    <i class="fas fa-clipboard-list mr-2 text-neon"></i>What's Next?
                </h3>
                
                <div class="space-y-3 text-left">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-neon text-black rounded-full flex items-center justify-center font-bold text-sm mr-3 mt-0.5 flex-shrink-0">1</div>
                        <div>
                            <p class="text-white font-medium">Order Confirmation</p>
                            <p class="text-gray-400 text-sm">You'll receive an email confirmation shortly</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-purple-500 text-white rounded-full flex items-center justify-center font-bold text-sm mr-3 mt-0.5 flex-shrink-0">2</div>
                        <div>
                            <p class="text-white font-medium">Order Processing</p>
                            <p class="text-gray-400 text-sm">We'll prepare your order for shipping</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-gray-600 text-white rounded-full flex items-center justify-center font-bold text-sm mr-3 mt-0.5 flex-shrink-0">3</div>
                        <div>
                            <p class="text-white font-medium">Delivery</p>
                            <p class="text-gray-400 text-sm">Your order will be delivered to your address</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-4">
                <a href="{{ route('home.index') }}" class="success-btn w-full block px-8 py-4 text-white font-bold text-lg rounded-xl">
                    <i class="fas fa-shopping-bag mr-3"></i>
                    Continue Shopping
                </a>
                
                <div class="grid grid-cols-2 gap-4">
                    <a href="#" class="secondary-btn px-6 py-3 text-white text-center font-semibold rounded-lg">
                        <i class="fas fa-receipt mr-2"></i>
                        Order Details
                    </a>
                    
                    <a href="#" class="secondary-btn px-6 py-3 text-white text-center font-semibold rounded-lg">
                        <i class="fas fa-download mr-2"></i>
                        Download Invoice
                    </a>
                </div>
            </div>

            <!-- Support Info -->
            <div class="mt-8 pt-6 border-t border-gray-700">
                <p class="text-gray-400 text-sm mb-2">Need help with your order?</p>
                <div class="flex justify-center space-x-4">
                    <a href="#" class="text-neon hover:text-neon/80 text-sm">
                        <i class="fas fa-phone mr-1"></i>Call Support
                    </a>
                    <a href="#" class="text-neon hover:text-neon/80 text-sm">
                        <i class="fas fa-envelope mr-1"></i>Email Us
                    </a>
                    <a href="#" class="text-neon hover:text-neon/80 text-sm">
                        <i class="fas fa-comments mr-1"></i>Live Chat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto redirect after 30 seconds
    let countdown = 30;
    const countdownElement = document.createElement('div');
    countdownElement.className = 'mt-4 text-gray-500 text-sm';
    countdownElement.innerHTML = `Redirecting to home in <span class="text-neon font-bold">${countdown}</span> seconds`;
    document.querySelector('.success-card').appendChild(countdownElement);
    
    const timer = setInterval(() => {
        countdown--;
        countdownElement.querySelector('span').textContent = countdown;
        
        if (countdown <= 0) {
            window.location.href = '{{ route("home.index") }}';
        }
    }, 1000);
    
    // Clear timer if user navigates away
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => clearInterval(timer));
    });
});
</script>
@endsection
