<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shippingFee = 0;
        $total = $subtotal + $shippingFee;

        return view('checkout.index', compact(
            'cart',
            'subtotal',
            'shippingFee',
            'total'
        ));
    }

    public function manualCheckout(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'phone' => ['required', 'string'],
            'country' => ['required', 'string'],
            'state' => ['nullable', 'string'],
            'city' => ['required', 'string'],
            'address_line' => ['required', 'string'],
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shippingFee = 0;
        $total = $subtotal + $shippingFee;

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address_line' => $request->address_line,
        ]);

        $orderNumber = 'ORD-' . strtoupper(Str::random(8));

        $order = Order::create([
            'customer_id' => $customer->id,
            'order_number' => $orderNumber,
            'subtotal' => $subtotal,
            'shipping_fee' => $shippingFee,
            'total_price' => $total,
            'currency' => 'NGN',
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'payment_method' => 'bank_transfer',
        ]);

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);

            if (!$product) {
                continue;
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'total_price' => $item['price'] * $item['quantity'],
            ]);
        }

        Payment::create([
            'order_id' => $order->id,
            'payment_method' => 'bank_transfer',
            'transaction_reference' => 'MANUAL-' . strtoupper(Str::random(12)),
            'amount' => $total,
            'currency' => 'NGN',
            'status' => 'pending',
        ]);

        session()->forget('cart');

        $message = urlencode(
            "My name is {$customer->name}. My order number is {$order->order_number}."
        );

        return redirect("https://wa.me/2349157023870?text={$message}");
    }

    public function paystackCheckout(Request $request)
    {
        return back()->with('info', 'Online payment will be available soon.');
    }
}
