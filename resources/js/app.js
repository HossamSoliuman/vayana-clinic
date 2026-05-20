/**
 * Vayana public-site interactions (vanilla JS).
 *
 * Keep JS limited to true interactions only:
 * - Carousels
 * - Tabs / filters
 * - Progressive reveal animations
 */

function onDomReady(callback) {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback, { once: true });
        return;
    }

    callback();
}

function qs(selector, root = document) {
    return root.querySelector(selector);
}

function qsa(selector, root = document) {
    return Array.from(root.querySelectorAll(selector));
}

function prefersReducedMotion() {
    return window.matchMedia?.('(prefers-reduced-motion: reduce)')?.matches ?? false;
}

function initScrollReveal(root = document) {
    if (prefersReducedMotion()) {
        return;
    }

    const revealables = qsa('[data-reveal]', root);
    if (!revealables.length) {
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            for (const entry of entries) {
                if (!entry.isIntersecting) {
                    continue;
                }

                entry.target.classList.add('is-revealed');
                observer.unobserve(entry.target);
            }
        },
        { threshold: 0.12 }
    );

    for (const el of revealables) {
        observer.observe(el);
    }
}

function initCarousel(carouselEl) {
    const track = qs('.home-carousel__track', carouselEl);
    const prevBtn = qs('.home-carousel__nav--prev', carouselEl);
    const nextBtn = qs('.home-carousel__nav--next', carouselEl);
    const dotsRoot = qs('.home-carousel__dots', carouselEl);

    if (!track) {
        return;
    }

    const getStep = () => {
        const firstCard = track.firstElementChild;
        if (!firstCard) {
            return 320;
        }

        const cardRect = firstCard.getBoundingClientRect();
        const style = window.getComputedStyle(track);
        const gap = Number.parseFloat(style.columnGap || style.gap || '0') || 0;
        return Math.max(240, Math.round(cardRect.width + gap));
    };

    const setNavState = () => {
        const max = Math.max(0, track.scrollWidth - track.clientWidth - 1);
        const x = track.scrollLeft;
        if (prevBtn) {
            prevBtn.disabled = x <= 2;
        }
        if (nextBtn) {
            nextBtn.disabled = x >= max - 2;
        }
    };

    const updateDots = () => {
        if (!dotsRoot) {
            return;
        }

        const step = getStep();
        const pages = Math.max(1, Math.ceil(track.scrollWidth / Math.max(1, track.clientWidth)));
        const activeIndex = Math.min(pages - 1, Math.floor((track.scrollLeft + step * 0.25) / (track.clientWidth || 1)));

        if (dotsRoot.childElementCount !== pages) {
            dotsRoot.innerHTML = '';
            const fragment = document.createDocumentFragment();
            for (let i = 0; i < pages; i += 1) {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = 'home-dot';
                dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
                dot.addEventListener('click', () => {
                    track.scrollTo({ left: i * track.clientWidth, behavior: prefersReducedMotion() ? 'auto' : 'smooth' });
                });
                fragment.appendChild(dot);
            }
            dotsRoot.appendChild(fragment);
        }

        qsa('.home-dot', dotsRoot).forEach((dot, idx) => {
            dot.classList.toggle('is-active', idx === activeIndex);
        });
    };

    const scrollByStep = (dir) => {
        const delta = getStep() * dir;
        track.scrollBy({ left: delta, behavior: prefersReducedMotion() ? 'auto' : 'smooth' });
    };

    prevBtn?.addEventListener('click', () => scrollByStep(-1));
    nextBtn?.addEventListener('click', () => scrollByStep(1));

    track.addEventListener(
        'scroll',
        () => {
            setNavState();
            updateDots();
        },
        { passive: true }
    );

    window.addEventListener(
        'resize',
        () => {
            setNavState();
            updateDots();
        },
        { passive: true }
    );

    setNavState();
    updateDots();
}

