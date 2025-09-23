@extends('layouts.admin')

@section('content')
<style>
    .status-pending { color: #f59e0b; }
    .status-success { color: #10b981; }
    .status-cancelled { color: #ef4444; }
    .table-container { max-height: 500px; overflow-y: auto; }
    .table-container::-webkit-scrollbar { width: 8px; }
    .table-container::-webkit-scrollbar-track { background: rgba(30, 41, 59, 0.5); }
    .table-container::-webkit-scrollbar-thumb { background: #00f7ff; border-radius: 4px; }
    .table-container::-webkit-scrollbar-thumb:hover { background: #8b5cf6; }
</style>

<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h2 class="text-3xl font-bold section-title text-white mb-2 glow-text">ALL ORDERS</h2>
        <p class="text-gray-400">Manage all customer orders in one place</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8" id="statsCards">
        <div class="admin-card neon-border p-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-400">Total Orders</p>
                    <p class="text-3xl font-bold text-white" id="totalCount">{{ $orders->total() }}</p>
                </div>
                <div class="text-3xl text-neon"><i class="fas fa-shopping-cart"></i></div>
            </div>
        </div>
        
        <div class="admin-card neon-border p-6 cursor-pointer" data-status="pending">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-400">Pending</p>
                    <p class="text-3xl font-bold text-white" id="pendingCount">0</p>
                </div>
                <div class="text-3xl text-yellow-500"><i class="fas fa-clock"></i></div>
            </div>
        </div>
        
        <div class="admin-card neon-border p-6 cursor-pointer" data-status="completed">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-400">Completed</p>
                    <p class="text-3xl font-bold text-white" id="completedCount">0</p>
                </div>
                <div class="text-3xl text-green-500"><i class="fas fa-check-circle"></i></div>
            </div>
        </div>
        
        <div class="admin-card neon-border p-6 cursor-pointer" data-status="cancelled">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-400">Cancelled</p>
                    <p class="text-3xl font-bold text-white" id="cancelledCount">0</p>
                </div>
                <div class="text-3xl text-red-500"><i class="fas fa-times-circle"></i></div>
            </div>
        </div>
    </div>
    
    <div class="admin-card neon-border p-6 mb-8">
        <h3 class="text-xl font-bold section-title text-white mb-6">FILTER ORDERS</h3>
        
        <form id="filterForm">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-gray-300 mb-2">Search</label>
                    <input type="text" name="search" id="searchInput" class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none" placeholder="Order ID, Customer, Email, Phone" value="{{ $search }}">
                </div>
                
                <div>
                    <label class="block text-gray-300 mb-2">Status</label>
                    <select name="status" id="statusFilter" class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none">
                        <option value="all" {{ $status == 'all' ? 'selected' : '' }}>All Statuses</option>
                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-300 mb-2">Per Page</label>
                    <select name="per_page" id="perPageSelect" class="input-field w-full px-4 py-3 rounded-lg text-white focus:outline-none">
                        <option value="15">15 per page</option>
                        <option value="25">25 per page</option>
                        <option value="50">50 per page</option>
                        <option value="100">100 per page</option>
                    </select>
                </div>
            </div>
            
            <div class="flex justify-end mt-6">
                <button type="button" id="resetBtn" class="btn-secondary px-6 py-3 rounded-lg text-white font-bold mr-3">
                    <i class="fas fa-undo mr-2"></i> Reset
                </button>
                <button type="button" id="refreshBtn" class="btn-primary px-6 py-3 rounded-lg text-white font-bold">
                    <i class="fas fa-sync-alt mr-2"></i> Refresh
                </button>
            </div>
        </form>
    </div>
    
    <div class="admin-card neon-border p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h3 class="text-xl font-bold section-title text-white mb-4 md:mb-0">ORDER LIST</h3>
            <div class="flex space-x-3">
                <button id="exportBtn" class="btn-secondary px-4 py-2 rounded-lg text-white font-bold">
                    <i class="fas fa-file-export mr-2"></i> Export
                </button>
                <div id="bulkActions" style="display: none;">
                    <select id="bulkActionSelect" class="input-field px-3 py-2 rounded-lg text-white mr-2">
                        <option value="">Bulk Actions</option>
                        <option value="delete">Delete Selected</option>
                        <option value="update_status">Update Status</option>
                    </select>
                    <select id="bulkStatusSelect" class="input-field px-3 py-2 rounded-lg text-white mr-2" style="display: none;">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <button id="applyBulkBtn" class="btn-primary px-4 py-2 rounded-lg text-white font-bold">Apply</button>
                </div>
            </div>
        </div>
        
        <div id="loadingSpinner" class="text-center py-8" style="display: none;">
            <i class="fas fa-spinner fa-spin text-3xl text-neon"></i>
            <p class="text-gray-400 mt-2">Loading orders...</p>
        </div>
        
        <div id="tableContainer">
            @include('admin.orders.partials.table')
        </div>
        
        <div id="paginationContainer" class="mt-6">
            @include('admin.orders.partials.pagination')
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let currentPage = 1;
let isLoading = false;

$(document).ready(function() {
    loadStatusCounts();
    
    let searchTimeout;
    $(document).on('input', '#searchInput', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            currentPage = 1;
            loadOrders();
        }, 500);
    });
    
    $(document).on('change', '#statusFilter', function() {
        currentPage = 1;
        loadOrders();
    });
    
    $(document).on('change', '#perPageSelect', function() {
        currentPage = 1;
        loadOrders();
    });
    
    $(document).on('click', '#resetBtn', function() {
        $('#filterForm')[0].reset();
        currentPage = 1;
        loadOrders();
    });
    
    $(document).on('click', '#refreshBtn', function() {
        loadOrders();
        loadStatusCounts();
    });
    
    $(document).on('click', '.admin-card[data-status]', function() {
        const status = $(this).data('status');
        $('#statusFilter').val(status);
        currentPage = 1;
        loadOrders();
    });
    
    $(document).on('click', '#exportBtn', function() {
        const params = new URLSearchParams({
            search: $('#searchInput').val(),
            status: $('#statusFilter').val()
        });
        window.open('{{ route("admin.orders.export") }}?' + params.toString());
    });
    
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        if (url) {
            const page = new URL(url).searchParams.get('page');
            currentPage = parseInt(page) || 1;
            loadOrders();
        }
    });
    
    $(document).on('change', '#selectAll', function() {
        $('.order-checkbox').prop('checked', $(this).is(':checked'));
        toggleBulkActions();
    });
    
    $(document).on('change', '.order-checkbox', function() {
        toggleBulkActions();
    });
    
    $(document).on('change', '#bulkActionSelect', function() {
        if ($(this).val() === 'update_status') {
            $('#bulkStatusSelect').show();
        } else {
            $('#bulkStatusSelect').hide();
        }
    });
    
    $(document).on('click', '#applyBulkBtn', function() {
        const action = $('#bulkActionSelect').val();
        const selectedIds = $('.order-checkbox:checked').map(function() {
            return $(this).val();
        }).get();
        
        if (!action || selectedIds.length === 0) {
            alert('Please select action and orders');
            return;
        }
        
        if (action === 'delete' && !confirm(`Delete ${selectedIds.length} selected orders?`)) {
            return;
        }
        
        const data = {
            action: action,
            order_ids: selectedIds
        };
        
        if (action === 'update_status') {
            data.status = $('#bulkStatusSelect').val();
        }
        
        bulkAction(data);
    });
    
    $(document).on('click', '.delete-order', function(e) {
        e.preventDefault();
        const orderId = $(this).data('id');
        const orderNumber = $(this).data('number');
        
        if (confirm(`Delete order ${orderNumber}?`)) {
            deleteOrder(orderId);
        }
    });
    
    $(document).on('click', '.view-order', function(e) {
        e.preventDefault();
        const orderId = $(this).data('id');
        window.open('/admin/orders/' + orderId, '_blank');
    });
});

