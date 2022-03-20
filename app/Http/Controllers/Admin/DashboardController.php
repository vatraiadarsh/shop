<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index(){

        return view('admin.dashboard', [
            'total_categories' => Category::count(),
            'total_products' => Product::count(),
            'total_active_categories' => Category::where('status', '=', 'on')->count(),
            'total_active_products' => Product::where('status', '=', 'on')->count()

        ]);
    }
}
