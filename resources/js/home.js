/* HERO SLIDESHOW */
function heroSlider() {
    const slider = document.getElementById('heroSlider');
    if (!slider) return;

    const slides = slider.querySelectorAll('.slide');
    const dots = slider.querySelectorAll('.dot');
    const progress = document.getElementById('slideProgress');
    const DURATION = 6000;

    let current = 0;
    let timer = null;
    let progTimer = null;
    let startTime = null;

    function goTo(idx) {
        slides[current].classList.remove('active');
        slides[current].classList.add('prev');
        dots[current].classList.remove('active');

        setTimeout(() => {
            if (slides[current]) slides[current].classList.remove('prev');
        }, 1400);

        current = (idx + slides.length) % slides.length;

        slides[current].classList.add('active');
        dots[current].classList.add('active');

        resetProgress();
    }

    function next() { goTo(current + 1); }
    function prev() { goTo(current - 1); }

    function startAuto() {
        clearInterval(timer);
        timer = setInterval(next, DURATION);
    }

    function resetProgress() {
        clearInterval(progTimer);
        progress.style.transition = 'none';
        progress.style.width = '0%';

        startTime = performance.now();

        requestAnimationFrame(function tick(now) {
            const pct = Math.min(((now - startTime) / DURATION) * 100, 100);
            progress.style.width = pct + '%';

            if (pct < 100) progTimer = requestAnimationFrame(tick);
        });
    }

    document.getElementById('heroNext')?.addEventListener('click', () => { next(); startAuto(); });
    document.getElementById('heroPrev')?.addEventListener('click', () => { prev(); startAuto(); });

    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            goTo(parseInt(dot.dataset.goto));
            startAuto();
        });
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'ArrowRight') { next(); startAuto(); }
        if (e.key === 'ArrowLeft') { prev(); startAuto(); }
    });

    let touchStartX = 0;
    slider.addEventListener('touchstart', e => touchStartX = e.touches[0].clientX, { passive: true });

    slider.addEventListener('touchend', e => {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 50) {
            diff > 0 ? next() : prev();
            startAuto();
        }
    });

    slider.addEventListener('mouseenter', () => clearInterval(timer));
    slider.addEventListener('mouseleave', startAuto);

    startAuto();
    resetProgress();
}

/* Scroll reveal */
function revealInit() {
    const ro = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) e.target.classList.add('in');
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('.reveal').forEach(el => ro.observe(el));
}

/* Filter tabs */
function filterTabs() {
    document.querySelectorAll('.ftab').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.ftab').forEach(b => {
                b.classList.remove('btn-primary','border-transparent','shadow-md');
                b.classList.add('bg-white','border-purple-100','text-gray-500');
            });

            this.classList.add('btn-primary','border-transparent','shadow-md');
            this.classList.remove('bg-white','border-purple-100','text-gray-500');
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    heroSlider();
    revealInit();
    filterTabs();
});