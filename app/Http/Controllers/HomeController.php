<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $criterias = \App\Models\Criteria::all();
        $categories = Category::with(['brands.score', 'brands.rankingResult'])->get();

        // Group ranking results per category for display
        $data = $categories->mapWithKeys(function($cat) {
            $rows = $cat->brands->map(function($b) {
                return [
                    'brand' => $b->name,
                    'harga' => $b->score?->harga ?? null,
                    'kualitas' => $b->score?->kualitas ?? null,
                    'minat_pasar' => $b->score?->minat_pasar ?? null,
                    'skor' => $b->rankingResult?->final_score ?? 0,
                ];
            });
            return [$cat->name => $rows];
        })->toArray();

        return view('compare', [
            'criterias' => $criterias,
            'categories' => $categories,
            'data' => $data,
        ]);
    }

    public function products(\Illuminate\Http\Request $request)
    {
        $query = Brand::with(['category', 'score', 'rankingResult']);

        // Filters from query string
        $categoryId = $request->query('category_id');
        $brandId    = $request->query('brand_id');
        $satuan     = $request->query('satuan');
        $sort       = $request->query('sort'); // price_asc, price_desc, best

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($brandId) {
            $query->where('id', $brandId);
        }

        if ($satuan) {
            $query->where('satuan', $satuan);
        }

        $brands = $query->get();

        // Sort in memory based on score->harga if requested
        if ($sort === 'price_asc') {
            $brands = $brands->sortBy(function($b) { return $b->score?->harga ?? PHP_INT_MAX; })->values();
        } elseif ($sort === 'price_desc') {
            $brands = $brands->sortByDesc(function($b) { return $b->score?->harga ?? 0; })->values();
        } elseif ($sort === 'best') {
            $brands = $brands->sortByDesc(function($b) { return $b->rankingResult?->final_score ?? 0; })->values();
        }

        $categories = Category::withCount('brands')->get();
        $brandsList = Brand::select('id','name')->get();
        $satuanList = Brand::whereNotNull('satuan')->pluck('satuan')->unique()->values();

        return view('products', compact('brands','categories','brandsList','satuanList','categoryId','brandId','satuan','sort'));
    }

    public function category($id)
    {
        $category = Category::with(['brands.rankingResult', 'brands.score'])->findOrFail($id);

        return view('category', [
            'category' => $category,
            'brands'   => $category->brands,
        ]);
    }
}
