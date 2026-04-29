@extends('layout.app')
@section('title', 'Shop')

@push('styles')
<style>
/* ── Reveal ── */

</style>
@endpush

@section('content')

<!-- ══════════════════════════════════
     SHOP HERO BANNER
══════════════════════════════════ -->
<section class="shop-hero pt-[68px] pb-14">
    <div class="max-w-7xl mx-auto px-5 lg:px-8 pt-12 relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-gray-400 mb-7">
            <a href="/" class="hover:text-plum transition-colors">Home</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-plum font-semibold">Shop</span>
        </nav>

        <div class="flex flex-col lg:flex-row items-start lg:items-end justify-between gap-6">
            <div>
                <span class="text-xs font-semibold text-plum uppercase tracking-widest">Our Collection</span>
                <h1 class="font-serif text-4xl lg:text-6xl font-bold text-gray-900 mt-2 leading-tight">
                    Baking <em class="grad-text not-italic">Tools &</em><br>Accessories
                </h1>
                <p class="text-gray-500 mt-3 text-sm max-w-md leading-relaxed">Over 350 professional-grade products for every baker — from beginner home bakers to seasoned pastry chefs.</p>
            </div>
            <!-- Quick-stat pills -->
            <div class="flex flex-wrap gap-3">
                <div class="bg-white border border-purple-100 rounded-2xl px-5 py-3 shadow-sm">
                    <p class="text-2xl font-serif font-bold grad-text">350+</p>
                    <p class="text-xs text-gray-400 mt-0.5">Products</p>
                </div>
                <div class="bg-white border border-purple-100 rounded-2xl px-5 py-3 shadow-sm">
                    <p class="text-2xl font-serif font-bold grad-text">8</p>
                    <p class="text-xs text-gray-400 mt-0.5">Categories</p>
                </div>
                <div class="bg-white border border-purple-100 rounded-2xl px-5 py-3 shadow-sm">
                    <p class="text-2xl font-serif font-bold grad-text">2-5d</p>
                    <p class="text-xs text-gray-400 mt-0.5">Delivery</p>
                </div>
            </div>
        </div>


    </div>
</section>


<!-- ══════════════════════════════════
     MAIN SHOP LAYOUT
