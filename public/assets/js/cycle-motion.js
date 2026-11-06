/**
 * AZORA SOLUTIONS — 4-Stage Engineering Cycle Motion Engine
 * Tech/Engineering Subtle Precision Animation
 * Features:
 *  - IntersectionObserver (threshold 0.25, single-run trigger)
 *  - Digital Scramble / Typewriter sequence for numbers (01, 02, 03, 04)
 *  - Mouse spotlight coordinate tracking (--x, --y)
 *  - 8-second looping traveling pulse connector
 *  - Strict prefers-reduced-motion adherence
 */
(function () {
  'use strict';

  function initCycleMotion() {
    var section = document.getElementById('engineering-cycle-section');
    if (!section) return;

    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var cards = Array.prototype.slice.call(section.querySelectorAll('.cycle-card'));
    var numberEls = Array.prototype.slice.call(section.querySelectorAll('.cycle-card-number'));
    var pulseEl = section.querySelector('#cycle-travel-pulse');
    var isMobile = window.innerWidth < 768;

    // Default target numbers
    var finalNumbers = ['01', '02', '03', '04'];

    /* ----------------------------------------------------
       1. DIGITAL SCRAMBLE / TYPEWRITER EFFECT (~0.6s)
       ---------------------------------------------------- */
    var SCRAMBLE_CHARS = '0123456789XFABCD';

    function scrambleNumber(el, targetText, delayMs) {
      if (prefersReduced) {
        el.textContent = targetText;
        return;
      }

      setTimeout(function () {
        var duration = 600; // 0.6s
        var startTime = performance.now();
        var timer = null;

        function updateScramble(now) {
          var elapsed = now - startTime;
          var progress = Math.min(elapsed / duration, 1);

          if (progress < 0.5) {
            // Both characters cycling
            var c1 = SCRAMBLE_CHARS[Math.floor(Math.random() * SCRAMBLE_CHARS.length)];
            var c2 = SCRAMBLE_CHARS[Math.floor(Math.random() * SCRAMBLE_CHARS.length)];
            el.textContent = c1 + c2;
          } else if (progress < 0.9) {
            // First character settled, second cycling
            var c2 = SCRAMBLE_CHARS[Math.floor(Math.random() * SCRAMBLE_CHARS.length)];
            el.textContent = targetText.charAt(0) + c2;
          } else {
            // Both settled
            el.textContent = targetText;
          }

          if (progress < 1) {
            timer = requestAnimationFrame(updateScramble);
          } else {
            el.textContent = targetText;
          }
        }

        timer = requestAnimationFrame(updateScramble);
      }, delayMs);
    }

    /* ----------------------------------------------------
       2. TRAVELING CYCLE PULSE LOOP (01 -> 02 -> 04 -> 03 -> 01)
       8-Second Continuous Loop at Low Opacity
       ---------------------------------------------------- */
    var loopAnimFrame = null;
    var loopStartTime = 0;
    var loopDuration = 8000; // 8s
    var cardCenters = [];

    function updateCardCenters() {
      if (!section || isMobile || cards.length < 4) return;
      var secRect = section.getBoundingClientRect();
      
      // Sequence: Card 01 (top-left) -> Card 02 (top-right) -> Card 04 (bottom-right) -> Card 03 (bottom-left)
      var cycleOrder = [0, 1, 3, 2];
      cardCenters = cycleOrder.map(function (idx) {
        var card = cards[idx];
        if (!card) return { x: 0, y: 0 };
        var r = card.getBoundingClientRect();
        return {
          x: (r.left + r.width / 2) - secRect.left,
          y: (r.top + r.height / 2) - secRect.top
        };
      });
    }

    function animateTravelPulse(now) {
      if (!loopStartTime) loopStartTime = now;
      var elapsed = (now - loopStartTime) % loopDuration;
      var totalProgress = elapsed / loopDuration; // 0 to 1

      // 4 segments of travel
      var numSegments = 4;
      var segmentProgress = (totalProgress * numSegments) % 1;
      var currentSegment = Math.floor(totalProgress * numSegments);

      if (cardCenters.length === 4 && pulseEl) {
        var pStart = cardCenters[currentSegment];
        var pEnd = cardCenters[(currentSegment + 1) % 4];

        // Smooth cubic ease between card centers
        var t = segmentProgress;
        var ease = t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;

        var posX = pStart.x + (pEnd.x - pStart.x) * ease;
        var posY = pStart.y + (pEnd.y - pStart.y) * ease;

        pulseEl.style.left = posX + 'px';
        pulseEl.style.top = posY + 'px';
      }

      loopAnimFrame = requestAnimationFrame(animateTravelPulse);
    }

    function startCyclePulseLoop() {
      if (prefersReduced || isMobile || !pulseEl) return;
      updateCardCenters();
      loopAnimFrame = requestAnimationFrame(animateTravelPulse);
    }

    window.addEventListener('resize', function () {
      isMobile = window.innerWidth < 768;
      updateCardCenters();
    }, { passive: true });

    /* ----------------------------------------------------
       3. DESKTOP MOUSE SPOTLIGHT TRACKING (--x, --y)
       ---------------------------------------------------- */
    if (!isMobile && !prefersReduced) {
      cards.forEach(function (card) {
        card.addEventListener('pointermove', function (e) {
          var rect = card.getBoundingClientRect();
          var x = e.clientX - rect.left;
          var y = e.clientY - rect.top;
          card.style.setProperty('--x', x + 'px');
          card.style.setProperty('--y', y + 'px');
        }, { passive: true });
      });
    }

    /* ----------------------------------------------------
       4. INTERSECTION OBSERVER TRIGGER (threshold 0.25)
       ---------------------------------------------------- */
    function onTrigger() {
      section.classList.add('is-triggered');

      // Staggered scramble start for each number
      var baseStagger = isMobile ? 80 : 150;
      numberEls.forEach(function (numEl, index) {
        var targetNum = numEl.dataset.number || finalNumbers[index] || '0' + (index + 1);
        var delay = (index * baseStagger) + 300; // Starts right after card appears
        scrambleNumber(numEl, targetNum, delay);
      });

      // Start the traveling connector loop
      setTimeout(function () {
        startCyclePulseLoop();
      }, 1000);
    }

    if (prefersReduced) {
      onTrigger();
      return;
    }

    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            onTrigger();
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.25,
        rootMargin: '0px 0px -50px 0px'
      });

      observer.observe(section);
    } else {
      // Fallback for older browsers
      onTrigger();
    }
  }

  // Initialize once DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCycleMotion);
  } else {
    initCycleMotion();
  }
})();
