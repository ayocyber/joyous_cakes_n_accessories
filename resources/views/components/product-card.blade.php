@props([
    'product',
    'index' => 0,
    'delay'  => 1,
])

<div class="product-card reveal" data-delay="{{ $delay }}">

    {{-- Image / thumb --}}
    <div class="product-img-wrap bg-gradient-to-br {{ $product['bg'] }} relative overflow-hidden rounded-t-2xl">
        <img src="{{ $product['image'] }}"
             alt="{{ $product['name'] }}"
             class="w-full h-48 object-cover"
             onerror="this.style.display='none'">

        @if(!empty($product['badge']))
        <span class="absolute top-3 left-3 text-xs font-bold text-white px-2.5 py-1 rounded-full shadow
            {{ $product['badge']==='Sale' ? 'bg-blush' : ($product['badge']==='New' ? 'bg-green-500' : 'bg-plum') }}">
            {{ $product['badge'] }}
        </span>
        @endif

        <button class="absolute top-3 right-3 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center shadow hover:bg-white transition-all text-gray-400 hover:text-rose-500"
                aria-label="Add to wishlist">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </button>
    </div>

    {{-- Details --}}
    <div class="p-4">
        <div class="flex items-center gap-1 mb-1.5">
            <span class="text-yellow-400 text-xs">
                @for($s=0;$s<$product['stars'];$s++)★@endfor
                @for($s=$product['stars'];$s<5;$s++)☆@endfor
            </span>
            <span class="text-xs text-gray-400">({{ $product['reviews'] }})</span>
        </div>

        <p class="font-serif font-bold text-gray-900 text-sm leading-snug mb-2">{{ $product['name'] }}</p>

        <div class="flex items-center gap-2 mb-3">
            <span class="font-bold text-plum">₦{{ number_format((float) $product['price']) }}</span>
            @if(!empty($product['old']))
            <span class="text-xs text-gray-400 line-through">₦{{ $product['old'] }}</span>
            @endif
        </div>

        <button
            class="add-to-cart-btn w-full btn-primary text-xs font-semibold py-2.5 rounded-full shadow transition-all"
            data-id="{{ $product['id'] ?? $index }}"
            data-name="{{ $product['name'] }}"
            data-price="{{ $product['price'] }}"
            data-stock="{{ $product['stock'] ?? 99 }}"
            data-image="{{ $product['image'] }}"
            data-badge="{{ $product['badge'] ?? '' }}"
            onclick="handleAddToCart(this)">
            <span class="btn-label flex items-center justify-center gap-1.5">
                🛒 Add to Cart
            </span>
            <span class="btn-label-added">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                Added!
            </span>
        </button>
    </div>
</div>