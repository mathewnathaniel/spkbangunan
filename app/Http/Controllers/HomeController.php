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

        return view('components.welcome', compact('categories', 'featuredProducts'));
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

        return view('components.compare', [
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

        return view('components.products', compact('brands','categories','brandsList','satuanList','categoryId','brandId','satuan','sort'));
    }

    public function category($id)
    {
        $category = Category::with(['brands.rankingResult', 'brands.score'])->findOrFail($id);

        return view('components.category', [
            'category' => $category,
            'brands'   => $category->brands,
        ]);
    }

    public function show($id)
    {
        $brand = Brand::with(['category', 'score', 'rankingResult'])->findOrFail($id);

        return view('components.brand-show', [
            'brand' => $brand,
        ]);
    }

    public function search(Request $request)
    {
        $q = trim($request->query('q', ''));

        $brands = Brand::with(['category','score','rankingResult'])
            ->when($q !== '', function($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhereHas('category', function($c) use ($q) {
                        $c->where('name', 'like', "%{$q}%");
                    });
            })
            ->get();

        return view('components.search', compact('brands','q'));
    }

    public function assistant(Request $request)
    {
        return view('components.assistant');
    }

    public function assistantRecommend(Request $request)
    {
        $prompt = trim($request->input('prompt', ''));

        if ($prompt === '') {
            return response()->json(['error' => 'Masukkan pertanyaan atau kata kunci.'], 422);
        }

        $lower = mb_strtolower($prompt, 'UTF-8');

        // Try to match category keywords
        $categories = Category::all();
        $matchedCategory = null;
        foreach ($categories as $cat) {
            if (str_contains(mb_strtolower($cat->name, 'UTF-8'), $lower) || str_contains($lower, mb_strtolower($cat->name, 'UTF-8'))) {
                $matchedCategory = $cat;
                break;
            }
        }

        if ($matchedCategory) {
            $brands = Brand::with(['category','score','rankingResult'])
                ->where('category_id', $matchedCategory->id)
                ->get()
                ->sortByDesc(function($b) { return $b->rankingResult?->final_score ?? 0; })
                ->values()
                ->take(8);

            $explanation = "Rekomendasi untuk kategori: {$matchedCategory->name}";
        } else {
            // If user asks for "murah" or "hemat", recommend low price
            if (str_contains($lower, 'murah') || str_contains($lower, 'hemat') || str_contains($lower, 'tersedia murah')) {
                $brands = Brand::with(['category','score','rankingResult'])
                    ->get()
                    ->sortBy(function($b) { return $b->score?->harga ?? PHP_INT_MAX; })
                    ->values()
                    ->take(8);

                $explanation = 'Rekomendasi produk dengan harga terendah (murah).';
            } else {
                // Default: top ranked products
                $brands = Brand::with(['category','score','rankingResult'])
                    ->get()
                    ->sortByDesc(function($b) { return $b->rankingResult?->final_score ?? 0; })
                    ->values()
                    ->take(8);

                $explanation = 'Rekomendasi produk unggulan berdasarkan skor.';
            }
        }

        // Map to simple array for frontend
        $items = $brands->map(function($b) {
            return [
                'id' => $b->id,
                'name' => $b->name,
                'description' => $b->description,
                'image' => $b->image ? asset('storage/' . $b->image) : null,
                'url' => route('brand.show', $b->id),
                'price' => $b->score?->harga ? number_format($b->score->harga,0,',','.') : '-',
                'score' => $b->rankingResult?->final_score ?? 0,
                'category' => $b->category?->name,
            ];
        });

        return response()->json([
            'explanation' => $explanation,
            'items' => $items,
        ]);
    }
}

