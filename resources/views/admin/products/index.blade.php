@extends('layouts.admin')
@section('content')
	<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h2 class="text-3xl font-bold section-title text-white mb-2 glow-text">PRODUCT MANAGEMENT</h2>
        <p class="text-gray-400">Manage all products in your inventory</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="admin-card neon-border p-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-400">Total Products</p>
                    <p class="text-3xl font-bold text-white">{{ $totalProducts ?? 0 }}</p>
                </div>
                <div class="text-3xl text-neon">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
        </div>
        
        <div class="admin-card neon-border p-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-400">Low Stock (<10)</p>
                    <p class="text-3xl font-bold text-white">{{ $lowStock ?? 0 }}</p>
                </div>
                <div class="text-3xl text-yellow-500">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
        </div>
        
        <div class="admin-card neon-border p-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-400">Out of Stock</p>
                    <p class="text-3xl font-bold text-white">{{ $outOfStock ?? 0 }}</p>
                </div>
                <div class="text-3xl text-red-500">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
        </div>
        
        <div class="admin-card neon-border p-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-400">Categories</p>
                    <p class="text-3xl font-bold text-white">{{ $totalCategories ?? 0 }}</p>
                </div>
                <div class="text-3xl text-purple-500">
                    <i class="fas fa-tags"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="admin-card neon-border p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h3 class="text-xl font-bold text-white mb-4 md:mb-0">Product List</h3>
            <div class="flex space-x-3">
                <div class="relative">
                    <input type="text" id="search-input" placeholder="Search products..." class="input-field px-4 py-2 rounded-lg text-white focus:outline-none pl-10">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <button class="btn-primary px-4 py-2 rounded-lg text-white" onclick="#createRoute">
                    <i class="fas fa-plus mr-2"></i> Add Product
                </button>
            </div>
        </div>
        
        <div id="table-loader" class="hidden flex justify-center items-center py-12">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-neon"></div>
        </div>

        <div id="table-content">
            @include('admin.products._table', ['products' => $products])
        </div>
    </div>
</div>

@endsection
@push('scripts')
	
@endpush