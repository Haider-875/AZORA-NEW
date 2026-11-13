/**
 * AZORA SOLUTIONS — Premium Interactive Service Showcase & Carousel Engine
 * Vanilla JS + GSAP 3.x Integration · 60 FPS Spring Physics
 * Touch/Drag Gesture Support · 3D Perspective Tilt · Magnetic Buttons
 */
(function () {
  'use strict';

  function initServiceShowcase() {
    var section = document.getElementById('services');
    if (!section) return;

    var track = section.querySelector('#serviceCarouselTrack');
    var viewport = section.querySelector('#serviceCarouselViewport');
    var slides = Array.prototype.slice.call(section.querySelectorAll('.service-carousel-slide'));
    var prevBtn = section.querySelector('#servicePrevBtn');
    var nextBtn = section.querySelector('#serviceNextBtn');
    var counterEl = section.querySelector('#serviceSlideCounter');
    var dots = Array.prototype.slice.call(section.querySelectorAll('.service-page-dot'));
    var cards = Array.prototype.slice.call(section.querySelectorAll('.service-premium-card'));
    var magneticBtns = Array.prototype.slice.call(section.querySelectorAll('[data-magnetic-btn]'));

    if (!track || !slides.length) return;

    var totalSlides = slides.length;
    var currentIndex = 0;
    var maxIndex = 0;
    var isDragging = false;
    var startX = 0;
    var currentTranslate = 0;
    var prevTranslate = 0;
    var animationID = null;
    var autoPlayTimer = null;
    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ------------------------------------------------------------
       1. RESPONSIVE METRICS & MAX INDEX CALCULATION
       ------------------------------------------------------------ */
    function calculateMaxIndex() {
      var w = window.innerWidth;
      if (w >= 1200) {
        maxIndex = Math.max(0, totalSlides - 3); // 3 slides visible on wide desktop
      } else if (w >= 768) {
        maxIndex = Math.max(0, totalSlides - 2); // 2 slides visible on tablet
      } else {
        maxIndex = Math.max(0, totalSlides - 1); // 1 slide visible on mobile
      }
    }

    function getSlideStep() {
      if (!slides[0]) return 0;
      var slideRect = slides[0].getBoundingClientRect();
      var gap = 28; // Matches gap in CSS
      return slideRect.width + gap;
    }

    /* ------------------------------------------------------------
       2. SLIDE TRANSITIONS & UI STATE SYNC
       ------------------------------------------------------------ */
    function updateControlsUI() {
      calculateMaxIndex();

      if (currentIndex > maxIndex) currentIndex = maxIndex;
      if (currentIndex < 0) currentIndex = 0;

      // Update button states
      if (prevBtn) {
        prevBtn.disabled = (currentIndex === 0);
        prevBtn.setAttribute('aria-disabled', String(currentIndex === 0));
      }
      if (nextBtn) {
        nextBtn.disabled = (currentIndex >= maxIndex);
        nextBtn.setAttribute('aria-disabled', String(currentIndex >= maxIndex));
      }

      // Update counter (e.g. 01 / 03)
      if (counterEl) {
        var activeNum = String(currentIndex + 1).padStart(2, '0');
        var totalNum = String(totalSlides).padStart(2, '0');
        counterEl.innerHTML = '<span class="current-num">' + activeNum + '</span> / ' + totalNum;
      }

      // Update pagination dots
      dots.forEach(function (dot, idx) {
        if (idx === currentIndex) {
          dot.classList.add('is-active');
          dot.setAttribute('aria-current', 'true');
        } else {
          dot.classList.remove('is-active');
          dot.removeAttribute('aria-current');
        }
      });
    }

    function goToSlide(index, smooth) {
      calculateMaxIndex();
      currentIndex = Math.max(0, Math.min(index, maxIndex));

      var step = getSlideStep();
      var targetX = -(currentIndex * step);
      currentTranslate = targetX;
      prevTranslate = targetX;

      if (smooth && !prefersReduced && typeof window.gsap !== 'undefined') {
        window.gsap.to(track, {
          x: targetX,
          duration: 0.65,
          ease: 'power3.out',
          overwrite: 'auto'
        });
      } else {
        track.style.transform = 'translate3d(' + targetX + 'px, 0, 0)';
      }

      updateControlsUI();
    }

    function nextSlide() {
      calculateMaxIndex();
      if (currentIndex < maxIndex) {
        goToSlide(currentIndex + 1, true);
      } else {
        goToSlide(0, true); // Loop back smoothly
      }
    }

    function prevSlide() {
      calculateMaxIndex();
      if (currentIndex > 0) {
        goToSlide(currentIndex - 1, true);
      } else {
        goToSlide(maxIndex, true);
      }
    }

    if (prevBtn) {
      prevBtn.addEventListener('click', function () {
        pauseAutoPlay();
        prevSlide();
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', function () {
        pauseAutoPlay();
        nextSlide();
      });
    }

    dots.forEach(function (dot) {
      dot.addEventListener('click', function () {
        pauseAutoPlay();
        var targetIdx = parseInt(dot.getAttribute('data-slide-to') || '0', 10);
        goToSlide(targetIdx, true);
      });
    });

    /* ------------------------------------------------------------
       3. TOUCH / DRAG GESTURE TRACKING
       ------------------------------------------------------------ */
    if (viewport) {
      function getPositionX(event) {
        return event.type.includes('mouse') ? event.pageX : event.touches[0].clientX;
      }

      function touchStart(event) {
        if (event.target && (event.target.closest('button') || event.target.closest('a'))) {
          // Allow clicks on links and buttons
          return;
        }
        pauseAutoPlay();
        isDragging = true;
        startX = getPositionX(event);
        viewport.classList.add('is-dragging');

        if (animationID) cancelAnimationFrame(animationID);
      }

      function touchMove(event) {
        if (!isDragging) return;
        var currentX = getPositionX(event);
        var diff = currentX - startX;
        currentTranslate = prevTranslate + diff;

        track.style.transform = 'translate3d(' + currentTranslate + 'px, 0, 0)';
      }

      function touchEnd() {
        if (!isDragging) return;
        isDragging = false;
        viewport.classList.remove('is-dragging');

        var movedBy = currentTranslate - prevTranslate;
        var step = getSlideStep();
        var threshold = step * 0.2; // 20% drag threshold to switch slides

        if (movedBy < -threshold) {
          nextSlide();
        } else if (movedBy > threshold) {
          prevSlide();
        } else {
          goToSlide(currentIndex, true);
        }
      }

      viewport.addEventListener('mousedown', touchStart);
      window.addEventListener('mousemove', touchMove);
      window.addEventListener('mouseup', touchEnd);

      viewport.addEventListener('touchstart', touchStart, { passive: true });
      viewport.addEventListener('touchmove', touchMove, { passive: true });
      viewport.addEventListener('touchend', touchEnd);
    }

    /* ------------------------------------------------------------
       4. KEYBOARD NAVIGATION
       ------------------------------------------------------------ */
    section.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowRight') {
        pauseAutoPlay();
        nextSlide();
      } else if (e.key === 'ArrowLeft') {
        pauseAutoPlay();
        prevSlide();
      }
    });

    /* ------------------------------------------------------------
       5. 3D PERSPECTIVE TILT & RADIAL SPOTLIGHT (Desktop only)
       ------------------------------------------------------------ */
    var hasFinePointer = window.matchMedia && window.matchMedia('(pointer:fine)').matches;
    if (hasFinePointer && !prefersReduced) {
      cards.forEach(function (card) {
        card.addEventListener('pointermove', function (e) {
          var rect = card.getBoundingClientRect();
          var x = e.clientX - rect.left;
          var y = e.clientY - rect.top;

          // Inject coordinates for CSS radial spotlight
          card.style.setProperty('--spot-x', x + 'px');
          card.style.setProperty('--spot-y', y + 'px');

          // Subtle 3D Perspective Tilt (Max 4deg)
          var centerX = rect.width / 2;
          var centerY = rect.height / 2;
          var tiltX = ((y - centerY) / centerY) * -3.5;
          var tiltY = ((x - centerX) / centerX) * 4;

          card.style.transform = 'perspective(1000px) rotateX(' + tiltX.toFixed(2) + 'deg) rotateY(' + tiltY.toFixed(2) + 'deg) translateY(-8px)';
        });

        card.addEventListener('pointerleave', function () {
          card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0)';
        });
      });
    }

    /* ------------------------------------------------------------
       6. MAGNETIC BUTTON INTERACTION (Apple / Linear style)
       ------------------------------------------------------------ */
    if (hasFinePointer && !prefersReduced) {
      magneticBtns.forEach(function (btn) {
        btn.addEventListener('mousemove', function (e) {
          var rect = btn.getBoundingClientRect();
          var x = e.clientX - rect.left - rect.width / 2;
          var y = e.clientY - rect.top - rect.height / 2;

          // Magnetic strength: 22% pull
          var pullX = x * 0.22;
          var pullY = y * 0.22;

          btn.style.transform = 'translate3d(' + pullX.toFixed(1) + 'px, ' + pullY.toFixed(1) + 'px, 0)';
        });

        btn.addEventListener('mouseleave', function () {
          btn.style.transform = 'translate3d(0, 0, 0)';
        });
      });
    }

    /* ------------------------------------------------------------
       7. SUBTLE AUTOPLAY WITH PAUSE ON HOVER
       ------------------------------------------------------------ */
    function startAutoPlay() {
      if (prefersReduced) return;
      stopAutoPlay();
      autoPlayTimer = setInterval(function () {
        calculateMaxIndex();
        if (maxIndex > 0) {
          nextSlide();
        }
      }, 5500);
    }

    function stopAutoPlay() {
      if (autoPlayTimer) {
        clearInterval(autoPlayTimer);
        autoPlayTimer = null;
      }
    }

    function pauseAutoPlay() {
      stopAutoPlay();
      setTimeout(startAutoPlay, 8000); // Resume after 8s idle
    }

    if (viewport) {
      viewport.addEventListener('mouseenter', stopAutoPlay);
      viewport.addEventListener('mouseleave', startAutoPlay);
    }

    /* ------------------------------------------------------------
       8. GSAP SCROLLTRIGGER ENTRANCE ANIMATION
       ------------------------------------------------------------ */
    if (!prefersReduced && typeof window.gsap !== 'undefined' && typeof window.ScrollTrigger !== 'undefined') {
      var headerEl = section.querySelector('.service-header-wrap');
      if (headerEl) {
        window.gsap.fromTo(headerEl,
          { opacity: 0, y: 30 },
          {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: 'power3.out',
            scrollTrigger: {
              trigger: section,
              start: 'top 82%',
              once: true
            }
          }
        );
      }

      window.gsap.fromTo(slides,
        { opacity: 0, y: 45, scale: 0.95 },
        {
          opacity: 1,
          y: 0,
          scale: 1,
          duration: 0.85,
          stagger: 0.12,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: section,
            start: 'top 78%',
            once: true
          }
        }
      );
    }

    /* ------------------------------------------------------------
       9. WINDOW RESIZE RE-CALCULATION
       ------------------------------------------------------------ */
    var resizeTimer = null;
    window.addEventListener('resize', function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function () {
        calculateMaxIndex();
        goToSlide(currentIndex, false);
      }, 100);
    }, { passive: true });

    // Initialize initial slide position and controls
    calculateMaxIndex();
    goToSlide(0, false);
    startAutoPlay();
  }

  // Auto-init on DOM Ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initServiceShowcase);
  } else {
    initServiceShowcase();
  }

  window.initServiceShowcase = initServiceShowcase;
})();

