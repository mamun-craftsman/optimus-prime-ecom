@extends('layouts.admin')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold section-title text-white mb-2 glow-text">CREATE PRODUCT</h2>
                    <p class="text-gray-400">Add a new product to your inventory</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="btn-secondary px-4 py-2 rounded-lg text-white">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Products
                </a>
            </div>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Product Info -->
                <div class="lg:col-span-2">
                    <div class="admin-card neon-border p-6 mb-6">
                        <h3 class="text-xl font-bold text-white mb-4">Basic Information</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-300 mb-2">Product Name *</label>
                                <input type="text" name="name" id="productName"
                                    class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none @error('name') border-red-500 @enderror"
                                    placeholder="Enter product name" value="{{ old('name') }}" required>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-300 mb-2">Slug</label>
                                <input type="text" name="slug" id="productSlug"
                                    class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none @error('slug') border-red-500 @enderror"
                                    placeholder="Auto-generated from name" value="{{ old('slug') }}">
                                @error('slug')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-300 mb-2">Category *</label>
                                <select name="category_id" id="categorySelect"
                                    class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none @error('category_id') border-red-500 @enderror"
                                    required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-300 mb-2">Subcategory *</label>
                                <select name="subcategory_id" id="subcategorySelect"
                                    class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none @error('subcategory_id') border-red-500 @enderror"
                                    required>
                                    <option value="">Select Subcategory</option>
                                </select>
                                @error('subcategory_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-300 mb-2">Price *</label>
                                <input type="number" name="price" step="0.01" min="0"
                                    class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none @error('price') border-red-500 @enderror"
                                    placeholder="0.00" value="{{ old('price') }}" required>
                                @error('price')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-300 mb-2">Stock *</label>
                                <input type="number" name="stock" min="0"
                                    class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none @error('stock') border-red-500 @enderror"
                                    placeholder="0" value="{{ old('stock') }}" required>
                                @error('stock')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-300 mb-2">Status *</label>
                                <select name="status"
                                    class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none @error('status') border-red-500 @enderror"
                                    required>
                                    <option value="sell" {{ old('status') == 'sell' ? 'selected' : '' }}>Sell
                                    </option>
                                    <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold
                                    </option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Features & Description -->
                    <div class="admin-card neon-border p-6 mb-6">
                        <h3 class="text-xl font-bold text-white mb-4">Features & Description</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-300 mb-2">Key Features (Left) *</label>
                                <textarea name="key_feature_left" id="keyFeatureLeft" class="tinymce-editor">{{ old('key_feature_left') }}</textarea>
                                @error('key_feature_left')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-300 mb-2">Key Features (Right) *</label>
                                <textarea name="key_feature_right" id="keyFeatureRight" class="tinymce-editor">{{ old('key_feature_right') }}</textarea>
                                @error('key_feature_right')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Description *</label>
                            <textarea name="description" id="description" class="tinymce-editor">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-300 mb-2">Video URL</label>
                            <input type="url" name="video_url"
                                class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none @error('video_url') border-red-500 @enderror"
                                placeholder="https://youtube.com/..." value="{{ old('video_url') }}">
                            @error('video_url')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Product Variations -->
                    <div class="admin-card neon-border p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-white">Product Variations</h3>
                            <label class="flex items-center">
                                <input type="checkbox" id="hasVariations" name="has_variations" value="1"
                                    class="mr-2">
                                <span class="text-gray-300">This product has variations</span>
                            </label>
                        </div>

                        <div id="variationsContainer" class="hidden">
                            <div id="attributeSelection" class="mb-4">
                                <label class="block text-gray-300 mb-2">Select Attributes</label>
                                @foreach ($attributes as $attribute)
                                    <div class="mb-3">
                                        <label class="flex items-center mb-2">
                                            <input type="checkbox" name="attributes[]" value="{{ $attribute->id }}"
                                                class="attribute-checkbox mr-2" data-attribute-id="{{ $attribute->id }}">
                                            <span class="text-gray-300">{{ $attribute->name }}</span>
                                        </label>
                                        <div class="attribute-values hidden ml-6"
                                            data-attribute-id="{{ $attribute->id }}">
                                            @foreach ($attribute->values as $value)
                                                <label class="flex items-center mb-1">
                                                    <input type="checkbox"
                                                        name="attribute_values[{{ $attribute->id }}][]"
                                                        value="{{ $value->id }}" class="mr-2">
                                                    <span class="text-gray-400 text-sm">{{ $value->value }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" id="generateVariations"
                                class="btn-primary px-4 py-2 rounded-lg text-white mb-4">
                                <i class="fas fa-magic mr-2"></i> Generate Variations
                            </button>

                            <div id="variationsPreview" class="hidden">
                                <h4 class="text-lg font-bold text-white mb-3">Generated Variations</h4>
                                <div id="variationsList"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Images -->
                    <div class="admin-card neon-border p-6 mb-6">
                        <h3 class="text-xl font-bold text-white mb-4">Product Images</h3>

                        <div class="mb-4">
                            <label class="block text-gray-300 mb-2">Primary Image *</label>
                            <div class="upload-area border-2 border-dashed border-gray-600 rounded-lg p-4 text-center">
                                <input type="file" name="primary_image" id="primaryImage" accept="image/*"
                                    class="hidden" required>
                                <div id="primaryPreview" class="hidden mb-3">
                                    <img id="primaryImg" class="w-full h-32 object-cover rounded">
                                </div>
                                <button type="button" onclick="document.getElementById('primaryImage').click()"
                                    class="btn-secondary px-4 py-2 rounded-lg text-white">
                                    <i class="fas fa-upload mr-2"></i> Choose Primary Image
                                </button>
                            </div>
                            @error('primary_image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-300 mb-2">Secondary Images</label>
                            <div class="upload-area border-2 border-dashed border-gray-600 rounded-lg p-4 text-center">
                                <input type="file" name="secondary_images[]" id="secondaryImages" accept="image/*"
                                    multiple class="hidden">
                                <div id="secondaryPreview" class="hidden mb-3 grid grid-cols-2 gap-2"></div>
                                <button type="button" onclick="document.getElementById('secondaryImages').click()"
                                    class="btn-secondary px-4 py-2 rounded-lg text-white">
                                    <i class="fas fa-upload mr-2"></i> Choose Secondary Images
                                </button>
                            </div>
                            @error('secondary_images.*')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="admin-card neon-border p-6">
                        <button type="submit" class="btn-primary w-full py-3 rounded-lg text-white font-bold"
                            id="submitBtn">
                            <i class="fas fa-save mr-2"></i> Create Product
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <style>
        .tox-menubar,
        .tox-promotion,
        .tox-statusbar__right-container {
            display: none !important;
        }
		#primaryImg {
			aspect-ratio: 1/1;
			object-fit: cover;
		}
		
		.aspect-\[1\/1\] {
			aspect-ratio: 1/1;
		}
    </style>
@endpush

@push('scripts')
<script>
tinymce.init({
    selector: '.tinymce-editor',
    height: 400,
    plugins: 'lists link code',
    toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link | code',
    theme: 'silver',
    skin: 'oxide-dark',
    content_css: 'dark'
});

const productNameInput = document.getElementById('productName');
const productSlugInput = document.getElementById('productSlug');
if (productNameInput && productSlugInput) {
    productNameInput.addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
                        .replace(/[^\w ]+/g, '')
                        .replace(/ +/g, '-');
        productSlugInput.value = slug;
    });
}