function initHomeResourcesFilter(homeRoot) {
    const categoryButtons = qsa('.category-filter-btn', homeRoot);
    const resourcesContainer = qs('#resourcesContainer', homeRoot);
    const loadingSpinner = qs('#loadingSpinner', homeRoot);

    if (!categoryButtons.length || !resourcesContainer || !loadingSpinner) {
        return;
    }

    const endpoint = resourcesContainer.getAttribute('data-endpoint');
    if (!endpoint) {
        return;
    }

    const setActiveButton = (activeButton) => {
        for (const btn of categoryButtons) {
            btn.classList.remove('is-active');
            btn.setAttribute('aria-selected', 'false');
        }

        activeButton.classList.add('is-active');
        activeButton.setAttribute('aria-selected', 'true');
    };

    const renderResources = (resources) => {
        resourcesContainer.innerHTML = '';

        if (!resources?.length) {
            resourcesContainer.innerHTML =
                '<div class="home-empty" style="color: rgba(255,255,255,.8); text-align:center; padding: 28px 0;">No resources found.</div>';
            return;
        }

        const fragment = document.createDocumentFragment();

        for (const resource of resources) {
            const card = document.createElement('article');
            card.className = 'res-card resource-card is-revealed';

            const durationHtml = resource.duration
                ? `<span class="chip"><i class="bi bi-clock"></i> ${resource.duration}</span>`
                : '';

            const mediaHtml = resource.thumbnail
                ? `<img src="${resource.thumbnail}" alt="" loading="lazy" decoding="async">`
                : `<div class="res-card__placeholder" aria-hidden="true"><i class="bi bi-book"></i></div>`;

            card.innerHTML = `
                <div class="res-card__media">
                    ${mediaHtml}
                    <div class="res-card__chips">
                        <span class="chip">${resource.category}</span>
                        ${durationHtml}
                    </div>
                </div>
                <div class="res-card__body">
                    <h3 class="res-card__title">${resource.title}</h3>
                    <p class="res-card__text">${resource.description}</p>
                    <a class="home-btn home-btn--primary home-btn--sm" href="/resources/${resource.slug}">Access resource <span aria-hidden="true">→</span></a>
                </div>
            `;

            fragment.appendChild(card);
        }

        resourcesContainer.appendChild(fragment);
    };

    const fetchResources = async (category) => {
        const url = new URL(endpoint, window.location.origin);
        url.searchParams.set('category', category);
        url.searchParams.set('limit', '6');

        const response = await fetch(url.toString(), {
            headers: { Accept: 'application/json' },
            credentials: 'same-origin',
        });

        if (!response.ok) {
            throw new Error(`Resources request failed: ${response.status}`);
        }

        return response.json();
    };

    for (const button of categoryButtons) {
        button.addEventListener('click', async () => {
            const category = button.getAttribute('data-category') || 'all';
            setActiveButton(button);

            loadingSpinner.style.display = 'flex';
            resourcesContainer.style.opacity = '0.55';

            try {
                const data = await fetchResources(category);
                if (data?.success) {
                    renderResources(data.resources);
                }
            } catch (error) {
                // eslint-disable-next-line no-console
                console.error(error);
            } finally {
                loadingSpinner.style.display = 'none';
                resourcesContainer.style.opacity = '1';
            }
        });
    }
}

