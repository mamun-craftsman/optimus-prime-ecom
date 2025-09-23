@extends('layouts.admin')

@section('title', 'Customer Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center text-neon hover:text-cyan-300 transition">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Customers
        </a>
    </div>

    <div class="admin-card neon-border p-8 mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:space-x-8">
            <div class="flex-shrink-0 mb-6 md:mb-0">
                <img class="h-32 w-32 rounded-full object-cover mx-auto md:mx-0" 
                     src="{{ $customer->photo_url }}" 
                     alt="{{ $customer->name }}">
            </div>
            
            <div class="flex-grow text-center md:text-left">
                <h1 class="text-3xl font-bold text-white mb-2">{{ $customer->name }}</h1>
                <p class="text-gray-400 text-lg mb-4">{{'@'.$customer->username }}</p>
                
                <div class="flex flex-wrap justify-center md:justify-start gap-4 mb-6">
                    <span class="px-3 py-1 text-sm rounded-full 
                        @if($customer->status === 'active') bg-green-900/50 text-green-300
                        @elseif($customer->status === 'inactive') bg-red-900/50 text-red-300
                        @else bg-yellow-900/50 text-yellow-300 @endif">
                        {{ ucfirst($customer->status) }}
                    </span>
                    <span class="px-3 py-1 bg-blue-900/50 text-blue-300 text-sm rounded-full">
                        {{ ucfirst($customer->role) }}
                    </span>
                </div>
                
                <div class="flex flex-wrap justify-center md:justify-start gap-6 text-sm text-gray-300">
                    <div class="flex items-center">
                        <i class="fas fa-envelope mr-2 text-neon"></i>
                        {{ $customer->email }}
                    </div>
                    @if($customer->phone)
                    <div class="flex items-center">
                        <i class="fas fa-phone mr-2 text-neon"></i>
                        {{ $customer->phone }}
                    </div>
                    @endif
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt mr-2 text-neon"></i>
                        Member {{ $customerStats['member_since'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="admin-card neon-border p-6 text-center">
            <i class="fas fa-star text-3xl text-yellow-500 mb-3"></i>
            <p class="text-2xl font-bold text-white">{{ $customerStats['reviews_count'] }}</p>
            <p class="text-gray-400">Reviews Given</p>
        </div>
        
        <div class="admin-card neon-border p-6 text-center">
            <i class="fas fa-heart text-3xl text-red-500 mb-3"></i>
            <p class="text-2xl font-bold text-white">{{ $customerStats['wishlists_count'] }}</p>
            <p class="text-gray-400">Wishlist Items</p>
        </div>
        
        <div class="admin-card neon-border p-6 text-center">
            <i class="fas fa-shopping-cart text-3xl text-green-500 mb-3"></i>
            <p class="text-2xl font-bold text-white">{{ $customerStats['carts_count'] }}</p>
            <p class="text-gray-400">Cart Items</p>
        </div>
        
        <div class="admin-card neon-border p-6 text-center">
            <i class="fas fa-clock text-3xl text-blue-500 mb-3"></i>
            <p class="text-sm font-bold text-white">{{ $customerStats['last_seen'] }}</p>
            <p class="text-gray-400">Last Activity</p>
        </div>
    </div>

    <!-- Customer Details -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Basic Information -->
        <div class="admin-card neon-border p-6">
            <h3 class="text-xl font-bold text-white mb-6">Basic Information</h3>
            
            <div class="space-y-4">
                <div class="grid grid-cols-3 gap-4">
                    <span class="text-gray-400">Full Name:</span>
                    <span class="col-span-2 text-white">{{ $customer->name }}</span>
                </div>
                
                <div class="grid grid-cols-3 gap-4">
                    <span class="text-gray-400">Username:</span>
                    <span class="col-span-2 text-white">{{ $customer->username }}</span>
                </div>
                
                <div class="grid grid-cols-3 gap-4">
                    <span class="text-gray-400">Email:</span>
                    <span class="col-span-2 text-white">{{ $customer->email }}</span>
                </div>
                
                @if($customer->phone)
                <div class="grid grid-cols-3 gap-4">
                    <span class="text-gray-400">Phone:</span>
                    <span class="col-span-2 text-white">{{ $customer->phone }}</span>
                </div>
                @endif
                
                <div class="grid grid-cols-3 gap-4">
                    <span class="text-gray-400">Status:</span>
                    <span class="col-span-2">
                        <span class="px-2 py-1 text-xs rounded-full 
                            @if($customer->status === 'active') bg-green-900/50 text-green-300
                            @elseif($customer->status === 'inactive') bg-red-900/50 text-red-300
                            @else bg-yellow-900/50 text-yellow-300 @endif">
                            {{ ucfirst($customer->status) }}
                        </span>
                    </span>
                </div>
                
                <div class="grid grid-cols-3 gap-4">
                    <span class="text-gray-400">Joined:</span>
                    <span class="col-span-2 text-white">{{ $customer->created_at->format('F j, Y \a\t g:i A') }}</span>
                </div>
            </div>
        </div>

        <!-- Address Information -->
        <div class="admin-card neon-border p-6">
            <h3 class="text-xl font-bold text-white mb-6">Address Information</h3>
            
            @if($customer->customer)
                <div class="space-y-4">
                    @if($customer->customer->permanent_addr)
                    <div>
                        <span class="text-gray-400 block mb-2">Permanent Address:</span>
                        <div class="text-white bg-gray-800/50 p-3 rounded-lg">
                            {{ $customer->customer->permanent_addr }}
                        </div>
                    </div>
                    @endif
                    
                    @if($customer->customer->shipping_addr)
                    <div>
                        <span class="text-gray-400 block mb-2">Shipping Address:</span>
                        <div class="text-white bg-gray-800/50 p-3 rounded-lg">
                            {{ $customer->customer->shipping_addr }}
                        </div>
                    </div>
                    @endif
                    
                    @if(!$customer->customer->permanent_addr && !$customer->customer->shipping_addr)
                    <div class="text-center py-8 text-gray-400">
                        <i class="fas fa-map-marker-alt text-3xl mb-3"></i>
                        <p>No address information available</p>
                    </div>
                    @endif
                </div>
            @else
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-map-marker-alt text-3xl mb-3"></i>
                    <p>No customer profile created yet</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-center space-x-4 mt-8">
        <button onclick="changeStatus({{ $customer->id }})" 
                class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg hover:from-blue-700 hover:to-purple-700 transition">
            <i class="fas fa-edit mr-2"></i>
            Change Status
        </button>
        
        <button onclick="deleteCustomer({{ $customer->id }})" 
                class="px-6 py-2 bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-lg hover:from-red-700 hover:to-pink-700 transition">
            <i class="fas fa-trash mr-2"></i>
            Delete Customer
        </button>
    </div>
</div>

@endsection
