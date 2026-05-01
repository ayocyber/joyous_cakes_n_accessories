@extends('layout.app')
@section('title', 'Shop')

@push('styles')
<style>
/* ── Reveal ── */

/* ── Add-to-cart button states ── */
.add-to-cart-btn {
    position: relative;
    overflow: hidden;
    transition: all .25s ease;
}
.add-to-cart-btn.added {
    background: linear-gradient(135deg, #16a34a, #15803d) !important;
    border-color: #16a34a !important;
}
.add-to-cart-btn .btn-label { transition: opacity .2s, transform .2s; }
.add-to-cart-btn .btn-label-added {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .35rem;
    opacity: 0;
    transform: translateY(6px);
    transition: opacity .2s, transform .2s;
}
.add-to-cart-btn.added .btn-label { opacity: 0; transform: translateY(-6px); }
.add-to-cart-btn.added .btn-label-added { opacity: 1; transform: translateY(0); }

/* ── Cart added pop feedback ── */
@keyframes cartPop {
    0%   { transform: scale(1); }
    40%  { transform: scale(1.18); }
    70%  { transform: scale(.94); }
    100% { transform: scale(1); }
}
.cart-pop { animation: cartPop .4s cubic-bezier(.34,1.56,.64,1); }
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

          {{-- ── SIDEBAR / FILTER ── --}}
<aside class="w-full lg:w-64 shrink-0">

    {{-- Mobile: Filter toggle button (hidden on desktop) --}}
    <div class="lg:hidden mb-4">
        <button id="filterToggle"
            class="w-full flex items-center justify-between bg-white border border-purple-100 rounded-2xl px-5 py-3.5 shadow-sm text-sm font-semibold text-gray-800">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4 text-plum" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                </svg>
                Filters
            </span>
            <span id="filterBadge" class="hidden bg-plum text-white text-xs font-bold px-2 py-0.5 rounded-full">3</span>
            <svg id="filterChevron" class="w-4 h-4 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
    </div>

    {{-- Filter panel — collapsible on mobile, always visible on desktop --}}
    <div id="filterPanel"
         class="overflow-hidden transition-all duration-300 ease-in-out
                max-h-0 lg:max-h-none
                space-y-5">

        {{-- Search --}}
        <div class="filter-section bg-white p-5 shadow-sm border border-purple-50">
            <span class="filter-label">Search</span>
            <div class="relative">
                <input type="text" placeholder="Search products…"
                    class="w-full bg-purple-50 border border-purple-100 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-plum focus:ring-2 focus:ring-purple-100 transition-all pr-9 placeholder-gray-400">
                <svg class="w-4 h-4 text-plum absolute right-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        {{-- Price Range --}}
        <div class="filter-section bg-white p-5 shadow-sm border border-purple-50">
            <span class="filter-label">Price Range</span>
            <input type="range" min="0" max="50000" value="25000" class="price-range my-2" id="priceRange">
            <div class="flex justify-between text-xs text-gray-500 mt-1">
                <span>₦0</span>
                <span class="font-semibold text-plum" id="priceVal">₦25,000</span>
                <span>₦50,000</span>
            </div>
        </div>

        {{-- Ratings --}}
        <div class="filter-section bg-white p-5 shadow-sm border border-purple-50">
            <span class="filter-label">Rating</span>
            <div class="space-y-1">
                @foreach([5,4,3,2] as $r)
                <label class="check-item">
                    <input type="checkbox" {{ $r >= 4 ? 'checked' : '' }}>
                    <div class="flex text-yellow-400 text-xs">
                        @for($i=0;$i<$r;$i++)★@endfor
                        @for($i=$r;$i<5;$i++)☆@endfor
                    </div>
                    <span class="text-xs text-gray-500">& above</span>
                </label>
                @endforeach
            </div>
        </div>

        {{-- Availability --}}
        <div class="filter-section bg-white p-5 shadow-sm border border-purple-50">
            <span class="filter-label">Availability</span>
            <div class="space-y-1">
                <label class="check-item"><input type="checkbox" checked><span class="text-sm text-gray-600">In Stock</span></label>
                <label class="check-item"><input type="checkbox"><span class="text-sm text-gray-600">Pre-Order</span></label>
                <label class="check-item"><input type="checkbox"><span class="text-sm text-gray-600">On Sale</span></label>
            </div>
        </div>

        {{-- Clear filters --}}
        <button class="w-full border-2 border-purple-200 text-plum font-semibold py-3 rounded-xl text-sm hover:bg-plum hover:text-white hover:border-plum transition-all">
            Clear All Filters
        </button>
    </div>
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
                        ['id'=>1, 'name'=>'Paper box','price'=>8500,'old'=>'11,000','badge'=>'Bestseller','stars'=>5,'reviews'=>213,'image'=>'images/6_6_6_ paper-boxes.jpeg','bg'=>'from-purple-50 to-purple-100','stock'=>20],
                        ['id'=>2, 'name'=>'White Cake Board','price'=>6200,'old'=>null,'badge'=>'Popular','stars'=>5,'reviews'=>142,'image'=>'images/8_,10_,12,14_,16_  white cake boards.jpeg','bg'=>'from-pink-50 to-rose-100','stock'=>15],
                        ['id'=>3, 'name'=>'Birthday Coin Toppers','price'=>4800,'old'=>'6,500','badge'=>'Sale','stars'=>4,'reviews'=>89,'image'=>'images/Birthday-coin-toppers.jpeg','bg'=>'from-fuchsia-50 to-pink-100','stock'=>30],
                        ['id'=>4, 'name'=>'Birthday Toppers','price'=>15000,'old'=>null,'badge'=>'Premium','stars'=>5,'reviews'=>367,'image'=>'images/Birthday-toppers 2.jpeg','bg'=>'from-indigo-50 to-purple-100','stock'=>10],
                        ['id'=>5, 'name'=>'Cake Dowel','price'=>5500,'old'=>'7,000','badge'=>'New','stars'=>5,'reviews'=>54,'image'=>'images/Cake dowel.jpeg','bg'=>'from-purple-100 to-pink-50','stock'=>25],
                        ['id'=>6, 'name'=>'Whipped Cream Powder','price'=>3200,'old'=>null,'badge'=>null,'stars'=>4,'reviews'=>71,'image'=>'images/Whipped cream powder 3.jpeg','bg'=>'from-rose-50 to-pink-100','stock'=>18],
                        ['id'=>7, 'name'=>'Christmas Cookies Pouch','price'=>4100,'old'=>'5,500','badge'=>'Sale','stars'=>5,'reviews'=>98,'image'=>'images/Christmas cookies or snacks pouch.jpeg','bg'=>'from-pink-50 to-purple-50','stock'=>12],
                        ['id'=>8, 'name'=>'Crowns','price'=>22000,'old'=>null,'badge'=>'Gift','stars'=>5,'reviews'=>201,'image'=>'images/Crowns.jpeg','bg'=>'from-purple-50 to-indigo-100','stock'=>8],
                    ];
                @endphp

                {{-- Encode products as JSON for JS ──────────────────────────── --}}
                <script>
                    window.SHOP_PRODUCTS = @json($products);
                </script>

                <div id="productGrid" class="grid grid-cols-2 xl:grid-cols-3 gap-4">
                    @foreach($products as $i => $p)
                    {{-- Pass product data attrs so JS can pick them up --}}
                    <div class="product-card reveal" data-delay="{{ ($i % 4) + 1 }}">

                        {{-- Image / thumb --}}
                        <div class="product-img-wrap bg-gradient-to-br {{ $p['bg'] }} relative overflow-hidden rounded-t-2xl">
                            <img src="{{ $p['image'] }}" alt="{{ $p['name'] }}"
                                 class="w-full h-48 object-cover"
                                 onerror="this.style.display='none'">

                            @if(!empty($p['badge']))
                            <span class="absolute top-3 left-3 text-xs font-bold text-white px-2.5 py-1 rounded-full shadow
                                {{ $p['badge']==='Sale' ? 'bg-blush' : ($p['badge']==='New' ? 'bg-green-500' : 'bg-plum') }}">
                                {{ $p['badge'] }}
                            </span>
                            @endif

                            {{-- Quick wishlist --}}
                            <button class="absolute top-3 right-3 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center shadow hover:bg-white transition-all text-gray-400 hover:text-rose-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </button>
                        </div>

                        {{-- Details --}}
                        <div class="p-4">
                            {{-- Stars --}}
                            <div class="flex items-center gap-1 mb-1.5">
                                <span class="text-yellow-400 text-xs">
                                    @for($s=0;$s<$p['stars'];$s++)★@endfor
                                    @for($s=$p['stars'];$s<5;$s++)☆@endfor
                                </span>
                                <span class="text-xs text-gray-400">({{ $p['reviews'] }})</span>
                            </div>

                            <p class="font-serif font-bold text-gray-900 text-sm leading-snug mb-2">{{ $p['name'] }}</p>

                            <div class="flex items-center gap-2 mb-3">
                                <span class="font-bold text-plum">₦{{ number_format($p['price']) }}</span>
                                @if(!empty($p['old']))
                                <span class="text-xs text-gray-400 line-through">₦{{ $p['old'] }}</span>
                                @endif
                            </div>

                            {{-- ── ADD TO CART BUTTON ── --}}
                            <button
                                class="add-to-cart-btn w-full btn-primary text-xs font-semibold py-2.5 rounded-full shadow transition-all"
                                data-id="{{ $p['id'] }}"
                                data-name="{{ $p['name'] }}"
                                data-price="{{ $p['price'] }}"
                                data-stock="{{ $p['stock'] }}"
                                data-image="{{ $p['image'] }}"
                                data-badge="{{ $p['badge'] ?? '' }}"
                                onclick="handleAddToCart(this)">
                                <span class="btn-label flex items-center justify-center gap-1.5">
                                    🛒 Add to Cart
                                </span>
                                <span class="btn-label-added">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    Added!
                                </span>
                            </button>
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

