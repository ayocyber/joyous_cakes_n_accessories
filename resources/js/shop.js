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
});