<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_active', true)
            ->with('category')
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::with(['products' => function ($query) {
            $query->where('is_active', true)->take(4);
        }])->get();

        return view('user.home', compact('featuredProducts', 'categories'));
    }
}