══════════════════════════════════ -->
<section class="py-14" style="background:#faf8ff;">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">

            <!-- ── SIDEBAR ── -->
            <aside class="w-full lg:w-64 shrink-0 space-y-5">

                <!-- Search -->
                <div class="filter-section bg-white p-5 shadow-sm border border-purple-50">
                    <span class="filter-label">Search</span>
                    <div class="relative">
                        <input type="text" placeholder="Search products…"
                            class="w-full bg-purple-50 border border-purple-100 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-plum focus:ring-2 focus:ring-purple-100 transition-all pr-9 placeholder-gray-400">
                        <svg class="w-4 h-4 text-plum absolute right-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>

                <!-- Price Range -->
                <div class="filter-section bg-white p-5 shadow-sm border border-purple-50">
                    <span class="filter-label">Price Range</span>
                    <input type="range" min="0" max="50000" value="25000" class="price-range my-2" id="priceRange">
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>₦0</span>
                        <span class="font-semibold text-plum" id="priceVal">₦25,000</span>
                        <span>₦50,000</span>
                    </div>
                </div>

                <!-- Ratings -->
                <div class="filter-section bg-white p-5 shadow-sm border border-purple-50">
                    <span class="filter-label">Rating</span>
                    <div class="space-y-1">
                        @foreach([5,4,3,2] as $r)
                        <label class="check-item">
                            <input type="checkbox" {{ $r >= 4 ? 'checked' : '' }}>
                            <div class="flex text-yellow-400 text-xs">
                                @for($i=0;$i<$r;$i++)★
                                @endfor
                                @for($i=$r;$i<5;$i++)
                                ☆
                                @endfor
                            </div>
                            <span class="text-xs text-gray-500">& above</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Availability -->
                <div class="filter-section bg-white p-5 shadow-sm border border-purple-50">
                    <span class="filter-label">Availability</span>
                    <div class="space-y-1">
                        <label class="check-item"><input type="checkbox" checked><span class="text-sm text-gray-600">In Stock</span></label>
                        <label class="check-item"><input type="checkbox"><span class="text-sm text-gray-600">Pre-Order</span></label>
                        <label class="check-item"><input type="checkbox"><span class="text-sm text-gray-600">On Sale</span></label>
                    </div>
                </div>

                <!-- Clear filters -->
                <button class="w-full border-2 border-purple-200 text-plum font-semibold py-3 rounded-xl text-sm hover:bg-plum hover:text-white hover:border-plum transition-all">
                    Clear All Filters
                </button>
            </aside>


            <!-- ── PRODUCT GRID ── -->
            <div class="flex-1 min-w-0">

                <!-- Toolbar -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-7 bg-white border border-purple-50 rounded-2xl px-5 py-3.5 shadow-sm">
                    <p class="text-sm text-gray-500"><span class="font-semibold text-gray-800">350</span> products found</p>
                    <div class="flex items-center gap-3 flex-wrap">
                        <select class="sort-select" aria-label="Sort by">
                            <option>Sort: Featured</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest First</option>
                            <option>Best Rated</option>
                            <option>Most Popular</option>
                        </select>
                        <!-- View toggle -->
                        <div class="flex border border-purple-100 rounded-xl overflow-hidden bg-white">
                            <button id="gridView" class="p-2 bg-plum text-white transition-colors" title="Grid view">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            </button>
                            <button id="listView" class="p-2 text-gray-400 hover:text-plum transition-colors" title="List view">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Grid -->
                @php
                    $products = [
                        ['name'=>'Non-Stick Round Tin Set (3pc)','price'=>'8,500','old'=>'11,000','badge'=>'Bestseller','stars'=>5,'reviews'=>213,'emoji'=>'🍰','bg'=>'from-purple-50 to-purple-100','stock'=>true],
                        ['name'=>'Piping Tips Collection (24pc)','price'=>'6,200','old'=>null,'badge'=>'Popular','stars'=>5,'reviews'=>142,'emoji'=>'🎨','bg'=>'from-pink-50 to-rose-100','stock'=>true],
                        ['name'=>'Fondant Smoother & Cutter Set','price'=>'4,800','old'=>'6,500','badge'=>'Sale','stars'=>4,'reviews'=>89,'emoji'=>'🍬','bg'=>'from-fuchsia-50 to-pink-100','stock'=>true],
                        ['name'=>'Professional Turntable','price'=>'15,000','old'=>null,'badge'=>'Premium','stars'=>5,'reviews'=>367,'emoji'=>'🎠','bg'=>'from-indigo-50 to-purple-100','stock'=>true],
                        ['name'=>'Silicone Bundt Mould','price'=>'5,500','old'=>'7,000','badge'=>'New','stars'=>5,'reviews'=>54,'emoji'=>'🧁','bg'=>'from-purple-100 to-pink-50','stock'=>true],
                        ['name'=>'Cake Board Bundle (10pc)','price'=>'3,200','old'=>null,'badge'=>null,'stars'=>4,'reviews'=>71,'emoji'=>'🎀','bg'=>'from-rose-50 to-pink-100','stock'=>true],
                        ['name'=>'Offset Spatula Set (3pc)','price'=>'4,100','old'=>'5,500','badge'=>'Sale','stars'=>5,'reviews'=>98,'emoji'=>'🔪','bg'=>'from-pink-50 to-purple-50','stock'=>true],
                        ['name'=>"Baker's Starter Kit",'price'=>'22,000','old'=>null,'badge'=>'Gift','stars'=>5,'reviews'=>201,'emoji'=>'🎁','bg'=>'from-purple-50 to-indigo-100','stock'=>true],
                        ['name'=>'Flower Nail Set (12pc)','price'=>'2,800','old'=>null,'badge'=>null,'stars'=>4,'reviews'=>33,'emoji'=>'🌸','bg'=>'from-pink-50 to-rose-50','stock'=>true],
                        ['name'=>'Silicone Lace Mat','price'=>'3,900','old'=>'5,200','badge'=>'Sale','stars'=>4,'reviews'=>45,'emoji'=>'🕸️','bg'=>'from-purple-50 to-fuchsia-50','stock'=>false],
                        ['name'=>'Cake Dummy Set (5pc)','price'=>'7,500','old'=>null,'badge'=>'Pro','stars'=>5,'reviews'=>19,'emoji'=>'🎂','bg'=>'from-indigo-50 to-purple-50','stock'=>true],
                        ['name'=>'Pastry Brush Set','price'=>'2,100','old'=>null,'badge'=>null,'stars'=>4,'reviews'=>62,'emoji'=>'🖌️','bg'=>'from-yellow-50 to-pink-50','stock'=>true],
                    ];
                @endphp

                <div id="productGrid" class="grid grid-cols-2 xl:grid-cols-3 gap-4">
                    @foreach($products as $i => $p)
                    <div class="prod-card reveal d{{ ($i%4)+1 }}">
                        @if($p['badge'])
                        <div class="absolute top-3 left-3 z-10">
                            <span class="text-xs font-semibold text-white px-3 py-1 rounded-full shadow
                                {{ $p['badge']==='Sale' ? 'bg-blush' : ($p['badge']==='Premium'||$p['badge']==='Pro'||$p['badge']==='Gift' ? 'bg-gray-800' : 'bg-plum') }}">
                                {{ $p['badge'] }}
                            </span>
                        </div>
                        @endif
                        @if(!$p['stock'])
                        <div class="absolute top-3 right-12 z-10">
                            <span class="text-xs font-semibold text-white bg-gray-400 px-3 py-1 rounded-full shadow">Out of Stock</span>
                        </div>
                        @endif
                        <button class="absolute top-3 right-3 z-10 w-8 h-8 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:scale-110 hover:bg-plum group transition-all shadow">
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </button>
                        <div class="relative overflow-hidden">
                            <div class="prod-img bg-gradient-to-br {{ $p['bg'] }}">
                                <span class="text-7xl select-none">{{ $p['emoji'] }}</span>
                            </div>
                            <div class="hover-actions">
                                <button class="bg-white text-plum text-xs font-bold px-4 py-2 rounded-full hover:scale-105 transition-transform shadow">Quick View</button>
                                @if($p['stock'])
                                <button class="bg-white text-blush text-xs font-bold px-4 py-2 rounded-full hover:scale-105 transition-transform shadow">Add to Cart</button>
                                @endif
                            </div>
                        </div>
                        <div class="p-4">
                            <p class="font-medium text-gray-900 text-sm mb-1 line-clamp-2 leading-snug">{{ $p['name'] }}</p>
                            <div class="flex items-center gap-1 mb-2">
                                @for($s=0;$s<$p['stars'];$s++)<svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                                <span class="text-xs text-gray-400">({{ $p['reviews'] }})</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-plum text-sm">₦{{ $p['price'] }}</span>
                                @if($p['old'])<span class="text-xs text-gray-400 line-through">₦{{ $p['old'] }}</span>@endif
                            </div>
                        </div>
                        <div class="border-t border-gray-50 px-4 py-3">
                            @if($p['stock'])
                            <button class="w-full btn-primary text-xs font-semibold py-2.5 rounded-full hover:scale-[1.02] transition-transform shadow">
                                🛒 Add to Cart
                            </button>
                            @else
                            <button class="w-full bg-gray-100 text-gray-400 text-xs font-semibold py-2.5 rounded-full cursor-not-allowed" disabled>
                                Notify Me
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-12 pt-8 border-t border-purple-50">
                    <p class="text-xs text-gray-400">Showing <span class="font-semibold text-gray-700">1–12</span> of <span class="font-semibold text-gray-700">350</span> products</p>
                    <div class="flex items-center gap-2">
                        <button class="page-btn" title="Previous">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        @foreach([1,2,3,'…',29] as $pg)
                        <button class="page-btn {{ $pg===1 ? 'active' : '' }}">{{ $pg }}</button>
                        @endforeach
                        <button class="page-btn" title="Next">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

            </div>{{-- end product grid --}}
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>

</script>
@endpush