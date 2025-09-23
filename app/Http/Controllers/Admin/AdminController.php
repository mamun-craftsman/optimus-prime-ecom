<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function analytics()
    {
        $totalRevenue = Order::where('order_status', 'shipped')->sum('total') ?? 0;
        $totalOrders = Order::count() ?? 0;
        $totalUsers = User::count() ?? 0;
        $totalProducts = Product::count() ?? 0;
        
        $currentMonth = now();
        $lastMonth = now()->subMonth();
        
        $currentRevenue = Order::where('order_status', 'shipped')
            ->whereMonth('created_at', $currentMonth->month)
            ->whereYear('created_at', $currentMonth->year)
            ->sum('total') ?? 0;
            
        $lastRevenue = Order::where('order_status', 'shipped')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('total') ?? 0;
            
        $revenueGrowth = $lastRevenue > 0 ? round((($currentRevenue - $lastRevenue) / $lastRevenue) * 100, 1) : 0;
        
        $currentOrders = Order::whereMonth('created_at', $currentMonth->month)
            ->whereYear('created_at', $currentMonth->year)
            ->count() ?? 0;
            
        $lastOrders = Order::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count() ?? 0;
            
        $ordersGrowth = $lastOrders > 0 ? round((($currentOrders - $lastOrders) / $lastOrders) * 100, 1) : 0;
        
        $currentUsers = User::whereMonth('created_at', $currentMonth->month)
            ->whereYear('created_at', $currentMonth->year)
            ->count() ?? 0;
            
        $lastUsers = User::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count() ?? 0;
            
        $usersGrowth = $lastUsers > 0 ? round((($currentUsers - $lastUsers) / $lastUsers) * 100, 1) : 0;
        
        $conversionRate = $totalUsers > 0 ? round(($totalOrders / $totalUsers) * 100, 2) : 0;
        
        $revenueData = $this->getMonthlyRevenue();
        $monthlyLabels = $this->getMonthlyLabels();
        
        $categoryData = $this->getOrdersByCategory();
        
        $analytics = [
            'total_revenue' => $totalRevenue,
            'total_orders' => $totalOrders,
            'total_users' => $totalUsers,
            'total_products' => $totalProducts,
            'revenue_growth' => $revenueGrowth,
            'orders_growth' => $ordersGrowth,
            'users_growth' => $usersGrowth,
            'conversion_rate' => $conversionRate,
            
            'revenue_chart' => [
                'labels' => $monthlyLabels,
                'data' => $revenueData
            ],
            
            'orders_chart' => [
                'labels' => $categoryData['labels'],
                'data' => $categoryData['data']
            ]
        ];
        
        return view('admin.analytics', compact('analytics'));
    }
    
 
    private function getMonthlyRevenue()
    {
        $months = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $revenue = Order::where('order_status', 'shipped')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total') ?? 0;
            $months[] = $revenue;
        }
        return $months;
    }
    
  
    private function getMonthlyLabels()
    {
        $labels = [];
        for ($i = 11; $i >= 0; $i--) {
            $labels[] = now()->subMonths($i)->format('M Y');
        }
        return $labels;
    }
    
    
    private function getOrdersByCategory()
    {
        return [
            'labels' => ['Smartphone', 'Accessories', 'Laptop', 'Camera', 'Desktop', 'Tv and Monitors'],
            'data' => [35, 20, 15, 12, 10, 8]
        ];
    }
}
