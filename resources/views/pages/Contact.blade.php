@extends('layout.app')
@section('title', 'Contact Us')

@push('styles')
<style>
/* ── Reveal ── */

</style>
@endpush

@section('content')

<!-- ══════════════════════════════════
     HERO BANNER
══════════════════════════════════ -->
<section class="contact-hero pt-[68px] pb-14">
    <div class="max-w-7xl mx-auto px-5 lg:px-8 pt-12 relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-gray-400 mb-7">
            <a href="/" class="hover:text-plum transition-colors">Home</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-plum font-semibold">Contact Us</span>
        </nav>

        <div class="text-center max-w-2xl mx-auto">
            <span class="text-xs font-semibold text-plum uppercase tracking-widest">Get In Touch</span>
            <h1 class="font-serif text-4xl lg:text-6xl font-bold text-gray-900 mt-2 leading-tight">
                We'd Love to <em class="grad-text not-italic">Hear</em><br>From You
            </h1>
            <p class="text-gray-500 mt-4 text-sm leading-relaxed">Have a question about an order, a product, or just want to say hello? Our friendly team is here to help every step of the way.</p>
        </div>

        <!-- Response time badge -->
        <div class="flex justify-center mt-7">
            <div class="inline-flex items-center gap-2 bg-white border border-purple-100 rounded-full px-5 py-2.5 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                <span class="text-xs font-semibold text-gray-700">Average response time: <span class="text-plum">under 2 hours</span> on weekdays</span>
            </div>
        </div>
    </div>
</section>


<!-- ══════════════════════════════════
     INFO CARDS
