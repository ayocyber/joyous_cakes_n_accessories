@extends('layout.app')
@section('title', 'Home')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Serif+Display:ital@0;1&family=Manrope:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>

/* ═══════════════════════════════════
 
/* ── Reveal ── */
</style>
@endpush

@section('content')

<!-- ══════════════════════════════════
     HERO SLIDESHOW
══════════════════════════════════ -->
<section class="hero-root" id="heroSlider">

    <div class="hero-track" id="heroTrack">

        <!-- Slide 1 -->
        <div class="hero-slide is-active" id="hsl0">
            <img class="hero-slide-img" src=" images/Cupcake liners.jpeg " alt="Baking tools flat lay" />
            <div class="hero-scrim"></div>
            <div class="hero-bignum">01</div>
            <div class="hero-body">
                <div class="hero-tag"><span class="hero-tag-dot"></span>New arrivals this week</div>
                <h1 class="hero-title">Tools That Make<br>Every Bake <i>Extraordinary</i></h1>
                <p class="hero-desc">Professional-grade baking accessories for home bakers and pastry artists — accept orders 24/7 and never miss a sale.</p>
                <div class="hero-pills">
                    <span class="hero-pill">Chef-approved quality</span>
                    <span class="hero-pill">350+ products</span>
                    <span class="hero-pill">Open 24/7</span>
                </div>
                <div class="hero-btns">
                    <a href="/shop" class="hero-btn-main">Shop Now <i class="bi bi-arrow-right"></i></a>
                    <a href="#products" class="hero-btn-ghost">Browse All</a>
                </div>
            </div>
            <div class="hero-badge hero-badge-1"><div class="hero-badge-icon">🛒</div><div><span class="hero-badge-title">Open 24/7</span><span class="hero-badge-sub">Never miss a sale</span></div></div>
            <div class="hero-sidedots" id="heroSideDots">
                <button class="hero-sddot on" data-i="0"></button>
                <button class="hero-sddot" data-i="1"></button>
                <button class="hero-sddot" data-i="2"></button>
                <button class="hero-sddot" data-i="3"></button>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="hero-slide" id="hsl1">
            <img class="hero-slide-img" src="images/Cookies pouch white.jpeg" alt="Beautifully decorated cake" />
            <div class="hero-scrim"></div>
            <div class="hero-bignum">02</div>
            <div class="hero-body">
                <div class="hero-tag"><span class="hero-tag-dot"></span>Customer favourite</div>
                <h1 class="hero-title">Decorate Like a<br><i>Pastry Artist</i></h1>
                <p class="hero-desc">Piping tips, fondant tools and decorating sets that give every cake a show-stopping finish — clients will keep coming back.</p>
                <div class="hero-pills">
                    <span class="hero-pill">Piping & fondant</span>
                    <span class="hero-pill">All skill levels</span>
                    <span class="hero-pill">2–5 day delivery</span>
                </div>
                <div class="hero-btns">
                    <a href="/shop" class="hero-btn-main">Shop Decorating <i class="bi bi-arrow-right"></i></a>
                    <a href="#testimonials" class="hero-btn-ghost">See Reviews</a>
                </div>
            </div>
            <div class="hero-badge hero-badge-1"><div class="hero-badge-icon">🎂</div><div><span class="hero-badge-title">Stunning finishes</span><span class="hero-badge-sub">Clients keep returning</span></div></div>
            <div class="hero-badge hero-badge-2"><div class="hero-badge-icon">📦</div><div><span class="hero-badge-title">Fast delivery</span><span class="hero-badge-sub">Nationwide</span></div></div>
        </div>

        <!-- Slide 3 -->
        <div class="hero-slide" id="hsl3">
            <img class="hero-slide-img" src="https://images.unsplash.com/photo-1558301211-0d8c8ddee6ec?w=1400&q=90" alt="Celebration cake" />
            <div class="hero-scrim"></div>
            <div class="hero-bignum">03</div>
            <div class="hero-body">
                <div class="hero-tag"><span class="hero-tag-dot"></span>Bestseller alert</div>
                <h1 class="hero-title">From Home Baker<br>to <i>Pastry Legend</i></h1>
                <p class="hero-desc">Affordable, reliable and beautiful — your shop never sleeps.</p>
                <div class="hero-pills">
                    <span class="hero-pill">Since 2018</span>
                    <span class="hero-pill">Award winning</span>
                </div>
                <div class="hero-btns">
                    <a href="/shop" class="hero-btn-main">Start Shopping <i class="bi bi-arrow-right"></i> </a>
                    <a href="/about" class="hero-btn-ghost">Our Story</a>
                </div>
            </div>
            <div class="hero-badge hero-badge-2"><div class="hero-badge-icon">🏆</div><div><span class="hero-badge-title">6 years trusted</span><span class="hero-badge-sub">Since 2018</span></div></div>
        </div>

    </div>

    <!-- Stats belt -->
    {{-- <div class="hero-stats">
        <div class="hero-stat"><span class="hero-stat-n">350+</span><span class="hero-stat-l">Products</span></div>
        <div class="hero-stat"><span class="hero-stat-n">24/7</span><span class="hero-stat-l">Orders Open</span></div>
    </div> --}}

    <!-- Nav dots + arrows -->
    <div class="hero-nav">
        <button class="hero-arr" id="heroPrev">&#8592;</button>
        <button class="hero-ndot on" data-i="0"></button>
        <button class="hero-ndot" data-i="1"></button>
        <button class="hero-ndot" data-i="2"></button>
        <button class="hero-ndot" data-i="3"></button>
        <button class="hero-arr" id="heroNext">&#8594;</button>
    </div>

    <div class="hero-prog" id="heroProgress"></div>

