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

{{-- Categories --}}
<div class="filter-section bg-white p-5 shadow-sm border border-purple-50">
    <span class="filter-label">Categories</span>
    <div class="space-y-1 mt-2">
        <label class="check-item">
            <input type="radio" name="category" value="" checked class="accent-plum">
            <span class="text-sm text-gray-600 flex-1">All Products</span>
        </label>
        @foreach($categories as $cat)
        <label class="check-item">
            <input type="radio" name="category" value="{{ $cat->id }}" class="accent-plum">
            <span class="text-sm text-gray-600 flex-1">{{ $cat->name }}</span>
            <span class="text-xs text-gray-400 bg-gray-50 px-2 py-0.5 rounded-full">{{ $cat->products_count }}</span>
        </label>
        @endforeach
    </div>
</div>

{{-- Price Range --}}
<div class="filter-section bg-white p-5 shadow-sm border border-purple-50">
    <span class="filter-label">Price Range</span>
    <input type="range" min="0" max="50000" value="25000" class="price-range my-2" id="priceRange">
    <div class="flex justify-between text-xs text-gray-500 mt-1">
        <span>L$0</span>
        <span class="font-semibold text-plum" id="priceVal">L$250</span>
        <span>L$500</span>
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

@php
    $productsJson = $products->map(function($p) {
        return [
            'id'    => $p->id,
            'name'  => $p->name,
            'price' => $p->price,
            'stock' => $p->stock,
            'badge' => $p->featured ? 'Featured' : ($p->stock < 5 ? 'Low Stock' : null),
            'image' => $p->image ?? '',
        ];
    });
@endphp

<script>
    window.SHOP_PRODUCTS = {!! json_encode($productsJson) !!};
</script>

<div id="productGrid" class="grid grid-cols-2 xl:grid-cols-3 gap-4">
    @foreach($products as $i => $p)
    @php
        $badge = $p->featured ? 'Featured' : ($p->stock < 5 ? 'Low Stock' : null);
        $badgeColor = match($badge) {
            'Featured'  => 'bg-plum',
            'Low Stock' => 'bg-blush',
            default     => 'bg-green-500',
        };
        $bgColors = ['from-purple-50 to-purple-100','from-pink-50 to-rose-100','from-fuchsia-50 to-pink-100','from-indigo-50 to-purple-100'];
        $bg = $bgColors[$loop->index % count($bgColors)];
    @endphp

