@extends('layout.app')
@section('title', 'Your Cart')

@push('styles')
<style>
/* ── Reveal ── */

</style>
@endpush

@section('content')

<!-- ══════════════════════════════════
     PAGE HEADER
══════════════════════════════════ -->
<section class="cart-hero pt-[68px] pb-10">
    <div class="max-w-7xl mx-auto px-5 lg:px-8 pt-10 relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-gray-400 mb-6">
            <a href="/" class="hover:text-plum transition-colors">Home</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="/shop" class="hover:text-plum transition-colors">Shop</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-plum font-semibold">Cart</span>
        </nav>

        <div class="flex flex-wrap items-end gap-4 justify-between">
            <div>
                <span class="text-xs font-semibold text-plum uppercase tracking-widest">Your Shopping Bag</span>
                <h1 class="font-serif text-4xl lg:text-5xl font-bold text-gray-900 mt-1">
                    My <em class="grad-text not-italic">Cart</em>
                    <span id="cartCountBadge" class="align-middle inline-flex items-center justify-center w-9 h-9 rounded-full bg-plum text-white text-sm font-bold ml-3 shadow-md">3</span>
                </h1>
            </div>
            <a href="/shop" class="flex items-center gap-2 text-sm font-semibold text-plum hover:text-blush transition-colors group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
                Continue Shopping
            </a>
        </div>
    </div>
</section>


<!-- ══════════════════════════════════
     MAIN LAYOUT
