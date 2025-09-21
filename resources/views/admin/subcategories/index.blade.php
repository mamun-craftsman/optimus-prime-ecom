@extends('layouts.admin')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h2 class="text-3xl font-bold section-title text-white mb-2 glow-text">SUB CATEGORIES</h2>
        <p class="text-gray-400">Manage all product subcategories</p>
    </div>
    
    <div class="admin-card neon-border p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h3 class="text-xl font-bold text-white mb-4 md:mb-0">Sub Categories List</h3>
            <div class="flex space-x-3">
                <div class="relative">
                    <input type="text" id="search-input" placeholder="Search subcategories..." class="input-field px-4 py-2 rounded-lg text-white focus:outline-none pl-10">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <button class="btn-primary px-4 py-2 rounded-lg text-white" onclick="openAddModal()">
                    <i class="fas fa-plus mr-2"></i> Add Sub Category
                </button>
            </div>
        </div>
        
        <div id="table-loader" class="hidden flex justify-center items-center py-12">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-neon"></div>
        </div>

        <div id="table-content">
            @include('admin.subcategories._table', ['subcategories' => $subcategories])
        </div>
    </div>
</div>

<div id="subcategoryModal" class="modal-overlay fixed inset-0 flex items-center justify-center hidden">
    <div class="modal w-full max-w-md p-6">
        <div class="modal-header flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold section-title text-white">Add Sub Category</h3>
            <button class="close-btn text-gray-400 hover:text-white text-2xl" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="subcategoryForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="subcategoryId">
            <div class="mb-4">
                <label class="block text-gray-300 mb-2">Sub Category Name *</label>
                <input type="text" id="subcategoryName" class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none" placeholder="Enter sub category name" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-2">Slug *</label>
                <input type="text" id="subcategorySlug" class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none" placeholder="Enter sub category slug" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-2">Parent Category *</label>
                <select id="parentCategory" class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none" required>
                    <option value="">Select parent category</option>
                </select>
            </div>
            <div class="mb-6">
                <label class="block text-gray-300 mb-2">Icon/Image *</label>
                <div class="flex items-center space-x-4">
                    <div class="category-icon-container">
                        <div class="w-16 h-16 bg-gray-700 rounded-lg flex items-center justify-center overflow-hidden" id="iconPreview">
                            <i class="fas fa-image text-gray-400 text-2xl"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <input type="file" id="iconFile" accept="image/*" class="hidden" onchange="previewIcon(this)">
                        <button type="button" onclick="document.getElementById('iconFile').click()" class="btn-secondary px-4 py-2 rounded-lg text-white w-full">
                            <i class="fas fa-upload mr-2"></i> Choose Image
                        </button>
                        <p class="text-xs text-gray-400 mt-1">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" class="btn-secondary px-6 py-3 rounded-lg text-white font-bold" onclick="closeModal()">
                    Cancel
                </button>
                <button type="submit" class="btn-primary px-6 py-3 rounded-lg text-white font-bold" id="submit-btn">
                    Save Sub Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
let searchTimer;
let currentPage = 1;
let currentSearch = '';
let categories = [];

function showLoader() {
    document.getElementById('table-loader').classList.remove('hidden');
    document.getElementById('table-content').classList.add('opacity-50');
}

function hideLoader() {
    document.getElementById('table-loader').classList.add('hidden');
    document.getElementById('table-content').classList.remove('opacity-50');
}

