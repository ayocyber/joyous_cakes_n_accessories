@extends('layout.app')
@section('title', 'Home')

@push('styles')

<style>
/* ── Reveal ── */
</style>
@endpush

@section('content')

<!-- ══════════════════════════════════
     HERO SLIDESHOW
══════════════════════════════════ -->
<section class="hero-slider" id="heroSlider">

    @php
        $slides = [
            [
                'label'    => '🎀 New Arrivals This Week',
                'title'    => "Tools That Make Every Bake Extraordinary",
                'highlight'=> 'Every Bake',
                'desc'     => 'Professional-grade baking accessories for home bakers and pastry artists. From elegant cake moulds to precision decorating tools.',
                'cta1'     => ['text'=>'Shop Now', 'href'=>'/shop'],
                'cta2'     => ['text'=>'Browse Categories', 'href'=>'#products'],
                'emoji'    => '🍰',
                'badge1'   => ['icon'=>'🎨','title'=>'Pro-Grade Tools','sub'=>'Chef-approved quality'],
                'badge2'   => ['icon'=>'⭐','title'=>'12,000+ Bakers','sub'=>'★★★★★ Rated'],
            ],
            [
                'label'    => '✨ Customer Favourite',
                'title'    => "Decorate Like a Professional Pastry Chef",
                'highlight'=> 'Professional Pastry Chef',
                'desc'     => 'Our piping tips, fondant tools, and decorating sets give your cakes that stunning finish that keeps clients coming back.',
                'cta1'     => ['text'=>'Shop Decorating', 'href'=>'/shop'],
                'cta2'     => ['text'=>'See Reviews', 'href'=>'#testimonials'],
                'emoji'    => '🎨',
                'badge1'   => ['icon'=>'💜','title'=>'350+ Products','sub'=>'Curated collection'],
                'badge2'   => ['icon'=>'📦','title'=>'Fast Delivery','sub'=>'2–5 days nationwide'],
            ],
            [
                'label'    => '🧁 This Month\'s Deal',
                'title'    => "The Perfect Gift for Every Baker You Love",
                'highlight'=> 'Every Baker You Love',
                'desc'     => 'Our beautifully packaged gift sets make the perfect present for birthdays, celebrations, and every occasion in between.',
                'cta1'     => ['text'=>'View Gift Sets', 'href'=>'/shop'],
                'cta2'     => ['text'=>'Learn More', 'href'=>'#products'],
                'emoji'    => '🎁',
                'badge1'   => ['icon'=>'🎀','title'=>'Gift Ready','sub'=>'Beautifully packaged'],
                'badge2'   => ['icon'=>'💳','title'=>'Secure Payments','sub'=>'Card & bank transfer'],
            ],
            [
                'label'    => '🔥 Bestseller Alert',
                'title'    => "From Home Baker to Pastry Artist",
                'highlight'=> 'Pastry Artist',
                'desc'     => 'Join over 12,000 Nigerian bakers who have elevated their craft with our professional tools — affordable, reliable, and beautiful.',
                'cta1'     => ['text'=>'Start Baking', 'href'=>'/shop'],
                'cta2'     => ['text'=>'Our Story', 'href'=>'/about'],
                'emoji'    => '🏆',
                'badge1'   => ['icon'=>'🇳🇬','title'=>'Made for Nigeria','sub'=>'Serving all 36 states'],
                'badge2'   => ['icon'=>'🌟','title'=>'6 Years Trusted','sub'=>'Since 2018'],
            ],
        ];
    @endphp

    @foreach($slides as $i => $slide)
    <div class="slide {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}">
        <div class="slide-bg"></div>
        <div class="slide-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
        </div>
        <div class="slide-overlay"></div>

        <div class="slide-content">
            <div class="max-w-7xl mx-auto px-5 lg:px-8 w-full">
                <div class="max-w-xl">
                    <div class="slide-label">
                        <span class="text-xs font-semibold text-white uppercase tracking-widest">{{ $slide['label'] }}</span>
                    </div>
                    <h1 class="font-serif slide-title">{{ $slide['title'] }}</h1>
                    <p class="slide-desc">{{ $slide['desc'] }}</p>
                    <div class="slide-actions">
                        <a href="{{ $slide['cta1']['href'] }}"
                           class="btn-primary px-8 py-4 rounded-full shadow-xl hover:scale-105 transition-all duration-300 flex items-center gap-2 text-sm font-semibold">
                            <span>{{ $slide['cta1']['text'] }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="{{ $slide['cta2']['href'] }}"
                           class="flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/25 text-white font-semibold px-8 py-4 rounded-full hover:bg-white/20 transition-all duration-300 text-sm">
                            {{ $slide['cta2']['text'] }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="slide-visual">
            <div class="relative">
                <div class="absolute inset-0 rounded-full bg-white/10 blur-3xl scale-75"></div>
                <div class="relative text-center">
                    <div class="text-[10rem] lg:text-[14rem] leading-none drop-shadow-2xl select-none"
                         style="filter: drop-shadow(0 30px 60px rgba(0,0,0,0.4));">
                        {{ $slide['emoji'] }}
                    </div>
                </div>
                <div class="float-badge float-badge-1">
                    <div class="w-9 h-9 rounded-xl bg-purple-50 flex items-center justify-center text-lg shrink-0">{{ $slide['badge1']['icon'] }}</div>
                    <div>
                        <p class="text-xs font-bold text-gray-800">{{ $slide['badge1']['title'] }}</p>
                        <p class="text-xs text-gray-400">{{ $slide['badge1']['sub'] }}</p>
                    </div>
                </div>
                <div class="float-badge float-badge-2">
                    <div class="w-9 h-9 rounded-xl bg-pink-50 flex items-center justify-center text-lg shrink-0">{{ $slide['badge2']['icon'] }}</div>
                    <div>
                        <p class="text-xs font-bold text-gray-800">{{ $slide['badge2']['title'] }}</p>
                        <p class="text-xs text-gray-400">{{ $slide['badge2']['sub'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <button class="arrow-btn arrow-prev" id="heroPrev" aria-label="Previous slide">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button class="arrow-btn arrow-next" id="heroNext" aria-label="Next slide">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>

    <div class="slider-controls">
        @foreach($slides as $i => $s)
        <button class="dot {{ $i === 0 ? 'active' : '' }}" data-goto="{{ $i }}" aria-label="Go to slide {{ $i+1 }}"></button>
        @endforeach
    </div>

    <div class="slide-progress" id="slideProgress"></div>

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
                'price'   => (string) $p['price'],   // product-card.js does parseInt(p.price.replace...)
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
<script src="{{ asset('js/product-card.js') }}" ></script>
{{-- Hero slideshow JS --}}
@endpush