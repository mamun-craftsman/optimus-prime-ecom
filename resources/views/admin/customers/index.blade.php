@extends('layouts.admin')

@section('title', 'Customer Management')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Customer Management</h2>
        <p class="text-gray-400">Manage and monitor your customer base</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="admin-card neon-border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Customers</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($stats['total']) }}</p>
                </div>
                <i class="fas fa-users text-3xl text-neon"></i>
            </div>
        </div>
        
        <div class="admin-card neon-border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Active Customers</p>
                    <p class="text-2xl font-bold text-green-500">{{ number_format($stats['active']) }}</p>
                </div>
                <i class="fas fa-user-check text-3xl text-green-500"></i>
            </div>
        </div>
        
        <div class="admin-card neon-border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Inactive Customers</p>
                    <p class="text-2xl font-bold text-red-500">{{ number_format($stats['inactive']) }}</p>
                </div>
                <i class="fas fa-user-times text-3xl text-red-500"></i>
            </div>
        </div>
        
        <div class="admin-card neon-border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">New This Week</p>
                    <p class="text-2xl font-bold text-blue-500">{{ number_format($stats['recent']) }}</p>
                </div>
                <i class="fas fa-user-plus text-3xl text-blue-500"></i>
            </div>
        </div>
    </div>

    <div class="admin-card neon-border p-6 mb-8">
        <form method="GET" action="{{ route('admin.customers.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4" id="searchForm">
            <div>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search customers..." 
                       class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:border-neon focus:outline-none">
            </div>
            
            <div>
                <select name="status" class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:border-neon focus:outline-none">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                </select>
            </div>
            
            <div>
                <select name="sort_by" class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:border-neon focus:outline-none">
                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date Joined</option>
                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>Email</option>
                </select>
            </div>
            
            <div class="flex space-x-2">
                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-purple-600 to-cyan-500 text-white rounded-lg hover:from-purple-700 hover:to-cyan-600 transition flex-1">
                    <i class="fas fa-search mr-2"></i> Search
                </button>
                <a href="{{ route('admin.customers.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>

    <div class="admin-card neon-border overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-purple-900/50 to-cyan-900/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Joined</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($customers as $customer)
                    <tr class="hover:bg-gray-800/50 transition duration-300">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img class="h-10 w-10 rounded-full object-cover" 
                                     src="{{ $customer->photo_url ?? asset('avatar.png') }}" 
                                     alt="{{ $customer->name }}">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-white">{{ $customer->name }}</div>
                                    <div class="text-sm text-gray-400">{{ '@'.$customer->username }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-300">{{ $customer->email }}</div>
                            @if($customer->phone)
                                <div class="text-sm text-gray-400">{{ $customer->phone }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($customer->status === 'active') bg-green-900/50 text-green-300
                                @elseif($customer->status === 'inactive') bg-red-900/50 text-red-300
                                @else bg-yellow-900/50 text-yellow-300 @endif">
                                {{ ucfirst($customer->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                            {{ $customer->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('admin.customers.show', $customer) }}" 
                               class="text-neon hover:text-cyan-300 transition">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button onclick="changeStatus({{ $customer->id }})" 
                                    class="text-blue-400 hover:text-blue-300 transition">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteCustomer({{ $customer->id }})" 
                                    class="text-red-400 hover:text-red-300 transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <i class="fas fa-users text-4xl mb-4"></i>
                            <p class="text-lg">No customers found</p>
                            <p class="text-sm">Try adjusting your search criteria</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($customers->hasPages())
    <div class="mt-8">
        {{ $customers->links() }}
    </div>
    @endif
</div>

<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="admin-card neon-border max-w-md w-full p-6">
            <h3 class="text-lg font-bold text-white mb-4">Change Customer Status</h3>
            <form id="statusForm">
                <div class="mb-4">
                    <select id="newStatus" class="w-full px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="suspended">Suspended</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeStatusModal()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-purple-600 to-cyan-500 text-white rounded-lg hover:from-purple-700 hover:to-cyan-600">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
let currentCustomerId = null;

function changeStatus(customerId) {
    currentCustomerId = customerId;
    document.getElementById('statusModal').classList.remove('hidden');
}

function closeStatusModal() {
    document.getElementById('statusModal').classList.add('hidden');
    currentCustomerId = null;
}

document.getElementById('statusForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const status = document.getElementById('newStatus').value;
    
    fetch(`/admin/customers/${currentCustomerId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeStatusModal();
            window.location.reload();
        }
    });
});

function deleteCustomer(customerId) {
    if (confirm('Are you sure you want to delete this customer? This action cannot be undone.')) {
        fetch(`/admin/customers/${customerId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.querySelector('select[name="status"]');
    const sortSelect = document.querySelector('select[name="sort_by"]');
    
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            document.getElementById('searchForm').submit();
        });
    }
    
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            document.getElementById('searchForm').submit();
        });
    }
});
</script>
@endpush
@endsection