══════════════════════════════════ -->
<section class="py-10" style="background:#faf8ff;">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @php
                $infos = [
                    ['icon'=>'📞','title'=>'Call Us','lines'=>['+231 886 188 822','+231 886 188 822'],'sub'=>'Mon–Sat, 8am–6pm'],
                    ['icon'=>'✉️','title'=>'Email Us','lines'=>['joyouscakesnaccessories@gmail.com, +231 886 188 822'],'sub'=>'We reply within 2 hours'],
                    ['icon'=>'📍','title'=>'Visit Us','lines'=>['12 Adewale Close','Ikeja, Lagos State'],'sub'=>'Mon–Sat, 9am–5pm'],
                    ['icon'=>'💬','title'=>'WhatsApp','lines'=>['+231 886 188 822'],'sub'=>'Quick replies on WhatsApp'],
                ];
            @endphp
            @foreach($infos as $i => $info)
            <div class="info-card p-6 reveal d{{ $i+1 }}">
                <div class="info-icon mb-4 text-2xl">{{ $info['icon'] }}</div>
                <h3 class="font-serif font-bold text-gray-900 mb-2">{{ $info['title'] }}</h3>
                @foreach($info['lines'] as $line)
                <p class="text-sm text-gray-700 font-medium">{{ $line }}</p>
                @endforeach
                <p class="text-xs text-gray-400 mt-2">{{ $info['sub'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ══════════════════════════════════
     FORM + MAP
══════════════════════════════════ -->
<section class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 items-start">

            <!-- ── Contact Form ── -->
            <div class="lg:col-span-3 contact-form-wrap p-8 lg:p-10 reveal">
                <div class="mb-8">
                    <span class="text-xs font-semibold text-plum uppercase tracking-widest">Send a Message</span>
                    <h2 class="font-serif text-3xl font-bold text-gray-900 mt-1">How Can We Help?</h2>
                    <p class="text-sm text-gray-400 mt-1.5">Fill out the form and a member of our team will get back to you promptly.</p>
                </div>

                {{-- In production, point action to your route, e.g. action="{{ route('contact.send') }}" --}}
                <form id="contactForm" action="#" method="POST" class="space-y-5">
                    @csrf

                    <!-- Name row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="form-field">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" placeholder="Amara" class="form-input" required>
                        </div>
                        <div class="form-field">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" placeholder="Okafor" class="form-input" required>
                        </div>
                    </div>

                    <!-- Email + Phone -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="form-field">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="you@example.com" class="form-input" required>
                        </div>
                        <div class="form-field">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="+234 800 000 0000" class="form-input">
                        </div>
                    </div>

                    <!-- Subject -->
                    <div class="form-field">
                        <label for="subject">Subject</label>
                        <select id="subject" name="subject" class="form-input" required>
                            <option value="" disabled selected>Select a topic…</option>
                            <option>Order Enquiry</option>
                            <option>Product Question</option>
                            <option>Delivery / Shipping</option>
                            <option>Returns & Refunds</option>
                            <option>Wholesale / Bulk Order</option>
                            <option>Partnership / Collaboration</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <!-- Order number (optional) -->
                    <div class="form-field">
                        <label for="order_no">Order Number <span class="text-gray-400 normal-case font-normal tracking-normal text-xs">(optional)</span></label>
                        <input type="text" id="order_no" name="order_no" placeholder="e.g. BS-2025-00123" class="form-input">
                    </div>

                    <!-- Message -->
                    <div class="form-field">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" placeholder="Tell us more about how we can help…" class="form-input" required></textarea>
                    </div>

                    <!-- Preferences -->
                    <div class="flex items-start gap-3">
                        <input type="checkbox" id="newsletter" name="newsletter" class="mt-1 accent-plum w-4 h-4 shrink-0 cursor-pointer">
                        <label for="newsletter" class="text-xs text-gray-500 cursor-pointer leading-relaxed">
                            Keep me updated with baking tips, new arrivals and exclusive subscriber discounts. No spam, unsubscribe anytime.
                        </label>
                    </div>

                    <button type="submit" class="w-full btn-primary font-semibold py-4 rounded-full shadow-xl hover:scale-[1.02] transition-all text-sm flex items-center justify-center gap-2" id="submitBtn">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        <span>Send Message</span>
                    </button>
                </form>
            </div>


            <!-- ── Right column: Map + Social ── -->
            <div class="lg:col-span-2 space-y-6 reveal d2">

                <!-- Map placeholder (swap iframe for Google Maps embed in production) -->
                <div>
                    <span class="text-xs font-semibold text-plum uppercase tracking-widest block mb-3">Find Us</span>
                    <div class="map-placeholder h-64">
                        <!-- Drop in a real Google Maps iframe:
                        <iframe src="https://maps.google.com/maps?q=Ikeja+Lagos&output=embed" width="100%" height="100%" style="border:0;" loading="lazy"></iframe>
                        -->
                        <div class="text-center p-8">
                            <div class="map-pin text-6xl mb-3">📍</div>
                            <p class="font-serif font-bold text-gray-800 text-lg">12 Adewale Close</p>
                            <p class="text-sm text-gray-500 mt-1">Ikeja, Lagos State, Nigeria</p>
                            <a href="https://maps.google.com/?q=Ikeja+Lagos" target="_blank"
                                class="inline-flex items-center gap-1.5 mt-4 text-xs font-semibold text-plum border border-purple-200 px-4 py-2 rounded-full hover:bg-plum hover:text-white hover:border-plum transition-all">
                                Open in Google Maps
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Business Hours -->
                <div class="bg-white border border-purple-50 rounded-2xl p-6 shadow-sm">
                    <h3 class="font-serif font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="text-xl">🕐</span> Business Hours
                    </h3>
                    @php
                        $hours = [
                            ['day'=>'Monday – Friday','time'=>'8:00 AM – 6:00 PM','open'=>true],
                            ['day'=>'Saturday','time'=>'9:00 AM – 4:00 PM','open'=>true],
                            ['day'=>'Sunday','time'=>'Closed','open'=>false],
                            ['day'=>'Public Holidays','time'=>'Closed','open'=>false],
                        ];
                    @endphp
                    <ul class="space-y-2.5">
                        @foreach($hours as $h)
                        <li class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">{{ $h['day'] }}</span>
                            <span class="{{ $h['open'] ? 'text-plum font-semibold' : 'text-gray-400' }}">{{ $h['time'] }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Social -->
                <div class="bg-white border border-purple-50 rounded-2xl p-6 shadow-sm">
                    <h3 class="font-serif font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="text-xl">🌸</span> Follow Us
                    </h3>
                    <p class="text-xs text-gray-400 mb-4 leading-relaxed">Stay inspired with baking tips, behind-the-scenes and new product reveals on our socials.</p>
                    <div class="flex gap-3 flex-wrap">
                        @php
                            $socials = [
                                ['label'=>'Instagram','icon'=>'📸','color'=>'hover:bg-pink-500','href'=>'#'],
                                ['label'=>'Facebook','icon'=>'👍','color'=>'hover:bg-blue-600','href'=>'#'],
                                ['label'=>'TikTok','icon'=>'🎵','color'=>'hover:bg-gray-800','href'=>'#'],
                                ['label'=>'WhatsApp','icon'=>'💬','color'=>'hover:bg-green-500','href'=>'#'],
                            ];
                        @endphp
                        @foreach($socials as $s)
                        <a href="{{ $s['href'] }}" class="flex items-center gap-2 bg-purple-50 {{ $s['color'] }} hover:text-white text-plum text-xs font-semibold px-4 py-2 rounded-full transition-all group">
                            <span class="group-hover:scale-110 transition-transform">{{ $s['icon'] }}</span>
                            {{ $s['label'] }}
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>


<!-- ══════════════════════════════════
     FAQ
══════════════════════════════════ -->
<section class="py-16" style="background:#faf8ff;">
    <div class="max-w-3xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-12 reveal">
            <span class="text-xs font-semibold text-plum uppercase tracking-widest">Quick Answers</span>
            <h2 class="font-serif text-4xl font-bold text-gray-900 mt-2">Frequently Asked <em class="grad-text not-italic">Questions</em></h2>
        </div>

        @php
            $faqs = [
                ['q'=>'How long does delivery take?','a'=>'Standard delivery across Lagos takes 1–2 business days. Orders to other states in Nigeria are delivered within 3–5 business days. You will receive a tracking link once your order ships.'],
                ['q'=>'What payment methods do you accept?','a'=>'We accept bank transfers, debit/credit cards (Visa, Mastercard), and mobile payments via Paystack and Flutterwave. All transactions are fully encrypted and secure.'],
                ['q'=>'Can I return or exchange a product?','a'=>'Yes. We offer hassle-free returns within 7 days of delivery for unused, unopened items in original packaging. Simply contact us and we will guide you through the process.'],
                ['q'=>'Do you offer bulk or wholesale pricing?','a'=>'Absolutely! We offer competitive bulk pricing for baking schools, cake studios, and resellers. Select "Wholesale / Bulk Order" when contacting us and our team will send a custom quote.'],
                ['q'=>'Are your products food-safe?','a'=>'Yes — all our baking tins, silicone moulds, and decorating tools are manufactured to food-safe standards and are BPA-free. Product descriptions include safety certifications where applicable.'],
                ['q'=>'Do you ship outside Nigeria?','a'=>'International shipping is currently unavailable, but we are working on it! We currently serve all 36 states within Nigeria plus the FCT.'],
            ];
        @endphp

        <div class="space-y-3" id="faqList">
            @foreach($faqs as $i => $faq)
            <div class="faq-item reveal d{{ ($i%4)+1 }}">
                <button class="faq-q" type="button">
                    <span>{{ $faq['q'] }}</span>
                    <svg class="faq-chevron w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div class="faq-a"><p>{{ $faq['a'] }}</p></div>
            </div>
            @endforeach
        </div>

        <p class="text-center text-sm text-gray-500 mt-10">
            Still have questions? <a href="mailto:hello@bakeshop.ng" class="text-plum font-semibold hover:underline">Email us directly →</a>
        </p>
    </div>
</section>

<!-- ── Toast notification ── -->
<div class="toast" id="successToast">
    <span class="text-2xl">🎉</span>
    <div>
        <p class="text-sm font-semibold text-gray-900">Message sent!</p>
        <p class="text-xs text-gray-400">We'll get back to you within 2 hours.</p>
    </div>
</div>

@endsection

@push('scripts')
<script>

</script>
@endpush