@extends('layout.app')
@section('title', 'Home')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Serif+Display:ital@0;1&family=Manrope:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>

/* ═══════════════════════════════════
   HERO
═══════════════════════════════════ */
.hero-root {
    width: 100%;
    position: relative;
    overflow: hidden;
    background: #fff;
    font-family: 'Manrope', sans-serif;
}

/* Slides track */
.hero-track {
    display: flex;
    width: 400%;
    transition: transform 0.65s cubic-bezier(0.77, 0, 0.175, 1);
}
.hero-slide {
    width: 25%;
    position: relative;
    overflow: hidden;
}

/* Full-bleed image */
.hero-slide-img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 8s ease;
}
.hero-slide.is-active .hero-slide-img {
    transform: scale(1.06);
}

/* Light scrim — white fades in from left & bottom so text stays readable */
.hero-scrim {
    position: absolute;
    inset: 0;
    z-index: 1;
    /* mobile: fade from bottom */
    background: linear-gradient(
        to top,
        rgba(255,255,255,1)   0%,
        rgba(255,255,255,0.92) 30%,
        rgba(255,255,255,0.5)  55%,
        rgba(255,255,255,0.1)  80%,
        transparent           100%
    );
}

/* Desktop: fade from left instead */
@media (min-width: 768px) {
    .hero-scrim {
        background: linear-gradient(
            to right,
            rgba(255,255,255,1)   0%,
            rgba(255,255,255,0.96) 35%,
            rgba(255,255,255,0.7)  55%,
            rgba(255,255,255,0.1)  75%,
            transparent           100%
        );
    }
}

/* Slide body */
.hero-body {
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    min-height: 580px;
    padding: 0 24px 48px;
}
@media (min-width: 768px) {
    .hero-body {
        justify-content: center;
        min-height: 560px;
        padding: 80px 64px;
        max-width: 54%;
    }
}

/* Eyebrow tag */
.hero-tag {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(124, 58, 237, 0.08);
    border: 0.5px solid rgba(124, 58, 237, 0.2);
    border-radius: 4px;
    padding: 4px 11px;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.12em;
    color: #6d28d9;
    text-transform: uppercase;
    margin-bottom: 16px;
    width: fit-content;
}
.hero-tag-dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: #a78bfa;
    animation: hdot 2s ease-in-out infinite;
    flex-shrink: 0;
}
@keyframes hdot { 0%,100%{opacity:1} 50%{opacity:0.2} }

/* Title */
.hero-title {
    font-family: 'DM Serif Display', Georgia, serif;
    font-size: 38px;
    font-weight: 400;
    line-height: 1.06;
    color: #1a0a2e;
    margin-bottom: 14px;
    letter-spacing: -0.02em;
}
.hero-title i {
    font-style: italic;
    color: #7c3aed;
}
@media (min-width: 768px) {
    .hero-title { font-size: 54px; }
}

/* Description */
.hero-desc {
    font-size: 13px;
    color: #6b7280;
    line-height: 1.85;
    margin-bottom: 24px;
    font-weight: 300;
    max-width: 360px;
}
@media (min-width: 768px) {
    .hero-desc { font-size: 14px; max-width: 420px; }
}

/* Pills */
.hero-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
    margin-bottom: 26px;
}
.hero-pill {
    font-size: 11px;
    color: #6d28d9;
    background: rgba(124, 58, 237, 0.07);
    border: 0.5px solid rgba(124, 58, 237, 0.18);
    border-radius: 100px;
    padding: 4px 12px;
    font-weight: 500;
}

