<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Testimonial;

class HomeController extends Controller
{
    //
        public function index()
    {
        $featured = Product::with('categories')
            ->where('is_active', true)
            ->where('featured', true)
            ->limit(8)
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('sort_order')
            ->latest()
            ->get();

        return view('pages.home', compact('featured', 'testimonials'));
    }

}
