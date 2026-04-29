document.addEventListener('DOMContentLoaded', () => {

    // Reveal animation
    const ro = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) e.target.classList.add('in');
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => ro.observe(el));

    // FAQ accordion
    document.querySelectorAll('.faq-q').forEach(btn => {
        btn.addEventListener('click', function () {
            const item = this.closest('.faq-item');
            const isOpen = item.classList.contains('open');

            document.querySelectorAll('.faq-item')
                .forEach(i => i.classList.remove('open'));

            if (!isOpen) item.classList.add('open');
        });
    });

    // Contact form
    const form = document.getElementById('contactForm');
    const btn = document.getElementById('submitBtn');
    const toast = document.getElementById('successToast');

    if (form && btn) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            btn.disabled = true;
            btn.innerHTML = `
                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                </svg>
                <span>Sending…</span>
            `;

            // Simulated request (replace with real Laravel route later)
            setTimeout(() => {

                btn.disabled = false;
                btn.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    <span>Send Message</span>
                `;

                form.reset();

                if (toast) {
                    toast.classList.add('show');
                    setTimeout(() => toast.classList.remove('show'), 4000);
                }

            }, 1500);
        });
    }
});