══════════════════════════════════ -->
<section class="pb-20" style="background:#faf8ff;">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8 items-start">

            <!-- ══════════════
                 LEFT: ITEMS
            ══════════════ -->
            <div class="flex-1 min-w-0 space-y-4" id="cartItemsList">

                @php
                    $cartItems = [
                        [
                            'id'     => 1,
                            'name'   => 'Non-Stick Round Tin Set (3pc)',
                            'cat'    => 'Tins & Moulds',
                            'price'  => 8500,
                            'qty'    => 2,
                            'badge'  => 'Bestseller',
                            'emoji'  => '🍰',
                            'bg'     => 'from-purple-50 to-purple-100',
                            'stock'  => 12,
                        ],
                        [
                            'id'     => 2,
                            'name'   => 'Piping Tips Collection (24pc)',
                            'cat'    => 'Piping & Decorating',
                            'price'  => 6200,
                            'qty'    => 1,
                            'badge'  => 'Popular',
                            'emoji'  => '🎨',
                            'bg'     => 'from-pink-50 to-rose-100',
                            'stock'  => 8,
                        ],
                        [
                            'id'     => 3,
                            'name'   => 'Professional Turntable',
                            'cat'    => 'Turntables',
                            'price'  => 15000,
                            'qty'    => 1,
                            'badge'  => 'Premium',
                            'emoji'  => '🎠',
                            'bg'     => 'from-indigo-50 to-purple-100',
                            'stock'  => 4,
                        ],
                    ];
                @endphp

                @forelse($cartItems as $item)
                <div class="cart-item p-5" data-id="{{ $item['id'] }}" data-price="{{ $item['price'] }}" data-stock="{{ $item['stock'] }}">
                    <div class="flex items-start gap-4">

                        <!-- Thumb -->
                        <div class="item-thumb bg-gradient-to-br {{ $item['bg'] }}">
                            {{ $item['emoji'] }}
                        </div>

                        <!-- Details -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2 flex-wrap">
                                <div>
                                    <span class="text-xs font-semibold text-plum bg-purple-50 px-2.5 py-0.5 rounded-full">{{ $item['badge'] }}</span>
                                    <p class="font-serif font-bold text-gray-900 text-base mt-1.5 leading-tight">{{ $item['name'] }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $item['cat'] }}</p>
                                </div>
                                <!-- Remove -->
                                <button class="remove-btn" onclick="removeItem({{ $item['id'] }})" title="Remove item">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>

                            <!-- Price + controls row -->
                            <div class="flex items-center justify-between flex-wrap gap-3 mt-4">
                                <!-- Qty stepper -->
                                <div class="qty-wrap" data-id="{{ $item['id'] }}">
                                    <button class="qty-btn qty-minus" onclick="changeQty({{ $item['id'] }}, -1)" {{ $item['qty'] <= 1 ? 'disabled' : '' }}>−</button>
                                    <span class="qty-num" id="qty-{{ $item['id'] }}">{{ $item['qty'] }}</span>
                                    <button class="qty-btn qty-plus" onclick="changeQty({{ $item['id'] }}, 1)" {{ $item['qty'] >= $item['stock'] ? 'disabled' : '' }}>+</button>
                                </div>

                                <!-- Line price -->
                                <div class="text-right">
                                    <p class="text-xs text-gray-400">Unit price: <span class="font-medium text-gray-600">₦{{ number_format($item['price']) }}</span></p>
                                    <p class="font-serif font-bold text-plum text-lg" id="line-{{ $item['id'] }}">₦{{ number_format($item['price'] * $item['qty']) }}</p>
                                </div>
                            </div>

                            <!-- Save for later -->
                            <div class="mt-3 flex items-center gap-4">
                                <button class="save-btn" onclick="saveForLater({{ $item['id'] }})">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                    Save for Later
                                </button>
                                <span class="text-gray-200">|</span>
                                <span class="text-xs text-green-600 font-semibold flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    In Stock ({{ $item['stock'] }} left)
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                @empty
                <!-- Empty cart state -->
                <div class="bg-white rounded-3xl border border-purple-50 shadow-sm empty-state" id="emptyState">
                    <div class="empty-bag">🛒</div>
                    <h2 class="font-serif text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
                    <p class="text-gray-400 text-sm mb-8 max-w-xs mx-auto">Looks like you haven't added anything yet. Explore our collection and find something you'll love!</p>
                    <a href="/shop" class="btn-primary px-8 py-4 rounded-full font-semibold text-sm inline-flex items-center gap-2 shadow-xl hover:scale-105 transition-all">
                        <span>Start Shopping</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                @endforelse

                <!-- Saved for later (hidden by default; JS populates) -->
                <div id="savedSection" class="hidden">
                    <div class="flex items-center gap-3 my-6">
                        <div class="flex-1 h-px bg-purple-100"></div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Saved for Later</span>
                        <div class="flex-1 h-px bg-purple-100"></div>
                    </div>
                    <div id="savedList" class="space-y-3"></div>
                </div>

            </div>{{-- end items --}}


            <!-- ══════════════
                 RIGHT: SUMMARY
            ══════════════ -->
            <div class="w-full lg:w-[360px] shrink-0">
                <div class="summary-card reveal d2">

                    <!-- Header -->
                    <div class="summary-header">
                        <p class="text-white/70 text-xs font-semibold uppercase tracking-widest mb-0.5">Order Summary</p>
                        <p class="text-white font-serif text-2xl font-bold" id="summaryTotal">₦37,200</p>
                        <p class="text-white/60 text-xs mt-1" id="summaryItemCount">3 items in your cart</p>
                    </div>

                    <div class="summary-body space-y-2">

                        <!-- Free shipping progress -->
                        <div class="bg-purple-50 rounded-xl p-3.5 mb-4 border border-purple-100">
                            <div class="flex justify-between text-xs mb-2">
                                <span class="font-semibold text-gray-700">🚚 Free Shipping Progress</span>
                                <span class="font-bold text-plum" id="shippingLeft">₦12,800 away</span>
                            </div>
                            <div class="shipping-bar">
                                <div class="shipping-fill" id="shippingFill" style="width: 74%"></div>
                            </div>
                            <p class="text-xs text-gray-400 mt-2">Spend ₦50,000 or more for free delivery</p>
                        </div>

                        <!-- Coupon -->
                        <div class="coupon-wrap">
                            <input type="text" id="couponInput" class="coupon-input" placeholder="Coupon code…">
                            <button class="coupon-btn" onclick="applyCoupon()">Apply</button>
                        </div>

                        <!-- Line items -->
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span class="font-semibold text-gray-800" id="subtotalVal">₦37,200</span>
                        </div>
                        <div class="summary-row" id="discountRow" style="display:none;">
                            <span class="text-green-600">Discount</span>
                            <span class="font-semibold text-green-600" id="discountVal">−₦0</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span class="font-semibold text-gray-800" id="shippingVal">₦1,500</span>
                        </div>
                        <div class="summary-row">
                            <span>VAT (7.5%)</span>
                            <span class="font-semibold text-gray-800" id="vatVal">₦2,790</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span class="grad-text" id="totalVal">₦41,490</span>
                        </div>

                        <!-- Checkout CTA -->
                        <a href="/checkout"
                           class="checkout-btn w-full btn-primary font-bold py-4 rounded-full shadow-xl hover:scale-[1.02] transition-all text-sm flex items-center justify-center gap-2 mt-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Proceed to Checkout
                        </a>

                        <!-- Payment icons -->
                        <div class="flex items-center justify-center gap-2 mt-3 flex-wrap">
                            @foreach(['💳','🏦','📱'] as $ico)
                            <div class="bg-gray-50 border border-gray-100 rounded-lg px-3 py-1.5 text-xs text-gray-500 font-medium flex items-center gap-1.5">
                                {{ $ico }}
                                @if($ico === '💳') Card
                                @elseif($ico === '🏦') Bank Transfer
                                @else Mobile Pay
                                @endif
                            </div>
                            @endforeach
                        </div>

                        <!-- Trust strip -->
                        <div class="trust-strip">
                            <div class="trust-item">
                                <div class="text-xl mb-1">🔒</div>
                                <p class="text-xs font-semibold text-gray-700">Secure</p>
                                <p class="text-xs text-gray-400">SSL Encrypted</p>
                            </div>
                            <div class="trust-item">
                                <div class="text-xl mb-1">↩️</div>
                                <p class="text-xs font-semibold text-gray-700">Returns</p>
                                <p class="text-xs text-gray-400">7-day policy</p>
                            </div>
                            <div class="trust-item">
                                <div class="text-xl mb-1">📦</div>
                                <p class="text-xs font-semibold text-gray-700">Delivery</p>
                                <p class="text-xs text-gray-400">2–5 days</p>
                            </div>
                        </div>

                        <!-- Need help? -->
                        <p class="text-center text-xs text-gray-400 mt-2">
                            Questions?
                            <a href="/contact" class="text-plum font-semibold hover:underline">Chat with us →</a>
                        </p>

                    </div>
                </div>
            </div>

        </div>{{-- end flex --}}


        <!-- ══════════════════════════════════
             YOU MAY ALSO LIKE
        ══════════════════════════════════ -->
        <div class="mt-16 reveal">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <span class="text-xs font-semibold text-plum uppercase tracking-widest">Handpicked For You</span>
                    <h2 class="font-serif text-3xl font-bold text-gray-900 mt-1">You May Also <em class="grad-text not-italic">Love</em></h2>
                </div>
                <a href="/shop" class="text-sm font-semibold text-plum hover:text-blush flex items-center gap-1 group transition-colors">
                    See All
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            @php
                $recos = [
                    ['name'=>'Silicone Bundt Mould','price'=>'5,500','old'=>'7,000','emoji'=>'🧁','bg'=>'from-purple-100 to-pink-50','badge'=>'New'],
                    ['name'=>'Fondant Smoother Set','price'=>'4,800','old'=>'6,500','emoji'=>'🍬','bg'=>'from-fuchsia-50 to-pink-100','badge'=>'Sale'],
                    ['name'=>'Offset Spatula Set (3)','price'=>'4,100','old'=>null,'emoji'=>'🔪','bg'=>'from-pink-50 to-purple-50','badge'=>null],
                    ['name'=>"Baker's Starter Kit",'price'=>'22,000','old'=>null,'emoji'=>'🎁','bg'=>'from-purple-50 to-indigo-100','badge'=>'Gift'],
                ];
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($recos as $r)
                <div class="reco-card">
                    <div class="reco-img bg-gradient-to-br {{ $r['bg'] }} relative">
                        {{ $r['emoji'] }}
                        @if($r['badge'])
                        <span class="absolute top-2 left-2 text-xs font-bold text-white px-2.5 py-1 rounded-full shadow
                            {{ $r['badge']==='Sale' ? 'bg-blush' : 'bg-plum' }}">{{ $r['badge'] }}</span>
                        @endif
                    </div>
                    <div class="p-3.5">
                        <p class="font-medium text-gray-900 text-sm mb-1 truncate">{{ $r['name'] }}</p>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="font-bold text-plum text-sm">₦{{ $r['price'] }}</span>
                            @if($r['old'])<span class="text-xs text-gray-400 line-through">₦{{ $r['old'] }}</span>@endif
                        </div>
                        <button class="w-full btn-primary text-xs font-semibold py-2.5 rounded-full hover:scale-[1.02] transition-transform shadow">
                            🛒 Add to Cart
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

