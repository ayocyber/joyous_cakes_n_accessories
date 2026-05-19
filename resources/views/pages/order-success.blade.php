@extends('layout.app')
@section('title', 'Order Placed!')

@section('content')
<section class="min-h-screen flex items-center justify-center" style="background:#faf8ff;">
    <div class="text-center px-5 py-20">
        <div class="text-8xl mb-6">🎉</div>
        <h1 class="font-serif text-4xl font-bold text-gray-900 mb-3">
            Order <em class="grad-text not-italic">Placed!</em>
        </h1>
        <p class="text-gray-500 mb-2">Your order number is</p>
        <p class="text-2xl font-bold text-plum mb-6">{{ $order->order_number }}</p>
        <p class="text-gray-500 text-sm max-w-sm mx-auto mb-8">
            We'll reach out on WhatsApp to confirm your payment and arrange delivery. Thank you! 💜
        </p>
        <a href="/shop" class="btn-primary px-8 py-4 rounded-full font-semibold text-sm inline-flex items-center gap-2 shadow-xl hover:scale-105 transition-all">
            Continue Shopping →
        </a>
    </div>
</section>
@endsection