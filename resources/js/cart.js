document.addEventListener('DOMContentLoaded', () => {

    const FREE_SHIPPING_THRESHOLD = 50000;
    const SHIPPING_COST = 1500;
    const VAT_RATE = 0.075;

    // Laravel injected data
    let cart = {};

    (window.__CART__ || []).forEach(item => {
        cart[item.id] = item;
    });

    let savedItems = {};
    let discount = 0;

    function fmt(n) {
        return '₦' + Math.round(n).toLocaleString('en-NG');
    }

    function subtotal() {
        return Object.values(cart).reduce((s, i) => s + i.price * i.qty, 0);
    }

    function updateSummary() {
        const sub = subtotal();
        const disc = sub * discount;
        const afterDisc = sub - disc;

        const ship = afterDisc >= FREE_SHIPPING_THRESHOLD ? 0 : SHIPPING_COST;
        const vat = afterDisc * VAT_RATE;
        const total = afterDisc + ship + vat;

        const toFree = Math.max(0, FREE_SHIPPING_THRESHOLD - afterDisc);
        const pct = Math.min(100, (afterDisc / FREE_SHIPPING_THRESHOLD) * 100);

        document.getElementById('subtotalVal').textContent = fmt(sub);
        document.getElementById('vatVal').textContent = fmt(vat);
        document.getElementById('shippingVal').textContent = ship === 0 ? 'FREE 🎉' : fmt(ship);
        document.getElementById('totalVal').textContent = fmt(total);

        document.getElementById('shippingFill').style.width = pct + '%';
        document.getElementById('shippingLeft').textContent =
            toFree > 0 ? fmt(toFree) + ' away' : 'You have free shipping! 🎉';

        const count = Object.values(cart).reduce((s, i) => s + i.qty, 0);
        document.getElementById('cartCountBadge').textContent = count;

        checkEmpty();
    }

    function checkEmpty() {
        if (Object.keys(cart).length === 0) {
            const list = document.getElementById('cartItemsList');
            if (!document.getElementById('emptyState')) {
                const div = document.createElement('div');
                div.id = 'emptyState';
                div.innerHTML = 'Cart is empty';
                list.appendChild(div);
            }
        }
    }

    function changeQty(id, delta) {
        const item = cart[id];
        if (!item) return;

        const newQty = item.qty + delta;
        if (newQty < 1 || newQty > item.stock) return;

        item.qty = newQty;

        document.getElementById('qty-' + id).textContent = newQty;
        document.getElementById('line-' + id).textContent = fmt(item.price * newQty);

        updateSummary();
    }

    function removeItem(id) {
        delete cart[id];

        const el = document.querySelector('.cart-item[data-id="' + id + '"]');
        if (el) el.remove();

        updateSummary();
    }

    function applyCoupon() {
        const code = document.getElementById('couponInput').value.trim().toUpperCase();
        const valid = { BAKE10: 0.10, SWEET15: 0.15, BAKER20: 0.20 };

        if (valid[code]) {
            discount = valid[code];
            updateSummary();
        }
    }

    document.getElementById('couponInput')?.addEventListener('keydown', e => {
        if (e.key === 'Enter') applyCoupon();
    });

    const ro = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) e.target.classList.add('in');
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => ro.observe(el));

    updateSummary();
});