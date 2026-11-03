

(function () {
    // ---- 1. Header gets a blurred background after scrolling ----
    const header = document.querySelector('.site-header');

    function updateHeader() {
        if (!header) return;
        header.classList.toggle('is-scrolled', window.scrollY > 10);
    }

    updateHeader();
    window.addEventListener('scroll', updateHeader, { passive: true });

    // ---- 2. Scroll reveal ----
    // Elements that fade/slide in when they enter the screen.
    // No need to add classes in Blade – they are picked here.
    const revealTargets = document.querySelectorAll(
        '.hero, .gallery-item, .card, .service-item, .service-intro, .service-actions'
    );

    revealTargets.forEach(function (el) {
        el.classList.add('reveal');
    });

    // Stagger items that sit next to each other (gallery, service grid)
    document.querySelectorAll('.gallery, .services-grid').forEach(function (group) {
        Array.from(group.children).forEach(function (child, i) {
            child.style.setProperty('--delay', (i % 4) * 90 + 'ms');
        });
    });

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target); // animate only once
                    }
                });
            },
            { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
        );

        revealTargets.forEach(function (el) {
            observer.observe(el);
        });
    } else {
        // Very old browsers: just show everything
        revealTargets.forEach(function (el) {
            el.classList.add('is-visible');
        });
    }

    // ---- 3. Images fade in once they finish loading ----
    document.querySelectorAll('.gallery-item img, .image-frame img').forEach(function (img) {
        img.classList.add('lazy-fade');

        if (img.complete) {
            img.classList.add('is-loaded');
        } else {
            img.addEventListener('load', function () {
                img.classList.add('is-loaded');
            });
            img.addEventListener('error', function () {
                img.classList.add('is-loaded');
            });
        }
    });
})();