/* Buttons */
.hero-btns {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.hero-btn-main {
    font-family: 'Manrope', sans-serif;
    font-size: 13px;
    font-weight: 600;
    background: #7c3aed;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 13px 26px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    transition: background 0.18s, transform 0.18s, box-shadow 0.18s;
    box-shadow: 0 6px 24px rgba(124,58,237,0.3);
    letter-spacing: 0.01em;
}
.hero-btn-main:hover {
    background: #6d28d9;
    transform: translateY(-2px);
    box-shadow: 0 10px 32px rgba(124,58,237,0.42);
}
.hero-btn-ghost {
    font-family: 'Manrope', sans-serif;
    font-size: 13px;
    font-weight: 500;
    background: transparent;
    color: #6d28d9;
    border: 0.5px solid rgba(124,58,237,0.35);
    border-radius: 6px;
    padding: 13px 22px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.18s;
}
.hero-btn-ghost:hover {
    background: rgba(124,58,237,0.06);
    border-color: #7c3aed;
}

/* Floating badges */
.hero-badge {
    position: absolute;
    z-index: 3;
    background: #fff;
    border: 0.5px solid rgba(0,0,0,0.07);
    border-radius: 12px;
    padding: 10px 14px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.1);
    min-width: 155px;
}
.hero-badge-1 {
    right: 20px;
    bottom: 56px;
    animation: hbadge 4s ease-in-out infinite;
}
.hero-badge-2 {
    right: 20px;
    top: 64px;
    animation: hbadge 4s ease-in-out infinite 2s;
}
@media (min-width: 768px) {
    .hero-badge-1 { right: 56px; bottom: 90px; }
    .hero-badge-2 { right: 56px; top: 110px; }
}
@keyframes hbadge { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-7px)} }
.hero-badge-icon {
    width: 34px;
    height: 34px;
    border-radius: 9px;
    background: #f5f3ff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
    line-height: 1;
}
.hero-badge-title {
    font-size: 12px;
    font-weight: 600;
    color: #1a1a1a;
    display: block;
    line-height: 1.3;
}
.hero-badge-sub {
    font-size: 10px;
    color: #9ca3af;
    display: block;
}

/* Big background number */
.hero-bignum {
    position: absolute;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 140px;
    line-height: 0.85;
    color: rgba(124,58,237,0.05);
    right: 24px;
    bottom: 60px;
    letter-spacing: -0.02em;
    z-index: 1;
    user-select: none;
    pointer-events: none;
}
@media (min-width: 768px) {
    .hero-bignum { font-size: 200px; right: 48px; bottom: auto; top: 50%; transform: translateY(-50%); }
}

/* Vertical side dots */
.hero-sidedots {
    position: absolute;
    top: 50%;
    right: 16px;
    transform: translateY(-50%);
    z-index: 10;
    display: flex;
    flex-direction: column;
    gap: 7px;
}
@media (min-width: 768px) {
    .hero-sidedots { display: none; }
}
.hero-sddot {
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: rgba(124,58,237,0.2);
    border: none;
    padding: 0;
    cursor: pointer;
    transition: all 0.3s;
}
.hero-sddot.on {
    height: 18px;
    border-radius: 2px;
    background: #7c3aed;
}

/* Stats belt */
.hero-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    border-top: 0.5px solid rgba(124,58,237,0.1);
    background: #fff;
}
.hero-stat {
    padding: 14px 8px;
    text-align: center;
    border-right: 0.5px solid rgba(124,58,237,0.1);
}
.hero-stat:last-child { border-right: none; }
.hero-stat-n {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 22px;
    letter-spacing: 0.04em;
    color: #7c3aed;
    display: block;
    line-height: 1;
}
.hero-stat-l {
    font-size: 9px;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-top: 3px;
    display: block;
}

