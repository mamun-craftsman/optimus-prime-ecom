<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('customer')->where(function($q) {
            $q->where('role', 'customer')->orWhereHas('customer');
        });
            
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('username', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        if (in_array($sortBy, ['name', 'email', 'created_at', 'phone'])) {
            $query->orderBy($sortBy, $sortOrder);
        }
        
        $customers = $query->paginate(15)->withQueryString();
        
        $stats = [
            'total' => User::where('role', 'customer')->count(),
            'active' => User::where('role', 'customer')->where('status', 'active')->count(),
            'inactive' => User::where('role', 'customer')->where('status', 'inactive')->count(),
            'recent' => User::where('role', 'customer')->where('created_at', '>=', now()->subDays(7))->count(),
        ];
        
        return view('admin.customers.index', compact('customers', 'stats'));
    }
    
    public function show(User $customer)
    {
        if ($customer->role !== 'customer' && !$customer->customer) {
            abort(404);
        }
        
        $customer->load(['customer', 'customer.reviews', 'customer.wishlists', 'customer.carts']);
        
        $customerStats = [
            'reviews_count' => $customer->customer?->reviews()->count() ?? 0,
            'wishlists_count' => $customer->customer?->wishlists()->count() ?? 0,
            'carts_count' => $customer->customer?->carts()->count() ?? 0,
            'member_since' => $customer->created_at->diffForHumans(),
            'last_seen' => $customer->updated_at->diffForHumans(),
        ];
        
        return view('admin.customers.show', compact('customer', 'customerStats'));
    }
    
    public function updateStatus(Request $request, User $customer)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,suspended'
        ]);
        
        $customer->update([
            'status' => $request->status
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Customer status updated successfully!'
        ]);
    }
    
    public function destroy(User $customer)
    {
        if ($customer->role !== 'customer') {
            return response()->json([
                'success' => false,
                'message' => 'Invalid customer!'
            ], 400);
        }
        
        if ($customer->customer) {
            $customer->customer->delete();
        }
        
        $customer->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Customer deleted successfully!'
        ]);
    }
}