<!-- ── Toast ── -->
<div id="toast" class="fixed bottom-6 right-6 z-50 bg-white rounded-2xl shadow-2xl border border-purple-100 px-5 py-4 flex items-center gap-3 translate-y-24 opacity-0 transition-all duration-500 pointer-events-none max-w-xs">
    <span class="text-2xl" id="toastIcon">✅</span>
    <div>
        <p class="text-sm font-bold text-gray-900" id="toastTitle">Done!</p>
        <p class="text-xs text-gray-400" id="toastMsg">Item updated.</p>
    </div>
</div>

@endsection

@push('scripts')
<script>
/* ═══════════════════════════════════
   CART STATE
═══════════════════════════════════ */
const FREE_SHIPPING_THRESHOLD = 50000;
const SHIPPING_COST = 1500;
const VAT_RATE = 0.075;

// Build initial state from rendered PHP data
let cart = {
    @foreach($cartItems as $item)
    {{ $item['id'] }}: { id: {{ $item['id'] }}, name: @json($item['name']), price: {{ $item['price'] }}, qty: {{ $item['qty'] }}, stock: {{ $item['stock'] }}, emoji: @json($item['emoji']) },
    @endforeach
};

let savedItems = {};
let discount = 0;

/* ── Helpers ── */
function fmt(n) { return '₦' + Math.round(n).toLocaleString('en-NG'); }

