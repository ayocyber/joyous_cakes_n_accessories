<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrderNotificationMail;

class CheckoutController extends Controller
{

    // public function index()
    // {
    //     $cart = session()->get('cart', []);

    //     if (empty($cart)) {
    //         return redirect()->route('cart')
    //             ->with('error', 'Your cart is empty.');
    //     }

    //     $subtotal = 0;

    //     foreach ($cart as $item) {
    //         $subtotal += $item['price'] * $item['quantity'];
    //     }

    //     $shippingFee = 0;
    //     $total = $subtotal + $shippingFee;

    //     return view('checkout.index', compact(
    //         'cart',
    //         'subtotal',
    //         'shippingFee',
    //         'total'
    //     ));
    // }

    public function index(Request $request)
    {
        // $cart = session()->get('cart', []);

        //     if (empty($cart)) {
        //         return redirect()->route('cart')
        //             ->with('error', 'Your cart is empty.');
        //     }
    
        //     $subtotal = 0;
    
        //     foreach ($cart as $item) {
        //         $subtotal += $item['price'] * $item['quantity'];
        //     }
    
        //     $shippingFee = 0;
        //     $total = $subtotal + $shippingFee;

        $currency = $request->get('currency', 'LRD');

        $rates = [
            'LRD' => 1,
            'USD' => 0.0055,
            'NGN' => 7.46,
        ];

        
        return view('pages.checkout.index', compact('currency', 'rates'));
    }

    public function manualCheckout(Request $request)
    {
    $request->validate([
        'name'         => ['required', 'string', 'max:255'],
        'email'        => ['nullable', 'email'],
        'phone'        => ['required', 'string'],
        'country'      => ['required', 'string'],
        'state'        => ['nullable', 'string'],
        'city'         => ['required', 'string'],
        'address_line' => ['required', 'string'],
    ]);

    $cartRaw = $request->input('cart', []);

    if (empty($cartRaw)) {
        return response()->json(['success' => false, 'message' => 'Your cart is empty.'], 422);
    }

    // ✅ Extract only IDs and quantities — ignore frontend prices entirely
    $incoming = collect($cartRaw)->keyBy('id')->map(fn($item) => [
        'qty' => (int) $item['qty'],
    ]);

    $productIds = $incoming->keys()->toArray();

    // ✅ Fetch real prices from DB
    $products = Product::whereIn('id', $productIds)
        ->where('is_active', true)
        ->get()
        ->keyBy('id');

    // ✅ Validate every item exists and has enough stock
    foreach ($incoming as $id => $item) {
        if (!$products->has($id)) {
            return response()->json([
                'success' => false,
                'message' => 'One or more products no longer exist.'
            ], 422);
        }

        $product = $products[$id];

        if ($product->stock < $item['qty']) {
            return response()->json([
                'success' => false,
                'message' => "Sorry, \"{$product->name}\" only has {$product->stock} left in stock."
            ], 422);
        }
    }

    // ✅ Calculate totals using DB prices, not frontend prices
    $subtotal = 0;
    foreach ($incoming as $id => $item) {
        $subtotal += $products[$id]->price * $item['qty'];
    }

    $shippingFee = $subtotal >= 500 ? 0 : 15;
    $vat         = $subtotal * 0.075;
    $total       = $subtotal + $shippingFee + $vat;

    // Create customer
    $customer = Customer::create([
        'name'         => $request->name,
        'email'        => $request->email,
        'phone'        => $request->phone,
        'country'      => $request->country,
        'state'        => $request->state,
        'city'         => $request->city,
        'address_line' => $request->address_line,
    ]);

    // Create order
    $order = Order::create([
        'customer_id'    => $customer->id,
        'order_number'   => 'ORD-' . strtoupper(Str::random(8)),
        'subtotal'       => $subtotal,
        'shipping_fee'   => $shippingFee,
        'vat'            => $vat,
        'total_price'    => $total,
        'currency'       => 'LRD',
        'status' => 'pending_payment_confirmation',
        'payment_status' => 'awaiting_verification',
        'payment_method' => 'bank_transfer',
    ]);

    // Create order items using DB prices & deduct stock
    foreach ($incoming as $id => $item) {
        $product = $products[$id];

        OrderItem::create([
            'order_id'    => $order->id,
            'product_id'  => $product->id,
            'quantity'    => $item['qty'],
            'unit_price'  => $product->price,   // ✅ real price from DB
            'total_price' => $product->price * $item['qty'],
        ]);

        // ✅ Deduct stock
        $product->decrement('stock', $item['qty']);
    }

    // Create payment record
    Payment::create([
        'order_id'              => $order->id,
        'payment_method'        => 'bank_transfer',
        'transaction_reference' => 'MANUAL-' . strtoupper(Str::random(12)),
        'amount'                => $total,
        'currency'              => 'LRD',
        'status'                => 'pending',
    ]);

    Mail::to('joyouscakesnaccessories@gmail.com')
    ->send(
        new NewOrderNotificationMail(
            $order,
            $customer
        )
    );

    return response()->json([
        'success' => true,
        'order_id' => $order->id,
        'order_number' => $order->order_number,
        'customer_name' => $customer->name,
        'phone' => $customer->phone,
        'amount' => $order->total_price,
    ]);
    }

    public function paystackCheckout(Request $request)
    {
        return back()->with('info', 'Online payment will be available soon.');
    }

    public function success(Order $order)
    {
    return view('pages.order-success', compact('order'));
    }
}
