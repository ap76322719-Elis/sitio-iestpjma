/* ==========================================================================
   ARQUITECTURA DE PLATAFORMAS Y SERVICIOS DE TI — IESTP JOSÉ MARÍA ARGUEDAS
   Script Principal Vanilla JS (100% Estable sin Admin)
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
  // Limpia cualquier clave de sincronización previa almacenada en el navegador
  localStorage.removeItem('apsti_content_directo');

  initMobileMenu();
  initHeroCarousel();
  initScrollSpy();
  initExperienciasCarousel();
  initNoticiasCarousel();
  initBolsaParallax();
});

/* --------------------------------------------------------------------------
   MENÚ MÓVIL
   -------------------------------------------------------------------------- */
function initMobileMenu() {
  const toggle = document.getElementById('navToggle');
  const nav = document.querySelector('.navbar__nav');
  if (!toggle || !nav) return;

  toggle.addEventListener('click', () => {
    const isOpen = nav.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', String(isOpen));
  });

  nav.querySelectorAll('.nav-link').forEach((link) => {
    link.addEventListener('click', () => {
      nav.classList.remove('is-open');
      toggle.setAttribute('aria-expanded', 'false');
    });
  });
}

/* --------------------------------------------------------------------------
   HERO CARRUSEL
   -------------------------------------------------------------------------- */
function initHeroCarousel() {
  const track = document.getElementById('heroSlides');
  const dotsWrap = document.getElementById('heroDots');
  const prevBtn = document.getElementById('heroPrev');
  const nextBtn = document.getElementById('heroNext');
  if (!track || !dotsWrap) return;

  const slides = Array.from(track.querySelectorAll('.hero__slide'));
  if (slides.length === 0) return;

  let current = slides.findIndex((s) => s.classList.contains('is-active'));
  if (current === -1) current = 0;

  const AUTOPLAY_DELAY = 6000;
  let autoplayTimer = null;

  dotsWrap.innerHTML = '';

  slides.forEach((_, index) => {
    const dot = document.createElement('button');
    dot.classList.add('hero__dot');
    dot.setAttribute('role', 'tab');
    dot.setAttribute('aria-label', `Ir a la diapositiva ${index + 1}`);
    if (index === current) dot.classList.add('is-active');
    dot.addEventListener('click', () => goToSlide(index));
    dotsWrap.appendChild(dot);
  });

  const dots = Array.from(dotsWrap.querySelectorAll('.hero__dot'));

  function render() {
    slides.forEach((slide, index) => {
      slide.classList.toggle('is-active', index === current);
    });
    dots.forEach((dot, index) => {
      dot.classList.toggle('is-active', index === current);
    });
  }

  function goToSlide(index) {
    current = (index + slides.length) % slides.length;
    render();
    restartAutoplay();
  }

  function restartAutoplay() {
    if (autoplayTimer) clearInterval(autoplayTimer);
    autoplayTimer = setInterval(() => goToSlide(current + 1), AUTOPLAY_DELAY);
  }

  if (prevBtn) prevBtn.addEventListener('click', () => goToSlide(current - 1));
  if (nextBtn) nextBtn.addEventListener('click', () => goToSlide(current + 1));

  const heroSection = track.closest('.hero');
  if (heroSection) {
    heroSection.addEventListener('mouseenter', () => {
      if (autoplayTimer) clearInterval(autoplayTimer);
    });
    heroSection.addEventListener('mouseleave', restartAutoplay);
  }

  render();
  restartAutoplay();
}

/* --------------------------------------------------------------------------
   CAMBIO DE SEMESTRES (PLAN DE ESTUDIOS)
   -------------------------------------------------------------------------- */
