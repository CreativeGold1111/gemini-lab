document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('.site-header');
    const cursor = document.createElement('div');
    cursor.className = 'custom-cursor';
    cursor.innerHTML = '<span class="cursor-tag"></span>';
    document.body.appendChild(cursor);

    const cursorTag = cursor.querySelector('.cursor-tag');

    // Header Scroll Effect
    const handleScroll = () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    };

    // Mobile Menu Toggle is handled by common.js

    // --- Custom Cursor ---
    let mouseX = 0, mouseY = 0;
    let cursorX = 0, cursorY = 0;

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    const animateCursor = () => {
        cursorX += (mouseX - cursorX) * 0.15;
        cursorY += (mouseY - cursorY) * 0.15;
        cursor.style.left = `${cursorX}px`;
        cursor.style.top = `${cursorY}px`;

        // Update meta-data
        const coordX = Math.floor(mouseX).toString().padStart(4, '0');
        const coordY = Math.floor(mouseY).toString().padStart(4, '0');
        cursorTag.innerText = `[ SCANNING:: ${coordX}:${coordY} ]`;

        requestAnimationFrame(animateCursor);
    };
    animateCursor();

    // Hover effect for links
    document.querySelectorAll('a, button, .work-card').forEach(el => {
        el.addEventListener('mouseenter', () => cursor.classList.add('hover'));
        el.addEventListener('mouseleave', () => cursor.classList.remove('hover'));
    });

    // --- Canvas Background Animation ---
    const canvas = document.getElementById('bg-canvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        let points = [];
        const gap = 120;

        const resize = () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            points = [];
            for (let x = 0; x < canvas.width + gap; x += gap) {
                for (let y = 0; y < canvas.height + gap; y += gap) {
                    points.push({ x, y, originX: x, originY: y });
                }
            }
        };

        const animate = () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = '#0066CC';
            points.forEach(p => {
                const dx = mouseX - p.x;
                const dy = mouseY - p.y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                const maxDist = 300;

                if (dist < maxDist) {
                    const power = (maxDist - dist) / maxDist;
                    p.x = p.originX - dx * power * 0.2;
                    p.y = p.originY - dy * power * 0.2;
                } else {
                    p.x += (p.originX - p.x) * 0.1;
                    p.y += (p.originY - p.y) * 0.1;
                }

                ctx.beginPath();
                ctx.arc(p.x, p.y, 0.5, 0, Math.PI * 2);
                ctx.fill();
            });
            requestAnimationFrame(animate);
        };

        window.addEventListener('resize', resize);
        resize();
        animate();
    }

    // --- Glitch Effect Reveal ---
    const glitchText = (el) => {
        const originalText = el.innerText;
        const chars = '!<>-_\\/[]{}—=+*^?#________';
        let iterations = 0;

        const interval = setInterval(() => {
            el.innerText = originalText.split('')
                .map((char, index) => {
                    if (index < iterations) return originalText[index];
                    return chars[Math.floor(Math.random() * chars.length)];
                })
                .join('');

            if (iterations >= originalText.length) clearInterval(interval);
            iterations += 1 / 3;
        }, 30);
    };

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (!entry.target.classList.contains('active')) {
                    entry.target.classList.add('active');
                    const titles = entry.target.querySelectorAll('.section-heading, .role-title-large, .label-parenthesis');
                    titles.forEach(t => glitchText(t));
                }
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

    // --- Drag to Scroll for Portfolio ---
    const slider = document.querySelector('.works-slider-wrapper');
    if (slider) {
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.style.cursor = 'grabbing';
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });

        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.style.cursor = 'grab';
        });

        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.style.cursor = 'grab';
        });

        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 2; 
            slider.scrollLeft = scrollLeft - walk;
        });

        // --- Arrow Buttons ---
        const btnPrev = document.querySelector('.nav-btn.prev');
        const btnNext = document.querySelector('.nav-btn.next');

        if (btnPrev && btnNext) {
            btnPrev.addEventListener('click', () => {
                slider.scrollLeft -= 420; // card width + gap
            });
            btnNext.addEventListener('click', () => {
                slider.scrollLeft += 420;
            });
        }
    }

    // Initial check
    window.addEventListener('scroll', handleScroll);
    handleScroll();
});
