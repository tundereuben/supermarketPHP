<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;

class AdminController extends Controller
{
    public function dashboard()
    {
        $metrics = [
            ['label' => 'Gross Sales Revenue', 'value' => '₦' . number_format((int) Order::sum('total')), 'icon' => 'fa-wallet', 'tone' => 'emerald'],
            ['label' => 'Fulfillment Volume', 'value' => Order::count() . ' Orders', 'icon' => 'fa-truck-fast', 'tone' => 'blue'],
            ['label' => 'Active Food Baskets', 'value' => UserSubscription::where('status', 'active')->count() . ' Plans', 'icon' => 'fa-basket-shopping', 'tone' => 'purple'],
            ['label' => 'Low Stock Alerts', 'value' => Product::where('stock', '<', 10)->count() . ' SKUs', 'icon' => 'fa-triangle-exclamation', 'tone' => 'orange'],
        ];

        return view('admin.dashboard', [
            'metrics' => $metrics,
            'orders' => Order::with('user', 'items')->latest()->take(5)->get(),
        ]);
    }

    public function orders()
    {
        return view('admin.orders.index', ['orders' => Order::with('user', 'items')->latest()->paginate(20)]);
    }

    public function products()
    {
        return view('admin.products.index', ['products' => Product::with('category')->paginate(20)]);
    }

    public function subscriptions()
    {
        return view('admin.subscriptions.index', ['subscriptions' => Subscription::paginate(10)]);
    }

    public function customers()
    {
        return view('admin.customers.index', [
            'customers' => User::where('role', 'customer')->with('orders')->paginate(20),
        ]);
    }
}
