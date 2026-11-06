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
   * Delegated Mouse Tracking for Spotlight Effect
   * Uses single pointermove listener with requestAnimationFrame
   */
  var activeCard = null;
  var mouseX = 0;
  var mouseY = 0;
  var rafPending = false;

  function updateSpotlight() {
    if (activeCard) {
      var rect = activeCard.getBoundingClientRect();
      var x = mouseX - rect.left;
      var y = mouseY - rect.top;
      activeCard.style.setProperty('--x', x + 'px');
      activeCard.style.setProperty('--y', y + 'px');
    }
    rafPending = false;
  }

  function setupSpotlightDelegation() {
    var hasTouchOnly = ('ontouchstart' in window) && !window.matchMedia('(pointer:fine)').matches;
    if (hasTouchOnly) return; // Do not run on touch devices

    document.addEventListener('pointermove', function (e) {
      var card = e.target && e.target.closest ? e.target.closest('[data-motion-card]') : null;
      if (!card || card.getAttribute('data-motion') === 'off') {
        activeCard = null;
        return;
      }

      activeCard = card;
      mouseX = e.clientX;
      mouseY = e.clientY;

      if (!rafPending) {
        rafPending = true;
        requestAnimationFrame(updateSpotlight);
      }
    }, { passive: true });
  }

  // Expose global initializer for SPA / AJAX / Dynamic Content
  window.initMotionCards = initMotionCards;

  // Listen for DOM ready and frameworks events (Turbo, Livewire)
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      initMotionCards();
      setupSpotlightDelegation();
    });
  } else {
    initMotionCards();
    setupSpotlightDelegation();
  }

  window.addEventListener('turbo:load', initMotionCards);
  window.addEventListener('livewire:navigated', initMotionCards);

  // Resize handler for responsive stagger
  window.addEventListener('resize', function () {
    // Only debounce if needed
  }, { passive: true });

})();

export default window.initMotionCards;

