@extends('layouts.admin')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold section-title text-white mb-2 glow-text">PRODUCT DETAILS & EDIT</h2>
                <p class="text-gray-400">Manage and view complete product information</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.products.index') }}" class="btn-secondary px-4 py-2 rounded-lg text-white">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Products
                </a>
                <button id="editModeToggle" class="btn-primary px-4 py-2 rounded-lg text-white">
                    <i class="fas fa-edit mr-2"></i> <span id="editModeText">Edit Mode</span>
                </button>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" id="productForm">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Product Images Section -->
            <div class="lg:col-span-1">
                <!-- Primary Image Display -->
                <div class="admin-card neon-border p-6 mb-6">
                    <h3 class="text-xl font-bold text-white mb-4">Product Images</h3>
                    
                    <!-- Primary Image Display -->
                    <div class="mb-6">
                        <div class="relative aspect-[1/1] rounded-lg overflow-hidden bg-gray-800">
                            <img id="mainProductImage" 
                                 src="{{ $product->primary_image ? asset('storage/' . $product->primary_image) : 'https://via.placeholder.com/400x400/374151/9CA3AF?text=No+Image' }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover">
                            <div class="absolute top-3 right-3 bg-black/50 rounded-lg px-2 py-1">
                                <span class="text-white text-sm font-medium">Primary</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image Thumbnails -->
                    <div class="grid grid-cols-3 gap-2 mb-4" id="imageThumbnails">
                        <div class="aspect-[1/1] rounded-lg overflow-hidden bg-gray-700 cursor-pointer border-2 border-neon" onclick="changeMainImage('{{ asset('storage/' . $product->primary_image) }}')">
                            <img src="{{ $product->primary_image ? asset('storage/' . $product->primary_image) : 'https://via.placeholder.com/120x120/374151/9CA3AF?text=Primary' }}" 
                                 alt="Primary" class="w-full h-full object-cover">
                        </div>
                        @if($product->secondary_images)
                            @foreach($product->secondary_images as $index => $image)
                                <div class="aspect-[1/1] rounded-lg overflow-hidden bg-gray-700 cursor-pointer border-2 border-gray-600 hover:border-neon transition-colors" 
                                     onclick="changeMainImage('{{ asset('storage/' . $image) }}')">
                                    <img src="{{ asset('storage/' . $image) }}" 
                                         alt="Image {{ $index + 2 }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    
                    <!-- Edit Mode Image Upload -->
                    <div class="edit-mode hidden">
                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Primary Image</label>
                            <input type="file" name="primary_image" id="primaryImageEdit" accept="image/*" class="input-field w-full px-3 py-2 rounded-lg text-white">
                            <p class="text-gray-500 text-xs mt-1">Leave empty to keep current image</p>
                        </div>
                        
                        <div>
                            <label class="block text-gray-300 mb-2">Secondary Images</label>
                            <input type="file" name="secondary_images[]" accept="image/*" multiple class="input-field w-full px-3 py-2 rounded-lg text-white">
                            <p class="text-gray-500 text-xs mt-1">Leave empty to keep current images</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="admin-card neon-border p-6">
                    <h4 class="text-lg font-bold text-white mb-4">Quick Stats</h4>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Status</span>
                            <span class="px-2 py-1 rounded text-xs font-medium {{ $product->status == 'sell' ? 'bg-green-500/20 text-green-400' : 'bg-gray-500/20 text-gray-400' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Stock Level</span>
                            <span class="text-white font-medium 
                                {{ $product->stock == 0 ? 'text-red-400' : ($product->stock < 10 ? 'text-yellow-400' : 'text-green-400') }}">
                                {{ $product->stock }} units
                            </span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Price</span>
                            <span class="text-white font-bold text-lg">${{ number_format($product->price, 2) }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Variations</span>
                            <span class="text-neon font-medium">{{ $product->variations->count() }} variants</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Category</span>
                            <span class="text-gray-300 text-sm">{{ $product->subcategory->name }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Created</span>
                            <span class="text-gray-300 text-sm">{{ $product->created_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Basic Information -->
                <div class="admin-card neon-border p-6 mb-6">
                    <h3 class="text-xl font-bold text-white mb-6">Basic Information</h3>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-300 mb-2">Product Name</label>
                            <div class="view-mode">
                                <p class="text-white font-medium text-lg">{{ $product->name }}</p>
                            </div>
                            <div class="edit-mode hidden">
                                <input type="text" name="name" value="{{ $product->name }}" 
                                       class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none" required>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-gray-300 mb-2">Slug</label>
                            <div class="view-mode">
                                <p class="text-gray-400">{{ $product->slug }}</p>
                            </div>
                            <div class="edit-mode hidden">
                                <input type="text" name="slug" value="{{ $product->slug }}" 
                                       class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-gray-300 mb-2">Category</label>
                            <div class="view-mode">
                                <p class="text-white">{{ $product->category->name ?? 'N/A' }}</p>
                                <p class="text-gray-400 text-sm">{{ $product->subcategory->name ?? 'N/A' }}</p>
                            </div>
                            <div class="edit-mode hidden">
                                <select name="category_id" id="categorySelectEdit" class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none mb-3" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="subcategory_id" id="subcategorySelectEdit" class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none" required>
                                    @foreach($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-gray-300 mb-2">Video URL</label>
                            <div class="view-mode">
                                @if($product->video_url)
                                    <a href="{{ $product->video_url }}" target="_blank" class="text-neon hover:text-purple-400">
                                        <i class="fas fa-play-circle mr-2"></i> View Video
                                    </a>
                                @else
                                    <p class="text-gray-500">No video</p>
                                @endif
                            </div>
                            <div class="edit-mode hidden">
                                <input type="url" name="video_url" value="{{ $product->video_url }}" 
                                       class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none" 
                                       placeholder="https://youtube.com/...">
                            </div>
                        </div>
                        
                        <div class="lg:col-span-2 grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-gray-300 mb-2">Price</label>
                                <div class="view-mode">
                                    <p class="text-white text-2xl font-bold">${{ number_format($product->price, 2) }}</p>
                                </div>
                                <div class="edit-mode hidden">
                                    <input type="number" name="price" value="{{ $product->price }}" step="0.01" min="0"
                                           class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none" required>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-300 mb-2">Stock</label>
                                <div class="view-mode">
                                    <p class="text-white text-xl font-semibold 
                                        {{ $product->stock == 0 ? 'text-red-400' : ($product->stock < 10 ? 'text-yellow-400' : 'text-green-400') }}">
                                        {{ $product->stock }} units
                                    </p>
                                </div>
                                <div class="edit-mode hidden">
                                    <input type="number" name="stock" value="{{ $product->stock }}" min="0"
                                           class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none" required>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-300 mb-2">Status</label>
                                <div class="view-mode">
                                    <span class="px-3 py-2 rounded-lg font-medium {{ $product->status == 'sell' ? 'bg-green-500/20 text-green-400' : 'bg-gray-500/20 text-gray-400' }}">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </div>
                                <div class="edit-mode hidden">
                                    <select name="status" class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none" required>
                                        <option value="sell" {{ $product->status == 'sell' ? 'selected' : '' }}>Sell</option>
                                        <option value="sold" {{ $product->status == 'sold' ? 'selected' : '' }}>Sold</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features & Description -->
                <div class="admin-card neon-border p-6 mb-6">
                    <h3 class="text-xl font-bold text-white mb-6">Product Details</h3>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-300 mb-3">Key Features (Left)</label>
                            <div class="view-mode">
                                <div class="bg-gray-800 rounded-lg p-4 prose prose-invert prose-sm max-w-none">
                                    {!! $product->key_feature_left !!}
                                </div>
                            </div>
                            <div class="edit-mode hidden">
                                <textarea name="key_feature_left" class="tinymce-editor">{{ $product->key_feature_left }}</textarea>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-gray-300 mb-3">Key Features (Right)</label>
                            <div class="view-mode">
                                <div class="bg-gray-800 rounded-lg p-4 prose prose-invert prose-sm max-w-none">
                                    {!! $product->key_feature_right !!}
                                </div>
                            </div>
                            <div class="edit-mode hidden">
                                <textarea name="key_feature_right" class="tinymce-editor">{{ $product->key_feature_right }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-300 mb-3">Product Description</label>
                        <div class="view-mode">
                            <div class="bg-gray-800 rounded-lg p-6 prose prose-invert max-w-none">
                                {!! $product->description !!}
                            </div>
                        </div>
                        <div class="edit-mode hidden">
                            <textarea name="description" class="tinymce-editor">{{ $product->description }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Product Variations -->
                @if($product->variations->count() > 0)
                <div class="admin-card neon-border p-6 mb-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-white">Product Variations</h3>
                        <div class="edit-mode hidden">
                            <button type="button" onclick="saveAllVariations()" class="btn-primary px-4 py-2 rounded-lg text-white text-sm">
                                <i class="fas fa-save mr-2"></i> Save All Variations
                            </button>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full" id="variationsTable">
                            <thead>
                                <tr class="border-b border-gray-700">
                                    <th class="text-left py-3 text-gray-400 w-1/4">Name</th>
                                    <th class="text-left py-3 text-gray-400 w-1/4">Attributes</th>
                                    <th class="text-left py-3 text-gray-400 w-1/6">Price</th>
                                    <th class="text-left py-3 text-gray-400 w-1/6">Stock</th>
                                    <th class="text-left py-3 text-gray-400 w-1/6">Status</th>
                                    <th class="text-left py-3 text-gray-400 edit-mode hidden w-1/12">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productVariations as $variation)
                                <tr class="border-b border-gray-800 variation-row" data-variation-id="{{ $variation->id }}">
                                    <td class="py-4">
                                        <div class="view-mode">
                                            <span class="text-white font-medium">{{ $variation->name }}</span>
                                        </div>
                                        <div class="edit-mode hidden">
                                            <input type="text" value="{{ $variation->name }}" 
                                                   class="input-field w-full px-2 py-1 rounded text-white text-sm variation-name" 
                                                   data-field="name" data-variation-id="{{ $variation->id }}">
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($variation->attributeValues as $attributeValue)
                                                <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">
                                                    {{ $attributeValue->attribute->name }}: {{ $attributeValue->value }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <div class="view-mode">
                                            <span class="text-white font-medium">${{ number_format($variation->price, 2) }}</span>
                                        </div>
                                        <div class="edit-mode hidden">
                                            <input type="number" value="{{ $variation->price }}" step="0.01" min="0"
                                                   class="input-field w-full px-2 py-1 rounded text-white text-sm variation-price" 
                                                   data-field="price" data-variation-id="{{ $variation->id }}">
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <div class="view-mode">
                                            <span class="font-medium {{ $variation->stock == 0 ? 'text-red-400' : ($variation->stock < 10 ? 'text-yellow-400' : 'text-green-400') }}">
                                                {{ $variation->stock }}
                                            </span>
                                        </div>
                                        <div class="edit-mode hidden">
                                            <input type="number" value="{{ $variation->stock }}" min="0"
                                                   class="input-field w-full px-2 py-1 rounded text-white text-sm variation-stock" 
                                                   data-field="stock" data-variation-id="{{ $variation->id }}">
                                        </div>
                                    </td>
                                    <td class="py-4">
                                        <div class="view-mode">
                                            <span class="px-2 py-1 rounded text-xs font-medium {{ $variation->status == 'sell' ? 'bg-green-500/20 text-green-400' : 'bg-gray-500/20 text-gray-400' }}">
                                                {{ ucfirst($variation->status) }}
                                            </span>
                                        </div>
                                        <div class="edit-mode hidden">
                                            <select class="input-field w-full px-2 py-1 rounded text-white text-sm variation-status" 
                                                    data-field="status" data-variation-id="{{ $variation->id }}">
                                                <option value="sell" {{ $variation->status == 'sell' ? 'selected' : '' }}>Sell</option>
                                                <option value="sold" {{ $variation->status == 'sold' ? 'selected' : '' }}>Sold</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="py-4 edit-mode hidden">
                                        <button type="button" onclick="saveVariation({{ $variation->id }})" 
                                                class="text-green-400 hover:text-green-300 mr-2" 
                                                title="Save Variation">
                                            <i class="fas fa-save"></i>
                                        </button>
                                        <button type="button" onclick="deleteVariation({{ $variation->id }})" 
                                                class="text-red-400 hover:text-red-300" 
                                                title="Delete Variation">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex justify-between items-center">
                    <div class="edit-mode hidden">
                        <button type="button" onclick="cancelEdit()" class="btn-secondary px-6 py-3 rounded-lg text-white">
                            <i class="fas fa-times mr-2"></i> Cancel
                        </button>
                    </div>
                    
                    <div class="edit-mode hidden ml-auto">
                        <button type="submit" class="btn-primary px-6 py-3 rounded-lg text-white font-bold" id="updateBtn">
                            <i class="fas fa-save mr-2"></i> Update Product
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<style>
    .tox-menubar, .tox-promotion, .tox-statusbar__right-container {
        display: none !important;
    }
    
    .prose h1, .prose h2, .prose h3 { color: #fff; }
    .prose p { color: #d1d5db; }
    .prose ul li { color: #d1d5db; }
    .prose strong { color: #fff; }
    
    .edit-mode.show { display: block !important; }
    .view-mode.hide { display: none !important; }
    
    .variation-row.editing {
        background-color: rgba(59, 130, 246, 0.1);
        border-left: 3px solid #3b82f6;
    }
</style>
@endpush

@push('scripts')
<script>
let editMode = false;
let tinyMCEInstances = [];

function toggleEditMode() {
    editMode = !editMode;
    
    const editElements = document.querySelectorAll('.edit-mode');
    const viewElements = document.querySelectorAll('.view-mode');
    const editModeText = document.getElementById('editModeText');
    const editModeToggle = document.getElementById('editModeToggle');
    
    if (editMode) {
        editElements.forEach(el => el.classList.remove('hidden'));
        viewElements.forEach(el => el.classList.add('hidden'));
        editModeText.textContent = 'View Mode';
        editModeToggle.innerHTML = '<i class="fas fa-eye mr-2"></i> View Mode';
        initTinyMCE();
    } else {
        editElements.forEach(el => el.classList.add('hidden'));
        viewElements.forEach(el => el.classList.remove('hidden'));
        editModeText.textContent = 'Edit Mode';
        editModeToggle.innerHTML = '<i class="fas fa-edit mr-2"></i> Edit Mode';
        destroyTinyMCE();
    }
}

function initTinyMCE() {
    tinymce.init({
        selector: '.tinymce-editor',
        height: 300,
        plugins: 'lists link code',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link | code',
        theme: 'silver',
        skin: 'oxide-dark',
        content_css: 'dark'
    });
}

function destroyTinyMCE() {
    tinymce.remove('.tinymce-editor');
}

function cancelEdit() {
    if (confirm('Are you sure? All unsaved changes will be lost.')) {
        location.reload();
    }
}

function changeMainImage(src) {
    document.getElementById('mainProductImage').src = src;
    
    document.querySelectorAll('#imageThumbnails > div').forEach(thumb => {
        thumb.classList.remove('border-neon');
        thumb.classList.add('border-gray-600');
    });
    
    event.currentTarget.classList.remove('border-gray-600');
    event.currentTarget.classList.add('border-neon');
}

async function saveVariation(variationId) {
    const row = document.querySelector(`[data-variation-id="${variationId}"]`);
    const name = row.querySelector('.variation-name').value;
    const price = row.querySelector('.variation-price').value;
    const stock = row.querySelector('.variation-stock').value;
    const status = row.querySelector('.variation-status').value;
    
    try {
        const response = await fetch(`/admin/products/{{ $product->id }}/variations/${variationId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: name,
                price: price,
                stock: stock,
                status: status
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            row.classList.add('editing');
            setTimeout(() => {
                row.classList.remove('editing');
            }, 1000);
            
            showNotification('Variation updated successfully', 'success');
            
            updateVariationDisplay(row, {name, price, stock, status});
        } else {
            throw new Error(result.message || 'Failed to update variation');
        }
    } catch (error) {
        console.error('Error updating variation:', error);
        showNotification('Error updating variation: ' + error.message, 'error');
    }
}

async function deleteVariation(variationId) {
    if (!confirm('Are you sure you want to delete this variation?')) return;
    
    try {
        const response = await fetch(`/admin/products/{{ $product->id }}/variations/${variationId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                'Accept': 'application/json'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            document.querySelector(`[data-variation-id="${variationId}"]`).remove();
            showNotification('Variation deleted successfully', 'success');
        } else {
            throw new Error(result.message || 'Failed to delete variation');
        }
    } catch (error) {
        console.error('Error deleting variation:', error);
        showNotification('Error deleting variation: ' + error.message, 'error');
    }
}

async function saveAllVariations() {
    const variations = [];
    
    document.querySelectorAll('.variation-row').forEach(row => {
        const variationId = row.dataset.variationId;
        variations.push({
            id: variationId,
            name: row.querySelector('.variation-name').value,
            price: row.querySelector('.variation-price').value,
            stock: row.querySelector('.variation-stock').value,
            status: row.querySelector('.variation-status').value
        });
    });
    
    try {
        const response = await fetch(`/admin/products/{{ $product->id }}/variations/bulk-update`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ variations: variations })
        });
        
        const result = await response.json();
        
        if (result.success) {
            showNotification('All variations updated successfully', 'success');
        } else {
            throw new Error(result.message || 'Failed to update variations');
        }
    } catch (error) {
        console.error('Error updating variations:', error);
        showNotification('Error updating variations: ' + error.message, 'error');
    }
}

function updateVariationDisplay(row, data) {
    row.querySelector('.view-mode span').textContent = data.name;
    
    const priceSpan = row.querySelector('td:nth-child(3) .view-mode span');
    priceSpan.textContent = `$${parseFloat(data.price).toFixed(2)}`;
    
    const stockSpan = row.querySelector('td:nth-child(4) .view-mode span');
    stockSpan.textContent = data.stock;
    stockSpan.className = `font-medium ${data.stock == 0 ? 'text-red-400' : (data.stock < 10 ? 'text-yellow-400' : 'text-green-400')}`;
    
    const statusSpan = row.querySelector('td:nth-child(5) .view-mode span');
    statusSpan.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
    statusSpan.className = `px-2 py-1 rounded text-xs font-medium ${data.status == 'sell' ? 'bg-green-500/20 text-green-400' : 'bg-gray-500/20 text-gray-400'}`;
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-4 py-3 rounded-lg z-50 ${type === 'success' ? 'bg-green-500/20 border border-green-500/30 text-green-200' : 'bg-red-500/20 border border-red-500/30 text-red-200'}`;
    notification.innerHTML = `<i class="fas fa-${type === 'success' ? 'check' : 'exclamation-triangle'} mr-2"></i>${message}`;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 4000);
}

const categorySelectEdit = document.getElementById('categorySelectEdit');
const subcategorySelectEdit = document.getElementById('subcategorySelectEdit');

if (categorySelectEdit && subcategorySelectEdit) {
    categorySelectEdit.addEventListener('change', async function() {
        const categoryId = this.value;
        subcategorySelectEdit.innerHTML = '<option value="">Loading...</option>';
        
        if (categoryId) {
            try {
                const response = await fetch(`/admin/categories/${categoryId}/subcategories`);
                const data = await response.json();
                
                if (data.success) {
                    subcategorySelectEdit.innerHTML = '<option value="">Select Subcategory</option>';
                    data.subcategories.forEach(sub => {
                        const selected = sub.id == {{ $product->subcategory_id }} ? 'selected' : '';
                        subcategorySelectEdit.innerHTML += `<option value="${sub.id}" ${selected}>${sub.name}</option>`;
                    });
                }
            } catch (error) {
                subcategorySelectEdit.innerHTML = '<option value="">Error loading subcategories</option>';
            }
        }
    });
}

document.getElementById('editModeToggle').addEventListener('click', toggleEditMode);

document.getElementById('productForm').addEventListener('submit', function() {
    const updateBtn = document.getElementById('updateBtn');
    if (updateBtn) {
        updateBtn.disabled = true;
        updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Updating...';
    }
});
</script>
@endpush