const categorySelect = document.getElementById('categorySelect');
const subcategorySelect = document.getElementById('subcategorySelect');
if (categorySelect && subcategorySelect) {
    categorySelect.addEventListener('change', async function() {
        const categoryId = this.value;
        subcategorySelect.innerHTML = '<option value="">Loading...</option>';
        
        if (categoryId) {
            try {
                const response = await fetch(`/admin/categories/${categoryId}/subcategories`);
                const data = await response.json();
                
                if (data.success) {
                    subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
                    data.subcategories.forEach(sub => {
                        subcategorySelect.innerHTML += `<option value="${sub.id}">${sub.name}</option>`;
                    });
                } else {
                    subcategorySelect.innerHTML = '<option value="">Error loading subcategories</option>';
                }
            } catch (error) {
                subcategorySelect.innerHTML = '<option value="">Error loading subcategories</option>';
            }
        } else {
            subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
        }
    });
}

const hasVariationsCheckbox = document.getElementById('hasVariations');
const variationsContainer = document.getElementById('variationsContainer');
if (hasVariationsCheckbox && variationsContainer) {
    hasVariationsCheckbox.addEventListener('change', function() {
        if (this.checked) {
            variationsContainer.classList.remove('hidden');
        } else {
            variationsContainer.classList.add('hidden');
        }
    });
}

