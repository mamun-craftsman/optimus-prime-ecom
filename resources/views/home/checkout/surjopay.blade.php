@extends('layouts.home')

@push('styles')
<style>
    .payment-card {
        background: rgba(15, 23, 42, 0.9);
        border-radius: 20px;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(0, 247, 255, 0.3);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    }

    .payment-icon {
        animation: pulse-glow 2s ease-in-out infinite alternate;
    }

    @keyframes pulse-glow {
        0% {
            transform: scale(1);
            box-shadow: 0 0 20px rgba(0, 247, 255, 0.3);
        }
        100% {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(0, 247, 255, 0.6);
        }
    }

    .processing-animation {
        position: relative;
        overflow: hidden;
    }

    .processing-animation::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        animation: loading 2s infinite;
    }

    @keyframes loading {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .payment-btn {
        background: linear-gradient(45deg, #10b981, #059669);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .payment-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.4);
    }

    .payment-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: all 0.6s;
    }

    .payment-btn:hover::before {
        left: 100%;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-lg mx-auto">
        <div class="payment-card p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="payment-icon w-24 h-24 bg-gradient-to-r from-neon to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-credit-card text-4xl text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">SurjoPay Payment</h1>
                <p class="text-gray-400">Secure payment gateway powered by SurjoPay</p>
            </div>

            <form action="https://sandbox.surjopay.com/api/payment" method="POST" id="surjopayForm">
                @foreach($surjoPayData as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                
                <!-- Payment Details -->
                <div class="bg-gray-800/50 rounded-xl p-6 mb-8">
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-neon"></i>Payment Details
                    </h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Amount:</span>
                            <span class="text-white font-semibold">৳{{ number_format($surjoPayData['amount'], 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Order ID:</span>
                            <span class="text-white font-mono text-sm">{{ $surjoPayData['order_id'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Customer:</span>
                            <span class="text-white">{{ $surjoPayData['customer_name'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Email:</span>
                            <span class="text-white">{{ $surjoPayData['customer_email'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="mb-8">
                    <h4 class="text-white font-semibold mb-4 flex items-center">
                        <i class="fas fa-credit-card mr-2 text-neon"></i>Supported Payment Methods
                    </h4>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-gray-800/50 rounded-lg p-3 flex items-center justify-center">
                            <img src="https://via.placeholder.com/60x35/00f7ff/ffffff?text=VISA" alt="Visa" class="rounded">
                        </div>
                        <div class="bg-gray-800/50 rounded-lg p-3 flex items-center justify-center">
                            <img src="https://via.placeholder.com/60x35/00f7ff/ffffff?text=MC" alt="Mastercard" class="rounded">
                        </div>
                        <div class="bg-gray-800/50 rounded-lg p-3 flex items-center justify-center">
                            <img src="https://via.placeholder.com/60x35/00f7ff/ffffff?text=bKash" alt="bKash" class="rounded">
                        </div>
                        <div class="bg-gray-800/50 rounded-lg p-3 flex items-center justify-center">
                            <img src="https://via.placeholder.com/60x35/00f7ff/ffffff?text=Nagad" alt="Nagad" class="rounded">
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="space-y-4">
                    <button type="submit" class="payment-btn w-full px-8 py-4 text-white font-bold text-lg rounded-xl">
                        <i class="fas fa-arrow-right mr-3"></i>
                        Proceed to Payment Gateway
                    </button>
                    
                    <a href="{{ route('checkout.index') }}" class="block w-full px-8 py-4 bg-gray-700 hover:bg-gray-600 text-white text-center font-semibold rounded-xl transition-all">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Checkout
                    </a>
                </div>
            </form>

            <!-- Security Note -->
            <div class="mt-8 p-4 bg-green-500/10 rounded-lg border border-green-500/20">
                <div class="flex items-start text-green-400 text-sm">
                    <i class="fas fa-shield-alt mr-2 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <p class="font-semibold mb-1">Secure Payment</p>
                        <p>Your payment is processed securely through SurjoPay's encrypted gateway. We do not store your card information.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('surjopayForm').addEventListener('submit', function(e) {
    const button = this.querySelector('button[type="submit"]');
    
    // Add loading animation
    button.classList.add('processing-animation');
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Redirecting to SurjoPay...';
    button.disabled = true;
    
    // Show processing message
    const card = document.querySelector('.payment-card');
    setTimeout(() => {
        const processingMsg = document.createElement('div');
        processingMsg.className = 'mt-4 p-4 bg-blue-500/10 rounded-lg border border-blue-500/20';
        processingMsg.innerHTML = `
            <div class="flex items-center text-blue-400 text-sm">
                <i class="fas fa-info-circle mr-2"></i>
                <span>Please wait while we redirect you to SurjoPay...</span>
            </div>
        `;
        card.appendChild(processingMsg);
    }, 1000);
});
</script>
@endsection
