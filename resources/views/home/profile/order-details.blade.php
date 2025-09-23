@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-white">Order Details</h1>
            <a href="{{ route('profile.orders') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Back to Orders
            </a>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="product-card neon-border p-6 mb-6">
                    <h2 class="text-xl font-bold text-white mb-4">Order Items</h2>
                    <div class="space-y-4">
                        @foreach($order->orderItems as $item)
                        <div class="bg-gray-800 rounded-lg p-4">
                            <div class="flex items-center gap-4">
                                <img src="{{ $item->product->primary_image ? '/storage/' . $item->product->primary_image : 'https://via.placeholder.com/80x80/1e293b/ffffff?text=No+Image' }}" 
                                     alt="{{ $item->product->name }}" 
                                     class="w-20 h-20 object-cover rounded-lg">
                                
                                <div class="flex-1">
                                    <h4 class="font-semibold text-white">{{ $item->product->name }}</h4>
                                    @inject('variationModel', 'App\Models\ProductVariation')

                                    @if($item->variations)
                                        <div class="flex flex-wrap gap-1 mt-1">
                                            @foreach(json_decode($item->variations, true) as $variationId)
                                                @php
                                                    $variation = $variationModel->find($variationId);
                                                @endphp
                                                <span class="bg-neon/20 text-neon text-xs px-2 py-1 rounded-full">
                                                    {{ $variation ? $variation->name : 'Variation #' . $variationId }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <p class="text-gray-400 text-sm mt-1">Quantity: {{ $item->quantity }}</p>
                                </div>
                                
                                <div class="text-right">
                                    <p class="text-white font-bold">${{ number_format($item->price * $item->quantity, 2) }}</p>
                                    <p class="text-gray-400 text-sm">${{ number_format($item->price, 2) }} each</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="product-card neon-border p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Shipping Information</h2>
                    <div>
                        <p class="text-gray-400 text-sm">Delivery Address:</p>
                        <p class="text-white">{{ $order->address }}</p>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-1">
                <div class="product-card neon-border p-6 mb-6">
                    <h2 class="text-xl font-bold text-white mb-4">Order Summary</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Order Number:</span>
                            <span class="text-white font-mono text-sm">{{ $order->order_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Order Date:</span>
                            <span class="text-white">{{ $order->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Status:</span>
                            <span class="px-2 py-1 rounded text-sm
                                @if($order->order_status === 'pending') bg-yellow-500/20 text-yellow-400
                                @elseif($order->order_status === 'processing') bg-blue-500/20 text-blue-400
                                @elseif($order->order_status === 'shipped') bg-purple-500/20 text-purple-400
                                @else bg-green-500/20 text-green-400
                                @endif">
                                {{ ucfirst($order->order_status) }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="product-card neon-border p-6 mb-6">
                    <h3 class="text-lg font-bold text-white mb-4">Payment Details</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Subtotal:</span>
                            <span class="text-white">${{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Shipping:</span>
                            <span class="text-white">
                                @if($order->shipping == 0)
                                    <span class="text-green-400">FREE</span>
                                @else
                                    ${{ number_format($order->shipping, 2) }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Tax:</span>
                            <span class="text-white">${{ number_format($order->tax, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-xl font-bold text-white pt-3 border-t border-gray-700">
                            <span>Total:</span>
                            <span class="text-neon">${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="product-card neon-border p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Payment Information</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Method:</span>
                            <span class="text-white">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Status:</span>
                            <span class="px-2 py-1 rounded text-sm
                                @if($order->payment_status === 'pending') bg-yellow-500/20 text-yellow-400
                                @elseif($order->payment_status === 'paid') bg-green-500/20 text-green-400
                                @else bg-red-500/20 text-red-400
                                @endif">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                        @if($order->transaction_id)
                        <div class="flex justify-between">
                            <span class="text-gray-400">Transaction ID:</span>
                            <span class="text-white font-mono text-sm">{{ $order->transaction_id }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