</section>


<!-- ══════════════════════════════════
     FEATURED PRODUCTS
══════════════════════════════════ -->
<section id="products" class="py-20" style="background:#faf8ff;">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">

    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12 reveal">

{{-- Left --}}
<div>
    <span class="text-xs font-semibold text-plum uppercase tracking-widest">
        Top Picks
    </span>

    <h2 class="font-serif text-4xl lg:text-5xl font-bold text-gray-900 mt-2">
        Our <em class="grad-text not-italic">Bestsellers</em>
    </h2>
</div>

{{-- Right --}}
<div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">

    {{-- Currency Switcher --}}
    <div class="bg-white border border-purple-100 rounded-2xl p-1 shadow-sm flex items-center">

        <span class="px-3 text-xs font-semibold text-gray-400 uppercase">
            Currency
        </span>

        <a href="?currency=LRD"
           class="px-3 py-2 rounded-xl text-xs font-semibold transition-all
           {{ request('currency', 'LRD') == 'LRD'
                ? 'bg-[#5B2D90] text-white shadow-sm'
                : 'text-gray-600 hover:bg-purple-50' }}">
            LRD
        </a>

        <a href="?currency=USD"
           class="px-3 py-2 rounded-xl text-xs font-semibold transition-all
           {{ request('currency') == 'USD'
                ? 'bg-[#5B2D90] text-white shadow-sm'
                : 'text-gray-600 hover:bg-purple-50' }}">
            USD
        </a>

        <a href="?currency=NGN"
           class="px-3 py-2 rounded-xl text-xs font-semibold transition-all
           {{ request('currency') == 'NGN'
                ? 'bg-[#5B2D90] text-white shadow-sm'
                : 'text-gray-600 hover:bg-purple-50' }}">
            NGN
        </a>

    </div>

    {{-- View all --}}
    <a href="/shop"
       class="flex items-center gap-2 text-sm font-semibold text-plum hover:text-blush transition-colors">
        View All Products
        <i class="bi bi-arrow-right"></i>
    </a>

</div>

</div>

@php
    $bgColors = ['from-purple-50 to-purple-100','from-pink-50 to-rose-100','from-fuchsia-50 to-pink-100','from-indigo-50 to-purple-100'];
@endphp

<div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
    @forelse($featured as $i => $p)
    @php
        $badge = $p->featured ? 'Featured' : ($p->stock < 5 ? 'Low Stock' : null);
        $bg = $bgColors[$loop->index % count($bgColors)];
    @endphp

    <div class="product-card reveal" data-delay="{{ ($loop->index % 4) + 1 }}">

        {{-- Image --}}
        <div class="product-img-wrap bg-gradient-to-br {{ $bg }} relative overflow-hidden rounded-t-2xl">
            @if($p->image_path)
                <img src="{{ asset('storage/' . $p->image_path) }}" alt="{{ $p->name }}"
                     class="w-full h-48 object-cover" onerror="this.style.display='none'">
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
                <i class="bi bi-heart"></i>
            </button>
        </div>

        {{-- Details --}}
        <div class="p-4 flex flex-col gap-1.5">

            @if($p->category)
            <span class="text-xs text-gray-400 uppercase tracking-widest font-medium">{{ $p->category->name }}</span>
            @endif

            <p class="font-serif font-bold text-gray-900 text-sm leading-snug">{{ $p->name }}</p>

            @if($p->description)
            <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">{{ $p->description }}</p>
            @endif

            <div class="flex items-center gap-2 flex-wrap mt-1">
                <span class="text-base font-bold text-green-700">L${{ number_format($p->price , 2) }}</span>
                @if($p->size_value)
                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full">{{ $p->size_value }} {{ $p->size_unit }}</span>
                @endif
            </div>

            <div class="flex items-center gap-1.5 text-xs">
                @if($p->stock === 0)
                    <span class="w-2 h-2 rounded-full bg-red-400 inline-block"></span>
                    <span class="text-red-500">Out of stock</span>
                @elseif($p->stock < 5)
                    <span class="w-2 h-2 rounded-full bg-orange-400 inline-block"></span>
                    <span class="text-orange-500">Only {{ $p->stock }} left</span>
                @else
                    <span class="w-2 h-2 rounded-full bg-green-500 inline-block"></span>
                    <span class="text-gray-500">In stock</span>
                @endif
            </div>

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
                    <i class="bi bi-check-lg"></i>
                    Added!
                </span>
            </button>
        </div>
    </div>

    @empty
    {{-- No featured products yet --}}
    <div class="col-span-4 text-center py-16 text-gray-400">
        <p class="text-4xl mb-3">🍞</p>
        <p class="text-sm">No featured products yet — mark some as featured in the admin panel.</p>
        <a href="/shop" class="mt-4 inline-block text-xs font-semibold text-plum hover:underline">Browse all products →</a>
    </div>
    @endforelse
