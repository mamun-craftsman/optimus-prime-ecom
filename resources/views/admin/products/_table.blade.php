<div class="table-container" id="products-table">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-700">
                <th class="py-3 text-left text-gray-400">ID</th>
                <th class="py-3 text-left text-gray-400">Image</th>
                <th class="py-3 text-left text-gray-400">Name</th>
                <th class="py-3 text-left text-gray-400">Category</th>
                <th class="py-3 text-left text-gray-400">Stock</th>
                <th class="py-3 text-left text-gray-400">Price</th>
                <th class="py-3 text-left text-gray-400">Status</th>
                <th class="py-3 text-left text-gray-400">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr class="border-b border-gray-800 hover:bg-gray-800">
                    <td class="py-4 text-white">#{{ $product->id }}</td>
                    <td class="py-4">
                        <div class="w-12 h-12 rounded-lg overflow-hidden bg-gray-700 flex items-center justify-center">
                            @if($product->primary_image && file_exists(storage_path('app/public/' . $product->primary_image)))
                                <img src="{{ asset('storage/' . $product->primary_image) }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
                            @else
                                <i class="fas fa-image text-gray-400"></i>
                            @endif
                        </div>
                    </td>
                    <td class="py-4 text-gray-300">{{ $product->name }}</td>
                    <td class="py-4 text-gray-400">{{ $product->subcategory->name ?? 'N/A' }}</td>
                    <td class="py-4">
                        @if($product->stock == 0)
                            <span class="text-red-500">
                                <i class="fas fa-times-circle mr-1"></i> {{ $product->stock }}
                            </span>
                        @elseif($product->stock < 10)
                            <span class="text-yellow-500">
                                <i class="fas fa-exclamation-triangle mr-1"></i> {{ $product->stock }}
                            </span>
                        @else
                            <span class="text-green-500">
                                <i class="fas fa-check-circle mr-1"></i> {{ $product->stock }}
                            </span>
                        @endif
                    </td>
                    <td class="py-4 text-white">${{ number_format($product->price, 2) }}</td>
                    <td class="py-4">
                        @if($product->status == 'sell')
                            <span class="text-green-500">
                                <i class="fas fa-check-circle mr-1"></i> Sell
                            </span>
                        @else
                            <span class="text-gray-500">
                                <i class="fas fa-pause-circle mr-1"></i> Sold
                            </span>
                        @endif
                    </td>
                    <td class="py-4">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-neon hover:text-purple-400 mr-3">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="text-red-500 hover:text-red-400" onclick="deleteProduct({{ $product->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="py-8 text-center text-gray-400">No products found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="flex justify-between items-center mt-6">
    <p class="text-gray-400">Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products</p>
    <div class="flex space-x-2" id="pagination-links">
        {{ $products->appends(request()->query())->links('partials._pagination') }}
    </div>
</div>
