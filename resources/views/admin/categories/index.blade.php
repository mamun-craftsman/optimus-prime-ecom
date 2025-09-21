@extends('layouts.admin')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h2 class="text-3xl font-bold section-title text-white mb-2 glow-text">MAIN CATEGORIES</h2>
            <p class="text-gray-400">Manage all main product categories</p>
        </div>

        <div class="admin-card neon-border p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <h3 class="text-xl font-bold text-white mb-4 md:mb-0">Main Categories List</h3>
                <div class="flex space-x-3">
                    <div class="relative">
                        <input type="text" id="search-input" placeholder="Search categories..." class="input-field px-4 py-2 rounded-lg text-white focus:outline-none pl-10">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <button class="btn-primary px-4 py-2 rounded-lg text-white" onclick="openAddModal()">
                        <i class="fas fa-plus mr-2"></i> Add Category
                    </button>
                </div>
            </div>

            <div id="table-loader" class="hidden flex justify-center items-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-neon"></div>
            </div>

            <div id="table-content">
                @include('admin.categories._table', ['categories' => $categories])
            </div>
        </div>
    </div>

    <div id="categoryModal" class="modal-overlay fixed inset-0 flex items-center justify-center hidden">
        <div class="modal w-full max-w-md p-6">
            <div class="modal-header flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold section-title text-white">Add Category</h3>
                <button class="close-btn text-gray-400 hover:text-white text-2xl" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="categoryForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="categoryId">
                <div class="mb-4">
                    <label class="block text-gray-300 mb-2">Category Name *</label>
                    <input type="text" id="categoryName" class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none" placeholder="Enter category name" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-300 mb-2">Slug *</label>
                    <input type="text" id="categorySlug" class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none" placeholder="Enter category slug" required>
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
                        Save Category
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

function showLoader() {
    document.getElementById('table-loader').classList.remove('hidden');
    document.getElementById('table-content').classList.add('opacity-50');
}

function hideLoader() {
    document.getElementById('table-loader').classList.add('hidden');
    document.getElementById('table-content').classList.remove('opacity-50');
}

async function loadCategories(page = 1, search = '') {
    showLoader();
    
    try {
        const response = await fetch(`/admin/categories/fetch?page=${page}&search=${encodeURIComponent(search)}`, {
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
        console.error('Error loading categories:', error);
        showErrorMessage('Error loading categories. Please try again.');
    } finally {
        hideLoader();
    }
}

function loadPage(page) {
    loadCategories(page, currentSearch);
}

document.getElementById('search-input').addEventListener('input', function(e) {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
        loadCategories(1, e.target.value);
    }, 300);
});

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
    document.getElementById('categoryForm').reset();
    document.getElementById('categoryId').value = '';
    document.querySelector('.modal h3').textContent = 'Add Category';
    document.getElementById('categoryModal').classList.remove('hidden');
    resetIconPreview();
}

function openEditModal(id, name, slug, iconPath = null) {
    document.getElementById('categoryId').value = id;
    document.getElementById('categoryName').value = name;
    document.getElementById('categorySlug').value = slug;
    document.querySelector('.modal h3').textContent = 'Edit Category';
    document.getElementById('categoryModal').classList.remove('hidden');
    
    if (iconPath) {
        document.getElementById('iconPreview').innerHTML = `<img src="/storage/${iconPath}" class="w-full h-full object-cover rounded-lg">`;
    } else {
        resetIconPreview();
    }
}

function resetIconPreview() {
    document.getElementById('iconPreview').innerHTML = '<i class="fas fa-image text-gray-400 text-2xl"></i>';
}

function closeModal() {
    document.getElementById('categoryModal').classList.add('hidden');
}

document.getElementById('categoryName').addEventListener('input', function() {
    const name = this.value;
    const slug = name.toLowerCase()
                    .replace(/[^\w ]+/g, '')
                    .replace(/ +/g, '-');
    document.getElementById('categorySlug').value = slug;
});

document.getElementById('categoryForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submit-btn');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Saving...';
    
    try {
        const formData = new FormData();
        const id = document.getElementById('categoryId').value;
        const iconFile = document.getElementById('iconFile').files[0];
        
        formData.append('_token', document.querySelector('[name="_token"]').value);
        formData.append('name', document.getElementById('categoryName').value);
        formData.append('slug', document.getElementById('categorySlug').value);
        
        if (iconFile) {
            formData.append('icon', iconFile);
        }
        
        const url = id ? `/admin/categories/${id}` : '/admin/categories/store';
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
            loadCategories(currentPage, currentSearch);
            showSuccessMessage(result.message);
        } else {
            throw new Error(result.message || 'Something went wrong');
        }
    } catch (error) {
        console.error('Error saving category:', error);
        showErrorMessage('Error saving category: ' + error.message);
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }
});

async function deleteCategory(id) {
    if (!confirm('Are you sure you want to delete this category?')) return;
    
    try {
        const response = await fetch(`/admin/categories/${id}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            loadCategories(currentPage, currentSearch);
            showSuccessMessage(result.message);
        } else {
            throw new Error(result.message || 'Failed to delete category');
        }
    } catch (error) {
        console.error('Error deleting category:', error);
        showErrorMessage('Error deleting category: ' + error.message);
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

document.getElementById('categoryModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endpush