<div class="product-card reveal" data-delay="{{ ($loop->index % 4) + 1 }}">

    {{-- Image --}}
    <div class="product-img-wrap bg-gradient-to-br {{ $bg }} relative overflow-hidden rounded-t-2xl">
        @if($p->image)
            <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}"
                 class="w-full h-48 object-cover"
                 onerror="this.style.display='none'">
        @else
            <div class="w-full h-48 flex items-center justify-center text-4xl text-gray-300">🍞</div>
        @endif

        @if($badge)
        <span class="absolute top-3 left-3 text-xs font-bold px-2.5 py-1 rounded-full shadow
            {{ $badge === 'Featured' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
            {{ $badge }}
        </span>
        @endif

        <button class="absolute top-3 right-3 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center shadow hover:bg-white transition-all text-gray-400 hover:text-rose-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        </button>
    </div>

    {{-- Details --}}
    <div class="p-4 flex flex-col gap-1.5">

        {{-- Category --}}
        @if($p->category)
        <span class="text-xs text-gray-400 uppercase tracking-widest font-medium">{{ $p->category->name }}</span>
        @endif

        {{-- Name --}}
        <p class="font-serif font-bold text-gray-900 text-sm leading-snug">{{ $p->name }}</p>

        {{-- Description --}}
        @if($p->description)
        <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">{{ $p->description }}</p>
        @endif

        {{-- Price + Size --}}
        <div class="flex items-center gap-2 flex-wrap mt-1">
            <span class="text-base font-bold text-green-700">${{ number_format($p->price, 2) }}</span>
            @if($p->size_value)
            <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full">{{ $p->size_value }} {{ $p->size_unit }}</span>
            @endif
        </div>

        {{-- Stock status --}}
        <div class="flex items-center gap-1.5 text-xs">
            @if($p->stock === 0)
                <span class="w-2 h-2 rounded-full bg-red-400 inline-block"></span>
                <span class="text-red-500">Out of stock</span>
            @elseif($p->stock < 5)
                <span class="w-2 h-2 rounded-full bg-orange-400 inline-block"></span>
                <span class="text-orange-500">Only {{ $p->stock }} left</span>
            @else
                <span class="w-2 h-2 rounded-full bg-green-500 inline-block"></span>
                <span class="text-gray-500">In stock · {{ $p->stock }} units</span>
            @endif
        </div>

        {{-- Add to Cart --}}
        <button
            class="add-to-cart-btn mt-2 w-full border border-purple-500 text-gray-800 text-xs font-semibold py-2.5 rounded-xl hover:bg-purple-50 transition-all
                   {{ $p->stock === 0 ? 'opacity-40 cursor-not-allowed' : '' }}"
            data-id="{{ $p->id }}"
            data-name="{{ $p->name }}"
            data-price="{{ number_format($p->price, 2) }}"
            data-stock="{{ $p->stock }}"
            data-image="{{ $p->image ? asset('storage/' . $p->image) : '' }}"
            data-badge="{{ $badge ?? '' }}"
            {{ $p->stock === 0 ? 'disabled' : '' }}
            onclick="handleAddToCart(this)">
            <span class="btn-label flex items-center justify-center gap-1.5">
                🛒 {{ $p->stock === 0 ? 'Out of Stock' : 'Add to Cart' }}
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

{{-- Pagination --}}
<div class="flex items-center justify-between mt-12 pt-8 border-t border-purple-50">
    <p class="text-xs text-gray-400">
        Showing <span class="font-semibold text-gray-700">{{ $products->firstItem() }}–{{ $products->lastItem() }}</span>
        of <span class="font-semibold text-gray-700">{{ $products->total() }}</span> products
    </p>
    <div class="flex items-center gap-2">
        {{ $products->links() }}
    </div>
</div>

           
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
<script src="/js/cart-utils.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    /* ── Reveal animations ── */
    const ro = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('in'); });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(el => ro.observe(el));

    /* ── Price range ── */
    const pr = document.getElementById('priceRange');
    const pv = document.getElementById('priceVal');
    if (pr && pv) {
        pr.addEventListener('input', () => {
            pv.textContent = '₦' + parseInt(pr.value).toLocaleString();
        });
    }

    /* ── Grid / List toggle ── */
    const gridBtn = document.getElementById('gridView');
    const listBtn = document.getElementById('listView');
    const grid    = document.getElementById('productGrid');
    if (gridBtn && listBtn && grid) {
        gridBtn.addEventListener('click', () => {
            grid.classList.remove('grid-cols-1');
            grid.classList.add('grid-cols-2', 'xl:grid-cols-3');
            gridBtn.classList.add('bg-plum', 'text-white');
            listBtn.classList.remove('bg-plum', 'text-white');
        });
        listBtn.addEventListener('click', () => {
            grid.classList.remove('grid-cols-2', 'xl:grid-cols-3');
            grid.classList.add('grid-cols-1');
            listBtn.classList.add('bg-plum', 'text-white');
            gridBtn.classList.remove('bg-plum', 'text-white');
        });
    }

    /* ── Mobile filter toggle ── */
    (function () {
        const toggle  = document.getElementById('filterToggle');
        const panel   = document.getElementById('filterPanel');
        const chevron = document.getElementById('filterChevron');
        if (!toggle || !panel) return;
        let open = false;
        toggle.addEventListener('click', function () {
            open = !open;
            if (open) {
                panel.style.maxHeight = panel.scrollHeight + 'px';
                chevron.style.transform = 'rotate(180deg)';
                panel.addEventListener('transitionend', function once() {
                    if (open) panel.style.maxHeight = 'none';
                    panel.removeEventListener('transitionend', once);
                });
            } else {
                panel.style.maxHeight = panel.scrollHeight + 'px';
                requestAnimationFrame(() => {
                    panel.style.maxHeight = '0px';
                    chevron.style.transform = 'rotate(0deg)';
                });
            }
        });
    })();

    /* ── Sync cart button states ── */
    syncButtonStates();
});

/* ── Add to Cart ── */
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

function handleAddToCart(btn) {
    const product = {
        id:    btn.dataset.id,
        name:  btn.dataset.name,
        price: Number(btn.dataset.price),
        stock: Number(btn.dataset.stock),
        image: btn.dataset.image,
        badge: btn.dataset.badge,
        emoji: '🛒',
    };
    const newQty = CartUtils.addItem(product);
    btn.classList.add('added');
    btn.querySelector('.btn-label').textContent = `🛒 In Cart (${newQty})`;
    const badge = document.querySelector('[data-cart-count]');
    if (badge) { badge.classList.remove('cart-pop'); void badge.offsetWidth; badge.classList.add('cart-pop'); }
    showToast('🛒', 'Added to cart!', `${product.name} × ${newQty}`);
}

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
</script>
@endpush