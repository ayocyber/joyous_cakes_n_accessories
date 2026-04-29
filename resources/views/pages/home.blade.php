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
        <!-- Background -->
        <div class="slide-bg"></div>
        <div class="slide-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
        </div>
        <div class="slide-overlay"></div>

        <!-- Content -->
        <div class="slide-content">
            <div class="max-w-7xl mx-auto px-5 lg:px-8 w-full">
                <div class="max-w-xl">
                    <!-- Label pill -->
                    <div class="slide-label">
                        <span class="text-xs font-semibold text-white uppercase tracking-widest">{{ $slide['label'] }}</span>
                    </div>

                    <!-- Headline -->
                    <h1 class="font-serif slide-title">
                        {{ $slide['title'] }}
                    </h1>

                    <!-- Description -->
                    <p class="slide-desc">{{ $slide['desc'] }}</p>

                    <!-- CTAs -->
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

        <!-- Right visual -->
        <div class="slide-visual">
            <div class="relative">
                <!-- Glow -->
                <div class="absolute inset-0 rounded-full bg-white/10 blur-3xl scale-75"></div>

                <!-- Large emoji focal point -->
                <div class="relative text-center">
                    <div class="text-[10rem] lg:text-[14rem] leading-none drop-shadow-2xl select-none"
                         style="filter: drop-shadow(0 30px 60px rgba(0,0,0,0.4));">
                        {{ $slide['emoji'] }}
                    </div>
                </div>

                <!-- Float badges -->
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

    <!-- Prev / Next arrows -->
    <button class="arrow-btn arrow-prev" id="heroPrev" aria-label="Previous slide">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button class="arrow-btn arrow-next" id="heroNext" aria-label="Next slide">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>

    

    <!-- Dot controls -->
    <div class="slider-controls">
        @foreach($slides as $i => $s)
        <button class="dot {{ $i === 0 ? 'active' : '' }}" data-goto="{{ $i }}" aria-label="Go to slide {{ $i+1 }}"></button>
        @endforeach
    </div>

    <!-- Progress bar -->
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

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
            @php
                $products = [
                    ['name'=>'Paper box','price'=>'8,500','old'=>'11,000','badge'=>'Bestseller','stars'=>5,'reviews'=>213,'image'=>'images/6_6_6_ paper-boxes.jpeg','bg'=>'from-purple-50 to-purple-100'],
                    ['name'=>'White Cake Board','price'=>'6,200','old'=>null,'badge'=>'Popular','stars'=>5,'reviews'=>142,'image'=>'images/8_,10_,12,14_,16_  white cake boards.jpeg','bg'=>'from-pink-50 to-rose-100'],
                    ['name'=>'Birthday Coin Toppers','price'=>'4,800','old'=>'6,500','badge'=>'Sale','stars'=>4,'reviews'=>89,'image'=>'images/Birthday-coin-toppers.jpeg','bg'=>'from-fuchsia-50 to-pink-100'],
                    ['name'=>'Birthday Toppers','price'=>'15,000','old'=>null,'badge'=>'Premium','stars'=>5,'reviews'=>367,'image'=>'images/Birthday-toppers 2.jpeg','bg'=>'from-indigo-50 to-purple-100'],
                    ['name'=>'Cake Dowel','price'=>'5,500','old'=>'7,000','badge'=>'New','stars'=>5,'reviews'=>54,'image'=>'images/Cake dowel.jpeg','bg'=>'from-purple-100 to-pink-50'],
                    ['name'=>'Whipped Cream Powder','price'=>'3,200','old'=>null,'badge'=>null,'stars'=>4,'reviews'=>71,'image'=>'images/Whipped cream powder 3.jpeg','bg'=>'from-rose-50 to-pink-100'],
                    ['name'=>'Christmas Cookies or Snacks Pouch','price'=>'4,100','old'=>'5,500','badge'=>'Sale','stars'=>5,'reviews'=>98,'image'=>'images/Christmas cookies or snacks pouch.jpeg','bg'=>'from-pink-50 to-purple-50'],
                    ['name'=>"Crowns",'price'=>'22,000','old'=>null,'badge'=>'Gift','stars'=>5,'reviews'=>201,'image'=>'images/Crowns.jpeg','bg'=>'from-purple-50 to-indigo-100'],
                ];
            @endphp
            @foreach($products as $i => $p)
            <div class="prod-card reveal d{{ ($i%4)+1 }}">
                @if($p['badge'])
                <div class="absolute top-3 left-3 z-10">
                    <span class="text-xs font-semibold text-white px-3 py-1 rounded-full shadow
                        {{ $p['badge']==='Sale' ? 'bg-blush' : ($p['badge']==='Premium' || $p['badge']==='Gift' ? 'bg-gray-800' : 'bg-plum') }}">
                        {{ $p['badge'] }}
                    </span>
                </div>
                @endif
                <button class="absolute top-3 right-3 z-10 w-8 h-8 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:scale-110 hover:bg-plum group transition-all shadow">
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </button>
                <div class="relative overflow-hidden">
                    <div class="prod-img bg-gradient-to-br {{ $p['bg'] }}">
                        <span class="text-7xl select-none">
                            <img src="{{ asset($p['image']) }}" alt="{{ $p['name'] }}" class="w-full h-full object-cover object-center transition-transform duration-300 hover:scale-105">
                            {{-- {{ $p['emoji'] }}</span> --}}
                    </div>
                    <div class="hover-actions">
                        <button class="bg-white text-plum text-xs font-bold px-4 py-2 rounded-full hover:scale-105 transition-transform shadow">Quick View</button>
                        <button class="bg-white text-blush text-xs font-bold px-4 py-2 rounded-full hover:scale-105 transition-transform shadow">Add to Cart</button>
                    </div>
                </div>
                <div class="p-4">
                    <p class="font-medium text-gray-900 text-sm mb-1 truncate">{{ $p['name'] }}</p>
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
                    <button class="w-full btn-primary text-xs font-semibold py-2.5 rounded-full hover:scale-[1.02] transition-transform shadow">
                        🛒 Add to Cart
                    </button>
                </div>
            </div>
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

@endsection

@push('scripts')
<script>
/* ══════════════════════════════════
   HERO SLIDESHOW
══════════════════════════════════ */

</script>
@endpush