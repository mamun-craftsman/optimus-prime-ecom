@extends('layouts.admin')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h2 class="text-3xl font-bold section-title text-white mb-2 glow-text">PRODUCT ATTRIBUTES</h2>
        <p class="text-gray-400">Manage product attributes and their values</p>
    </div>

    <div class="admin-card neon-border p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h3 class="text-xl font-bold text-white mb-4 md:mb-0">Attributes List</h3>
            <div class="flex space-x-3">
                <div class="relative">
                    <input type="text" id="search-input" placeholder="Search attributes..." class="input-field px-4 py-2 rounded-lg text-white focus:outline-none pl-10">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <button class="btn-primary px-4 py-2 rounded-lg text-white" onclick="openAddModal()">
                    <i class="fas fa-plus mr-2"></i> Add Attribute
                </button>
            </div>
        </div>

        <div id="table-loader" class="hidden flex justify-center items-center py-12">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-neon"></div>
        </div>

        <div id="table-content">
            @include('admin.attributes._table', ['attributes' => $attributes])
        </div>
    </div>
</div>

<!-- Attribute Modal -->
<div id="attributeModal" class="modal-overlay fixed inset-0 flex items-center justify-center hidden">
    <div class="modal w-full max-w-2xl p-6">
        <div class="modal-header flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold section-title text-white">Add Attribute</h3>
            <button class="close-btn text-gray-400 hover:text-white text-2xl" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="attributeForm">
            @csrf
            <input type="hidden" id="attributeId">
            <div class="mb-4">
                <label class="block text-gray-300 mb-2">Attribute Name *</label>
                <input type="text" id="attributeName" class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none" placeholder="Enter attribute name (e.g., Color, Size)" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-300 mb-2">Attribute Values</label>
                <div id="valuesContainer">
                    <div class="flex items-center space-x-2 mb-2">
                        <input type="text" class="input-field flex-1 px-4 py-2 rounded-lg text-white focus:outline-none" placeholder="Enter value (e.g., Red, Blue)">
                        <button type="button" class="btn-secondary px-3 py-2 rounded-lg" onclick="addValueField()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <button type="button" class="btn-secondary px-4 py-2 rounded-lg text-white mt-2" onclick="addValueField()">
                    <i class="fas fa-plus mr-2"></i> Add Value
                </button>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" class="btn-secondary px-6 py-3 rounded-lg text-white font-bold" onclick="closeModal()">
                    Cancel
                </button>
                <button type="submit" class="btn-primary px-6 py-3 rounded-lg text-white font-bold" id="submit-btn">
                    Save Attribute
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

async function loadAttributes(page = 1, search = '') {
    showLoader();
    
    try {
        const response = await fetch(`/admin/attributes/fetch?page=${page}&search=${encodeURIComponent(search)}`, {
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
        console.error('Error loading attributes:', error);
        showErrorMessage('Error loading attributes. Please try again.');
    } finally {
        hideLoader();
    }
}

function loadPage(page) {
    loadAttributes(page, currentSearch);
}

document.getElementById('search-input').addEventListener('input', function(e) {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
        loadAttributes(1, e.target.value);
    }, 300);
});

function addValueField() {
    const container = document.getElementById('valuesContainer');
    const newField = document.createElement('div');
    newField.className = 'flex items-center space-x-2 mb-2';
    newField.innerHTML = `
        <input type="text" class="input-field flex-1 px-4 py-2 rounded-lg text-white focus:outline-none" placeholder="Enter value">
        <button type="button" class="btn-danger px-3 py-2 rounded-lg text-white" onclick="removeValueField(this)">
            <i class="fas fa-minus"></i>
        </button>
    `;
    container.appendChild(newField);
}

function removeValueField(button) {
    button.parentElement.remove();
}

function openAddModal() {
    document.getElementById('attributeForm').reset();
    document.getElementById('attributeId').value = '';
    document.querySelector('.modal h3').textContent = 'Add Attribute';
    
    const container = document.getElementById('valuesContainer');
    container.innerHTML = `
        <div class="flex items-center space-x-2 mb-2">
            <input type="text" class="input-field flex-1 px-4 py-2 rounded-lg text-white focus:outline-none" placeholder="Enter value (e.g., Red, Blue)">
            <button type="button" class="btn-secondary px-3 py-2 rounded-lg" onclick="addValueField()">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    `;
    
    document.getElementById('attributeModal').classList.remove('hidden');
}

function openEditModal(id, name, values) {
    document.getElementById('attributeId').value = id;
    document.getElementById('attributeName').value = name;
    document.querySelector('.modal h3').textContent = 'Edit Attribute';
    
    const container = document.getElementById('valuesContainer');
    container.innerHTML = '';
    
    if (values && values.length > 0) {
        values.forEach(value => {
            const newField = document.createElement('div');
            newField.className = 'flex items-center space-x-2 mb-2';
            newField.innerHTML = `
                <input type="text" class="input-field flex-1 px-4 py-2 rounded-lg text-white focus:outline-none" placeholder="Enter value" value="${value.value}">
                <button type="button" class="btn-danger px-3 py-2 rounded-lg text-white" onclick="removeValueField(this)">
                    <i class="fas fa-minus"></i>
                </button>
            `;
            container.appendChild(newField);
        });
    } else {
        addValueField();
    }
    
    document.getElementById('attributeModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('attributeModal').classList.add('hidden');
}

document.getElementById('attributeForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submit-btn');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Saving...';
    
    try {
        const id = document.getElementById('attributeId').value;
        const name = document.getElementById('attributeName').value;
        
        const valueInputs = document.querySelectorAll('#valuesContainer input');
        const values = Array.from(valueInputs).map(input => input.value.trim()).filter(value => value !== '');
        
        const formData = new FormData();
        formData.append('_token', document.querySelector('[name="_token"]').value);
        formData.append('name', name);
        formData.append('values', JSON.stringify(values));
        
        const url = id ? `/admin/attributes/${id}` : '/admin/attributes/store';
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
            loadAttributes(currentPage, currentSearch);
            showSuccessMessage(result.message);
        } else {
            throw new Error(result.message || 'Something went wrong');
        }
    } catch (error) {
        console.error('Error saving attribute:', error);
        showErrorMessage('Error saving attribute: ' + error.message);
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }
});

async function deleteAttribute(id) {
    if (!confirm('Are you sure you want to delete this attribute? This will also delete all its values.')) return;
    
    try {
        const response = await fetch(`/admin/attributes/${id}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            loadAttributes(currentPage, currentSearch);
            showSuccessMessage(result.message);
        } else {
            throw new Error(result.message || 'Failed to delete attribute');
        }
    } catch (error) {
        console.error('Error deleting attribute:', error);
        showErrorMessage('Error deleting attribute: ' + error.message);
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

document.getElementById('attributeModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endpush
