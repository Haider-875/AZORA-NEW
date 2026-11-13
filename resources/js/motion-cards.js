/**
 * AZORA SOLUTIONS — Reusable Sitewide Motion Cards Engine
 * Vanilla JS (ES Modules) · IntersectionObserver · Performance Focused
 */

(function () {
  'use strict';

  var SCRAMBLE_GLYPHS = '0123456789XFABCD';

  /**
   * Scramble number text effect for ~0.6s
   */
  function scrambleNumberElement(el, targetText, delayMs) {
    if (!el || !targetText) return;
    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReduced) {
      el.textContent = targetText;
      return;
    }

    setTimeout(function () {
      var duration = 600; // 0.6s
      var startTime = performance.now();

      function frame(now) {
        var elapsed = now - startTime;
        var progress = Math.min(elapsed / duration, 1);

        if (progress < 0.5) {
          var c1 = SCRAMBLE_GLYPHS[Math.floor(Math.random() * SCRAMBLE_GLYPHS.length)];
          var c2 = SCRAMBLE_GLYPHS[Math.floor(Math.random() * SCRAMBLE_GLYPHS.length)];
          el.textContent = c1 + c2;
        } else if (progress < 0.85) {
          var c2 = SCRAMBLE_GLYPHS[Math.floor(Math.random() * SCRAMBLE_GLYPHS.length)];
          el.textContent = targetText.charAt(0) + c2;
        } else {
          el.textContent = targetText;
        }

        if (progress < 1) {
          requestAnimationFrame(frame);
        } else {
          el.textContent = targetText;
        }
      }

      requestAnimationFrame(frame);
    }, delayMs);
  }

  /**
   * Initialize Motion Cards on current DOM
   */
  function initMotionCards() {
    var cards = Array.prototype.slice.call(document.querySelectorAll('[data-motion-card]'));
    if (!cards.length) return;

    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var isMobile = window.innerWidth < 768;

    // Reduced motion or disabled: reveal all immediately
    if (prefersReduced) {
      cards.forEach(function (card) {
        card.classList.add('is-visible');
        var numEl = card.querySelector('[data-card-number]');
        if (numEl) {
          var raw = numEl.getAttribute('data-card-number') || numEl.textContent.trim();
          numEl.textContent = raw;
        }
      });
      return;
    }

    // Identify sibling index within parent container for staggered entrance
    var cardIndexMap = new WeakMap();
    cards.forEach(function (card) {
      if (card.getAttribute('data-motion') === 'off') {
        card.classList.add('is-visible');
        return;
      }

      var parent = card.parentElement;
      if (!parent) return;

      var siblings = Array.prototype.slice.call(parent.querySelectorAll(':scope > [data-motion-card], :scope > * > [data-motion-card]'));
      var idx = siblings.indexOf(card);
      cardIndexMap.set(card, idx >= 0 ? idx : 0);
    });

    // Reveal callback
    function revealCard(card) {
      if (card.classList.contains('is-visible')) return;

      var idx = cardIndexMap.get(card) || 0;
      var step = isMobile ? 80 : 150;
      var delay = idx * step;

      setTimeout(function () {
        card.classList.add('is-visible');

        // Scramble number if element present
        var numEl = card.querySelector('[data-card-number]');
        if (numEl) {
          var targetText = numEl.getAttribute('data-card-number') || numEl.textContent.trim();
          scrambleNumberElement(numEl, targetText, 100);
        }
      }, delay);
    }

    // IntersectionObserver with threshold 0.2
    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            revealCard(entry.target);
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.2,
        rootMargin: '0px 0px -40px 0px'
      });

      cards.forEach(function (card) {
        if (!card.classList.contains('is-visible')) {
          observer.observe(card);
        }
      });
    } else {
      // Fallback: reveal all cards
      cards.forEach(revealCard);
    }
  }

  /**
   * Delegated Mouse Tracking for 3D Tilt & Spotlight Effect across ALL cards
   * Uses single pointermove listener with requestAnimationFrame
   */
  var activeCard = null;
  var mouseX = 0;
  var mouseY = 0;
  var rafPending = false;
  var CARD_SELECTOR = '[data-motion-card], .glass-card-interactive, .motion-card, .service-premium-card';

  function updateCardPhysics() {
    if (activeCard) {
      var rect = activeCard.getBoundingClientRect();
      var x = mouseX - rect.left;
      var y = mouseY - rect.top;

      // Update both variable sets for cross-CSS compatibility
      activeCard.style.setProperty('--x', x + 'px');
      activeCard.style.setProperty('--y', y + 'px');
      activeCard.style.setProperty('--spot-x', x + 'px');
      activeCard.style.setProperty('--spot-y', y + 'px');

      // Subtle 3D Perspective Tilt (clamped to max ±3.5deg)
      var centerX = rect.width / 2;
      var centerY = rect.height / 2;
      var tiltX = ((y - centerY) / centerY) * -3.2;
      var tiltY = ((x - centerX) / centerX) * 3.5;
      activeCard.style.transform = 'perspective(1000px) rotateX(' + tiltX.toFixed(2) + 'deg) rotateY(' + tiltY.toFixed(2) + 'deg) translateY(-6px)';
    }
    rafPending = false;
  }

  function resetCardTilt(card) {
    if (card) {
      card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0)';
    }
  }

  function setupCardTiltDelegation() {
    var hasFinePointer = window.matchMedia && window.matchMedia('(pointer:fine)').matches;
    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!hasFinePointer || prefersReduced) return;

    document.addEventListener('pointermove', function (e) {
      var card = e.target && e.target.closest ? e.target.closest(CARD_SELECTOR) : null;
      if (!card || card.getAttribute('data-motion') === 'off') {
        if (activeCard) {
          resetCardTilt(activeCard);
          activeCard = null;
        }
        return;
      }

      if (activeCard && activeCard !== card) {
        resetCardTilt(activeCard);
      }

      activeCard = card;
      mouseX = e.clientX;
      mouseY = e.clientY;

      if (!rafPending) {
        rafPending = true;
        requestAnimationFrame(updateCardPhysics);
      }
    }, { passive: true });

    document.addEventListener('pointerleave', function () {
      if (activeCard) {
        resetCardTilt(activeCard);
        activeCard = null;
      }
    });
  }

  /**
   * Magnetic Button Interaction for sitewide CTA buttons
   */
  function setupMagneticButtons() {
    var hasFinePointer = window.matchMedia && window.matchMedia('(pointer:fine)').matches;
    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!hasFinePointer || prefersReduced) return;

    var BTN_SELECTOR = '[data-magnetic-btn], .btn-modern-primary, .btn-service-showcase';

    document.addEventListener('mousemove', function (e) {
      var btn = e.target && e.target.closest ? e.target.closest(BTN_SELECTOR) : null;
      if (!btn) return;

      var rect = btn.getBoundingClientRect();
      var x = e.clientX - rect.left - rect.width / 2;
      var y = e.clientY - rect.top - rect.height / 2;

      var pullX = x * 0.22;
      var pullY = y * 0.22;
      btn.style.transform = 'translate3d(' + pullX.toFixed(1) + 'px, ' + pullY.toFixed(1) + 'px, 0)';
    }, { passive: true });

    document.addEventListener('mouseout', function (e) {
      var btn = e.target && e.target.closest ? e.target.closest(BTN_SELECTOR) : null;
      if (btn && (!e.relatedTarget || !btn.contains(e.relatedTarget))) {
        btn.style.transform = 'translate3d(0, 0, 0)';
      }
    });
  }

  // Expose global initializer for SPA / AJAX / Dynamic Content
  window.initMotionCards = initMotionCards;

  // Listen for DOM ready and frameworks events (Turbo, Livewire)
  function boot() {
    initMotionCards();
    setupCardTiltDelegation();
    setupMagneticButtons();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }

  window.addEventListener('turbo:load', boot);
  window.addEventListener('livewire:navigated', boot);

  // Resize handler for responsive stagger
  window.addEventListener('resize', function () {
    // Only debounce if needed
  }, { passive: true });

})();

export default window.initMotionCards;

