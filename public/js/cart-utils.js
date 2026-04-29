/**
 * cart-utils.js
 * Shared cart utility — include on every page via <script src="/js/cart-utils.js"></script>
 * Uses localStorage to persist cart across pages.
 */

const CartUtils = (() => {
    const KEY = 'bakery_cart';

    function getCart() {
        try { return JSON.parse(localStorage.getItem(KEY)) || {}; }
        catch { return {}; }
    }

    function saveCart(cart) {
        localStorage.setItem(KEY, JSON.stringify(cart));
        window.dispatchEvent(new CustomEvent('cartUpdated', { detail: { cart } }));
    }

    function addItem(product) {
        /**
         * product = { id, name, price (number), emoji, image, badge, stock }
         */
        const cart = getCart();
        if (cart[product.id]) {
            if (cart[product.id].qty < (cart[product.id].stock || 99)) {
                cart[product.id].qty++;
            }
        } else {
            cart[product.id] = { ...product, qty: 1 };
        }
        saveCart(cart);
        return cart[product.id].qty;
    }

    function removeItem(id) {
        const cart = getCart();
        delete cart[id];
        saveCart(cart);
    }

    function changeQty(id, delta) {
        const cart = getCart();
        if (!cart[id]) return;
        const newQty = cart[id].qty + delta;
        if (newQty < 1) { removeItem(id); return; }
        if (newQty > (cart[id].stock || 99)) return;
        cart[id].qty = newQty;
        saveCart(cart);
    }

    function setQty(id, qty) {
        const cart = getCart();
        if (!cart[id]) return;
        if (qty < 1) { removeItem(id); return; }
        cart[id].qty = Math.min(qty, cart[id].stock || 99);
        saveCart(cart);
    }

    function clearCart() {
        saveCart({});
    }

    function getCount() {
        return Object.values(getCart()).reduce((s, i) => s + i.qty, 0);
    }

    function getSubtotal() {
        return Object.values(getCart()).reduce((s, i) => s + i.price * i.qty, 0);
    }

    return { getCart, addItem, removeItem, changeQty, setQty, clearCart, getCount, getSubtotal };
})();

/* ── Update any cart count badge in the nav on every page ── */
function refreshNavCartBadge() {
    const count = CartUtils.getCount();
    document.querySelectorAll('[data-cart-count]').forEach(el => {
        el.textContent = count;
        el.style.display = count > 0 ? '' : 'none';
    });
}

window.addEventListener('cartUpdated', refreshNavCartBadge);
document.addEventListener('DOMContentLoaded', refreshNavCartBadge);