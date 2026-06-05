<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $currency = $request->get('currency', 'LRD');

        $query = Product::with('categories');

    // Search
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%");
        });
    }

    // Category filter (ONLY if selected)
    if ($request->filled('category')) {

        $query->whereHas('categories', function ($q) use ($request) {
            $q->where('categories.id', $request->category);
        });
    }

    // Price filter
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }
        // Sort — use if/else, NOT match (match returns a value, doesn't chain)
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            default:
                $query->orderBy('featured', 'desc')->latest();
                break;
        }

        $products   = $query->paginate(12)->withQueryString();

        $products->getCollection()->transform(function ($product) use ($currency) {

            $product->display_price = $this->convertCurrency(
                $product->price,
                $product->currency,
                $currency
            );
        
            return $product;
        });

        
        $categories = Category::withCount('products')->get();

        return view('pages.shop', compact('products', 'categories', 'currency'));
    }

    private function convertCurrency(float $amount, string $from, string $to): float
{
    if ($from === $to) {
        return $amount;
    }

    $rates = [
        'USD' => [
            'NGN' => 1361,
            'LRD' => 182.47,
        ],
        'NGN' => [
            'USD' => 0.00073,
            'LRD' => 0.13,
        ],
        'LRD' => [
            'USD' => 0.0055,
            'NGN' => 7.46,
        ],
    ];

    return $amount * ($rates[$from][$to] ?? 1);
}
}