function switchPropuestaTab(panelId, themeClass, targetButton) {
  const contents = document.querySelectorAll('.propuesta-content');
  const tabs = document.querySelectorAll('.propuesta-tab');
  const wrapper = document.getElementById('propuestaWrapper');

  contents.forEach((p) => p.classList.remove('is-active'));
  tabs.forEach((b) => b.classList.remove('is-active'));

  const activeContent = document.getElementById('content-' + panelId);
  if (activeContent) activeContent.classList.add('is-active');

  if (targetButton) {
    targetButton.classList.add('is-active');
  }

  if (wrapper) {
    wrapper.className = 'propuesta-wrapper ' + themeClass;
  }
}

/* --------------------------------------------------------------------------
   SCROLLSPY
   -------------------------------------------------------------------------- */
function initScrollSpy() {
  const sections = Array.from(document.querySelectorAll('main section[id]'));
  const navLinks = Array.from(document.querySelectorAll('.nav-link'));
  if (sections.length === 0 || navLinks.length === 0) return;

  const linkById = {};
  navLinks.forEach((link) => {
    const href = link.getAttribute('href');
    if (href && href.includes('#')) {
      const id = href.split('#')[1];
      linkById[id] = link;
    }
  });

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const id = entry.target.getAttribute('id');
        navLinks.forEach((link) => link.classList.remove('is-active'));
        if (linkById[id]) linkById[id].classList.add('is-active');
      });
    },
    { rootMargin: '-45% 0px -50% 0px', threshold: 0 }
  );

  sections.forEach((section) => observer.observe(section));
}

/* --------------------------------------------------------------------------
   CARRUSEL DE EXPERIENCIAS
   -------------------------------------------------------------------------- */
function initExperienciasCarousel() {
  const slides = Array.from(document.querySelectorAll('.exp-slide'));
  const prevBtn = document.getElementById('expPrev');
  const nextBtn = document.getElementById('expNext');

  if (slides.length === 0 || !prevBtn || !nextBtn) return;

  let currentIndex = 0;

  function showSlide(index) {
    currentIndex = (index + slides.length) % slides.length;

    slides.forEach((slide, idx) => {
      slide.classList.remove('is-active');
      if (idx === currentIndex) {
        void slide.offsetWidth; 
        slide.classList.add('is-active');
      }
    });
  }

  prevBtn.addEventListener('click', () => showSlide(currentIndex - 1));
  nextBtn.addEventListener('click', () => showSlide(currentIndex + 1));
}

/* --------------------------------------------------------------------------
   NOTICIAS Y EVENTOS
   -------------------------------------------------------------------------- */
function initNoticiasCarousel() {
  const tabNoticias = document.getElementById('tabNoticias');
  const tabEventos = document.getElementById('tabEventos');
  const panelNoticias = document.getElementById('panelNoticias');
  const panelEventos = document.getElementById('panelEventos');

  if (!tabNoticias || !tabEventos || !panelNoticias || !panelEventos) return;

  let isAnimating = false;

  function switchTab(activeTab, inactiveTab, showPanel, hidePanel) {
    if (isAnimating || showPanel.classList.contains('is-active')) return;
    isAnimating = true;

    activeTab.classList.add('is-active');
    inactiveTab.classList.remove('is-active');

    hidePanel.classList.remove('is-active');
    hidePanel.classList.add('is-leaving');

    setTimeout(() => {
      hidePanel.classList.remove('is-leaving');
      void showPanel.offsetWidth; 
      showPanel.classList.add('is-active');
      isAnimating = false;
    }, 180);
  }

  tabNoticias.addEventListener('click', () => {
    switchTab(tabNoticias, tabEventos, panelNoticias, panelEventos);
  });

  tabEventos.addEventListener('click', () => {
    switchTab(tabEventos, tabNoticias, panelEventos, panelNoticias);
  });
}

/* --------------------------------------------------------------------------
   PARALLAX BOLSA DE TRABAJO
   -------------------------------------------------------------------------- */
function initBolsaParallax() {
  const bg = document.getElementById('parallaxBg');
  if (!bg) return;

  window.addEventListener('scroll', () => {
    const scrollY = window.scrollY;
    bg.style.transform = `scale(1.15) translateY(${scrollY * 0.25}px)`;
  }, { passive: true });
}