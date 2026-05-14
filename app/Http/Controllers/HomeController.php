<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class HomeController extends Controller
{
    //
        public function index()
    {
        $featured = Product::with('category')
            ->where('is_active', true)
            ->where('featured', true)
            ->limit(8)
            ->get();

        return view('pages.home', compact('featured'));
    }

}
