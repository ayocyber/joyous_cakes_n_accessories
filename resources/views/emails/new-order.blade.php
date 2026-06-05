<h2>New Order Received</h2>

<p>
    A new order has been placed on Joyous Cakes & Accessories.
</p>

<hr>

<p><strong>Order Number:</strong> {{ $order->order_number }}</p>

<p><strong>Customer:</strong> {{ $customer->name }}</p>

<p><strong>Email:</strong> {{ $customer->email }}</p>

<p><strong>Phone:</strong> {{ $customer->phone }}</p>

<p><strong>Country:</strong> {{ $customer->country }}</p>

<p><strong>City:</strong> {{ $customer->city }}</p>

<p><strong>Address:</strong> {{ $customer->address_line }}</p>

<p><strong>Total:</strong> LRD {{ number_format($order->total_price, 2) }}</p>

<p><strong>Payment Method:</strong> Manual Transfer</p>

<hr>

<p>
    Review this order:
</p>

<p>
    <a href="http://joyouscakesnaccessories.com/admin/orders">
        Open Admin Panel
    </a>
</p>