@extends('layouts.admin')

@section('content')
<style>
    .status-pending { color: #f59e0b; }
    .status-success { color: #10b981; }
    .status-cancelled { color: #ef4444; }
    .order-card { background: rgba(30, 41, 59, 0.8); border: 1px solid #00f7ff; border-radius: 12px; }
    .order-detail-item { border-bottom: 1px solid #374151; padding: 12px 0; }
    .order-detail-item:last-child { border-bottom: none; }
</style>

<div class="container mx-auto px-4 py-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold section-title text-white mb-2 glow-text">ORDER DETAILS</h2>
            <p class="text-gray-400">Order #{{ $order->order_number }}</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn-secondary px-6 py-3 rounded-lg text-white font-bold">
            <i class="fas fa-arrow-left mr-2"></i> Back to Orders
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="order-card p-6 mb-6">
                <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-shopping-bag mr-2 text-neon"></i>
                    Order Items ({{ $order->orderItems->count() }})
                </h3>
                
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                    <div class="flex items-start space-x-4 p-4 bg-gray-800 rounded-lg">
                        <div class="flex-shrink-0 w-16 h-16">
                            @if($item->product && $item->product->primary_image)
                                <img src="{{ asset('storage/' . $item->product->primary_image) }}" 
                                     alt="{{ $item->product->name ?? 'Product' }}" 
                                     class="w-full h-full object-cover rounded">
                            @else
                                <div class="w-full h-full bg-gray-600 rounded flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex-grow">
                            <h4 class="text-white font-medium">{{ $item->product->name ?? 'Product Not Found' }}</h4>
                            <p class="text-gray-400 text-sm">Quantity: {{ $item->quantity }}</p>
                            
                            @inject('variationModel', 'App\Models\ProductVariation')

                            @if($item->variations)
                                @php
                                    $variationIds = json_decode($item->variations, true);
                                    $variations = $variationModel->whereIn('id', $variationIds)->get()->keyBy('id');
                                @endphp
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach($variationIds as $variationId)
                                        <span class="bg-neon/20 text-neon text-xs px-2 py-1 rounded-full">
                                            {{ $variations->get($variationId)?->name ?? 'Variation #' . $variationId }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif


                        </div>
                        
                        <div class="text-right">
                            <p class="text-white font-bold">৳{{ number_format($item->price, 2) }}</p>
                            <p class="text-gray-400 text-sm">Per item</p>
                            <p class="text-neon font-bold mt-1">৳{{ number_format($item->price * $item->quantity, 2) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="order-card p-6">
                <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-credit-card mr-2 text-neon"></i>
                    Payment Information
                </h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="order-detail-item">
                        <p class="text-gray-400 text-sm">Payment Method</p>
                        <p class="text-white font-medium">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                    </div>
                    
                    <div class="order-detail-item">
                        <p class="text-gray-400 text-sm">Payment Status</p>
                        <p class="text-white font-medium">
                            @if($order->payment_status === 'paid')
                                <span class="status-success">
                                    <i class="fas fa-check-circle mr-1"></i> Paid
                                </span>
                            @elseif($order->payment_status === 'failed')
                                <span class="status-cancelled">
                                    <i class="fas fa-times-circle mr-1"></i> Failed
                                </span>
                            @else
                                <span class="status-pending">
                                    <i class="fas fa-clock mr-1"></i> {{ ucfirst($order->payment_status) }}
                                </span>
                            @endif
                        </p>
                    </div>
                    
                    @if($order->transaction_id)
                    <div class="order-detail-item">
                        <p class="text-gray-400 text-sm">Transaction ID</p>
                        <p class="text-white font-medium font-mono">{{ $order->transaction_id }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="order-card p-6 mb-6">
                <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-neon"></i>
                    Order Summary
                </h3>
                
                <div class="space-y-3">
                    <div class="order-detail-item">
                        <p class="text-gray-400 text-sm">Order Date</p>
                        <p class="text-white">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                    
                    <div class="order-detail-item">
                        <p class="text-gray-400 text-sm">Order Status</p>
                        <div class="mt-2">
                            <select id="orderStatus" class="input-field px-3 py-2 rounded-lg text-white w-full">
                                <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button id="updateStatusBtn" class="btn-primary w-full mt-2 py-2 rounded-lg text-white font-bold">
                                <i class="fas fa-save mr-2"></i> Update Status
                            </button>
                        </div>
                    </div>
                    
                    <div class="order-detail-item">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Subtotal</span>
                            <span class="text-white">৳{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                    </div>
                    
                    <div class="order-detail-item">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Shipping</span>
                            <span class="text-white">৳{{ number_format($order->shipping, 2) }}</span>
                        </div>
                    </div>
                    
                    <div class="order-detail-item">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Tax</span>
                            <span class="text-white">৳{{ number_format($order->tax, 2) }}</span>
                        </div>
                    </div>
                    
                    <div class="order-detail-item border-t-2 border-neon pt-3">
                        <div class="flex justify-between">
                            <span class="text-white font-bold text-lg">Total</span>
                            <span class="text-neon font-bold text-lg">৳{{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="order-card p-6 mb-6">
                <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-user mr-2 text-neon"></i>
                    Customer Details
                </h3>
                
                <div class="space-y-3">
                    <div class="order-detail-item">
                        <p class="text-gray-400 text-sm">Name</p>
                        <p class="text-white">{{ $order->full_name }}</p>
                    </div>
                    
                    <div class="order-detail-item">
                        <p class="text-gray-400 text-sm">Email</p>
                        <p class="text-white">{{ $order->email }}</p>
                    </div>
                    
                    <div class="order-detail-item">
                        <p class="text-gray-400 text-sm">Phone</p>
                        <p class="text-white">{{ $order->phone }}</p>
                    </div>
                    
                    @if($order->user)
                    <div class="order-detail-item">
                        <p class="text-gray-400 text-sm">Account</p>
                        <p class="text-white">Registered User</p>
                    </div>
                    @else
                    <div class="order-detail-item">
                        <p class="text-gray-400 text-sm">Account</p>
                        <p class="text-gray-400">Guest Order</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="order-card p-6">
                <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-shipping-fast mr-2 text-neon"></i>
                    Shipping Address
                </h3>
                
                <div class="text-white leading-relaxed">
                    {{ $order->address }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#updateStatusBtn').on('click', function() {
        const newStatus = $('#orderStatus').val();
        const currentStatus = '{{ $order->order_status }}';
        
        if (newStatus === currentStatus) {
            alert('Status is already ' + newStatus);
            return;
        }
        
        if (confirm('Update order status to ' + newStatus + '?')) {
            $.ajax({
                url: '{{ route("admin.orders.updateStatus", $order->id) }}',
                type: 'PATCH',
                data: { status: newStatus },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload();
                    }
                },
                error: function() {
                    alert('Error updating order status');
                }
            });
        }
    });
});
</script>
@endpush
@endsection
