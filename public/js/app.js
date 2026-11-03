(function () {
    // header gets background when you scroll down
    const header = document.querySelector('.site-header');

    function updateHeader() {
        if (!header) return;
        header.classList.toggle('is-scrolled', window.scrollY > 10);
    }

    updateHeader();
    window.addEventListener('scroll', updateHeader, { passive: true });

    // these elements fade in when they show up on screen
    const revealTargets = document.querySelectorAll(
        '.hero, .gallery-item, .card, .service-item, .service-intro, .service-actions'
    );

    revealTargets.forEach(function (el) {
        el.classList.add('reveal');
    });

    // small delay for each item so they come one after another
    document.querySelectorAll('.gallery, .services-grid').forEach(function (group) {
        Array.from(group.children).forEach(function (child, i) {
            child.style.setProperty('--delay', (i % 4) * 90 + 'ms');
        });
    });

    // old browsers dont have IntersectionObserver, then just show everything
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
        );

        revealTargets.forEach(function (el) {
            observer.observe(el);
        });
    } else {
        revealTargets.forEach(function (el) {
            el.classList.add('is-visible');
        });
    }

    // images fade in after they load
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