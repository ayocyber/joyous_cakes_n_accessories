<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Joyous') }} — @yield('title', 'Cakes N  Baking Accessories')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;1,500&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
  
    </style>

    @stack('styles')
    <script src="/js/cart-utils.js"></script>
</head>
<body class="bg-white text-gray-800 antialiased overflow-x-hidden">

    <!-- ══ NAVBAR ══ -->
    <nav class="nav-glass fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-[68px]">

                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                            <img src="{{ asset('images/joyous_logo_2.png') }}" alt="Logo" class="w-20 h-12">
                        
                    <div>
                        <span class="text-xl font-serif font-bold grad-text tracking-wide">Joyous</span>
                        <span class="hidden sm:block text-black text-black-900 font-extrabold uppercase tracking-[0.15em] -mt-0.5 ">Cakes N  Accessories</span>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden lg:flex items-center gap-7">
                    <a href="{{ url('/') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-plum transition-colors">Home</a>
                    <a href="/shop" class="nav-link text-sm font-medium text-gray-600 hover:text-plum transition-colors">Shop</a>
                    <a href="/contact" class="nav-link text-sm font-medium text-gray-600 hover:text-plum transition-colors">Contact us</a>
                   
                </div>

                <!-- Right Icons -->
                <div class="flex items-center gap-2">
                   

                    {{-- <!-- Wishlist -->
                    <a href="#" class="relative p-2 rounded-full hover:bg-purple-50 transition-colors group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-plum transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </a> --}}

                    <!-- Cart -->
                    <a href="/cart" class="relative p-2 rounded-full hover:bg-purple-50 transition-colors group">
                        <i class="bi bi-bag text-gray-400 group-hover:text-plum transition-colors"></i>
                        <span data-cart-count
                            class="absolute -top-0.5 -right-0.5 w-4 h-4 cart-badge rounded-full text-white text-[10px] flex items-center justify-center font-bold">
                        </span>
                    </a>

                   
                    <!-- Mobile menu -->
                    <button id="mobileMenuBtn" class="lg:hidden p-2 rounded-xl hover:bg-purple-50 transition-colors">
                       <i class="bi bi-list text-secondary fs-4"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden border-t border-purple-50 bg-white/98 backdrop-blur-xl px-6 py-4 space-y-1">
            <a href="{{ url('/') }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-plum-light hover:text-plum transition-all">Home</a>
            <a href="/shop" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-plum-light hover:text-plum transition-all">Shop</a>
            <a href="/contact" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-plum-light hover:text-plum transition-all">Contact</a>
            <div class="pt-3">
                <a href="#" class="block text-center btn-primary px-6 py-3 rounded-full shadow text-sm">Order Now 🎀</a>
            </div>
        </div>
    </nav>

    <!-- PAGE CONTENT -->
   <main class="relative z-10 ">
    @yield('content')
</main>

    <!-- ══ FOOTER ══ -->
    <footer class="bg-white border-t border-purple-50 mt-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

                <!-- Brand -->
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 rounded-xl btn-primary flex items-center justify-center shadow-md text-base">
                             <img src="{{ asset('images/joyous_logo_2.png') }}" alt="Logo" class="w-20 h-12">
                        </div>
                        <div>
                        <span class="text-xl font-serif font-bold grad-text tracking-wide">Joyous</span>
                        <span class="hidden sm:block text-black text-black-900 font-extrabold uppercase tracking-[0.15em] -mt-0.5 ">Cakes N  Accessories</span>
                    </div>

                    </div>
                    <p class="text-sm text-gray-500 leading-relaxed mb-5">Professional baking accessories for home bakers and pastry artists. Elevate every bake.</p>
                    <div class="flex gap-2.5">
                        @foreach(['#','#','#'] as $i => $link)
                        <a href="{{ $link }}" class="w-8 h-8 rounded-full bg-purple-50 border border-purple-100 flex items-center justify-center hover:bg-plum hover:border-plum transition-all group">
                            @if($i===0)
                                <i class="bi bi-instagram text-plum group-hover:text-white transition-colors"></i>
                            @elseif($i===1)
                                <i class="bi bi-facebook text-plum group-hover:text-white transition-colors"></i>
                            @else
                                <i class="bi bi-tiktok text-plum group-hover:text-white transition-colors"></i>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold text-gray-900 mb-5 text-xs uppercase tracking-widest">Shop</h4>
                    <ul class="space-y-3">
                        @foreach(['Cake Tins & Moulds','Decorating Tools','Fondant & Icing','Presentation','Starter Kits','Gift Sets'] as $link)
                        <li><a href="/shop" class="text-sm text-gray-500 hover:text-plum transition-colors flex items-center gap-2 group">
                            <span class="w-1 h-1 rounded-full bg-purple-200 group-hover:bg-plum transition-colors"></span>{{ $link }}
                        </a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Help -->
                <div>
                    <h4 class="font-semibold text-gray-900 mb-5 text-xs uppercase tracking-widest">Help</h4>
                    <ul class="space-y-3">
                        @foreach(['FAQ','Shipping & Returns','Track Your Order','Wholesale Enquiry','Contact Us','Size Guide'] as $link)
                        <li><a href="#" class="text-sm text-gray-500 hover:text-plum transition-colors flex items-center gap-2 group">
                            <span class="w-1 h-1 rounded-full bg-purple-200 group-hover:bg-plum transition-colors"></span>{{ $link }}
                        </a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="font-semibold text-gray-900 mb-5 text-xs uppercase tracking-widest">Stay Inspired</h4>
                    <p class="text-sm text-gray-500 mb-4 leading-relaxed">Get baking tips, new arrivals, and exclusive discounts straight to your inbox.</p>
                    <div class="flex flex-col gap-2">
                        <input type="email" placeholder="your@email.com"
                            class="w-full px-4 py-3 rounded-xl border border-purple-100 bg-purple-50 text-sm focus:outline-none focus:border-plum focus:ring-2 focus:ring-purple-100 transition-all placeholder-gray-400">
                        <button class="w-full btn-primary text-sm font-semibold py-3 rounded-xl shadow hover:scale-[1.02] transition-all duration-200">
                            <span>Subscribe ✨</span>
                        </button>
                    </div>
                    <p class="text-xs text-gray-400 mt-3">No spam. Unsubscribe anytime.</p>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-purple-50 bg-purple-50/40">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs text-gray-400">© {{ date('Y') }} Joyous. All rights reserved. Made with 💜 for bakers.</p>
                <div class="flex items-center gap-5">
                    <a href="#" class="text-xs text-gray-400 hover:text-plum transition-colors">Privacy Policy</a>
                    <a href="#" class="text-xs text-gray-400 hover:text-plum transition-colors">Terms</a>
                    <a href="#" class="text-xs text-gray-400 hover:text-plum transition-colors">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>