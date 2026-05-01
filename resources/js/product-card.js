/* ══════════════════════════════════
   product-card.js
══════════════════════════════════ */

let qvCurrentPrice  = 0;
let qvWished        = false;
let qvQtyVal        = 1;
let qvCurrentIndex  = 0;

const products = window.PRODUCTS || [];

/* ── Open ── */
function openQuickView(index) {
    const p       = products[index];
    const overlay = document.getElementById('quickViewOverlay');
    const modal   = document.getElementById('quickViewModal');

    if (!overlay || !modal) { console.error('Modal elements not found'); return; }
    if (!p)                  { console.error('No product at index', index); return; }

    qvCurrentIndex = index;
    _populateModal(p);

    /* show overlay */
    overlay.style.opacity        = '1';
    overlay.style.pointerEvents  = 'all';

    /* animate modal in */
    modal.style.opacity   = '1';
    modal.style.transform = 'scale(1) translateY(0)';

    document.body.style.overflow = 'hidden';
}

/* ── Close ── */
function closeQuickView() {
    const overlay = document.getElementById('quickViewOverlay');
    const modal   = document.getElementById('quickViewModal');

    if (modal) {
        modal.style.opacity   = '0';
        modal.style.transform = 'scale(0.95) translateY(16px)';
    }
    setTimeout(function () {
        if (overlay) {
            overlay.style.opacity       = '0';
            overlay.style.pointerEvents = 'none';
        }
        document.body.style.overflow = '';
    }, 250);
}

/* ── Populate ── */
function _populateModal(p) {
    _setText('qvName',    p.name);
    _setText('qvReviews', '(' + p.reviews + ' reviews)');

    const img = document.getElementById('qvImage');
    if (img) { img.src = p.image; img.alt = p.name; }

    /* price */
    const rawPrice = parseInt(p.price.replace(/,/g, ''), 10);
    qvCurrentPrice = rawPrice;
    _setText('qvPrice', '₦' + p.price);

    const oldEl  = document.getElementById('qvOldPrice');
    const saveEl = document.getElementById('qvSavings');
    if (p.old) {
        const saved       = parseInt(p.old.replace(/,/g, ''), 10) - rawPrice;
        oldEl.textContent  = '₦' + p.old;
        saveEl.textContent = 'Save ₦' + saved.toLocaleString();
        oldEl.classList.remove('hidden');
        saveEl.classList.remove('hidden');
    } else {
        oldEl.classList.add('hidden');
        saveEl.classList.add('hidden');
    }

    /* badge */
    const badgeEl = document.getElementById('qvBadge');
    if (p.badge) {
        badgeEl.textContent = p.badge;
        badgeEl.className   = 'absolute top-3 left-3 text-xs font-semibold text-white px-3 py-1 rounded-full '
            + (p.badge === 'Sale' ? 'bg-blush'
            : (p.badge === 'Premium' || p.badge === 'Gift' ? 'bg-gray-800' : 'bg-plum'));
    } else {
        badgeEl.className = 'hidden';
    }

    /* stars */
    const starSvg = '<svg fill="currentColor" viewBox="0 0 20 20" style="width:14px;height:14px;color:#facc15;display:inline-block"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
    const starsEl = document.getElementById('qvStars');
    if (starsEl) starsEl.innerHTML = starSvg.repeat(p.stars);

    /* reset state */
    qvQtyVal = 1;
    qvWished = false;
    const qtyInput = document.getElementById('qvQtyInput');
    if (qtyInput) qtyInput.value = 1;
    _setText('qvSubtotal', '');

    const wishIcon = document.getElementById('qvWishIcon');
    if (wishIcon) { wishIcon.setAttribute('fill', 'none'); wishIcon.style.color = ''; }

    _resetCartBtn();
}

/* ── Quantity ── */
function qvQty(dir) {
    qvQtyVal = Math.max(1, Math.min(99, qvQtyVal + dir));
    document.getElementById('qvQtyInput').value = qvQtyVal;
    const sub = document.getElementById('qvSubtotal');
    if (sub) {
        sub.innerHTML = qvQtyVal > 1
            ? 'Subtotal: <strong style="color:#7c3aed">₦' + (qvCurrentPrice * qvQtyVal).toLocaleString() + '</strong>'
            : '';
    }
}

/* ── Wishlist ── */
function toggleQvWish() {
    qvWished = !qvWished;
    const icon = document.getElementById('qvWishIcon');
    if (!icon) return;
    icon.setAttribute('fill', qvWished ? 'currentColor' : 'none');
    icon.style.color = qvWished ? '#ec4899' : '';
}

/* ── Cart ── */
/* ── Cart ── */
function qvAddToCart() {
    const p = products[qvCurrentIndex];
    if (!p) return;

    // Build a product object that matches CartUtils expectations
    const product = {
        id:    p.id,
        name:  p.name,
        price: parseInt(p.price.replace(/,/g, ''), 10),
        image: p.image  || null,
        emoji: p.emoji  || '📦',
        badge: p.badge  || '',
        stock: p.stock  || 99,
    };

    CartUtils.addItem(product);          // ← use CartUtils, writes to 'bakery_cart'
    _flashCartBtn(document.getElementById('qvCartBtn'));
}

function _flashCartBtn(btn) {
    if (!btn) return;
    btn.style.background = '#059669';
    btn.innerHTML = '<svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Added!';
    setTimeout(_resetCartBtn, 2500);
}

function _resetCartBtn() {
    const btn = document.getElementById('qvCartBtn');
    if (!btn) return;
    btn.style.background = '';
    btn.innerHTML = '<svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg> Add to Cart';
}

/* ── Helpers ── */
function _setText(id, text) {
    const el = document.getElementById(id);
    if (el) el.textContent = text;
}

/* ── Global listeners (wait for DOM) ── */
document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeQuickView();
    });
    const overlay = document.getElementById('quickViewOverlay');
    if (overlay) {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeQuickView();
        });
    }
});


function handleAddToCart(btn) {
    const product = {
        id:    btn.dataset.id,
        name:  btn.dataset.name,
        price: Number(btn.dataset.price),
        stock: Number(btn.dataset.stock) || 99,
        image: btn.dataset.image || null,
        badge: btn.dataset.badge || '',
        emoji: '📦',
    };

    const result = CartUtils.addItem(product);

    if (result === 'max') return; // optional: show toast

    // Flash the button
    btn.classList.add('added');
    setTimeout(() => btn.classList.remove('added'), 2500);
}


// Expose to global scope for inline onclick handlers
window.handleAddToCart = handleAddToCart;
window.openQuickView   = openQuickView;
window.closeQuickView  = closeQuickView;
window.qvQty           = qvQty;
window.toggleQvWish    = toggleQvWish;
window.qvAddToCart     = qvAddToCart;

