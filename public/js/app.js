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

    // email and phone links open a small menu (write/call or copy)
    const menu = document.createElement('div');
    menu.className = 'contact-menu';
    menu.hidden = true;
    document.body.appendChild(menu);

    let openLink = null;

    function closeMenu() {
        menu.hidden = true;
        openLink = null;
    }

    // copy text, the old way is for browsers without navigator.clipboard
    function copyText(text) {
        if (navigator.clipboard && window.isSecureContext) {
            return navigator.clipboard.writeText(text);
        }

        const area = document.createElement('textarea');
        area.value = text;
        document.body.appendChild(area);
        area.select();
        document.execCommand('copy');
        area.remove();

        return Promise.resolve();
    }

    function addButton(label, onClick) {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.textContent = label;
        btn.addEventListener('click', onClick);
        menu.appendChild(btn);

        return btn;
    }

    function showMenu(link) {
        const isEmail = link.href.startsWith('mailto:');
        const value = decodeURIComponent(link.href.replace(/^(mailto|tel):/, '').split('?')[0]);

        menu.innerHTML = '';

        addButton(isEmail ? 'Rakstīt e-pastu' : 'Zvanīt', function () {
            // subject is already filled in so you can just start writing
            window.location.href = isEmail
                ? 'mailto:' + value + '?subject=' + encodeURIComponent('Jautājums par Barocco Art pakalpojumiem')
                : 'tel:' + value;
            closeMenu();
        });

        const copyBtn = addButton('Kopēt', function () {
            copyText(value).then(function () {
                copyBtn.textContent = 'Nokopēts!';
                setTimeout(closeMenu, 900);
            });
        });

        // put the menu under the link, but not outside the screen
        menu.hidden = false;
        const box = link.getBoundingClientRect();
        const left = Math.min(box.left, window.innerWidth - menu.offsetWidth - 12);
        menu.style.left = Math.max(12, left) + window.scrollX + 'px';
        menu.style.top = box.bottom + 8 + window.scrollY + 'px';

        openLink = link;
    }

    document.addEventListener('click', function (e) {
        const link = e.target.closest('a[href^="mailto:"], a[href^="tel:"]');

        if (link) {
            e.preventDefault();
            link === openLink ? closeMenu() : showMenu(link);
        } else if (!menu.contains(e.target)) {
            closeMenu();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeMenu();
    });

    window.addEventListener('resize', closeMenu);
})();