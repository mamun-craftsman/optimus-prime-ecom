<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        $search = $request->get('search');
        $perPage = $request->get('per_page', 15);

        $query = Order::with(['user', 'orderItems.product'])
            ->select([
                'orders.*',
                DB::raw('(SELECT COUNT(*) FROM order_items WHERE order_items.order_id = orders.id) as items_count')
            ]);

        switch ($status) {
            case 'pending':
                $query->whereIn('order_status', ['pending', 'processing']);
                break;
            case 'completed':
                $query->where('order_status', 'shipped');
                break;
            case 'cancelled':
                $query->where('order_status', 'cancelled');
                break;
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'LIKE', "%{$search}%")
                  ->orWhere('full_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%")
                  ->orWhere('transaction_id', 'LIKE', "%{$search}%");
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate($perPage);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.orders.partials.table', compact('orders'))->render(),
                'pagination' => view('admin.orders.partials.pagination', compact('orders'))->render(),
                'total' => $orders->total(),
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage()
            ]);
        }

        return view('admin.orders.index', compact('orders', 'status', 'search'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order->update(['order_status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully'
        ]);
    }

    public function getStatusCounts()
    {
        $counts = [
            'all' => Order::count(),
            'pending' => Order::whereIn('order_status', ['pending', 'processing'])->count(),
            'completed' => Order::where('order_status', 'shipped')->count(),
            'cancelled' => Order::where('order_status', 'cancelled')->count(),
        ];

        return response()->json($counts);
    }

    public function destroy(Order $order)
    {
        try {
            $order->orderItems()->delete();
            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting order'
            ], 500);
        }
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,update_status',
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id'
        ]);

        $orderIds = $request->order_ids;

        try {
            switch ($request->action) {
                case 'delete':
                    OrderItem::whereIn('order_id', $orderIds)->delete();
                    Order::whereIn('id', $orderIds)->delete();
                    $message = 'Orders deleted successfully';
                    break;

                case 'update_status':
                    $request->validate(['status' => 'required|in:pending,processing,shipped,delivered,cancelled']);
                    Order::whereIn('id', $orderIds)->update(['order_status' => $request->status]);
                    $message = 'Order status updated successfully';
                    break;
            }

            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error processing bulk action'], 500);
        }
    }

    public function export(Request $request)
    {
        $status = $request->get('status', 'all');
        $search = $request->get('search');

        $query = Order::with(['user', 'orderItems.product']);

        switch ($status) {
            case 'pending':
                $query->whereIn('order_status', ['pending', 'processing']);
                break;
            case 'completed':
                $query->where('order_status', 'shipped');
                break;
            case 'cancelled':
                $query->where('order_status', 'cancelled');
                break;
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'LIKE', "%{$search}%")
                  ->orWhere('full_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%")
                  ->orWhere('transaction_id', 'LIKE', "%{$search}%");
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        $csvData = [];
        $csvData[] = ['Order ID', 'Customer', 'Email', 'Phone', 'Date', 'Items', 'Total', 'Status', 'Payment Method'];

        foreach ($orders as $order) {
            $items = $order->orderItems->pluck('product.name')->join(', ');
            $csvData[] = [
                $order->order_number,
                $order->full_name,
                $order->email,
                $order->phone,
                $order->created_at->format('Y-m-d H:i:s'),
                $items,
                $order->total,
                $order->order_status,
                $order->payment_method
            ];
        }

        $filename = 'orders_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $handle = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
        
        fclose($handle);
        exit;
    }
}
