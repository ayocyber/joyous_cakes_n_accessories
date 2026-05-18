window.CartUtils = {
    getCart() {
        return JSON.parse(localStorage.getItem('cart') || '{}');
    },

    saveCart(cart) {
        localStorage.setItem('cart', JSON.stringify(cart));
    },

    addItem(product) {
        let cart = this.getCart();

        if (cart[product.id]) {
            cart[product.id].qty += 1;
        } else {
            cart[product.id] = {
                id: product.id,
                name: product.name,
                slug: product.slug || '',
                price: Number(product.price),
                qty: 1,
                stock: Number(product.stock || 0),
                image: product.image || '',
                currency: product.currency || 'USD',
                category: product.category || null,
            };
        }

        this.saveCart(cart);
    },

    removeItem(id) {
        let cart = this.getCart();
        delete cart[id];
        this.saveCart(cart);
    },

    changeQty(id, delta) {
        let cart = this.getCart();

        if (!cart[id]) return;

        cart[id].qty += delta;

        if (cart[id].qty <= 0) {
            delete cart[id];
        }

        this.saveCart(cart);
    },

    clearCart() {
        localStorage.removeItem('cart');
    }
};