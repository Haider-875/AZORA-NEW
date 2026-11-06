/**
 * AZORA SOLUTIONS — PAYMATE-STYLE CARD MACHINE CAROUSEL ENGINE
 * Circular Math · Pointer Dragging · Fluid Easing · Touch & Keyboard
 */

(function () {
  'use strict';

  function initPaymateCarousel() {
    var carEl = document.querySelector('.pm-car');
    if (!carEl) return;

    var strip = carEl.querySelector('.pm-car-strip');
    var cards = Array.from(carEl.querySelectorAll('.pm-car-card'));
    var lblEl = carEl.querySelector('.pm-car-lbl');
    var segs = Array.from(carEl.querySelectorAll('.pm-car-segs i'));
    var btnPrev = carEl.querySelector('.pm-car-ar.is-prev');
    var btnNext = carEl.querySelector('.pm-car-ar.is-next');
    var curBadge = carEl.querySelector('.pm-car-cur');

    if (!strip || cards.length === 0) return;

    var total = cards.length;
    var activeIndex = 1; // Start on index 1 (e.g. Clover Flex)
    var isDragging = false;
    var hasMoved = false;
    var startX = 0;
    var currentDx = 0;
    var pointerId = null;

    // Detect fine pointer for custom cursor badge
    if (window.matchMedia && window.matchMedia('(pointer: fine)').matches) {
      strip.classList.add('is-fine');
    }

    /**
     * Update all cards' --o CSS variables according to circular array math
     */
    function updateCarousel() {
      cards.forEach(function (card, idx) {
        var a = idx - activeIndex;
        // Circular wrapping: keeps offset between -total/2 and +total/2
        if (a > total / 2) a -= total;
        if (a < -total / 2) a += total;

        var isCur = (a === 0);
        var isFar = (Math.abs(a) > 3);

        card.style.setProperty('--o', a);
        card.classList.toggle('is-cur', isCur);
        card.classList.toggle('is-far', isFar);
        card.setAttribute('aria-hidden', !isCur);

        var chip = card.querySelector('.pm-car-chip');
        if (chip) chip.setAttribute('tabindex', isCur ? '0' : '-1');
      });

      // Update footer label
      var curCard = cards[activeIndex];
      if (curCard && lblEl) {
        var name = curCard.getAttribute('data-name') || '';
        var numStr = String(activeIndex + 1).padStart(2, '0');
        var totStr = String(total).padStart(2, '0');
        lblEl.textContent = numStr + ' / ' + totStr + ' · ' + name;
      }

      // Update segment indicators
      segs.forEach(function (seg, idx) {
        seg.classList.toggle('is-on', idx === activeIndex);
      });
    }

    /**
     * Navigate to a target index (circular wrap)
     */
    function goToIndex(targetIdx) {
      activeIndex = (targetIdx % total + total) % total;
      updateCarousel();
    }

    // Initialize layout
    updateCarousel();

    // -------------------------------------------------------------
    // POINTER DRAG & SWIPE PHYSICS
    // -------------------------------------------------------------
    strip.addEventListener('pointerdown', function (e) {
      if (e.button !== 0) return; // Primary mouse button only
      isDragging = true;
      hasMoved = false;
      startX = e.clientX;
      currentDx = 0;
      pointerId = e.pointerId;
    });

    window.addEventListener('pointermove', function (e) {
      // Floating cursor tracking
      if (curBadge && strip.classList.contains('is-fine')) {
        var rect = strip.getBoundingClientRect();
        var mx = e.clientX - rect.left;
        var my = e.clientY - rect.top;
        if (mx >= 0 && mx <= rect.width && my >= 0 && my <= rect.height) {
          curBadge.style.transform = 'translate3d(' + mx + 'px, ' + my + 'px, 0)';
        }
      }

      if (!isDragging) return;

      var dx = e.clientX - startX;
      if (!hasMoved && Math.abs(dx) > 6) {
        hasMoved = true;
        strip.classList.add('is-drag');
        try {
          if (pointerId !== null) strip.setPointerCapture(pointerId);
        } catch (err) {}
      }

      if (hasMoved) {
        currentDx = dx;
        strip.style.setProperty('--dx', dx + 'px');
      }
    });

    function handlePointerEnd() {
      if (!isDragging) return;
      isDragging = false;
      strip.classList.remove('is-drag');
      strip.style.setProperty('--dx', '0px');

      if (hasMoved) {
        if (currentDx < -55) {
          goToIndex(activeIndex + 1);
        } else if (currentDx > 55) {
          goToIndex(activeIndex - 1);
        }
      }

      hasMoved = false;
      currentDx = 0;
      pointerId = null;
    }

    strip.addEventListener('pointerup', handlePointerEnd);
    strip.addEventListener('pointercancel', handlePointerEnd);

    // Prevent navigation / clicking if dragged
    strip.addEventListener('click', function (e) {
      if (hasMoved) {
        e.preventDefault();
        e.stopPropagation();
      }
    }, true);

    // Card click: clicking inactive card focuses it immediately
    cards.forEach(function (card, idx) {
      card.addEventListener('click', function (e) {
        if (hasMoved) return;
        if (idx !== activeIndex) {
          e.preventDefault();
          goToIndex(idx);
        }
      });
    });

    // Arrow controls
    if (btnPrev) {
      btnPrev.addEventListener('click', function (e) {
        e.preventDefault();
        goToIndex(activeIndex - 1);
      });
    }

    if (btnNext) {
      btnNext.addEventListener('click', function (e) {
        e.preventDefault();
        goToIndex(activeIndex + 1);
      });
    }

    // Segment progress clicks
    segs.forEach(function (seg, idx) {
      seg.addEventListener('click', function () {
        goToIndex(idx);
      });
    });

    // Keyboard accessibility
    strip.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowRight') {
        e.preventDefault();
        goToIndex(activeIndex + 1);
      } else if (e.key === 'ArrowLeft') {
        e.preventDefault();
        goToIndex(activeIndex - 1);
      }
    });

    // Expose global controller
    window.AZ_TERMINAL_CAROUSEL = {
      goTo: goToIndex,
      next: function () { goToIndex(activeIndex + 1); },
      prev: function () { goToIndex(activeIndex - 1); }
    };
  }

  // Auto-init on DOMContentLoaded and SPA navigation
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPaymateCarousel);
  } else {
    initPaymateCarousel();
  }

  document.addEventListener('turbo:load', initPaymateCarousel);
  document.addEventListener('livewire:navigated', initPaymateCarousel);
})();
