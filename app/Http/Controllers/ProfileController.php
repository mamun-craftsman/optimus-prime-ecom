<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        $customer = $user->customer;
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('home.profile.index', compact('user', 'customer', 'orders'));
    }

    public function edit()
    {
        $user = User::find(Auth::id());
        $customer = $user->customer;
        
        return view('home.profile.edit', compact('user', 'customer'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'parmanent_addr' => 'nullable|string',
            'shipping_addr' => 'nullable|string'
        ]);

        $user = User::find(Auth::id());
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone
        ]);

        if ($user->customer) {
            $user->customer->update([
                'permanent_addr' => $request->parmanent_addr,
                'shipping_addr' => $request->shipping_addr
            ]);
        }

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::find(Auth::id());
        
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('profile.index')->with('success', 'Password updated successfully');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = User::find(Auth::id());

        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $photoPath = $request->file('photo')->store('profile_photos', 'public');

        $user->update(['photo' => $photoPath]);

        return redirect()->route('profile.index')->with('success', 'Photo updated successfully');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('home.profile.orders', compact('orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);
            
        return view('home.profile.order-details', compact('order'));
    }
}
