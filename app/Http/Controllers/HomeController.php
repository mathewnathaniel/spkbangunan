<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch categories with some brands for the carousel/featured
        $categories = Category::with('brands')->get();
        
        // Fetch featured products (top 6 highest ranking from ranking_results, or just random/latest if no ranking yet)
        $featuredProducts = Brand::with('category', 'rankingResult')
            ->get()
            ->sortBy(function($brand) {
                return $brand->rankingResult->ranking ?? 999;
            })
            ->take(6);

        return view('welcome', compact('categories', 'featuredProducts'));
    }

    public function compare()
    {
        // Placeholder for comparison page
        return view('compare');
    }
}