function loadOrders() {
    if (isLoading) return;
    
    isLoading = true;
    $('#loadingSpinner').show();
    $('#tableContainer').hide();
    
    const formData = {
        search: $('#searchInput').val(),
        status: $('#statusFilter').val(),
        per_page: $('#perPageSelect').val(),
        page: currentPage
    };
    
    $.ajax({
        url: '{{ route("admin.orders.index") }}',
        type: 'GET',
        data: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        success: function(response) {
            $('#tableContainer').html(response.html).show();
            $('#paginationContainer').html(response.pagination);
            $('#totalCount').text(response.total);
            $('#loadingSpinner').hide();
            isLoading = false;
        },
        error: function() {
            alert('Error loading orders');
            $('#loadingSpinner').hide();
            $('#tableContainer').show();
            isLoading = false;
        }
    });
}

function loadStatusCounts() {
    $.ajax({
        url: '{{ route("admin.orders.statusCounts") }}',
        type: 'GET',
        success: function(counts) {
            $('#totalCount').text(counts.all);
            $('#pendingCount').text(counts.pending);
            $('#completedCount').text(counts.completed);
            $('#cancelledCount').text(counts.cancelled);
        }
    });
}

function toggleBulkActions() {
    const selectedCount = $('.order-checkbox:checked').length;
    if (selectedCount > 0) {
        $('#bulkActions').show();
    } else {
        $('#bulkActions').hide();
        $('#bulkActionSelect').val('');
        $('#bulkStatusSelect').hide();
    }
}

function deleteOrder(orderId) {
    $.ajax({
        url: '/admin/orders/' + orderId,
        type: 'DELETE',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(response) {
            if (response.success) {
                loadOrders();
                loadStatusCounts();
                alert(response.message);
            }
        },
        error: function() {
            alert('Error deleting order');
        }
    });
}

function bulkAction(data) {
    $.ajax({
        url: '{{ route("admin.orders.bulkAction") }}',
        type: 'POST',
        data: data,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(response) {
            if (response.success) {
                loadOrders();
                loadStatusCounts();
                alert(response.message);
                $('#bulkActionSelect').val('');
                $('#bulkStatusSelect').hide();
                $('#bulkActions').hide();
            }
        },
        error: function() {
            alert('Error processing bulk action');
        }
    });
}
</script>
@endpush

@endsection
