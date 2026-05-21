/* ============================================================
   EXCIGENT TECH PARTNERS — Shared JavaScript
   ============================================================ */

/* ── Nav: active link highlight ── */
(function initActiveNav() {
  const links = document.querySelectorAll('.nav-links a');
  const path  = window.location.pathname.split('/').pop() || 'index.html';
  links.forEach(a => {
    const href = a.getAttribute('href');
    if (href === path) a.classList.add('active');
  });
})();

/* ── Nav: frosted glass deepens on scroll ── */
(function initNavOnScroll() {
  const nav = document.querySelector('nav');
  if (!nav) return;
  let ticking = false;

  function update() {
    ticking = false;
    const scrolled = window.scrollY > 60;
    if (scrolled) {
      nav.style.background        = 'rgba(255,255,255,0.62)';
      nav.style.backdropFilter    = 'saturate(220%) blur(40px)';
      nav.style.webkitBackdropFilter = 'saturate(220%) blur(40px)';
      nav.style.borderBottomColor = 'rgba(15,64,90,0.12)';
      nav.style.boxShadow =
        'inset 0 1px 0 rgba(255,255,255,0.6),' +
        'inset 0 -1px 0 rgba(255,255,255,0.18),' +
        '0 1px 0 rgba(15,64,90,0.05),' +
        '0 12px 28px -16px rgba(15,64,90,0.22)';
    } else {
      nav.style.background        = 'rgba(255,255,255,0.55)';
      nav.style.backdropFilter    = 'saturate(200%) blur(30px)';
      nav.style.webkitBackdropFilter = 'saturate(200%) blur(30px)';
      nav.style.borderBottomColor = 'rgba(15,64,90,0.08)';
      nav.style.boxShadow =
        'inset 0 1px 0 rgba(255,255,255,0.55),' +
        'inset 0 -1px 0 rgba(255,255,255,0.15),' +
        '0 1px 0 rgba(15,64,90,0.04)';
    }
  }
  window.addEventListener('scroll', () => {
    if (!ticking) { requestAnimationFrame(update); ticking = true; }
  }, { passive: true });
})();

/* ── Mobile nav hamburger ── */
(function initMobileNav() {
  const hamburger = document.querySelector('.nav-hamburger');
  const links     = document.querySelector('.nav-links');
  if (!hamburger || !links) return;

  hamburger.addEventListener('click', () => {
    links.classList.toggle('open');
    const isOpen = links.classList.contains('open');
    hamburger.setAttribute('aria-expanded', isOpen);
    const spans = hamburger.querySelectorAll('span');
    if (isOpen) {
      spans[0].style.transform = 'translateY(7px) rotate(45deg)';
      spans[1].style.opacity   = '0';
      spans[2].style.transform = 'translateY(-7px) rotate(-45deg)';
    } else {
      spans[0].style.transform = '';
      spans[1].style.opacity   = '';
      spans[2].style.transform = '';
    }
  });

  document.addEventListener('click', (e) => {
    if (!hamburger.contains(e.target) && !links.contains(e.target)) {
      links.classList.remove('open');
    }
  });
})();

/* ── Smooth scroll for in-page anchor links ── */
(function initSmoothAnchors() {
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', (e) => {
      const id = a.getAttribute('href').slice(1);
      if (!id) return;
      const target = document.getElementById(id);
      if (!target) return;
      e.preventDefault();
      const y = target.getBoundingClientRect().top + window.pageYOffset - 64;
      window.scrollTo({ top: y, behavior: 'smooth' });
    });
  });
})();

/* ── Scroll-reveal with IntersectionObserver ── */
(function initScrollReveal() {
  const reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (reduce) {
    document.querySelectorAll('.reveal').forEach(el => el.classList.add('in'));
    document.querySelectorAll('.process-track').forEach(el => el.classList.add('lit'));
    document.querySelectorAll('.count').forEach(el => { el.textContent = el.dataset.target; });
    return;
  }

  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el = entry.target;
      el.classList.add('in');

      if (el.classList.contains('stat')) {
        const num = el.querySelector('.count');
        if (num && !num.dataset.done) { num.dataset.done = '1'; animateCount(num); }
      }
      if (el.classList.contains('process-track')) { el.classList.add('lit'); }

      io.unobserve(el);
    });
  }, { threshold: 0.18, rootMargin: '0px 0px -60px 0px' });

  document.querySelectorAll('.reveal').forEach(el => io.observe(el));

  function animateCount(el) {
    const target = parseInt(el.dataset.target, 10) || 0;
    const dur    = 1500;
    const start  = performance.now();
    function tick(now) {
      const t     = Math.min(1, (now - start) / dur);
      const eased = 1 - Math.pow(1 - t, 3);
      el.textContent = Math.round(target * eased);
      if (t < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }
})();

/* ── Parallax drift on dark sections ── */
(function initSectionParallax() {
  const sections = document.querySelectorAll('.section.dark, .section.deep');
  if (!sections.length) return;
  if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  let ticking = false;
  function update() {
    ticking = false;
    const vh = window.innerHeight;
    sections.forEach(sec => {
      const rect = sec.getBoundingClientRect();
      if (rect.bottom < 0 || rect.top > vh) return;
      const progress = (rect.top - vh) / (vh + rect.height);
      const shift    = progress * 60;
      sec.style.backgroundPosition = `center ${shift.toFixed(1)}px`;
    });
  }
  window.addEventListener('scroll', () => {
    if (!ticking) { requestAnimationFrame(update); ticking = true; }
  }, { passive: true });
  update();
})();

/* ── Subscribe form feedback ── */
(function initSubscribeForm() {
  const form = document.querySelector('.subscribe-form');
  if (!form) return;
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const btn = form.querySelector('button');
    if (btn) { btn.textContent = 'Subscribed ✓'; btn.style.background = '#1260A7'; btn.style.color = '#fff'; }
  });
})();
