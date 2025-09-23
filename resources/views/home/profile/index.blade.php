@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-white mb-8">My Profile</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <div class="product-card neon-border p-6 text-center">
                    <div class="relative inline-block mb-4">
                        <img src="{{ $user->photo ? '/storage/' . $user->photo : asset('avata.png') }}" 
                             alt="{{ $user->name }}" 
                             class="w-32 h-32 rounded-full object-cover mx-auto">
                    </div>
                    <h2 class="text-xl font-bold text-white mb-2">{{ $user->name }}</h2>
                    <p class="text-gray-400 mb-4">{{ $user->email }}</p>
                    <p class="text-gray-400 mb-6">{{ $user->phone }}</p>
                    
                    <a href="{{ route('profile.edit') }}" class="btn-primary w-full text-white">
                        <i class="fas fa-edit mr-2"></i>Edit Profile 
                    </a>
                </div>
                
                <div class="product-card neon-border p-6 mt-6">
                    <h3 class="text-lg font-bold text-white mb-4">Quick Stats</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Total Orders:</span>
                            <span class="text-neon font-semibold">{{ $orders->count() }}+</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Member Since:</span>
                            <span class="text-white">{{ $user->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-2">
                <div class="product-card neon-border p-6 mb-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-white">Recent Orders</h3>
                        <a href="{{ route('profile.orders') }}" class="text-neon hover:text-neon/80">View All</a>
                    </div>
                    
                    @if($orders->count() > 0)
                        <div class="space-y-4">
                            @foreach($orders as $order)
                            <div class="bg-gray-800 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-white font-semibold">{{ $order->order_number }}</p>
                                        <p class="text-gray-400 text-sm">{{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-white font-bold">${{ number_format($order->total, 2) }}</p>
                                        <span class="px-2 py-1 rounded-full text-xs
                                            @if($order->order_status === 'pending') bg-yellow-500/20 text-yellow-400
                                            @elseif($order->order_status === 'processing') bg-blue-500/20 text-blue-400
                                            @elseif($order->order_status === 'shipped') bg-white text-green-400
                                            @else bg-green-500/20 text-green-400
                                            @endif">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-shopping-cart text-6xl text-gray-600 mb-4"></i>
                            <p class="text-gray-400">No orders yet</p>
                        </div>
                    @endif
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="product-card neon-border p-6">
                        <h3 class="text-lg font-bold text-white mb-4">Address Book</h3>
                        @if($customer && $customer->parmanent_addr)
                            <div class="mb-3">
                                <p class="text-gray-400 text-sm">Permanent Address:</p>
                                <p class="text-white">{{ $customer->permanent_addr }}</p>
                            </div>
                        @endif
                        @if($customer && $customer->shipping_addr)
                            <div>
                                <p class="text-gray-400 text-sm">Shipping Address:</p>
                                <p class="text-white">{{ $customer->shipping_addr }}</p>
                            </div>
                        @endif
                        @if(!$customer || (!$customer->parmanent_addr && !$customer->shipping_addr))
                            <p class="text-gray-400">No addresses saved</p>
                        @endif
                    </div>
                    
                    <div class="product-card neon-border p-6">
                        <h3 class="text-lg font-bold text-white mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('profile.orders') }}" class="block text-neon hover:text-neon/80">
                                <i class="fas fa-list mr-2"></i>View All Orders
                            </a>
                            <a href="#" class="block text-gray-400 hover:text-gray-300">
                                <i class="fas fa-heart mr-2"></i>Wishlist <small class="text-gray-500">(Time's Short, Can't Develop)</small>
                            </a>
                            <a href="#" class="block text-gray-400 hover:text-gray-300">
                                <i class="fas fa-star mr-2"></i>Reviews <small class="text-gray-500">(Time's Short, Can't Develop)</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