function subtotal() {
    return Object.values(cart).reduce((s, i) => s + i.price * i.qty, 0);
}

function updateSummary() {
    const sub    = subtotal();
    const disc   = sub * discount;
    const afterDisc = sub - disc;
    const ship   = afterDisc >= FREE_SHIPPING_THRESHOLD ? 0 : SHIPPING_COST;
    const vat    = afterDisc * VAT_RATE;
    const total  = afterDisc + ship + vat;
    const toFree = Math.max(0, FREE_SHIPPING_THRESHOLD - afterDisc);
    const pct    = Math.min(100, (afterDisc / FREE_SHIPPING_THRESHOLD) * 100);

    document.getElementById('subtotalVal').textContent  = fmt(sub);
    document.getElementById('vatVal').textContent       = fmt(vat);
    document.getElementById('shippingVal').textContent  = ship === 0 ? 'FREE 🎉' : fmt(ship);
    document.getElementById('totalVal').textContent     = fmt(total);
    document.getElementById('summaryTotal').textContent = fmt(total);
    document.getElementById('shippingFill').style.width = pct + '%';
    document.getElementById('shippingLeft').textContent = toFree > 0 ? fmt(toFree) + ' away' : 'You have free shipping! 🎉';

    if (disc > 0) {
        document.getElementById('discountRow').style.display = 'flex';
        document.getElementById('discountVal').textContent = '−' + fmt(disc);
    } else {
        document.getElementById('discountRow').style.display = 'none';
    }

    const count = Object.values(cart).reduce((s,i) => s + i.qty, 0);
    document.getElementById('cartCountBadge').textContent = count;
    document.getElementById('summaryItemCount').textContent = count + ' item' + (count !== 1 ? 's' : '') + ' in your cart';

    checkEmpty();
}