/* Nav strip */
.hero-nav {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 0 14px;
    background: #fff;
}
.hero-ndot {
    width: 5px;
    height: 5px;
    border-radius: 100px;
    background: rgba(124,58,237,0.18);
    border: none;
    padding: 0;
    cursor: pointer;
    transition: width 0.3s, background 0.3s;
}
.hero-ndot.on { width: 22px; background: #7c3aed; }
.hero-arr {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: rgba(124,58,237,0.07);
    border: 0.5px solid rgba(124,58,237,0.2);
    color: #7c3aed;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 13px;
    transition: all 0.18s;
    flex-shrink: 0;
}
.hero-arr:hover { background: rgba(124,58,237,0.14); }

/* Progress bar */
.hero-prog {
    height: 2px;
    background: linear-gradient(90deg, #7c3aed, #c084fc, #e879f9);
    border-radius: 2px;
    width: 0%;
    transition: width 0.04s linear;
}

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
            <img class="hero-slide-img" src="https://images.unsplash.com/photo-1486427944299-d1955d23e34d?w=1400&q=90" alt="Baking tools flat lay" />
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
                    <a href="/shop" class="hero-btn-main">Shop Now <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                    <a href="#products" class="hero-btn-ghost">Browse All</a>
                </div>
            </div>
            <div class="hero-badge hero-badge-1"><div class="hero-badge-icon">🛒</div><div><span class="hero-badge-title">Open 24/7</span><span class="hero-badge-sub">Never miss a sale</span></div></div>
            <div class="hero-badge hero-badge-2"><div class="hero-badge-icon">⭐</div><div><span class="hero-badge-title">12,000+ Bakers</span><span class="hero-badge-sub">★★★★★ Rated</span></div></div>
            <div class="hero-sidedots" id="heroSideDots">
                <button class="hero-sddot on" data-i="0"></button>
                <button class="hero-sddot" data-i="1"></button>
                <button class="hero-sddot" data-i="2"></button>
                <button class="hero-sddot" data-i="3"></button>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="hero-slide" id="hsl1">
            <img class="hero-slide-img" src="https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?w=1400&q=90" alt="Beautifully decorated cake" />
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
                    <a href="/shop" class="hero-btn-main">Shop Decorating <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                    <a href="#testimonials" class="hero-btn-ghost">See Reviews</a>
                </div>
            </div>
            <div class="hero-badge hero-badge-1"><div class="hero-badge-icon">🎂</div><div><span class="hero-badge-title">Stunning finishes</span><span class="hero-badge-sub">Clients keep returning</span></div></div>
            <div class="hero-badge hero-badge-2"><div class="hero-badge-icon">📦</div><div><span class="hero-badge-title">Fast delivery</span><span class="hero-badge-sub">Nationwide</span></div></div>
        </div>

        <!-- Slide 3 -->
        <div class="hero-slide" id="hsl2">
            <img class="hero-slide-img" src="https://images.unsplash.com/photo-1607478900766-efe13248b125?w=1400&q=90" alt="Baker at work" />
            <div class="hero-scrim"></div>
            <div class="hero-bignum">03</div>
            <div class="hero-body">
                <div class="hero-tag"><span class="hero-tag-dot"></span>This month's deal</div>
                <h1 class="hero-title">The Perfect Gift<br>for <i>Every Baker</i></h1>
                <p class="hero-desc">Beautifully packaged gift sets for birthdays and celebrations. Order online anytime — we deliver the joy to their door.</p>
                <div class="hero-pills">
                    <span class="hero-pill">Free packaging</span>
                    <span class="hero-pill">Secure checkout</span>
                    <span class="hero-pill">Card & bank pay</span>
                </div>
                <div class="hero-btns">
                    <a href="/shop" class="hero-btn-main">View Gift Sets <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                    <a href="#products" class="hero-btn-ghost">Learn More</a>
                </div>
            </div>
            <div class="hero-badge hero-badge-1"><div class="hero-badge-icon">🎁</div><div><span class="hero-badge-title">Gift ready</span><span class="hero-badge-sub">Free packaging</span></div></div>
            <div class="hero-badge hero-badge-2"><div class="hero-badge-icon">🔒</div><div><span class="hero-badge-title">100% secure</span><span class="hero-badge-sub">Safe checkout</span></div></div>
        </div>

        <!-- Slide 4 -->
        <div class="hero-slide" id="hsl3">
            <img class="hero-slide-img" src="https://images.unsplash.com/photo-1558301211-0d8c8ddee6ec?w=1400&q=90" alt="Celebration cake" />
            <div class="hero-scrim"></div>
            <div class="hero-bignum">04</div>
            <div class="hero-body">
                <div class="hero-tag"><span class="hero-tag-dot"></span>Bestseller alert</div>
                <h1 class="hero-title">From Home Baker<br>to <i>Pastry Legend</i></h1>
                <p class="hero-desc">12,000+ Nigerian bakers trust our tools. Affordable, reliable and beautiful — your shop never sleeps.</p>
                <div class="hero-pills">
                    <span class="hero-pill">All 36 states</span>
                    <span class="hero-pill">Since 2018</span>
                    <span class="hero-pill">Award winning</span>
                </div>
                <div class="hero-btns">
                    <a href="/shop" class="hero-btn-main">Start Shopping <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
                    <a href="/about" class="hero-btn-ghost">Our Story</a>
                </div>
            </div>
            <div class="hero-badge hero-badge-1"><div class="hero-badge-icon">🇳🇬</div><div><span class="hero-badge-title">Made for Nigeria</span><span class="hero-badge-sub">All 36 states</span></div></div>
            <div class="hero-badge hero-badge-2"><div class="hero-badge-icon">🏆</div><div><span class="hero-badge-title">6 years trusted</span><span class="hero-badge-sub">Since 2018</span></div></div>
        </div>

    </div>

    <!-- Stats belt -->
    <div class="hero-stats">
        <div class="hero-stat"><span class="hero-stat-n">350+</span><span class="hero-stat-l">Products</span></div>
        <div class="hero-stat"><span class="hero-stat-n">12K+</span><span class="hero-stat-l">Bakers</span></div>
        <div class="hero-stat"><span class="hero-stat-n">36</span><span class="hero-stat-l">States</span></div>
        <div class="hero-stat"><span class="hero-stat-n">24/7</span><span class="hero-stat-l">Orders Open</span></div>
    </div>

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

        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-12 reveal">
            <div>
                <span class="text-xs font-semibold text-plum uppercase tracking-widest">Top Picks</span>
                <h2 class="font-serif text-4xl lg:text-5xl font-bold text-gray-900 mt-2">Our <em class="grad-text not-italic">Bestsellers</em></h2>
            </div>
            <a href="/shop" class="flex items-center gap-2 text-sm font-semibold text-plum hover:text-blush transition-colors group">
                View All Products
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

@php
    $products = [
        ['id'=>1,'name'=>'Paper box','price'=>8500,'old'=>'11,000','badge'=>'Bestseller','stars'=>5,'reviews'=>213,'image'=>'images/6_6_6_ paper-boxes.jpeg','bg'=>'from-purple-50 to-purple-100','stock'=>20],
        ['id'=>2,'name'=>'White Cake Board','price'=>6200,'old'=>null,'badge'=>'Popular','stars'=>5,'reviews'=>142,'image'=>'images/8_,10_,12,14_,16_  white cake boards.jpeg','bg'=>'from-pink-50 to-rose-100','stock'=>15],
        ['id'=>3,'name'=>'Birthday Coin Toppers','price'=>4800,'old'=>'6,500','badge'=>'Sale','stars'=>4,'reviews'=>89,'image'=>'images/Birthday-coin-toppers.jpeg','bg'=>'from-fuchsia-50 to-pink-100','stock'=>30],
        ['id'=>4,'name'=>'Birthday Toppers','price'=>15000,'old'=>null,'badge'=>'Premium','stars'=>5,'reviews'=>367,'image'=>'images/Birthday-toppers 2.jpeg','bg'=>'from-indigo-50 to-purple-100','stock'=>10],
        ['id'=>5,'name'=>'Cake Dowel','price'=>5500,'old'=>'7,000','badge'=>'New','stars'=>5,'reviews'=>54,'image'=>'images/Cake dowel.jpeg','bg'=>'from-purple-100 to-pink-50','stock'=>25],
        ['id'=>6,'name'=>'Whipped Cream Powder','price'=>3200,'old'=>null,'badge'=>null,'stars'=>4,'reviews'=>71,'image'=>'images/Whipped cream powder 3.jpeg','bg'=>'from-rose-50 to-pink-100','stock'=>18],
        ['id'=>7,'name'=>'Christmas Cookies Pouch','price'=>4100,'old'=>'5,500','badge'=>'Sale','stars'=>5,'reviews'=>98,'image'=>'images/Christmas cookies or snacks pouch.jpeg','bg'=>'from-pink-50 to-purple-50','stock'=>12],
        ['id'=>8,'name'=>'Crowns','price'=>22000,'old'=>null,'badge'=>'Gift','stars'=>5,'reviews'=>201,'image'=>'images/Crowns.jpeg','bg'=>'from-purple-50 to-indigo-100','stock'=>8],
    ];
@endphp

   <script>
                    window.SHOP_PRODUCTS = @json($products);
                </script>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($products as $i => $p)
                <x-product-card :product="$p" :index="$i" :delay="($i % 4) + 1" />
            @endforeach
        </div>

    </div>
</section>


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
                    ['num'=>'01','icon'=>'🔍','title'=>'Browse Our Range','desc'=>'Explore 350+ professional baking tools and accessories in our curated shop.'],
                    ['num'=>'02','icon'=>'🛒','title'=>'Add to Cart','desc'=>'Select your items, choose quantities and any variants that suit your needs.'],
                    ['num'=>'03','icon'=>'💳','title'=>'Secure Checkout','desc'=>'Pay safely via bank transfer, card or mobile payment — fully encrypted.'],
                    ['num'=>'04','icon'=>'📦','title'=>'Swift Delivery','desc'=>'Your order is carefully packed and delivered to your door within 2–5 days.'],
                ];
            @endphp
            @foreach($steps as $i => $s)
            <div class="step-card p-7 text-center reveal d{{ $i+1 }}">
                <div class="text-4xl mb-4">{{ $s['icon'] }}</div>
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $testis = [
                    ['name'=>'Amara O.','loc'=>'Lagos','text'=>"The piping tips set completely transformed my cake decorating. Professional quality at such a fair price. My clients can't believe I'm working from home!",'stars'=>5,'av'=>'A','bg'=>'bg-plum'],
                    ['name'=>'Kemi A.','loc'=>'Abuja','text'=>"I've been baking for 8 years and these are the best cake tins I've ever used. Even heat distribution, easy release — absolutely brilliant quality.",'stars'=>5,'av'=>'K','bg'=>'bg-blush'],
                    ['name'=>'Tolu B.','loc'=>'Ibadan','text'=>"Ordered the starter kit as a gift for my daughter and she was so excited. Everything was beautifully packaged. Delivery was fast too. Will order again!",'stars'=>5,'av'=>'T','bg'=>'bg-purple-500'],
                ];
            @endphp
            @foreach($testis as $i => $t)
            <div class="testi-card p-7 reveal d{{ $i+1 }}">
                <div class="flex text-yellow-400 text-sm mb-4">@for($s=0;$s<$t['stars'];$s++)★@endfor</div>
                <p class="text-gray-600 text-sm leading-relaxed mb-6">"{{ $t['text'] }}"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full {{ $t['bg'] }} flex items-center justify-center text-white font-bold text-sm">{{ $t['av'] }}</div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">{{ $t['name'] }}</p>
                        <p class="text-xs text-gray-400">{{ $t['loc'] }}, Nigeria</p>
                    </div>
                    <svg class="w-7 h-7 text-purple-100 ml-auto" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ══════════════════════════════════
     NEWSLETTER CTA
══════════════════════════════════ -->
<section class="py-20 bg-white">
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
</section>


{{-- Modal lives INSIDE @section, BEFORE @endsection --}}
@include('components.quick-view-modal')

@endsection

@push('scripts')
@php
        $productsJson = array_values(array_map(function($p) {
            return [
                'id'      => $p['id'],
                'name'    => $p['name'],
                'price'   => (string) $p['price'],
                'old'     => isset($p['old']) ? (string) $p['old'] : null,
                'badge'   => $p['badge'] ?? null,
                'stars'   => $p['stars'],
                'reviews' => $p['reviews'],
                'image'   => asset($p['image']),
                'stock'   => $p['stock'] ?? 99,
                'emoji'   => $p['emoji'] ?? '📦',
            ];
        }, $products));
@endphp
<script>
    window.PRODUCTS = @json($productsJson);
</script>
<script src="{{ asset('js/cart-utils.js') }}"></script>
<script src="{{ asset('js/product-card.js') }}"></script>

{{-- Hero slideshow JS --}}
<script>
(function(){
    var cur = 0, tot = 4, pw = 0, timer;

    function goTo(n) {
        cur = (n + tot) % tot;
        document.getElementById('heroTrack').style.transform = 'translateX(-' + (cur * 25) + '%)';
        document.querySelectorAll('.hero-slide').forEach(function(s, i) {
            s.className = 'hero-slide' + (i === cur ? ' is-active' : '');
        });
        document.querySelectorAll('.hero-ndot').forEach(function(d, i) {
            d.className = 'hero-ndot' + (i === cur ? ' on' : '');
        });
        document.querySelectorAll('.hero-sddot').forEach(function(d, i) {
            d.className = 'hero-sddot' + (i === cur ? ' on' : '');
        });
        pw = 0;
        document.getElementById('heroProgress').style.width = '0%';
        clearInterval(timer);
        timer = setInterval(function() {
            pw += 0.45;
            document.getElementById('heroProgress').style.width = Math.min(pw, 100) + '%';
            if (pw >= 100) goTo(cur + 1);
        }, 22);
    }

    document.getElementById('heroPrev').addEventListener('click', function(){ goTo(cur - 1); });
    document.getElementById('heroNext').addEventListener('click', function(){ goTo(cur + 1); });

    document.querySelectorAll('.hero-ndot').forEach(function(d) {
        d.addEventListener('click', function(){ goTo(+d.getAttribute('data-i')); });
    });
    document.querySelectorAll('.hero-sddot').forEach(function(d) {
        d.addEventListener('click', function(){ goTo(+d.getAttribute('data-i')); });
    });

    goTo(0);
})();
</script>
@endpush