function initSiteNav() {
    const header = qs('[data-site-header]');
    if (!header) {
        return;
    }

    const toggle = qs('[data-nav-toggle]', header);
    const closeBtn = qs('[data-nav-close]', header);
    const panel = qs('[data-nav-panel]', header);
    const backdrop = qs('[data-nav-backdrop]', header);

    if (!toggle || !panel || !backdrop) {
        return;
    }

    const open = () => {
        panel.classList.add('is-open');
        backdrop.hidden = false;
        backdrop.classList.add('is-open');
        toggle.setAttribute('aria-expanded', 'true');
        document.documentElement.classList.add('is-nav-open');
    };

    const close = () => {
        panel.classList.remove('is-open');
        backdrop.classList.remove('is-open');
        backdrop.hidden = true;
        toggle.setAttribute('aria-expanded', 'false');
        document.documentElement.classList.remove('is-nav-open');
    };

    toggle.addEventListener('click', () => {
        const expanded = toggle.getAttribute('aria-expanded') === 'true';
        if (expanded) {
            close();
        } else {
            open();
        }
    });

    closeBtn?.addEventListener('click', close);
    backdrop.addEventListener('click', close);
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            close();
        }
    });

    // Close after navigation on mobile.
    qsa('a.site-nav__link', panel).forEach((a) => a.addEventListener('click', close));

    // User dropdown
    const userToggle = qs('[data-user-toggle]', header);
    const userMenu = qs('[data-user-menu]', header);
    if (userToggle && userMenu) {
        const setUserOpen = (isOpen) => {
            userToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            userMenu.classList.toggle('is-open', isOpen);
        };

        userToggle.addEventListener('click', () => {
            const isOpen = userToggle.getAttribute('aria-expanded') === 'true';
            setUserOpen(!isOpen);
        });

        document.addEventListener('click', (e) => {
            if (!userMenu.classList.contains('is-open')) {
                return;
            }
            const target = e.target;
            if (!(target instanceof Node)) {
                return;
            }
            if (userToggle.contains(target) || userMenu.contains(target)) {
                return;
            }
            setUserOpen(false);
        });
    }
}

onDomReady(() => {
    initSiteNav();

    const homeRoot = qs('[data-page="home"]');
    if (!homeRoot) {
        return;
    }

    initScrollReveal(homeRoot);

    qsa('[data-carousel]', homeRoot).forEach((carousel) => initCarousel(carousel));
    initHomeResourcesFilter(homeRoot);
});


document.addEventListener('DOMContentLoaded', () => {
    // --- Mobile Drawer Element Handles ---
    const navToggle = document.querySelector('[data-nav-toggle]');
    const navPanel = document.querySelector('[data-nav-panel]');
    const navClose = document.querySelector('[data-nav-close]');
    const navBackdrop = document.querySelector('[data-nav-backdrop]');

    function openMobileMenu() {
        navToggle.setAttribute('aria-expanded', 'true');
        navPanel.classList.add('is-active');
        navBackdrop.removeAttribute('hidden');
        document.body.style.overflow = 'hidden'; // Prevents scrolling behind overlay
    }

    function closeMobileMenu() {
        navToggle.setAttribute('aria-expanded', 'false');
        navPanel.classList.remove('is-active');
        navBackdrop.setAttribute('hidden', '');
        document.body.style.overflow = '';
    }

    if (navToggle && navPanel) {
        navToggle.addEventListener('click', () => {
            const isOpen = navToggle.getAttribute('aria-expanded') === 'true';
            isOpen ? closeMobileMenu() : openMobileMenu();
        });

        if (navClose) navClose.addEventListener('click', closeMobileMenu);
        if (navBackdrop) navBackdrop.addEventListener('click', closeMobileMenu);
    }

    // --- User Profile Context Menu Dropdown ---
    const userToggle = document.querySelector('[data-user-toggle]');
    const userMenu = document.querySelector('[data-user-menu]');

    if (userToggle && userMenu) {
        userToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            const isExpanded = userToggle.getAttribute('aria-expanded') === 'true';
            userToggle.setAttribute('aria-expanded', !isExpanded);
            userMenu.classList.toggle('is-open');
        });

        // Click outside dropdown to auto-close panel
        document.addEventListener('click', (e) => {
            if (!userToggle.contains(e.target) && !userMenu.contains(e.target)) {
                userToggle.setAttribute('aria-expanded', 'false');
                userMenu.classList.remove('is-open');
            }
        });
    }
});
