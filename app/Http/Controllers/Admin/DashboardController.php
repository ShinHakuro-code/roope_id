<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Gallery;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_orders' => Order::count() ?? 0,
            'total_galleries' => Gallery::count(),
            'recent_products' => Product::latest()->take(5)->get()
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
