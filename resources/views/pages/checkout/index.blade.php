@extends('layout.app')
@section('title', 'Checkout')

@push('styles')
<style>
/* ── Step indicator ── */
.step-bar { display: flex; align-items: center; gap: 0; }
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

/* ── Method selector tabs ── */
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

/* ── Bank detail card (account reveal) ── */
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

/* ── Transfer confirm button ── */
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

/* ── Form inputs ── */
.field-group { display: flex; flex-direction: column; gap: 6px; }
.field-label { font-size: 12px; font-weight: 700; color: #374151; text-transform: uppercase; letter-spacing: .04em; }
.field-input {
    padding: 12px 16px; border-radius: 12px; border: 1.5px solid #e5e7eb;
    font-size: 14px; color: #111827; background: #fff;
    transition: border-color .2s, box-shadow .2s; outline: none; width: 100%;
}
.field-input:focus { border-color: #7c3aed; box-shadow: 0 0 0 3px rgba(124,58,237,.12); }
.field-input.error { border-color: #ef4444; box-shadow: 0 0 0 3px rgba(239,68,68,.1); }

/* ── Order item row (in sidebar) ── */
.order-item-row { display: flex; align-items: center; gap-x: 12px; padding: 10px 0; border-bottom: 1px solid #f3e8ff; }
.order-item-row:last-child { border-bottom: none; }

/* ── Shimmer pulse for "coming soon" badge ── */
.coming-soon-badge {
    font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 999px;
    background: linear-gradient(90deg, #fde68a, #fef3c7, #fde68a);
    background-size: 200% 100%;
    animation: shimmer 2s linear infinite;
    color: #92400e;
}
@keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

/* ── Ripple on button click ── */
@keyframes ripple { to { transform: scale(3); opacity: 0; } }
</style>
@endpush

@section('content')

{{-- ════════════════════════════════
     PAGE HEADER
════════════════════════════════ --}}
<section class="pt-[68px] pb-10" style="background:#faf8ff;">
    <div class="max-w-7xl mx-auto px-5 lg:px-8 pt-10">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-gray-400 mb-6">
            <a href="/" class="hover:text-plum transition-colors">Home</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('cart.index') }}" class="hover:text-plum transition-colors">Cart</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-plum font-semibold">Checkout</span>
        </nav>

        {{-- Title + step bar --}}
        <div class="flex flex-wrap items-start justify-between gap-6">
            <div>
                <span class="text-xs font-semibold text-plum uppercase tracking-widest">Almost there</span>
                <h1 class="font-serif text-4xl lg:text-5xl font-bold text-gray-900 mt-1">
                    Check<em class="grad-text not-italic">out</em>
                </h1>
            </div>

            {{-- Step indicator --}}
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

{{-- ════════════════════════════════
     MAIN LAYOUT
════════════════════════════════ --}}
<section class="pb-24" style="background:#faf8ff;">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">

        <form method="POST" action="{{ route('checkout.manual') }}" id="checkoutForm">
        @csrf

        <div class="flex flex-col lg:flex-row gap-8 items-start">

            {{-- ══════════════════════════════════════
                 LEFT COLUMN: details + payment method
            ══════════════════════════════════════ --}}
            <div class="flex-1 min-w-0 space-y-6">

                {{-- ── SECTION 1: Customer details ── --}}
                <div class="bg-white rounded-3xl border border-purple-50 shadow-sm p-6 lg:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-plum flex items-center justify-center text-white text-sm font-bold shrink-0">1</div>
                        <h2 class="font-serif text-xl font-bold text-gray-900">Your Details</h2>
                    </div>

                    @if($errors->any())
                    <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-2xl px-5 py-4 text-sm">
                        <p class="font-semibold mb-1">Please fix the following:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- Full name --}}
                        <div class="field-group sm:col-span-2">
                            <label for="name" class="field-label">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name') }}"
                                   placeholder="e.g. Amara Chukwuemeka"
                                   class="field-input @error('name') error @enderror"
                                   autocomplete="name" required>
                            @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Email --}}
                        <div class="field-group">
                            <label for="email" class="field-label">Email <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="email" id="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="you@example.com"
                                   class="field-input @error('email') error @enderror"
                                   autocomplete="email">
                            @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Phone --}}
                        <div class="field-group">
                            <label for="phone" class="field-label">Phone <span class="text-red-500">*</span></label>
                            <input type="tel" id="phone" name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="+234 800 000 0000"
                                   class="field-input @error('phone') error @enderror"
                                   autocomplete="tel" required>
                            @error('phone')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Country --}}
                        <div class="field-group">
                            <label for="country" class="field-label">Country <span class="text-red-500">*</span></label>
                            <select id="country" name="country"
                                    class="field-input @error('country') error @enderror" required>
                                <option value="" disabled {{ old('country') ? '' : 'selected' }}>Select country…</option>
                                <option value="Nigeria"      {{ old('country') === 'Nigeria'      ? 'selected' : '' }}>Nigeria</option>
                                <option value="Ghana"        {{ old('country') === 'Ghana'        ? 'selected' : '' }}>Ghana</option>
                                <option value="Kenya"        {{ old('country') === 'Kenya'        ? 'selected' : '' }}>Kenya</option>
                                <option value="South Africa" {{ old('country') === 'South Africa' ? 'selected' : '' }}>South Africa</option>
                                <option value="United Kingdom" {{ old('country') === 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                <option value="United States"  {{ old('country') === 'United States'  ? 'selected' : '' }}>United States</option>
                                <option value="Other"        {{ old('country') === 'Other'        ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('country')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- State --}}
                        <div class="field-group">
                            <label for="state" class="field-label">State / Region <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="text" id="state" name="state"
                                   value="{{ old('state') }}"
                                   placeholder="e.g. Lagos"
                                   class="field-input @error('state') error @enderror"
                                   autocomplete="address-level1">
                            @error('state')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- City --}}
                        <div class="field-group">
                            <label for="city" class="field-label">City <span class="text-red-500">*</span></label>
                            <input type="text" id="city" name="city"
                                   value="{{ old('city') }}"
                                   placeholder="e.g. Ikeja"
                                   class="field-input @error('city') error @enderror"
                                   autocomplete="address-level2" required>
                            @error('city')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- Address --}}
                        <div class="field-group sm:col-span-2">
                            <label for="address_line" class="field-label">Street Address <span class="text-red-500">*</span></label>
                            <input type="text" id="address_line" name="address_line"
                                   value="{{ old('address_line') }}"
                                   placeholder="e.g. 12 Broad Street, Victoria Island"
                                   class="field-input @error('address_line') error @enderror"
                                   autocomplete="street-address" required>
                            @error('address_line')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                        </div>

                    </div>
                </div>{{-- end customer details --}}


                {{-- ── SECTION 2: Payment method ── --}}
                <div class="bg-white rounded-3xl border border-purple-50 shadow-sm p-6 lg:p-8" id="paymentSection">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-full bg-plum flex items-center justify-center text-white text-sm font-bold shrink-0">2</div>
                        <h2 class="font-serif text-xl font-bold text-gray-900">Payment Method</h2>
                    </div>

                    {{-- Method tabs --}}
                    <div class="flex gap-3 mb-6" role="radiogroup" aria-label="Payment method">

                        {{-- Manual / Bank Transfer --}}
                        <button type="button" role="radio" aria-checked="true"
                                id="tab-manual"
                                class="method-tab selected"
                                onclick="selectMethod('manual')">
                            <span class="text-2xl">🏦</span>
                            <span class="text-sm font-bold text-gray-800">Bank Transfer</span>
                            <span class="text-xs text-gray-400">Manual payment</span>
                        </button>

                        {{-- Online / Paystack --}}
                        <button type="button" role="radio" aria-checked="false"
                                id="tab-online"
                                class="method-tab disabled-tab"
                                onclick="selectMethod('online')"
                                title="Coming soon">
                            <span class="text-2xl">💳</span>
                            <span class="text-sm font-bold text-gray-800 flex items-center gap-2">
                                Card / Online
                                <span class="coming-soon-badge">Soon</span>
                            </span>
                            <span class="text-xs text-gray-400">Paystack</span>
                        </button>

                    </div>

                    {{-- ── MANUAL PAYMENT PANEL ── --}}
                    <div id="panel-manual">

                        {{-- Instructions --}}
                        <p class="text-sm text-gray-500 mb-4 leading-relaxed">
                            Transfer the exact order total to the account below, then click
                            <strong class="text-gray-800">"I have made the transfer"</strong>.
                            We'll confirm your payment and reach out on WhatsApp to arrange delivery.
                        </p>

                        {{-- Account details card --}}
                        <div class="bank-card mb-5">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Bank Account Details</p>

                            <div class="space-y-3">
                                {{-- Bank name --}}
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs text-gray-400">Bank</p>
                                        <p class="text-sm font-bold text-gray-900">First Bank of Nigeria</p>
                                    </div>
                                </div>

                                {{-- Account number --}}
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs text-gray-400">Account Number</p>
                                        <p class="text-lg font-bold text-gray-900 tracking-widest" id="acctNum">3012345678</p>
                                    </div>
                                    <button type="button" class="copy-btn" onclick="copyAcct()">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                        Copy
                                    </button>
                                </div>

                                {{-- Account name --}}
                                <div>
                                    <p class="text-xs text-gray-400">Account Name</p>
                                    <p class="text-sm font-bold text-gray-900">Your Business Name Ltd</p>
                                </div>

                                {{-- Amount due --}}
                                <div class="mt-3 pt-3 border-t border-purple-100 flex items-center justify-between">
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Amount to Transfer</p>
                                    <p class="text-xl font-bold text-plum">
                                        ₦{{ number_format($total, 2) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Transfer confirmation CTA --}}
                        <button type="submit" id="transferBtn" class="transfer-btn" onclick="addRipple(this, event)">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            I have made the transfer
                        </button>

                        <p class="text-center text-xs text-gray-400 mt-3">
                            After clicking, your order will be recorded and we'll contact you on WhatsApp to confirm.
                        </p>

                    </div>{{-- end panel-manual --}}

                    {{-- ── ONLINE PAYMENT PANEL (hidden / coming soon) ── --}}
                    <div id="panel-online" class="hidden">
                        <div class="rounded-2xl bg-amber-50 border border-amber-200 p-6 text-center">
                            <div class="text-4xl mb-3">🚧</div>
                            <p class="font-bold text-gray-800 mb-1">Online payment coming soon</p>
                            <p class="text-sm text-gray-500 max-w-xs mx-auto">
                                We're integrating Paystack for card and mobile payments.
                                For now, please use bank transfer.
                            </p>
                            <button type="button" onclick="selectMethod('manual')"
                                class="mt-5 text-sm font-bold text-plum border border-purple-200 px-5 py-2.5 rounded-full hover:bg-plum hover:text-white hover:border-plum transition-all">
                                ← Use Bank Transfer Instead
                            </button>
                        </div>
                    </div>{{-- end panel-online --}}

                </div>{{-- end payment section --}}

            </div>{{-- end left column --}}


            {{-- ══════════════════════════════════════
                 RIGHT COLUMN: order summary
            ══════════════════════════════════════ --}}
            <div class="w-full lg:w-[360px] shrink-0">
                <div class="summary-card reveal d2">

                    {{-- Header --}}
                    <div class="summary-header">
                        <p class="text-white/70 text-xs font-semibold uppercase tracking-widest mb-0.5">Order Summary</p>
                        <p class="text-white font-serif text-2xl font-bold">₦{{ number_format($total, 2) }}</p>
                        <p class="text-white/60 text-xs mt-1">
                            {{ collect($cart)->sum('quantity') }} {{ Str::plural('item', collect($cart)->sum('quantity')) }} in your order
                        </p>
                    </div>

                    <div class="summary-body space-y-3">

                        {{-- Cart items list --}}
                        <div class="space-y-0 mb-2">
                            @foreach($cart as $item)
                            <div class="order-item-row flex items-center gap-3">
                                {{-- Thumbnail --}}
                                <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center overflow-hidden shrink-0 border border-purple-100">
                                    @if(!empty($item['image']))
                                        <img src="{{ asset('storage/' . $item['image']) }}"
                                             alt="{{ $item['name'] }}"
                                             class="w-full h-full object-cover"
                                             onerror="this.outerHTML='<span class=\'text-xl\'>📦</span>'">
                                    @else
                                        <span class="text-xl">📦</span>
                                    @endif
                                </div>
                                {{-- Name + qty --}}
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $item['name'] }}</p>
                                    <p class="text-xs text-gray-400">Qty: {{ $item['quantity'] }}</p>
                                </div>
                                {{-- Line price --}}
                                <p class="text-sm font-bold text-gray-800 shrink-0">
                                    ₦{{ number_format($item['price'] * $item['quantity'], 2) }}
                                </p>
                            </div>
                            @endforeach
                        </div>

                        {{-- Divider --}}
                        <div class="h-px bg-purple-50"></div>

                        {{-- Totals --}}
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span class="font-semibold text-gray-800">₦{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span class="font-semibold text-gray-800">
                                @if($shippingFee > 0)
                                    ₦{{ number_format($shippingFee, 2) }}
                                @else
                                    <span class="text-green-600">Free</span>
                                @endif
                            </span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span class="grad-text">₦{{ number_format($total, 2) }}</span>
                        </div>

                        {{-- Edit cart link --}}
                        <a href="{{ route('cart.index') }}"
                           class="flex items-center justify-center gap-1.5 text-xs font-semibold text-plum hover:text-blush transition-colors mt-1 group">
                            <svg class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            Edit cart
                        </a>

                        {{-- Trust strip --}}
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

                        <p class="text-center text-xs text-gray-400 mt-1">
                            Need help?
                            <a href="/contact" class="text-plum font-semibold hover:underline">Chat with us →</a>
                        </p>

                    </div>
                </div>
            </div>{{-- end right column --}}

        </div>{{-- end flex --}}
        </form>

    </div>
</section>

{{-- ── Toast ── --}}
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
/* ════════════════════════════════════
   CHECKOUT PAGE SCRIPTS
════════════════════════════════════ */

/* ── Payment method toggle ── */
function selectMethod(method) {
    const tabs   = { manual: document.getElementById('tab-manual'),   online: document.getElementById('tab-online') };
    const panels = { manual: document.getElementById('panel-manual'), online: document.getElementById('panel-online') };

    // Don't allow selecting online (disabled)
    if (method === 'online') {
        showToast('🚧', 'Coming soon', 'Online payments will be available soon. Please use bank transfer.');
        return;
    }

    Object.keys(tabs).forEach(key => {
        tabs[key].classList.toggle('selected', key === method);
        tabs[key].setAttribute('aria-checked', key === method ? 'true' : 'false');
        panels[key].classList.toggle('hidden', key !== method);
    });
}

/* ── Copy account number ── */
function copyAcct() {
    const num = document.getElementById('acctNum').textContent.trim();
    navigator.clipboard.writeText(num).then(() => {
        showToast('📋', 'Copied!', 'Account number copied to clipboard.');
    }).catch(() => {
        // Fallback for older browsers
        const el = document.createElement('textarea');
        el.value = num; document.body.appendChild(el);
        el.select(); document.execCommand('copy'); document.body.removeChild(el);
        showToast('📋', 'Copied!', 'Account number copied to clipboard.');
    });
}

/* ── Submit guard: validate before letting form through ── */
document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    const method = document.getElementById('tab-manual').classList.contains('selected') ? 'manual' : 'online';

    if (method === 'online') {
        e.preventDefault();
        showToast('🚧', 'Not available', 'Online payment is coming soon. Please use bank transfer.');
        return;
    }

    // Visual loading state
    const btn = document.getElementById('transferBtn');
    if (btn) {
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="w-5 h-5 animate-spin shrink-0" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            Recording your order…`;
    }
});

/* ── Button ripple micro-interaction ── */
function addRipple(btn, e) {
    const rect = btn.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x    = e.clientX - rect.left - size / 2;
    const y    = e.clientY - rect.top  - size / 2;

    const ripple = document.createElement('span');
    ripple.style.cssText = `
        position:absolute; border-radius:50%;
        width:${size}px; height:${size}px;
        left:${x}px; top:${y}px;
        background:rgba(255,255,255,0.3);
        transform:scale(0); animation:ripple .55s ease-out forwards;
        pointer-events:none;`;
    btn.style.position = 'relative';
    btn.style.overflow = 'hidden';
    btn.appendChild(ripple);
    setTimeout(() => ripple.remove(), 600);
}

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
    }, 3500);
}

/* ── Reveal observer ── */
const ro = new IntersectionObserver(
    es => es.forEach(e => { if (e.isIntersecting) e.target.classList.add('in'); }),
    { threshold: 0.1 }
);
document.querySelectorAll('.reveal').forEach(el => ro.observe(el));

/* ── Auto-flash session messages ── */
@if(session('info'))
    document.addEventListener('DOMContentLoaded', () => showToast('ℹ️', 'Info', "{{ session('info') }}"));
@endif
@if(session('error'))
    document.addEventListener('DOMContentLoaded', () => showToast('❌', 'Error', "{{ session('error') }}"));
@endif
</script>
@endpush