function checkEmpty() {
    const isEmpty = Object.keys(cart).length === 0;
    const list    = document.getElementById('cartItemsList');
    let empty     = document.getElementById('emptyState');

    if (isEmpty && !empty) {
        const div = document.createElement('div');
        div.id = 'emptyState';
        div.className = 'bg-white rounded-3xl border border-purple-50 shadow-sm empty-state';
        div.innerHTML = `
            <div class="empty-bag">🛒</div>
            <h2 class="font-serif text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-400 text-sm mb-8 max-w-xs mx-auto">Looks like you haven't added anything yet. Explore our collection!</p>
            <a href="/shop" class="btn-primary px-8 py-4 rounded-full font-semibold text-sm inline-flex items-center gap-2 shadow-xl hover:scale-105 transition-all">
                <span>Start Shopping</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>`;
        list.appendChild(div);
    }
}

/* ── Quantity change ── */
function changeQty(id, delta) {
    const item = cart[id];
    if (!item) return;
    const newQty = item.qty + delta;
    if (newQty < 1 || newQty > item.stock) return;

    item.qty = newQty;

    const qtyEl   = document.getElementById('qty-' + id);
    const lineEl  = document.getElementById('line-' + id);
    const wrap    = document.querySelector('.qty-wrap[data-id="' + id + '"]');
    const minBtn  = wrap.querySelector('.qty-minus');
    const maxBtn  = wrap.querySelector('.qty-plus');

    qtyEl.textContent  = newQty;
    lineEl.textContent = fmt(item.price * newQty);
    minBtn.disabled    = newQty <= 1;
    maxBtn.disabled    = newQty >= item.stock;

    // Pulse the line price
    lineEl.style.transform = 'scale(1.15)';
    lineEl.style.transition = 'transform .2s';
    setTimeout(() => { lineEl.style.transform = 'scale(1)'; }, 200);

    updateSummary();
    showToast('🛒', 'Cart updated', item.name + ' × ' + newQty);
}

/* ── Remove item ── */
function removeItem(id) {
    const el = document.querySelector('.cart-item[data-id="' + id + '"]');
    if (!el) return;
    el.classList.add('removing');
    setTimeout(() => {
        el.remove();
        delete cart[id];
        updateSummary();
    }, 420);
    showToast('🗑️', 'Item removed', 'Removed from your cart.');
}

/* ── Save for later ── */
function saveForLater(id) {
    const item = cart[id];
    if (!item) return;

    savedItems[id] = item;
    delete cart[id];

    // Remove from list
    const el = document.querySelector('.cart-item[data-id="' + id + '"]');
    if (el) { el.classList.add('removing'); setTimeout(() => el.remove(), 420); }

    // Show saved section
    const section = document.getElementById('savedSection');
    const list    = document.getElementById('savedList');
    section.classList.remove('hidden');

    const card = document.createElement('div');
    card.id = 'saved-' + id;
    card.className = 'bg-white rounded-2xl border border-purple-50 p-4 flex items-center gap-4 shadow-sm';
    card.innerHTML = `
        <div class="w-14 h-14 rounded-xl bg-purple-50 flex items-center justify-center text-3xl">${item.emoji}</div>
        <div class="flex-1 min-w-0">
            <p class="font-semibold text-gray-900 text-sm truncate">${item.name}</p>
            <p class="text-xs text-gray-400 mt-0.5">${fmt(item.price)}</p>
        </div>
        <button onclick="moveToCart(${id})"
            class="text-xs font-bold text-plum border border-purple-200 px-4 py-2 rounded-full hover:bg-plum hover:text-white hover:border-plum transition-all whitespace-nowrap">
            Move to Cart
        </button>`;
    list.appendChild(card);

    updateSummary();
    showToast('💜', 'Saved for later', item.name + ' moved to saved items.');
}

