// js/top-b.js

document.addEventListener('DOMContentLoaded', () => {

    // Intersection Observer for amazing text reveals
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -10% 0px' });

    // Observing gimmick elements
    document.querySelectorAll('.gimmick-reveal, .outline-anim').forEach(el => {
        observer.observe(el);
    });

    // Scroll interactions (Parallax & Scale)
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY;

        // Big Numbers parallax inside service cards
        document.querySelectorAll('.s-num').forEach((el, index) => {
            el.style.transform = `translate3d(0, ${scrolled * (0.05 + index * 0.02)}px, 0)`;
        });

        // Cards stacking scale effect
        const cards = document.querySelectorAll('.service-card');
        const viewHeight = window.innerHeight;
        
        cards.forEach((card, index) => {
            const rect = card.getBoundingClientRect();
            // Start scaling when it hits the sticky top
            const stickyThreshold = viewHeight * 0.25;
            
            if (rect.top <= stickyThreshold) {
                const distance = stickyThreshold - rect.top;
                // Scale down slightly to give a depth stacking effect
                const scale = Math.max(0.9, 1 - (distance * 0.0002));
                card.style.transform = `scale(${scale})`;
                // Dim previous cards
                const opacity = Math.max(0.4, 1 - (distance * 0.0005));
                card.style.opacity = opacity;
            } else {
                card.style.transform = 'scale(1)';
                card.style.opacity = 1;
            }
        });
    });

    // Anchor smooth scroll
    document.querySelectorAll('.overlay-nav a, .main-nav a').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if(targetId && targetId.startsWith('#')) {
                e.preventDefault();
                const targetEl = document.querySelector(targetId);
                if(targetEl) {
                    document.body.classList.remove('menu-open');
                    window.scrollTo({
                        top: targetEl.offsetTop,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
});
