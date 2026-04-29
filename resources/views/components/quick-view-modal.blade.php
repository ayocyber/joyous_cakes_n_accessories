{{-- ══════════════════════════════════
     QUICK VIEW MODAL
     Include once per page: @include('components.quick-view-modal')
══════════════════════════════════ --}}

<div id="quickViewOverlay"
     style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.55);
            display:flex;align-items:center;justify-content:center;padding:16px;
            opacity:0;pointer-events:none;transition:opacity 0.25s;">

    <div id="quickViewModal"
         style="background:#fff;border-radius:20px;width:100%;max-width:680px;
                max-height:90vh;overflow-y:auto;display:grid;grid-template-columns:1fr 1fr;
                position:relative;opacity:0;
                transform:scale(0.95) translateY(16px);
                transition:opacity 0.25s, transform 0.25s;">

        {{-- Close --}}
        <button onclick="closeQuickView()"
                class="absolute top-3 right-3 z-20 w-8 h-8 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center transition-colors">
            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        {{-- Image panel --}}
        <div id="qvImagePanel"
             class="relative bg-gradient-to-br from-purple-50 to-pink-100 rounded-t-2xl md:rounded-l-2xl md:rounded-tr-none flex items-center justify-center p-8 min-h-[240px]">

            <span id="qvBadge"
                  class="hidden absolute top-3 left-3 text-xs font-semibold text-white px-3 py-1 rounded-full bg-plum">
            </span>

            <button id="qvWishBtn"
                    onclick="toggleQvWish()"
                    class="absolute top-3 right-10 w-8 h-8 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-plum group transition-all shadow">
                <svg id="qvWishIcon"
                     class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0
                             00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </button>

            <img id="qvImage" src="" alt=""
                 class="w-full h-full object-cover rounded-xl max-h-60">
        </div>

        {{-- Info panel --}}
        <div class="p-7 flex flex-col gap-4">

            <span class="text-xs font-semibold text-plum uppercase tracking-widest">
                Baking Accessories
            </span>

            <h2 id="qvName"
                class="font-serif text-xl font-bold text-gray-900 leading-snug">
            </h2>

            {{-- Stars + reviews --}}
            <div class="flex items-center gap-1.5">
                <div id="qvStars" class="flex gap-0.5"></div>
                <span id="qvReviews" class="text-xs text-gray-400"></span>
            </div>

            {{-- Price --}}
            <div class="flex items-baseline gap-2 flex-wrap">
                <span id="qvPrice"    class="text-2xl font-bold text-plum"></span>
                <span id="qvOldPrice" class="text-sm text-gray-400 line-through hidden"></span>
                <span id="qvSavings"  class="hidden text-xs font-semibold bg-pink-100 text-pink-700 px-2 py-0.5 rounded-full"></span>
            </div>

            <hr class="border-gray-100">

            {{-- Quantity --}}
            <div class="flex items-center gap-3">
                <label class="text-xs text-gray-500 font-medium">Qty</label>
                <div class="flex items-center border border-purple-100 rounded-lg overflow-hidden">
                    <button onclick="qvQty(-1)"
                            class="w-9 h-9 bg-purple-50 hover:bg-purple-100 text-plum font-bold text-lg transition-colors">
                        −
                    </button>
                    <input id="qvQtyInput" type="number" value="1" min="1" max="99" readonly
                           class="w-10 h-9 text-center text-sm font-medium border-x border-purple-100 bg-white text-gray-900 outline-none">
                    <button onclick="qvQty(1)"
                            class="w-9 h-9 bg-purple-50 hover:bg-purple-100 text-plum font-bold text-lg transition-colors">
                        +
                    </button>
                </div>
                <span id="qvSubtotal" class="text-xs text-gray-500 ml-auto"></span>
            </div>

            {{-- Actions --}}
            <button id="qvCartBtn"
                    onclick="qvAddToCart()"
                    class="btn-primary w-full py-3 rounded-full font-semibold text-sm flex items-center justify-center gap-2 hover:scale-[1.02] transition-transform shadow">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184
                             1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Add to Cart
            </button>

            <a id="qvFullLink" href="/shop"
               class="w-full text-center text-sm font-semibold text-plum border border-purple-200 py-3 rounded-full hover:bg-purple-50 transition-colors">
                View Full Details →
            </a>

        </div>
    </div>
</div>