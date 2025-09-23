@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-white">My Orders</h1>
            <a href="{{ route('profile.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Back to Profile
            </a>
        </div>
        
        @if($orders->count() > 0)
            <div class="space-y-4">
                @foreach($orders as $order)
                <div class="product-card neon-border p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-white">{{ $order->order_number }}</h3>
                            <p class="text-gray-400">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-bold text-white">${{ number_format($order->total, 2) }}</p>
                            <span class="px-3 py-1 rounded-full text-sm
                                @if($order->order_status === 'pending') bg-yellow-500/20 text-yellow-400
                                @elseif($order->order_status === 'processing') bg-blue-500/20 text-blue-400
                                @elseif($order->order_status === 'shipped') bg-purple-500/20 text-purple-400
                                @else bg-green-500/20 text-green-400
                                @endif">
                                {{ ucfirst($order->order_status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-gray-400 text-sm">Payment Method:</p>
                            <p class="text-white">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Payment Status:</p>
                            <span class="px-2 py-1 rounded text-sm
                                @if($order->payment_status === 'pending') bg-yellow-500/20 text-yellow-400
                                @elseif($order->payment_status === 'paid') bg-green-500/20 text-green-400
                                @else bg-red-500/20 text-red-400
                                @endif">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-gray-400 text-sm">Shipping Address:</p>
                        <p class="text-white">{{ $order->address }}</p>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-400">
                            <i class="fas fa-box mr-1"></i>{{ $order->orderItems->count() }} item(s)
                        </div>
                        <a href="{{ route('profile.order.details', $order->id) }}" class="text-neon hover:text-neon/80">
                            View Details <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <div class="product-card neon-border p-12 text-center">
                <i class="fas fa-shopping-cart text-6xl text-gray-600 mb-4"></i>
                <h3 class="text-xl text-white mb-2">No Orders Yet</h3>
                <p class="text-gray-400 mb-6">You haven't placed any orders yet</p>
                <a href="{{ route('home') }}" class="btn-primary">
                    <i class="fas fa-shopping-bag mr-2"></i>Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