document.querySelectorAll('.attribute-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const attributeId = this.dataset.attributeId;
        const valuesContainer = document.querySelector(`.attribute-values[data-attribute-id="${attributeId}"]`);
        
        if (valuesContainer) {
            if (this.checked) {
                valuesContainer.classList.remove('hidden');
            } else {
                valuesContainer.classList.add('hidden');
                valuesContainer.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
            }
        }
    });
});

const generateVariationsBtn = document.getElementById('generateVariations');
if (generateVariationsBtn) {
    generateVariationsBtn.addEventListener('click', async function() {
        const selectedAttributes = [];
        
        document.querySelectorAll('.attribute-checkbox:checked').forEach(checkbox => {
            const attributeId = checkbox.value;
            const selectedValues = [];
            
            document.querySelectorAll(`input[name="attribute_values[${attributeId}][]"]:checked`).forEach(valueCheckbox => {
                selectedValues.push(parseInt(valueCheckbox.value));
            });
            
            if (selectedValues.length > 0) {
                selectedAttributes.push({
                    id: parseInt(attributeId),
                    values: selectedValues
                });
            }
        });
        
        if (selectedAttributes.length === 0) {
            alert('Please select at least one attribute with values.');
            return;
        }
        
        const priceInput = document.querySelector('[name="price"]');
        const stockInput = document.querySelector('[name="stock"]');
        const csrfToken = document.querySelector('[name="_token"]');
        
        if (!csrfToken) {
            alert('CSRF token not found');
            return;
        }
        
        const basePrice = priceInput ? parseFloat(priceInput.value) || 0 : 0;
        const baseStock = stockInput ? parseInt(stockInput.value) || 0 : 0;
        
        try {
            const response = await fetch('/admin/products/generate-variations', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken.value,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    attributes: selectedAttributes,
                    base_price: basePrice,
                    base_stock: baseStock
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                displayVariations(data.variations);
            } else {
                alert('Error generating variations: ' + (data.message || 'Unknown error'));
            }
        } catch (error) {
            alert('Error generating variations. Please try again.');
        }
    });
}

function displayVariations(variations) {
    const container = document.getElementById('variationsList');
    const preview = document.getElementById('variationsPreview');
    
    if (!container || !preview) return;
    
    container.innerHTML = '';
    
    variations.forEach((variation, index) => {
        const variationDiv = document.createElement('div');
        variationDiv.className = 'bg-gray-800 p-4 rounded-lg mb-3';
        variationDiv.innerHTML = `
            <h5 class="text-white font-medium mb-2">${variation.name}</h5>
            <div class="grid grid-cols-3 gap-2">
                <input type="hidden" name="variations[${index}][name]" value="${variation.name}">
                <input type="hidden" name="variations[${index}][attribute_value_ids]" value='${JSON.stringify(variation.attribute_value_ids)}'>
                <input type="number" name="variations[${index}][price]" placeholder="Price" value="${variation.price}" class="input-field px-2 py-1 rounded text-white" step="0.01" min="0" required>
                <input type="number" name="variations[${index}][stock]" placeholder="Stock" value="${variation.stock}" class="input-field px-2 py-1 rounded text-white" min="0" required>
                <select name="variations[${index}][status]" class="input-field px-2 py-1 rounded text-white" required>
                    <option value="sell">Sell</option>
                    <option value="sold">Sold</option>
                </select>
            </div>
        `;
        container.appendChild(variationDiv);
    });
    
    preview.classList.remove('hidden');
}

const primaryImageInput = document.getElementById('primaryImage');
const primaryImg = document.getElementById('primaryImg');
const primaryPreview = document.getElementById('primaryPreview');
if (primaryImageInput && primaryImg && primaryPreview) {
    primaryImageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                primaryImg.src = e.target.result;
				primaryImg.className = 'w-full aspect-[1/1] object-cover rounded';
                primaryPreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
}

const secondaryImagesInput = document.getElementById('secondaryImages');
const secondaryPreview = document.getElementById('secondaryPreview');
if (secondaryImagesInput && secondaryPreview) {
    secondaryImagesInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        secondaryPreview.innerHTML = '';
        
        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full aspect-[1/1] object-cover rounded';
                secondaryPreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
        
        if (files.length > 0) {
            secondaryPreview.classList.remove('hidden');
        }
    });
}

const productForm = document.getElementById('productForm');
const submitBtn = document.getElementById('submitBtn');
if (productForm && submitBtn) {
    productForm.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Creating Product...';
    });
}
</script>
@endpush