</div>

    </div>


<!-- ══════════════════════════════════
     HOW IT WORKS
══════════════════════════════════ -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-14 reveal">
            <span class="text-xs font-semibold text-plum uppercase tracking-widest">Simple & Easy</span>
            <h2 class="font-serif text-4xl lg:text-5xl font-bold text-gray-900 mt-2">How It <em class="grad-text not-italic">Works</em></h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
        @php
            $steps = [
                [
                    'num' => '01',
                    'icon' => 'bi-search',
                    'title' => 'Browse Our Range',
                    'desc' => 'Explore 350+ professional baking tools and accessories in our curated shop.',
                ],
                [
                    'num' => '02',
                    'icon' => 'bi-cart3',
                    'title' => 'Add to Cart',
                    'desc' => 'Select your items, choose quantities and any variants that suit your needs.',
                ],
                [
                    'num' => '03',
                    'icon' => 'bi-credit-card',
                    'title' => 'Secure Checkout',
                    'desc' => 'Pay safely via bank transfer, card or mobile payment — fully encrypted.',
                ],
                [
                    'num' => '04',
                    'icon' => 'bi-box-seam',
                    'title' => 'Swift Delivery',
                    'desc' => 'Your order is carefully packed and delivered to your door within 2–5 days.',
                ],
            ];
        @endphp
            @foreach($steps as $i => $s)
            <div class="step-card p-7 text-center reveal d{{ $i+1 }}">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-purple-50 border border-purple-100 flex items-center justify-center">
                <i class="{{ $s['icon'] }} text-2xl text-plum"></i>
            </div>
                <div class="w-9 h-9 rounded-full btn-primary text-white text-xs font-bold flex items-center justify-center mx-auto mb-4 shadow-md">{{ $s['num'] }}</div>
                <h3 class="font-serif font-bold text-gray-900 text-lg mb-2">{{ $s['title'] }}</h3>
                <p class="text-sm text-gray-500 leading-relaxed">{{ $s['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ══════════════════════════════════
     TESTIMONIALS
══════════════════════════════════ -->
<section id="testimonials" class="py-20" style="background:#faf8ff;">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-14 reveal">
            <span class="text-xs font-semibold text-plum uppercase tracking-widest">Baker Reviews</span>
            <h2 class="font-serif text-4xl lg:text-5xl font-bold text-gray-900 mt-2">What <em class="grad-text not-italic">Bakers Say</em></h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $i => $t)
                <div class="testi-card p-7 reveal d{{ ($i % 3) + 1 }}">
                    <div class="flex text-yellow-400 text-sm mb-4">
                        @for($s = 0; $s < $t->rating; $s++)
                            ★
                        @endfor
                    </div>

                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                        "{{ $t->testimonial }}"
                    </p>

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-plum flex items-center justify-center text-white font-bold text-sm">
                            {{ $t->avatar_letter ?? strtoupper(substr($t->name, 0, 1)) }}
                        </div>

                        <div>
                            <p class="font-semibold text-gray-900 text-sm">
                                {{ $t->name }}
                            </p>

                            <p class="text-xs text-gray-400">
                                {{ $t->location }}
                            </p>
                        </div>

                        <i class="bi bi-quote ml-auto"></i>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ══════════════════════════════════
     NEWSLETTER CTA
══════════════════════════════════ -->
<!-- <section class="py-20 bg-white">
    <div class="max-w-xl mx-auto px-5 text-center reveal">
        <div class="w-16 h-16 rounded-2xl btn-primary flex items-center justify-center mx-auto mb-6 shadow-xl text-2xl">
            <span class="relative z-10">✉️</span>
        </div>
        <h2 class="font-serif text-4xl font-bold text-gray-900 mb-3">Get <em class="grad-text not-italic">10% Off</em> Your First Order</h2>
        <p class="text-gray-500 mb-8 text-sm leading-relaxed">Subscribe for baking tips, new product drops, and exclusive subscriber-only discounts.</p>
        <div class="flex flex-col sm:flex-row gap-3">
            <input type="email" placeholder="your@email.com"
                class="flex-1 px-5 py-4 rounded-full border border-purple-100 bg-purple-50 text-sm focus:outline-none focus:border-plum focus:ring-4 focus:ring-purple-100 transition-all placeholder-gray-400">
            <button class="btn-primary font-semibold px-8 py-4 rounded-full shadow-xl hover:scale-105 transition-all whitespace-nowrap text-sm">
                Claim 10% Off
            </button>
        </div>
        <p class="text-xs text-gray-400 mt-4">No spam. Unsubscribe anytime.</p>
    </div>
</section> -->


{{-- Modal lives INSIDE @section, BEFORE @endsection --}}
@include('components.quick-view-modal')

@endsection

@push('scripts')


{{-- Hero slideshow JS --}}
<script>
</script>
@endpush