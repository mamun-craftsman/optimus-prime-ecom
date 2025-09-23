<div class="table-container">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-700">
                <th class="py-3 text-left text-gray-400">
                    <input type="checkbox" id="selectAll" class="rounded">
                </th>
                <th class="py-3 text-left text-gray-400">Order ID</th>
                <th class="py-3 text-left text-gray-400">Customer</th>
                <th class="py-3 text-left text-gray-400">Date</th>
                <th class="py-3 text-left text-gray-400">Items</th>
                <th class="py-3 text-left text-gray-400">Total</th>
                <th class="py-3 text-left text-gray-400">Status</th>
                <th class="py-3 text-left text-gray-400">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr class="border-b border-gray-800 hover:bg-gray-800">
                <td class="py-4">
                    <input type="checkbox" class="order-checkbox rounded" value="{{ $order->id }}">
                </td>
                <td class="py-4 text-white">#{{ $order->order_number }}</td>
                <td class="py-4 text-gray-300">
                    <div>
                        <div class="font-medium">{{ $order->full_name }}</div>
                        <div class="text-sm text-gray-500">{{ $order->email }}</div>
                    </div>
                </td>
                <td class="py-4 text-gray-400">{{ $order->created_at->format('M d, Y') }}</td>
                <td class="py-4 text-gray-400">
                    <div class="max-w-xs truncate">
                        @if($order->orderItems->count() > 0)
                            @foreach($order->orderItems->take(2) as $item)
                                {{ $item->product->name ?? 'Product' }}@if(!$loop->last), @endif
                            @endforeach
                            @if($order->orderItems->count() > 2)
                                <span class="text-gray-500">+{{ $order->orderItems->count() - 2 }} more</span>
                            @endif
                        @endif
                    </div>
                    <div class="text-xs text-gray-500">{{ $order->items_count ?? $order->orderItems->count() }} items</div>
                </td>
                <td class="py-4 text-white">৳{{ number_format($order->total, 2) }}</td>
                <td class="py-4">
                    @php
                        $statusClass = 'status-pending';
                        $icon = 'fas fa-clock';
                        $text = ucfirst($order->order_status);
                        
                        if(in_array($order->order_status, ['shipped', 'delivered'])) {
                            $statusClass = 'status-success';
                            $icon = $order->order_status === 'shipped' ? 'fas fa-truck' : 'fas fa-check-circle';
                            $text = $order->order_status === 'shipped' ? 'Completed' : 'Delivered';
                        } elseif($order->order_status === 'cancelled') {
                            $statusClass = 'status-cancelled';
                            $icon = 'fas fa-times-circle';
                            $text = 'Cancelled';
                        } elseif($order->order_status === 'processing') {
                            $text = 'Pending';
                        }
                    @endphp
                    <span class="{{ $statusClass }}">
                        <i class="{{ $icon }} mr-1"></i> {{ $text }}
                    </span>
                </td>
                <td class="py-4">
                    <button class="text-neon hover:text-purple-400 mr-3 view-order" 
                            data-id="{{ $order->id }}" 
                            data-number="{{ $order->order_number }}">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="text-red-500 hover:text-red-400 delete-order" 
                            data-id="{{ $order->id }}" 
                            data-number="{{ $order->order_number }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="py-8 text-center text-gray-400">
                    <i class="fas fa-inbox text-4xl mb-4"></i>
                    <p class="text-lg">No orders found</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
