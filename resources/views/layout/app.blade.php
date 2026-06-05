<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ══════════════════════════════════
         PRIMARY SEO META TAGS
         Child views can override title, description, keywords
         using @section('meta_title') etc.
    ══════════════════════════════════ --}}
    @hasSection('meta_title')
        <title>@yield('meta_title') — {{ config('app.name', 'Joyous') }}</title>
    @else
        <title>{{ config('app.name', 'Joyous') }} — @yield('title', 'Cakes & Professional Baking Accessories')</title>
    @endif

    <meta name="description"    content="@yield('meta_description', 'Joyous – premium cakes and professional baking accessories for home bakers and pastry artists in Liberia. Shop cake tins, decorating tools, and more.')">
    <meta name="keywords"       content="@yield('meta_keywords', 'baking accessories, cake tools, cake tins, pastry equipment, Liberia bakery, Joyous cakes, baking supplies')">
    <meta name="author"         content="Joyous Cakes N Accessories">
    <meta name="robots"         content="@yield('meta_robots', 'index, follow')">
    <link rel="canonical"       href="@yield('canonical', request()->url())">

    {{-- ══════════════════════════════════
         OPEN GRAPH (Facebook / WhatsApp / LinkedIn)
    ══════════════════════════════════ --}}
    <meta property="og:type"        content="@yield('og_type', 'website')">
    <meta property="og:site_name"   content="{{ config('app.name', 'Joyous') }}">
    <meta property="og:url"         content="@yield('canonical', request()->url())">
    <meta property="og:title"       content="@yield('og_title', config('app.name', 'Joyous') . ' — Cakes & Professional Baking Accessories')">
    <meta property="og:description" content="@yield('og_description', 'Premium cakes and professional baking accessories for home bakers and pastry artists in Liberia.')">
    <meta property="og:image"       content="@yield('og_image', asset('images/joyous_logo_2.png'))">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale"      content="{{ str_replace('-', '_', app()->getLocale()) }}">

    {{-- ══════════════════════════════════
         TWITTER CARD
    ══════════════════════════════════ --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="@yield('og_title', config('app.name', 'Joyous') . ' — Cakes & Professional Baking Accessories')">
    <meta name="twitter:description" content="@yield('og_description', 'Premium cakes and professional baking accessories for home bakers and pastry artists in Liberia.')">
    <meta name="twitter:image"       content="@yield('og_image', asset('images/joyous_logo_2.png'))">

    {{-- ══════════════════════════════════
         STRUCTURED DATA — Organisation (site-wide)
         Product / BreadcrumbList can be injected per-page
         via @section('structured_data') in child views.
    ══════════════════════════════════ --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "{{ config('app.name', 'Joyous') }}",
        "url": "{{ config('app.url') }}",
        "logo": "{{ asset('images/joyous_logo_2.png') }}",
        "description": "Premium cakes and professional baking accessories for home bakers and pastry artists.",
        "sameAs": []
    }
    </script>
    @hasSection('structured_data')
        <script type="application/ld+json">@yield('structured_data')</script>
    @endif

    {{-- ══════════════════════════════════
         FAVICON
    ══════════════════════════════════ --}}
    <link rel="icon"             type="image/png" sizes="32x32" href="{{ asset('images/joyous_logo_2.png') }}">
    <link rel="apple-touch-icon"                               href="{{ asset('images/joyous_logo_2.png') }}">

    {{-- ══════════════════════════════════
         FONTS & ICONS
    ══════════════════════════════════ --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,500&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
    <script src="/js/cart-utils.js"></script>
</head>
<body class="bg-white text-gray-800 antialiased overflow-x-hidden">

    {{-- Skip-to-content link (accessibility + SEO) --}}
    <a href="#main-content"
       class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[999] focus:bg-white focus:text-plum focus:px-4 focus:py-2 focus:rounded-lg focus:shadow-lg focus:text-sm focus:font-semibold">
        Skip to main content
    </a>

    <!-- ══ NAVBAR ══ -->
    <nav class="nav-glass fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="navbar"
         role="navigation" aria-label="Main navigation">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-[68px]">

                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group" aria-label="Joyous Cakes N Accessories — Home">
                    <img src="{{ asset('images/joyous_logo_2.png') }}" alt="Joyous Cakes N Accessories logo" class="w-20 h-12" width="80" height="48">
                    <div>
                        <span class="text-xl font-serif font-bold grad-text tracking-wide">Joyous</span>
                        <span class="hidden sm:block text-black font-extrabold uppercase tracking-[0.15em] -mt-0.5">Cakes N Accessories</span>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden lg:flex items-center gap-7" role="menubar">
                    <a href="{{ url('/') }}"  class="nav-link text-sm font-medium text-gray-600 hover:text-plum transition-colors" role="menuitem">Home</a>
                    <a href="/shop"           class="nav-link text-sm font-medium text-gray-600 hover:text-plum transition-colors" role="menuitem">Shop</a>
                    <a href="/contact"        class="nav-link text-sm font-medium text-gray-600 hover:text-plum transition-colors" role="menuitem">Contact us</a>
                </div>

                <!-- Right Icons -->
                <div class="flex items-center gap-2">
                    <!-- Cart -->
                    <a href="/cart" class="relative p-2 rounded-full hover:bg-purple-50 transition-colors group" aria-label="Shopping cart">
                        <i class="bi bi-bag text-gray-400 group-hover:text-plum transition-colors" aria-hidden="true"></i>
                        <span data-cart-count
                            class="absolute -top-0.5 -right-0.5 w-4 h-4 cart-badge rounded-full text-white text-[10px] flex items-center justify-center font-bold"
                            aria-live="polite" aria-label="Cart item count">
                        </span>
                    </a>

                    <!-- Mobile menu -->
                    <button id="mobileMenuBtn"
                            class="lg:hidden p-2 rounded-xl hover:bg-purple-50 transition-colors"
                            aria-expanded="false"
                            aria-controls="mobileMenu"
                            aria-label="Open mobile menu">
                        <i class="bi bi-list text-secondary fs-4" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu"
             class="hidden lg:hidden border-t border-purple-50 bg-white/98 backdrop-blur-xl px-6 py-4 space-y-1"
             role="menu" aria-label="Mobile navigation">
            <a href="{{ url('/') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-plum-light hover:text-plum transition-all" role="menuitem">Home</a>
            <a href="/shop"          class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-plum-light hover:text-plum transition-all" role="menuitem">Shop</a>
            <a href="/contact"       class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-plum-light hover:text-plum transition-all" role="menuitem">Contact</a>
            <div class="pt-3">
                <a href="/shop" class="block text-center btn-primary px-6 py-3 rounded-full shadow text-sm" role="menuitem">Order Now 🎀</a>
            </div>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
    <main id="main-content" class="relative z-10">
        @yield('content')
    </main>

    <!-- ══ FOOTER ══ -->
    <footer class="bg-white border-t border-purple-50 mt-16" role="contentinfo" aria-label="Site footer">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
            <div class="grid lg:grid-cols-[minmax(320px,1fr)_minmax(320px,420px)] gap-12 lg:gap-24 items-start">

                <!-- Brand -->
                <div class="max-w-md">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 rounded-xl btn-primary flex items-center justify-center shadow-md text-base">
                            <img src="{{ asset('images/joyous_logo_2.png') }}" alt="Joyous logo" class="w-20 h-12" width="80" height="48">
                        </div>
                        <div>
                            <span class="text-xl font-serif font-bold grad-text tracking-wide">Joyous</span>
                            <span class="hidden sm:block text-black font-extrabold uppercase tracking-[0.15em] -mt-0.5">Cakes N Accessories</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 leading-relaxed mb-5">Professional baking accessories for home bakers and pastry artists. Elevate every bake.</p>
                    <div class="flex gap-2.5">
                        @foreach(['#','#','#'] as $i => $link)
                        <a href="{{ $link }}"
                           class="w-8 h-8 rounded-full bg-purple-50 border border-purple-100 flex items-center justify-center hover:bg-plum hover:border-plum transition-all group"
                           aria-label="{{ $i === 0 ? 'Instagram' : ($i === 1 ? 'Facebook' : 'TikTok') }}"
                           rel="noopener noreferrer" target="_blank">
                            @if($i===0)
                                <i class="bi bi-instagram text-plum group-hover:text-white transition-colors" aria-hidden="true"></i>
                            @elseif($i===1)
                                <i class="bi bi-facebook text-plum group-hover:text-white transition-colors" aria-hidden="true"></i>
                            @else
                                <i class="bi bi-tiktok text-plum group-hover:text-white transition-colors" aria-hidden="true"></i>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="lg:justify-self-end w-full max-w-md">
                    <h2 class="font-semibold text-gray-900 mb-5 text-xs uppercase tracking-widest">Stay Inspired</h2>
                    <p class="text-sm text-gray-500 mb-4 leading-relaxed">Get baking tips, new arrivals, and exclusive discounts straight to your inbox.</p>
                    <form action="{{ route('subscribe') }}" method="POST" class="flex flex-col gap-2" aria-label="Newsletter subscription">
                        @csrf
                        <label for="newsletter-email" class="sr-only">Email address</label>
                        <input
                            type="email"
                            id="newsletter-email"
                            name="email"
                            placeholder="your@email.com"
                            required
                            autocomplete="email"
                            class="w-full px-4 py-3 rounded-xl border border-purple-100 bg-purple-50 text-sm focus:outline-none focus:border-plum focus:ring-2 focus:ring-purple-100 transition-all placeholder-gray-400"
                        >
                        <button
                            type="submit"
                            class="w-full btn-primary text-sm font-semibold py-3 rounded-xl shadow hover:scale-[1.02] transition-all duration-200">
                            <span>Subscribe</span>
                        </button>
                    </form>

                    @if(session('success'))
                        <div class="mt-3 text-sm text-green-600 font-medium" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <p class="text-xs text-gray-400 mt-3">No spam. Unsubscribe anytime.</p>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-purple-50 bg-purple-50/40">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs text-gray-400">© {{ date('Y') }} Joyous. All rights reserved. Made with 💜 for bakers.</p>
                <nav class="flex items-center gap-5" aria-label="Legal links">
                    <a href="/privacy-policy" class="text-xs text-gray-400 hover:text-plum transition-colors">Privacy Policy</a>
                    <a href="/terms"          class="text-xs text-gray-400 hover:text-plum transition-colors">Terms</a>
                    <a href="/cookies"        class="text-xs text-gray-400 hover:text-plum transition-colors">Cookies</a>
                </nav>
            </div>
        </div>
    </footer>

    @stack('scripts')

    {{-- ══════════════════════════════════
         Mobile menu toggle — aria-expanded kept in sync
    ══════════════════════════════════ --}}
    <script>
    (function () {
        const btn  = document.getElementById('mobileMenuBtn');
        const menu = document.getElementById('mobileMenu');
        if (!btn || !menu) return;
        btn.addEventListener('click', function () {
            const open = menu.classList.toggle('hidden') === false;
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    })();
    </script>
</body>
</html>