{{-- ── Toast notification ── --}}
<div id="toast" class="fixed bottom-6 right-6 z-50 bg-white rounded-2xl shadow-2xl border border-purple-100 px-5 py-4 flex items-center gap-3 translate-y-24 opacity-0 transition-all duration-500 pointer-events-none max-w-xs">
    <span class="text-2xl" id="toastIcon">🛒</span>
    <div>
        <p class="text-sm font-bold text-gray-900" id="toastTitle">Added to cart!</p>
        <p class="text-xs text-gray-400" id="toastMsg"></p>
    </div>
    <a href="/cart" class="ml-auto text-xs font-bold text-plum whitespace-nowrap hover:underline">View Cart →</a>
</div>

@endsection

@push('scripts')
{{-- Load shared cart utility first --}}
<script src="/js/cart-utils.js"></script>

<script>
/* ══════════════════════════════════
   SHOP PAGE — ADD TO CART LOGIC
══════════════════════════════════ */

/**
 * Restores button visual state for items already in cart when page loads.
 */
function syncButtonStates() {
    const cart = CartUtils.getCart();
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        const id = String(btn.dataset.id);
        if (cart[id]) {
            btn.classList.add('added');
            btn.querySelector('.btn-label').textContent = `🛒 In Cart (${cart[id].qty})`;
        }
    });
}

