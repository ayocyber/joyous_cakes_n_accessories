document.addEventListener('DOMContentLoaded', () => {

    // Reveal animations
    const ro = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) e.target.classList.add('in');
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => ro.observe(el));

    // Price range
    const pr = document.getElementById('priceRange');
    const pv = document.getElementById('priceVal');

    if (pr && pv) {
        pr.addEventListener('input', () => {
            pv.textContent = '₦' + parseInt(pr.value).toLocaleString();
        });
    }

    // Category chips
    document.querySelectorAll('.tag-chip').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.tag-chip').forEach(b =>
                b.classList.remove('active')
            );
            this.classList.add('active');
        });
    });

    // Grid / List toggle
    const gridBtn = document.getElementById('gridView');
    const listBtn = document.getElementById('listView');
    const grid = document.getElementById('productGrid');

    if (gridBtn && listBtn && grid) {

        gridBtn.addEventListener('click', () => {
            grid.classList.remove('grid-cols-1');
            grid.classList.add('grid-cols-2', 'xl:grid-cols-3');

            gridBtn.classList.add('bg-plum', 'text-white');
            listBtn.classList.remove('bg-plum', 'text-white');
        });

        listBtn.addEventListener('click', () => {
            grid.classList.remove('grid-cols-2', 'xl:grid-cols-3');
            grid.classList.add('grid-cols-1');

            listBtn.classList.add('bg-plum', 'text-white');
            gridBtn.classList.remove('bg-plum', 'text-white');
        });
    }


    /* ── Mobile filter toggle ── */
(function () {
    const toggle  = document.getElementById('filterToggle');
    const panel   = document.getElementById('filterPanel');
    const chevron = document.getElementById('filterChevron');
    if (!toggle || !panel) return;

    let open = false;

    toggle.addEventListener('click', function () {
        open = !open;
        // Animate height: 0 → scrollHeight → auto
        if (open) {
            panel.style.maxHeight = panel.scrollHeight + 'px';
            chevron.style.transform = 'rotate(180deg)';
            // After transition, set to 'none' so inner dynamic content works
            panel.addEventListener('transitionend', function once() {
                if (open) panel.style.maxHeight = 'none';
                panel.removeEventListener('transitionend', once);
            });
        } else {
            // Snap back from 'none' to a fixed px before animating to 0
            panel.style.maxHeight = panel.scrollHeight + 'px';
            requestAnimationFrame(() => {
                panel.style.maxHeight = '0px';
                chevron.style.transform = 'rotate(0deg)';
            });
        }
    });
})();

});