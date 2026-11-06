/**
 * AZORA SOLUTION — HERO MOTION DASHBOARD CLUSTER
 * Plain vanilla JS, no heavy libraries, 60fps performance
 */

(function () {
  'use strict';

  var isReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var isTouch = window.matchMedia('(hover: none) or (pointer: coarse)').matches;

  // DOM Elements
  var cluster = document.getElementById('heroMotionCluster');
  var wrapper = document.getElementById('heroMotionWrapper');
  var toastBadge = document.getElementById('heroToastBadge');
  var timerEl = document.getElementById('heroCallTimer');
  var transcriptBox = document.getElementById('heroCallTranscript');
  var leadsNumEl = document.getElementById('heroLeadsNumber');
  var rankNumEl = document.getElementById('heroRankNumber');
  var sparklinePath = document.getElementById('heroSparklinePath');

  if (!cluster || !transcriptBox) return;

  // ============================================================
  // 1. CARD A: LIVE CALL TRANSCRIPT & TIMER
  // ============================================================
  var conversation = [
    { speaker: 'Caller', text: '"Hi, my water heater just broke. Can someone come today?"' },
    { speaker: 'Azora AI', text: '"Sorry to hear that! I can book a technician for 3:30 PM. Is that okay?"' },
    { speaker: 'Caller', text: '"Yes, please."' },
    { speaker: 'Azora AI', text: '"Done. You\'ll get a text confirmation, and the team has been notified."' }
  ];

  var timerSeconds = 14;
  var timerInterval = null;
  var isTypingActive = false;
  var isPaused = false;
  var currentTimeoutId = null;

  function formatTime(sec) {
    var m = Math.floor(sec / 60);
    var s = sec % 60;
    return (m < 10 ? '0' : '') + m + ':' + (s < 10 ? '0' : '') + s;
  }

  function startTimer() {
    if (timerInterval || isReducedMotion) return;
    timerInterval = setInterval(function () {
      if (isPaused) return;
      timerSeconds++;
      if (timerEl) {
        timerEl.textContent = formatTime(timerSeconds);
      }
    }, 1000);
  }

  function renderStaticTranscript() {
    if (!transcriptBox) return;
    transcriptBox.innerHTML = '';
    conversation.forEach(function (line) {
      var p = document.createElement('div');
      p.className = 'transcript-line';
      p.innerHTML = '<span class="transcript-speaker">' + line.speaker + ':</span> ' + line.text;
      transcriptBox.appendChild(p);
    });
  }

  function playConversationLoop() {
    if (isReducedMotion) {
      renderStaticTranscript();
      return;
    }

    var lineIndex = 0;
    var charIndex = 0;
    var currentLineEl = null;
    var cursorSpan = document.createElement('span');
    cursorSpan.className = 'typing-cursor';

    function clearTranscript() {
      transcriptBox.innerHTML = '';
      lineIndex = 0;
      charIndex = 0;
      currentLineEl = null;
    }

    function typeNextChar() {
      if (isPaused) {
        currentTimeoutId = setTimeout(typeNextChar, 100);
        return;
      }

      var currentItem = conversation[lineIndex];

      // New line start
      if (charIndex === 0) {
        currentLineEl = document.createElement('div');
        currentLineEl.className = 'transcript-line';
        currentLineEl.innerHTML = '<span class="transcript-speaker">' + currentItem.speaker + ':</span> ';
        currentLineEl.appendChild(cursorSpan);
        transcriptBox.appendChild(currentLineEl);
      }

      // Append next character
      if (charIndex < currentItem.text.length) {
        var char = currentItem.text.charAt(charIndex);
        var textNode = document.createTextNode(char);
        currentLineEl.insertBefore(textNode, cursorSpan);
        charIndex++;
        currentTimeoutId = setTimeout(typeNextChar, 24);
      } else {
        // Line finished
        lineIndex++;
        charIndex = 0;

        if (lineIndex < conversation.length) {
          // Pause between lines (650ms)
          currentTimeoutId = setTimeout(typeNextChar, 650);
        } else {
          // All 4 lines completed: hold 3.5s, update toast, then loop
          currentTimeoutId = setTimeout(function () {
            if (cursorSpan.parentNode) {
              cursorSpan.parentNode.removeChild(cursorSpan);
            }
            // Update toast badge to random "New lead +N" (1-3)
            if (toastBadge) {
              var randomN = Math.floor(Math.random() * 3) + 1;
              toastBadge.textContent = 'New lead +' + randomN;
            }
            // Clear and restart
            clearTranscript();
            currentTimeoutId = setTimeout(typeNextChar, 400);
          }, 3500);
        }
      }
    }

    clearTranscript();
    currentTimeoutId = setTimeout(typeNextChar, 600);
  }

  // ============================================================
  // 2. CARD B: ORGANIC LEADS (0 to 486 count-up + sparkline)
  // ============================================================
  function animateLeadsCounter() {
    if (!leadsNumEl) return;
    if (isReducedMotion) {
      leadsNumEl.textContent = '486';
      return;
    }

    setTimeout(function () {
      var startTime = null;
      var duration = 2200; // 2.2s
      var startVal = 0;
      var endVal = 486;

      function step(now) {
        if (!startTime) startTime = now;
        var progress = Math.min((now - startTime) / duration, 1);
        // Cubic ease-out
        var easeOut = 1 - Math.pow(1 - progress, 3);
        var current = Math.floor(startVal + (endVal - startVal) * easeOut);
        leadsNumEl.textContent = current;

        if (progress < 1) {
          requestAnimationFrame(step);
        } else {
          leadsNumEl.textContent = endVal;
        }
      }
      requestAnimationFrame(step);
    }, 500);
  }

  function animateSparkline() {
    if (!sparklinePath) return;
    var length = 260;
    try {
      length = sparklinePath.getTotalLength();
    } catch (e) {}

    sparklinePath.style.strokeDasharray = length;
    sparklinePath.style.strokeDashoffset = length;

    if (isReducedMotion) {
      sparklinePath.style.strokeDashoffset = 0;
      return;
    }

    setTimeout(function () {
      sparklinePath.style.transition = 'stroke-dashoffset 2.4s cubic-bezier(0.16, 1, 0.3, 1)';
      sparklinePath.style.strokeDashoffset = 0;
    }, 500);
  }

  // ============================================================
  // 3. CARD C: MAP PACK RANK (countdown from 8 to 1)
  // ============================================================
  function animateRankCountdown() {
    if (!rankNumEl) return;
    if (isReducedMotion) {
      rankNumEl.textContent = '#1';
      return;
    }

    setTimeout(function () {
      var startTime = null;
      var duration = 2200; // 2.2s
      var startVal = 8;
      var endVal = 1;

      function step(now) {
        if (!startTime) startTime = now;
        var progress = Math.min((now - startTime) / duration, 1);
        var easeOut = 1 - Math.pow(1 - progress, 3);
        var current = Math.max(1, Math.round(startVal - (startVal - endVal) * easeOut));
        rankNumEl.textContent = '#' + current;

        if (progress < 1) {
          requestAnimationFrame(step);
        } else {
          rankNumEl.textContent = '#1';
        }
      }
      requestAnimationFrame(step);
    }, 500);
  }

  // ============================================================
  // 4. DESKTOP 3D POINTER TILT
  // ============================================================
  function initPointerTilt() {
    if (!wrapper || !cluster || isTouch || isReducedMotion || window.innerWidth < 900) return;

    var baseRotateY = -9;
    var baseRotateX = 4;
    var isHovering = false;

    wrapper.addEventListener('pointerenter', function () {
      isHovering = true;
      cluster.style.transition = 'transform 0.15s ease-out';
    });

    wrapper.addEventListener('pointermove', function (e) {
      if (!isHovering) return;
      var rect = wrapper.getBoundingClientRect();
      var x = e.clientX - rect.left;
      var y = e.clientY - rect.top;
      var pctX = (x / rect.width) - 0.5; // -0.5 to 0.5
      var pctY = (y / rect.height) - 0.5;

      // rotateY from -9 to about -4/-14deg
      var targetY = baseRotateY + (pctX * 10);
      // rotateX from 4 to about 0/8deg
      var targetX = baseRotateX - (pctY * 8);

      cluster.style.transform = 'rotateY(' + targetY.toFixed(2) + 'deg) rotateX(' + targetX.toFixed(2) + 'deg)';
    });

    wrapper.addEventListener('pointerleave', function () {
      isHovering = false;
      cluster.style.transition = 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)';
      cluster.style.transform = 'rotateY(' + baseRotateY + 'deg) rotateX(' + baseRotateX + 'deg)';
    });
  }

  // ============================================================
  // 5. INTERSECTION OBSERVER & PAGE VISIBILITY
  // ============================================================
  function initVisibilityHandling() {
    // Page Visibility API
    document.addEventListener('visibilitychange', function () {
      isPaused = document.hidden;
    });

    // IntersectionObserver
    if ('IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          isPaused = !entry.isIntersecting;
        });
      }, { threshold: 0.1 });
      observer.observe(wrapper);
    }
  }

  // ============================================================
  // INITIALIZATION ON DOM READY
  // ============================================================
  function init() {
    startTimer();
    playConversationLoop();
    animateLeadsCounter();
    animateSparkline();
    animateRankCountdown();
    initPointerTilt();
    initVisibilityHandling();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();