/**
 * Called when user clicks any "Add to Cart" button.
 */
function handleAddToCart(btn) {
    const product = {
        id:    btn.dataset.id,
        name:  btn.dataset.name,
        price: Number(btn.dataset.price),
        stock: Number(btn.dataset.stock),
        image: btn.dataset.image,
        badge: btn.dataset.badge,
        emoji: '🛒',   // fallback for cart page thumb
    };

    const newQty = CartUtils.addItem(product);

    // Visual feedback — "added" state
    btn.classList.add('added');
    btn.querySelector('.btn-label').textContent = `🛒 In Cart (${newQty})`;

    // Pop animation on the badge
    const badge = document.querySelector('[data-cart-count]');
    if (badge) { badge.classList.remove('cart-pop'); void badge.offsetWidth; badge.classList.add('cart-pop'); }

    showToast('🛒', 'Added to cart!', `${product.name} × ${newQty}`);
}

/* ── Toast ── */
function showToast(icon, title, msg) {
    const t = document.getElementById('toast');
    document.getElementById('toastIcon').textContent  = icon;
    document.getElementById('toastTitle').textContent = title;
    document.getElementById('toastMsg').textContent   = msg;
    t.classList.remove('translate-y-24', 'opacity-0');
    t.classList.add('translate-y-0', 'opacity-100');
    clearTimeout(t._timer);
    t._timer = setTimeout(() => {
        t.classList.add('translate-y-24', 'opacity-0');
        t.classList.remove('translate-y-0', 'opacity-100');
    }, 3500);
}

/* ── Price range label ── */
document.getElementById('priceRange')?.addEventListener('input', function () {
    document.getElementById('priceVal').textContent = '₦' + Number(this.value).toLocaleString('en-NG');
});

/* ── Reveal animations ── */
const ro = new IntersectionObserver(es => es.forEach(e => { if (e.isIntersecting) e.target.classList.add('in'); }), { threshold: 0.1 });
document.querySelectorAll('.reveal').forEach(el => ro.observe(el));

/* ── Init ── */
document.addEventListener('DOMContentLoaded', syncButtonStates);
</script>
@endpush