async function loadSubcategories(page = 1, search = '') {
    showLoader();
    
    try {
        const response = await fetch(`/admin/subcategories/fetch?page=${page}&search=${encodeURIComponent(search)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
            }
        });
        
        if (!response.ok) throw new Error('Network response was not ok');
        
        const html = await response.text();
        document.getElementById('table-content').innerHTML = html;
        
        currentPage = page;
        currentSearch = search;
    } catch (error) {
        console.error('Error loading subcategories:', error);
        showErrorMessage('Error loading subcategories. Please try again.');
    } finally {
        hideLoader();
    }
}

function loadPage(page) {
    loadSubcategories(page, currentSearch);
}

document.getElementById('search-input').addEventListener('input', function(e) {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
        loadSubcategories(1, e.target.value);
    }, 300);
});

async function fetchCategories() {
    try {
        const response = await fetch('/admin/categories/fetch-options', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
            }
        });
        
        if (!response.ok) throw new Error('Failed to fetch categories');
        
        const result = await response.json();
        
        if (result.success) {
            categories = result.categories;
            populateCategoriesDropdown();
        } else {
            throw new Error(result.message || 'Failed to load categories');
        }
    } catch (error) {
        console.error('Error fetching categories:', error);
        showErrorMessage('Failed to load categories. Please refresh the page.');
    }
}

function populateCategoriesDropdown() {
    const select = document.getElementById('parentCategory');
    select.innerHTML = '<option value="">Select parent category</option>';
    
    categories.forEach(category => {
        const option = document.createElement('option');
        option.value = category.id;
        option.textContent = category.name;
        select.appendChild(option);
    });
}

function previewIcon(input) {
    const preview = document.getElementById('iconPreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg">`;
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

function openAddModal() {
    document.getElementById('subcategoryForm').reset();
    document.getElementById('subcategoryId').value = '';
    document.querySelector('.modal h3').textContent = 'Add Sub Category';
    document.getElementById('subcategoryModal').classList.remove('hidden');
    resetIconPreview();
    
    if (categories.length === 0) {
        fetchCategories();
    } else {
        populateCategoriesDropdown();
    }
}

function openEditModal(id, name, slug, categoryId, iconPath = null) {
    document.getElementById('subcategoryId').value = id;
    document.getElementById('subcategoryName').value = name;
    document.getElementById('subcategorySlug').value = slug;
    document.querySelector('.modal h3').textContent = 'Edit Sub Category';
    document.getElementById('subcategoryModal').classList.remove('hidden');
    
    if (iconPath) {
        document.getElementById('iconPreview').innerHTML = `<img src="/storage/${iconPath}" class="w-full h-full object-cover rounded-lg">`;
    } else {
        resetIconPreview();
    }
    
    if (categories.length === 0) {
        fetchCategories().then(() => {
            document.getElementById('parentCategory').value = categoryId;
        });
    } else {
        populateCategoriesDropdown();
        document.getElementById('parentCategory').value = categoryId;
    }
}

function resetIconPreview() {
    document.getElementById('iconPreview').innerHTML = '<i class="fas fa-image text-gray-400 text-2xl"></i>';
}

function closeModal() {
    document.getElementById('subcategoryModal').classList.add('hidden');
}

document.getElementById('subcategoryName').addEventListener('input', function() {
    const name = this.value;
    const slug = name.toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
    document.getElementById('subcategorySlug').value = slug;
});

document.getElementById('subcategoryForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submit-btn');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Saving...';
    
    try {
        const formData = new FormData();
        const id = document.getElementById('subcategoryId').value;
        const iconFile = document.getElementById('iconFile').files[0];
        
        formData.append('_token', document.querySelector('[name="_token"]').value);
        formData.append('name', document.getElementById('subcategoryName').value);
        formData.append('slug', document.getElementById('subcategorySlug').value);
        formData.append('category_id', document.getElementById('parentCategory').value);
        
        if (iconFile) {
            formData.append('icon', iconFile);
        }
        
        const url = id ? `/admin/subcategories/${id}` : '/admin/subcategories/store';
        if (id) formData.append('_method', 'PUT');
        
        const response = await fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            closeModal();
            loadSubcategories(currentPage, currentSearch);
            showSuccessMessage(result.message);
        } else {
            throw new Error(result.message || 'Something went wrong');
        }
    } catch (error) {
        console.error('Error saving subcategory:', error);
        showErrorMessage('Error saving subcategory: ' + error.message);
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }
});

async function deleteSubcategory(id) {
    if (!confirm('Are you sure you want to delete this subcategory?')) return;
    
    try {
        const response = await fetch(`/admin/subcategories/${id}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            loadSubcategories(currentPage, currentSearch);
            showSuccessMessage(result.message);
        } else {
            throw new Error(result.message || 'Failed to delete subcategory');
        }
    } catch (error) {
        console.error('Error deleting subcategory:', error);
        showErrorMessage('Error deleting subcategory: ' + error.message);
    }
}

function showSuccessMessage(message) {
    const successMsg = document.createElement('div');
    successMsg.className = 'fixed top-4 right-4 bg-green-500/20 border border-green-500/30 text-green-200 px-4 py-3 rounded-lg z-50';
    successMsg.innerHTML = `<i class="fas fa-check mr-2"></i>${message}`;
    document.body.appendChild(successMsg);
    
    setTimeout(() => {
        successMsg.remove();
    }, 4000);
}

function showErrorMessage(message) {
    const errorMsg = document.createElement('div');
    errorMsg.className = 'fixed top-4 right-4 bg-red-500/20 border border-red-500/30 text-red-200 px-4 py-3 rounded-lg z-50';
    errorMsg.innerHTML = `<i class="fas fa-exclamation-triangle mr-2"></i>${message}`;
    document.body.appendChild(errorMsg);
    
    setTimeout(() => {
        errorMsg.remove();
    }, 5000);
}

document.getElementById('subcategoryModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    fetchCategories();
});
</script>
@endpush
