@extends('layout.app')
@section('title', 'Checkout')
 
@push('styles')
<style>
.step-node {
    display: flex; align-items: center; justify-content: center;
    width: 32px; height: 32px; border-radius: 50%;
    font-size: 13px; font-weight: 700;
    transition: all .3s ease;
}
.step-node.active   { background: var(--plum, #6d28d9); color: #fff; box-shadow: 0 0 0 4px rgba(109,40,217,.15); }
.step-node.done     { background: #10b981; color: #fff; }
.step-node.inactive { background: #ede9fe; color: #9ca3af; }
.step-line { flex: 1; height: 2px; background: #ede9fe; }
.step-line.done { background: #10b981; }
 
.method-tab {
    flex: 1; display: flex; flex-direction: column; align-items: center; gap: 2px;
    padding: 14px 12px; border-radius: 16px; border: 2px solid transparent;
    background: #f5f3ff; cursor: pointer;
    transition: all .25s cubic-bezier(.34,1.56,.64,1);
    user-select: none;
}
.method-tab:hover       { border-color: #c4b5fd; background: #ede9fe; transform: translateY(-2px); }
.method-tab.selected    { border-color: #7c3aed; background: #ede9fe; box-shadow: 0 4px 16px rgba(109,40,217,.14); }
.method-tab.disabled-tab{ opacity: .55; cursor: not-allowed; }
 
.bank-card {
    border: 2px dashed #c4b5fd; border-radius: 20px;
    padding: 20px 24px; background: #faf8ff;
    animation: slideDown .35s cubic-bezier(.22,1,.36,1) both;
}
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to   { opacity: 1; transform: translateY(0); }
}
.copy-btn {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 999px;
    background: #ede9fe; color: #6d28d9; border: none; cursor: pointer;
    transition: background .2s, transform .15s;
}
.copy-btn:hover  { background: #7c3aed; color: #fff; transform: scale(1.05); }
.copy-btn:active { transform: scale(.97); }
 
.transfer-btn {
    width: 100%; padding: 16px; border-radius: 999px; border: none;
    background: linear-gradient(135deg, #7c3aed, #6d28d9);
    color: #fff; font-weight: 700; font-size: 15px;
    cursor: pointer; transition: all .2s cubic-bezier(.34,1.56,.64,1);
    box-shadow: 0 6px 24px rgba(109,40,217,.3);
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.transfer-btn:hover  { transform: translateY(-2px); box-shadow: 0 10px 32px rgba(109,40,217,.38); }
.transfer-btn:active { transform: translateY(0) scale(.98); }
.transfer-btn:disabled { opacity: .7; cursor: not-allowed; transform: none; }
 
.field-group { display: flex; flex-direction: column; gap: 6px; }
.field-label { font-size: 12px; font-weight: 700; color: #374151; text-transform: uppercase; letter-spacing: .04em; }
.field-input {
    padding: 12px 16px; border-radius: 12px; border: 1.5px solid #e5e7eb;
    font-size: 14px; color: #111827; background: #fff;
    transition: border-color .2s, box-shadow .2s; outline: none; width: 100%;
}
.field-input:focus { border-color: #7c3aed; box-shadow: 0 0 0 3px rgba(124,58,237,.12); }
.field-input.error { border-color: #ef4444; box-shadow: 0 0 0 3px rgba(239,68,68,.1); }
 
.order-item-row { display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f3e8ff; }
.order-item-row:last-child { border-bottom: none; }
 
.coming-soon-badge {
    font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 999px;
    background: linear-gradient(90deg, #fde68a, #fef3c7, #fde68a);
    background-size: 200% 100%;
    animation: shimmer 2s linear infinite;
    color: #92400e;
}
@keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }
@keyframes ripple  { to { transform: scale(3); opacity: 0; } }
 
/* Skeleton pulse for summary */
.skel { background: linear-gradient(90deg, #ede9fe 25%, #f5f3ff 50%, #ede9fe 75%); background-size: 200% 100%; animation: skelShimmer 1.4s infinite; border-radius: 8px; }
@keyframes skelShimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }
</style>
@endpush
 
@section('content')
 
{{-- PAGE HEADER --}}
<section class="pt-[68px] pb-10" style="background:#faf8ff;">
    <div class="max-w-7xl mx-auto px-5 lg:px-8 pt-10">
 
        <nav class="flex items-center gap-2 text-xs text-gray-400 mb-6">
            <a href="/" class="hover:text-plum transition-colors">Home</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ route('cart') }}" class="hover:text-plum transition-colors">Cart</a>
            <i class="bi bi-chevron-right"></i>
            <span class="text-plum font-semibold">Checkout</span>
        </nav>
 
        <div class="flex flex-wrap items-start justify-between gap-6">
            <div>
                <span class="text-xs font-semibold text-plum uppercase tracking-widest">Almost there</span>
                <h1 class="font-serif text-4xl lg:text-5xl font-bold text-gray-900 mt-1">
                    Check<em class="grad-text not-italic">out</em>
                </h1>
            </div>
            <div class="flex items-center gap-2 text-xs font-semibold text-gray-500 mt-2">
                <div class="step-node done">✓</div>
                <span class="hidden sm:inline text-gray-400">Cart</span>
                <div class="step-line done"></div>
                <div class="step-node active">2</div>
                <span class="hidden sm:inline text-plum">Details</span>
                <div class="step-line"></div>
                <div class="step-node inactive">3</div>
                <span class="hidden sm:inline">Confirm</span>
            </div>
        </div>
 
    </div>
</section>
 
{{-- MAIN LAYOUT --}}
<section class="pb-24" style="background:#faf8ff;">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8 items-start">
 
            {{-- ══════════════ LEFT COLUMN ══════════════ --}}
            <div class="flex-1 min-w-0 space-y-6">
 
                {{-- Empty cart warning (shown by JS if cart is empty) --}}
                <div id="emptyCartWarning" class="hidden bg-amber-50 border border-amber-200 rounded-2xl px-5 py-4 text-sm text-amber-800 font-semibold">
                    ⚠️ Your cart is empty. <a href="{{ route('shop') }}" class="underline">Go back to shop</a>
                </div>
 
                {{-- SECTION 1: Customer details --}}
                <div class="bg-white rounded-3xl border border-purple-50 shadow-sm p-6 lg:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-plum flex items-center justify-center text-white text-sm font-bold shrink-0">1</div>
                        <h2 class="font-serif text-xl font-bold text-gray-900">Your Details</h2>
                    </div>
 
                    {{-- JS validation errors shown here --}}
                    <div id="formErrors" class="hidden mb-5 bg-red-50 border border-red-200 text-red-700 rounded-2xl px-5 py-4 text-sm">
                        <p class="font-semibold mb-1">Please fix the following:</p>
                        <ul id="formErrorList" class="list-disc list-inside space-y-0.5"></ul>
                    </div>
 
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
 
                        <div class="field-group sm:col-span-2">
                            <label for="name" class="field-label">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" id="name" placeholder="e.g. Amara Chukwuemeka"
                                   class="field-input" autocomplete="name">
                        </div>
 
                        <div class="field-group">
                            <label for="email" class="field-label">Email <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="email" id="email" placeholder="you@example.com"
                                   class="field-input" autocomplete="email">
                        </div>
 
                        <div class="field-group">
                            <label for="phone" class="field-label">Phone <span class="text-red-500">*</span></label>
                            <input type="tel" id="phone" placeholder="+234 800 000 0000"
                                   class="field-input" autocomplete="tel">
                        </div>
 
                        <div class="field-group">
                            <label for="country" class="field-label">Country <span class="text-red-500">*</span></label>
                            <select id="country" class="field-input">
                                <option value="" disabled selected>Select country…</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Nigeria">Nigeria</option>
                            </select>
                        </div>
 
                        <div class="field-group">
                            <label for="state" class="field-label">State / Region <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="text" id="state" placeholder="e.g. Lagos"
                                   class="field-input" autocomplete="address-level1">
                        </div>
 
                        <div class="field-group">
                            <label for="city" class="field-label">City <span class="text-red-500">*</span></label>
                            <input type="text" id="city" placeholder="e.g. Ikeja"
                                   class="field-input" autocomplete="address-level2">
                        </div>
 
                        <div class="field-group sm:col-span-2">
                            <label for="address_line" class="field-label">Street Address <span class="text-red-500">*</span></label>
                            <input type="text" id="address_line" placeholder="e.g. 12 Broad Street, Victoria Island"
                                   class="field-input" autocomplete="street-address">
                        </div>
 
                    </div>
                </div>
 
                {{-- SECTION 2: Payment method --}}
                <div class="bg-white rounded-3xl border border-purple-50 shadow-sm p-6 lg:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-plum flex items-center justify-center text-white text-sm font-bold shrink-0">2</div>
                        <h2 class="font-serif text-xl font-bold text-gray-900">Payment Method</h2>
                    </div>
 
                    <div class="flex gap-3 mb-6">
                        <button type="button" id="tab-manual" class="method-tab selected" onclick="selectMethod('manual')">
                            <span class="text-2xl">🏦</span>
                            <span class="text-sm font-bold text-gray-800">Bank Transfer</span>
                            <span class="text-xs text-gray-400">Manual payment</span>
                        </button>
                        <button type="button" id="tab-online" class="method-tab disabled-tab" onclick="selectMethod('online')" title="Coming soon">
                            <span class="text-2xl">💳</span>
                            <span class="text-sm font-bold text-gray-800 flex items-center gap-2">
                                Card / Online <span class="coming-soon-badge">Soon</span>
                            </span>
                            <span class="text-xs text-gray-400">Paystack</span>
                        </button>
                    </div>
 
                    {{-- Manual panel --}}
                    <div id="panel-manual">
                        <p class="text-sm text-gray-500 mb-5 leading-relaxed">
                            Transfer the exact order total to any of the accounts below, then click
                            <strong class="text-gray-800">"I Have Made the Transfer"</strong>
                            to send your payment receipt via WhatsApp for confirmation.
                        </p>

                        {{-- MTN Mobile Money --}}
                        <div class="bank-card mb-4">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">
                                MTN Mobile Money (LRD & USD)
                            </p>

                            <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-gray-400">Account Number</p>
                                    <p class="text-lg font-bold text-gray-900">
                                        0886188822
                                    </p>
                                </div>

                                <button
                                    type="button"
                                    class="copy-btn"
                                    onclick="copyText('0886188822')">
                                    <i class="bi bi-files"></i>
                                    Copy
                                </button>
                            </div>

                                <div>
                                    <p class="text-xs text-gray-400">Account Name</p>
                                    <p class="text-sm font-bold text-gray-900">Joy Okpara</p>
                                </div>
                            </div>
                        </div>

                        {{-- GTB USD --}}
                        <div class="bank-card mb-5">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">
                                GTBank USD Account
                            </p>

                            <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-gray-400">Account Number</p>
                                    <p class="text-lg font-bold text-gray-900">
                                        203-329010-2590
                                    </p>
                                </div>

                                <button
                                    type="button"
                                    class="copy-btn"
                                    onclick="copyText('2033290102590')">
                                    <i class="bi bi-files"></i>
                                    Copy
                                </button>
                            </div>

                                <div>
                                    <p class="text-xs text-gray-400">Account Name</p>
                                    <p class="text-sm font-bold text-gray-900">Joy Faustina Okpara</p>
                                </div>
                            </div>
                        </div>

                        {{-- Amount --}}
                        <div class="mb-6 p-4 bg-purple-50 rounded-2xl border border-purple-100 flex items-center justify-between">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                Amount to Transfer
                            </p>

                            <p class="text-xl font-bold text-plum" id="amountDue">—</p>
                        </div>

                        <button
                            type="button"
                            id="transferBtn"
                            class="transfer-btn bg-green-600 hover:bg-green-700"
                            onclick="sendReceiptToWhatsApp()">
                            <i class="bi bi-whatsapp"></i>
                            I Have Made the Transfer
                        </button>

                        <p class="text-center text-xs text-gray-400 mt-3">
                            You'll be redirected to WhatsApp to send your payment receipt and complete order confirmation.
                        </p>
                    </div>
 
                    {{-- Online panel --}}
                    <div id="panel-online" class="hidden">
                        <div class="rounded-2xl bg-amber-50 border border-amber-200 p-6 text-center">
                            <div class="text-4xl mb-3">🚧</div>
                            <p class="font-bold text-gray-800 mb-1">Online payment coming soon</p>
                            <p class="text-sm text-gray-500 max-w-xs mx-auto">We're integrating card and mobile payments soon. For now, please use bank transfer.</p>
                            <button type="button" onclick="selectMethod('manual')"
                                class="mt-5 text-sm font-bold text-plum border border-purple-200 px-5 py-2.5 rounded-full hover:bg-plum hover:text-white hover:border-plum transition-all">
                                ← Use Bank Transfer Instead
                            </button>
                        </div>
                    </div>
                </div>
 
            </div>
            {{-- end left --}}
 
 
            {{-- ══════════════ RIGHT COLUMN: summary (JS-rendered) ══════════════ --}}
            <div class="w-full lg:w-[360px] shrink-0">
            <div class="flex items-center gap-2 bg-white border border-purple-100 rounded-xl p-1 mb-4">
                    <a href="?currency=LRD" class="px-3 py-1 text-xs rounded-lg {{ request('currency','LRD') == 'LRD' ? 'bg-plum text-white' : 'text-gray-600' }}">
                        LRD
                    </a>

                    <a href="?currency=USD"
                    class="px-3 py-1 text-xs rounded-lg {{ request('currency') == 'USD' ? 'bg-plum text-white' : 'text-gray-600' }}">
                        USD
                    </a>

                    <a href="?currency=NGN"
                    class="px-3 py-1 text-xs rounded-lg {{ request('currency') == 'NGN' ? 'bg-plum text-white' : 'text-gray-600' }}">
                        NGN
                    </a>
                </div>
                <div class="summary-card reveal d2">
 
                    {{-- Header --}}
                    <div class="summary-header">
                        <p class="text-white/70 text-xs font-semibold uppercase tracking-widest mb-0.5">Order Summary</p>
                        <p class="text-white font-serif text-2xl font-bold" id="summaryTotal">—</p>
                        <p class="text-white/60 text-xs mt-1" id="summaryItemCount">Loading…</p>
                    </div>
 
                    <div class="summary-body space-y-3">
 
                        {{-- Items list — populated by JS --}}
                        <div id="summaryItems" class="space-y-0 mb-2">
                            {{-- skeleton --}}
                            <div class="py-3 space-y-2" id="summarySkeleton">
                                <div class="skel h-3 w-3/4"></div>
                                <div class="skel h-3 w-1/2"></div>
                                <div class="skel h-3 w-2/3"></div>
                            </div>
                        </div>
 
                        <div class="h-px bg-purple-50"></div>
 
                        {{-- Totals --}}
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span class="font-semibold text-gray-800" id="summarySubtotal">—</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span class="font-semibold text-gray-800" id="summaryShipping">—</span>
                        </div>
                        <div class="summary-row">
                            <span>VAT (7.5%)</span>
                            <span class="font-semibold text-gray-800" id="summaryVat">—</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span class="grad-text" id="summaryTotalRow">—</span>
                        </div>
 
                        <a href="{{ route('cart') }}"
                           class="flex items-center justify-center gap-1.5 text-xs font-semibold text-plum hover:text-blush transition-colors mt-1 group">
                            <i class="bi bi-chevron-left"></i>
                            Edit cart
                        </a>
 
                        <div class="trust-strip">
                            <div class="trust-item">
                                <div class="text-xl mb-1"> <i class="bi bi-shield-lock text-plum"></i></div>
                                <p class="text-xs font-semibold text-gray-700">Secure</p>
                                <p class="text-xs text-gray-400">SSL Encrypted</p>
                            </div>
                            <div class="trust-item">
                                <div class="text-xl mb-1"><i class="bi bi-arrow-counterclockwise text-plum"></i></div>
                                <p class="text-xs font-semibold text-gray-700">Returns</p>
                                <p class="text-xs text-gray-400">7-day policy</p>
                            </div>
                            <div class="trust-item">
                                <div class="text-xl mb-1"><i class="bi bi-box-seam text-plum"></i></div>
                                <p class="text-xs font-semibold text-gray-700">Delivery</p>
                                <p class="text-xs text-gray-400">2–5 days</p>
                            </div>
                        </div>
 
                        <p class="text-center text-xs text-gray-400 mt-1">
                            Need help? <a href="/contact" class="text-plum font-semibold hover:underline">Chat with us →</a>
                        </p>
 
                    </div>
                </div>
            </div>
 
        </div>{{-- end flex --}}
    </div>
</section>
 
{{-- Toast --}}
<div id="toast" class="fixed bottom-6 right-6 z-50 bg-white rounded-2xl shadow-2xl border border-purple-100 px-5 py-4 flex items-center gap-3 translate-y-24 opacity-0 transition-all duration-500 pointer-events-none max-w-xs">
    <span class="text-2xl" id="toastIcon">✅</span>
    <div>
        <p class="text-sm font-bold text-gray-900" id="toastTitle">Done!</p>
        <p class="text-xs text-gray-400" id="toastMsg">Your order is being processed.</p>
    </div>
</div>
 
@endsection
 
@push('scripts')
<script>
window.CURRENCY = @json($currency);

window.RATES = {
    LRD: {{ $rates['LRD'] }},
    USD: {{ $rates['USD'] }},
    NGN: {{ $rates['NGN'] }}
};

window.SYMBOLS = {
    LRD: 'L$',
    USD: '$',
    NGN: '₦'
};
/* ═══════════════════════════════════════════
   CONSTANTS  (must match CheckoutController)
═══════════════════════════════════════════ */
const SHIPPING_THRESHOLD = 500;
const SHIPPING_COST      = 15;
const VAT_RATE           = 0.075;
 
function convertAmount(amount)
{
    return amount * window.RATES[window.CURRENCY];
}

function fmt(amount)
{
    return window.SYMBOLS[window.CURRENCY] +
        convertAmount(amount).toLocaleString(
            undefined,
            {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }
        );
}
 
/* ═══════════════════════════════════════════
   RENDER ORDER SUMMARY FROM localStorage
═══════════════════════════════════════════ */
function renderSummary() {
    const cart   = CartUtils.getCart();
    const items  = Object.values(cart);
    const skeleton = document.getElementById('summarySkeleton');
 
    if (skeleton) skeleton.remove();
 
    if (items.length === 0) {
        document.getElementById('emptyCartWarning').classList.remove('hidden');
        document.getElementById('transferBtn').disabled = true;
        document.getElementById('summaryItems').innerHTML =
            '<p class="text-xs text-gray-400 py-2 text-center">No items in cart.</p>';
        return;
    }
 
    // Render item rows (display only — prices re-calculated server-side)
    const container = document.getElementById('summaryItems');
    container.innerHTML = '';
    items.forEach(item => {
        const row = document.createElement('div');
        row.className = 'order-item-row';
        const thumb = item.image
            ? `<img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover" onerror="this.outerHTML='<span class=\\'text-xl\\'>${item.emoji||'📦'}</span>'">`
            : `<span class="text-xl">${item.emoji || '📦'}</span>`;
        row.innerHTML = `
            <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center overflow-hidden shrink-0 border border-purple-100">${thumb}</div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-900 truncate">${item.name}</p>
                <p class="text-xs text-gray-400">Qty: ${item.qty}</p>
            </div>
            <p class="text-sm font-bold text-gray-800 shrink-0">${fmt(item.price * item.qty)}</p>`;
        container.appendChild(row);
    });
 
    // Estimated totals (for display only)
    const subtotal = items.reduce((s, i) => s + i.price * i.qty, 0);
    const shipping = subtotal >= SHIPPING_THRESHOLD ? 0 : (subtotal > 0 ? SHIPPING_COST : 0);
    const vat      = subtotal * VAT_RATE;
    const total    = subtotal + shipping + vat;
    const count    = items.reduce((s, i) => s + i.qty, 0);
 
    document.getElementById('summarySubtotal').textContent  = fmt(subtotal);
    document.getElementById('summaryShipping').textContent  = shipping === 0 ? 'FREE 🎉' : fmt(shipping);
    document.getElementById('summaryVat').textContent       = fmt(vat);
    document.getElementById('summaryTotalRow').textContent  = fmt(total);
    document.getElementById('summaryTotal').textContent     = fmt(total);
    document.getElementById('summaryItemCount').textContent = count + ' item' + (count !== 1 ? 's' : '') + ' in your order';
 
    // Update "Amount to Transfer" in bank card
    document.getElementById('amountDue').textContent = fmt(total);
}
 
/* ═══════════════════════════════════════════
   PLACE ORDER — fetch POST (not form submit)
═══════════════════════════════════════════ */
function placeOrder(btn, event) {
    addRipple(btn, event);
 
    // 1. Validate form fields
    const fields = {
        name:         document.getElementById('name').value.trim(),
        email:        document.getElementById('email').value.trim(),
        phone:        document.getElementById('phone').value.trim(),
        country:      document.getElementById('country').value,
        state:        document.getElementById('state').value.trim(),
        city:         document.getElementById('city').value.trim(),
        address_line: document.getElementById('address_line').value.trim(),
    };
 
    const errors = [];
    if (!fields.name)         errors.push('Full name is required.');
    if (!fields.phone)        errors.push('Phone number is required.');
    if (!fields.country)      errors.push('Country is required.');
    if (!fields.city)         errors.push('City is required.');
    if (!fields.address_line) errors.push('Street address is required.');
    if (fields.email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(fields.email)) {
        errors.push('Please enter a valid email address.');
    }
 
    if (errors.length) {
        const errBox  = document.getElementById('formErrors');
        const errList = document.getElementById('formErrorList');
        errList.innerHTML = errors.map(e => `<li>${e}</li>`).join('');
        errBox.classList.remove('hidden');
        errBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }
 
    document.getElementById('formErrors').classList.add('hidden');
 
    // 2. Get cart — only IDs and quantities
    const cart = CartUtils.getCart();
    if (!Object.keys(cart).length) {
        showToast('⚠️', 'Cart empty', 'Add items before checking out.');
        return;
    }
 
    // 3. Loading state
    btn.disabled = true;
    btn.innerHTML = `
       <i class="bi bi-arrow-repeat"></i>
        Recording your order…`;
 
    // 4. POST to server
    fetch('/checkout/manual', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ ...fields, cart }),
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            CartUtils.clearCart();                                    // ✅ wipe localStorage
            window.location.href = '/order-success/' + data.order_id;

            localStorage.setItem(
                'pendingOrder',
                JSON.stringify(data)
            );
        
        } else {
            showToast('❌', 'Error', data.message || 'Checkout failed. Please try again.');
            btn.disabled = false;
            btn.innerHTML = `
               <i class="bi bi-check-circle"></i>
                I have made the transfer`;
        }
    })
    .catch(() => {
        showToast('❌', 'Network error', 'Something went wrong. Please check your connection.');
        btn.disabled = false;
        btn.innerHTML = `
           <i class="bi bi-check-circle"></i>
            I have made the transfer`;
    });
}
 
/* ═══════════════════════════════════════════
   PAYMENT METHOD TOGGLE
═══════════════════════════════════════════ */
function selectMethod(method) {
    if (method === 'online') {
        showToast('🚧', 'Coming soon', 'Online payments will be available soon. Please use bank transfer.');
        return;
    }
    ['manual','online'].forEach(key => {
        document.getElementById('tab-' + key).classList.toggle('selected', key === method);
        document.getElementById('panel-' + key).classList.toggle('hidden', key !== method);
    });
}
 
/* ═══════════════════════════════════════════
   COPY ACCOUNT NUMBER
═══════════════════════════════════════════ */
function copyText(text)
{
    navigator.clipboard.writeText(text);

    showToast(
        '✅',
        'Copied',
        `${text} copied to clipboard`
    );
}

/* ═══════════════════════════════════════════
   SEND RECEIPT TO WHATSAPP
═══════════════════════════════════════════ */
function sendReceiptToWhatsApp()
{
    const order = JSON.parse(
        localStorage.getItem('pendingOrder') || '{}'
    );

    const phone = "231886188822";

    const message =
`Hello Joyous Cakes & Accessories,

I have completed payment for my order.

Order Number: ${order.order_number}
Customer Name: ${order.customer_name}
Phone: ${order.phone}
Amount Paid: ${fmt(order.amount)}

I have attached my payment receipt for verification.

Thank you.`;

    window.open(
        `https://wa.me/${phone}?text=${encodeURIComponent(message)}`,
        '_blank'
    );
}

/* ═══════════════════════════════════════════
   RIPPLE + TOAST
═══════════════════════════════════════════ */
function addRipple(btn, e) {
    const rect = btn.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const ripple = document.createElement('span');
    ripple.style.cssText = `position:absolute;border-radius:50%;width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px;background:rgba(255,255,255,0.3);transform:scale(0);animation:ripple .55s ease-out forwards;pointer-events:none;`;
    btn.style.position = 'relative'; btn.style.overflow = 'hidden';
    btn.appendChild(ripple);
    setTimeout(() => ripple.remove(), 600);
}
 
function showToast(icon, title, msg) {
    const t = document.getElementById('toast');
    document.getElementById('toastIcon').textContent  = icon;
    document.getElementById('toastTitle').textContent = title;
    document.getElementById('toastMsg').textContent   = msg;
    t.classList.remove('translate-y-24','opacity-0');
    t.classList.add('translate-y-0','opacity-100');
    clearTimeout(t._timer);
    t._timer = setTimeout(() => {
        t.classList.add('translate-y-24','opacity-0');
        t.classList.remove('translate-y-0','opacity-100');
    }, 3500);
}
 
/* ═══════════════════════════════════════════
   REVEAL OBSERVER
═══════════════════════════════════════════ */
const ro = new IntersectionObserver(
    es => es.forEach(e => { if (e.isIntersecting) e.target.classList.add('in'); }),
    { threshold: 0.1 }
);
document.querySelectorAll('.reveal').forEach(el => ro.observe(el));
 
/* ═══════════════════════════════════════════
   BOOT
═══════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', renderSummary);
</script>
@endpush