/* ── Move saved item back to cart ── */
function moveToCart(id) {
    const item = savedItems[id];
    if (!item) return;
    item.qty = 1;
    cart[id] = item;
    delete savedItems[id];

    const savedCard = document.getElementById('saved-' + id);
    if (savedCard) savedCard.remove();

    if (Object.keys(savedItems).length === 0) {
        document.getElementById('savedSection').classList.add('hidden');
    }

    // Re-render the item card in the main list
    const list = document.getElementById('cartItemsList');
    const card = document.createElement('div');
    card.className = 'cart-item p-5';
    card.setAttribute('data-id', id);
    card.setAttribute('data-price', item.price);
    card.setAttribute('data-stock', item.stock);
    card.style.animation = 'popIn .45s cubic-bezier(.34,1.56,.64,1) both';
    card.innerHTML = `
        <div class="flex items-start gap-4">
            <div class="item-thumb bg-gradient-to-br from-purple-50 to-purple-100">${item.emoji}</div>
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-2 flex-wrap">
                    <div>
                        <p class="font-serif font-bold text-gray-900 text-base mt-1.5">${item.name}</p>
                    </div>
                    <button class="remove-btn" onclick="removeItem(${id})" title="Remove item">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="flex items-center justify-between flex-wrap gap-3 mt-4">
                    <div class="qty-wrap" data-id="${id}">
                        <button class="qty-btn qty-minus" onclick="changeQty(${id}, -1)" disabled>−</button>
                        <span class="qty-num" id="qty-${id}">1</span>
                        <button class="qty-btn qty-plus" onclick="changeQty(${id}, 1)">+</button>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400">Unit price: <span class="font-medium text-gray-600">${fmt(item.price)}</span></p>
                        <p class="font-serif font-bold text-plum text-lg" id="line-${id}">${fmt(item.price)}</p>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="save-btn" onclick="saveForLater(${id})">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        Save for Later
                    </button>
                </div>
            </div>
        </div>`;
    // Insert before saved section
    const savedSection = document.getElementById('savedSection');
    list.insertBefore(card, savedSection);

    updateSummary();
    showToast('🛒', 'Moved to cart', item.name + ' is back in your cart.');
}

/* ── Coupon ── */
function applyCoupon() {
    const code = document.getElementById('couponInput').value.trim().toUpperCase();
    const valid = { 'BAKE10': 0.10, 'SWEET15': 0.15, 'BAKER20': 0.20 };
    if (valid[code]) {
        discount = valid[code];
        showToast('🎉', 'Coupon applied!', Math.round(discount * 100) + '% discount added.');
        updateSummary();
    } else {
        showToast('❌', 'Invalid code', 'Try BAKE10, SWEET15 or BAKER20.');
    }
}

document.getElementById('couponInput')?.addEventListener('keydown', e => { if(e.key === 'Enter') applyCoupon(); });

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
    }, 3200);
}

/* ── Reveal ── */
const ro = new IntersectionObserver(es => es.forEach(e => { if(e.isIntersecting) e.target.classList.add('in'); }), { threshold:0.1 });
document.querySelectorAll('.reveal').forEach(el => ro.observe(el));

/* ── Boot ── */
updateSummary();
</script>
@endpush