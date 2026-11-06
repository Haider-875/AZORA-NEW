/* ============================================================
   AZORA SOLUTIONS — Client Application & Motion Engine
   PHP 8.2+ · Bootstrap 5.3 · GSAP 3.x + ScrollTrigger
   Hardware Removed · Global Navbar Fix · Unified Quote Modal
   ============================================================ */
(function () {
  'use strict';

  var SERVICES = (window.AZ_DATA && window.AZ_DATA.services) || [];

  /* ---------- Tiny DOM utilities ---------- */
  function $(selector, root) { return (root || document).querySelector(selector); }
  function $$(selector, root) { return Array.prototype.slice.call((root || document).querySelectorAll(selector)); }
  function esc(s) { return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]; }); }

  /* SVG Icons Dictionary */
  var SVG_PATHS = {
    check: '<path d="M4.5 12.5l5 5 10-11"/>',
    x: '<path d="M6 6l12 12M18 6L6 18"/>',
    right: '<path d="M5 12h14M13 6l6 6-6 6"/>',
    send: '<path d="M21 3L10.5 13.5M21 3l-7 18-3.5-7.5L3 10z"/>',
    chat: '<path d="M21 12a8 8 0 0 1-8 8c-1.3 0-2.6-.3-3.7-.9L4 20l1-5.1A8 8 0 1 1 21 12z"/>',
    spark: '<path d="M12 2l1.9 5.6 5.8.2-4.6 3.6 1.7 5.8-4.8-3.4-4.8 3.4 1.7-5.8L4.3 7.8l5.8-.2z"/>',
    globe: '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
    trend: '<path d="M23 6l-9.5 9.5-5-5L1 18"/>'
  };

  function iconSvg(name, cls) {
    return '<svg viewBox="0 0 24 24" class="' + (cls || 'h-4 w-4') + '" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' + (SVG_PATHS[name] || '') + '</svg>';
  }

  /* ============================================================
     1. GLOBAL CUSTOM CURSOR (Desktop only)
     ============================================================ */
  function initGlobalCursor() {
    var hasTouchOnly = ('ontouchstart' in window) && !window.matchMedia('(any-pointer:fine)').matches && !window.matchMedia('(pointer:fine)').matches;
    var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (hasTouchOnly || reducedMotion) return;

    var root = document.documentElement;

    if (!document.getElementById('azora-cursor-styles')) {
      var style = document.createElement('style');
      style.id = 'azora-cursor-styles';
      style.textContent = [
        '@media (pointer:fine) and (hover:hover) and (prefers-reduced-motion:no-preference) {',
        '  html.cursor-ready, html.cursor-ready body { cursor:none; }',
        '  html.cursor-ready a, html.cursor-ready button, html.cursor-ready input,',
        '  html.cursor-ready textarea, html.cursor-ready select, html.cursor-ready label,',
        '  html.cursor-ready [role="button"], html.cursor-ready .filter-pill,',
        '  html.cursor-ready .glass-card-interactive, html.cursor-ready summary { cursor:none; }',
        '  .cursor-core, .cursor-ring {',
        '    position:fixed; top:0; left:0; z-index:99999; pointer-events:none; opacity:0;',
        '    transform:translate3d(-100px,-100px,0) translate(-50%,-50%);',
        '    transition:opacity .2s ease, width .22s cubic-bezier(0.16,1,0.3,1), height .22s cubic-bezier(0.16,1,0.3,1);',
        '  }',
        '  .cursor-core {',
        '    width:6px; height:6px; border-radius:50%; background:#2469EB;',
        '    box-shadow:0 0 0 3px rgba(36,105,235,.15), 0 0 14px rgba(36,105,235,.6);',
        '  }',
        '  .cursor-ring {',
        '    width:32px; height:32px; border:1.2px solid rgba(36,105,235,.55); border-radius:50%;',
        '    background:rgba(255,255,255,.08); box-shadow:0 0 20px rgba(36,105,235,.15), inset 0 0 10px rgba(255,255,255,.15);',
        '    backdrop-filter:blur(2px); -webkit-backdrop-filter:blur(2px);',
        '  }',
        '  html.cursor-ready .cursor-core, html.cursor-ready .cursor-ring { opacity:1; }',
        '  html.cursor-ready.cursor-hover .cursor-ring {',
        '    width:48px; height:48px; border-color:rgba(56,189,248,.9); background:rgba(36,105,235,.12);',
        '    box-shadow:0 0 26px rgba(36,105,235,.3), inset 0 0 14px rgba(255,255,255,.3);',
        '  }',
        '  html.cursor-ready.cursor-hover .cursor-core {',
        '    transform:translate3d(-100px,-100px,0) translate(-50%,-50%) scale(1.2);',
        '  }',
        '  html.cursor-ready.cursor-click .cursor-ring { animation:az-cursor-click .45s ease-out; }',
        '}',
        '@keyframes az-cursor-click { 0% { box-shadow:0 0 0 0 rgba(36,105,235,.6); } 100% { box-shadow:0 0 0 20px rgba(36,105,235,0); } }'
      ].join('\n');
      document.head.appendChild(style);
    }

    var core = $('.cursor-core') || (function () {
      var el = document.createElement('div');
      el.className = 'cursor-core';
      el.setAttribute('aria-hidden', 'true');
      document.body.appendChild(el);
      return el;
    })();

    var ring = $('.cursor-ring') || (function () {
      var el = document.createElement('div');
      el.className = 'cursor-ring';
      el.setAttribute('aria-hidden', 'true');
      document.body.appendChild(el);
      return el;
    })();

    var x = -100, y = -100, frame = null;
    root.classList.add('cursor-ready');

    window.addEventListener('pointermove', function (event) {
      x = event.clientX;
      y = event.clientY;
      if (frame) return;
      frame = requestAnimationFrame(function () {
        core.style.transform = 'translate3d(' + x + 'px,' + y + 'px,0) translate(-50%,-50%)';
        ring.style.transform = 'translate3d(' + x + 'px,' + y + 'px,0) translate(-50%,-50%)';
        frame = null;
      });
    }, { passive: true });

    var hoverSelector = 'a, button, input, textarea, select, [role="button"], label, .filter-pill, .glass-card-interactive, summary, [onclick]';

    document.addEventListener('pointerover', function (event) {
      if (event.target && event.target.closest && event.target.closest(hoverSelector)) {
        root.classList.add('cursor-hover');
      }
    });

    document.addEventListener('pointerout', function (event) {
      if (!event.relatedTarget || !event.relatedTarget.closest || !event.relatedTarget.closest(hoverSelector)) {
        root.classList.remove('cursor-hover');
      }
    });

    document.addEventListener('pointerdown', function () {
      root.classList.remove('cursor-click');
      void root.offsetWidth;
      root.classList.add('cursor-click');
    });

    document.addEventListener('mouseleave', function () {
      core.style.opacity = '0';
      ring.style.opacity = '0';
    });

    document.addEventListener('mouseenter', function () {
      core.style.opacity = '1';
      ring.style.opacity = '1';
    });
  }

  /* ============================================================
     2. GLOBAL NAVBAR & SERVICES DROPDOWN LOGIC
     ============================================================ */
  function initNavigation() {
    var navDropdowns = $$('.azora-dropdown');
    navDropdowns.forEach(function (dd) {
      var toggleBtn = $('.azora-dropdown-toggle', dd);
      if (toggleBtn) {
        toggleBtn.addEventListener('click', function (e) {
          if (window.innerWidth < 992) {
            e.preventDefault();
            dd.classList.toggle('show');
          }
        });
      }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (e) {
      if (!e.target.closest('.azora-dropdown')) {
        navDropdowns.forEach(function (dd) {
          dd.classList.remove('show');
        });
      }
    });

    // Mobile menu toggle
    var menuBtn = $('#menu-btn');
    var mobileMenu = $('#mobile-menu');
    if (menuBtn && mobileMenu) {
      menuBtn.addEventListener('click', function (e) {
        e.preventDefault();
        var isHidden = mobileMenu.classList.toggle('d-none');
        var openIc = $('#menu-ic-open');
        var closeIc = $('#menu-ic-close');
        if (openIc) openIc.classList.toggle('d-none', !isHidden);
        if (closeIc) closeIc.classList.toggle('d-none', isHidden);
      });

      $$('a', mobileMenu).forEach(function (a) {
        a.addEventListener('click', function () {
          mobileMenu.classList.add('d-none');
          var openIc = $('#menu-ic-open');
          var closeIc = $('#menu-ic-close');
          if (openIc) openIc.classList.remove('d-none');
          if (closeIc) closeIc.classList.add('d-none');
        });
      });
    }

    // Header scroll background elevation
    var headerInner = $('#header-inner');
    if (headerInner) {
      var updateHeader = function () {
        if (window.scrollY > 20) {
          headerInner.classList.add('scrolled');
        } else {
          headerInner.classList.remove('scrolled');
        }
      };
      window.addEventListener('scroll', updateHeader, { passive: true });
      updateHeader();
    }

    // Enhanced clickable phone numbers (direct dial on mobile + clipboard copy on desktop)
    $$('a[href^="tel:"]').forEach(function (telLink) {
      telLink.addEventListener('click', function () {
        var num = (telLink.getAttribute('href') || '').replace('tel:', '');
        if (num && navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(num).catch(function () {});
        }
      });
    });
  }

  /* ============================================================
     3. ANIMATED NUMBER COUNTERS
     ============================================================ */
  function runCounter(el) {
    if (el.dataset.done) return;
    el.dataset.done = '1';
    var target = parseInt(el.dataset.count, 10) || 0;
    var dur = 1400, t0 = performance.now();
    function fmt(n) { return n.toLocaleString('en-US'); }
    (function tick(now) {
      var p = Math.min((now - t0) / dur, 1);
      var e = 1 - Math.pow(1 - p, 4);
      el.textContent = fmt(Math.round(target * e));
      if (p < 1) requestAnimationFrame(tick);
    })(t0);
  }

  /* ============================================================
     4. GSAP 3.x + SCROLLTRIGGER ANIMATION SYSTEM
     ============================================================ */
  function initMotionSystem() {
    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // Reveal all elements immediately if reduced motion is requested
    if (prefersReducedMotion) {
      $$('.rv').forEach(function (el) {
        el.classList.add('in');
      });
      $$('.counter').forEach(runCounter);
      return;
    }

    var hasGSAP = typeof window.gsap !== 'undefined';
    var hasScrollTrigger = typeof window.ScrollTrigger !== 'undefined';

    if (hasGSAP && hasScrollTrigger) {
      window.gsap.registerPlugin(window.ScrollTrigger);

      // Hero Section Entrance Timeline
      var heroCol = $('.hero-entrance-col');
      if (heroCol) {
        var tl = window.gsap.timeline({ defaults: { ease: 'power3.out' } });

        var badge = $('.hero-badge', heroCol);
        var headline = $('.hero-headline', heroCol);
        var desc = $('.hero-desc', heroCol);
        var ctaship = $('.hero-actions', heroCol);
        var metrics = $('.hero-metrics', heroCol);
        var windowDemo = $('.hero-window-col');

        if (badge) {
          tl.fromTo(badge, { opacity: 0, y: -20, scale: 0.95 }, { opacity: 1, y: 0, scale: 1, duration: 0.6 });
        }
        if (headline) {
          tl.fromTo(headline, { opacity: 0, y: 28 }, { opacity: 1, y: 0, duration: 0.8 }, '-=0.35');
        }
        if (desc) {
          tl.fromTo(desc, { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.7 }, '-=0.45');
        }
        if (ctaship) {
          tl.fromTo(ctaship, { opacity: 0, y: 18 }, { opacity: 1, y: 0, duration: 0.6 }, '-=0.4');
        }
        if (metrics) {
          tl.fromTo(metrics, { opacity: 0, y: 16 }, {
            opacity: 1,
            y: 0,
            duration: 0.6,
            onComplete: function () {
              $$('.counter', metrics).forEach(runCounter);
            }
          }, '-=0.35');
        }
        if (windowDemo) {
          tl.fromTo(windowDemo, { opacity: 0, scale: 0.94, y: 30 }, { opacity: 1, scale: 1, y: 0, duration: 0.85, ease: 'back.out(1.2)' }, '-=0.6');
        }
      }

      // Scroll-Triggered Stagger for Service, Pricing & Process Cards
      $$('.gsap-stagger-group').forEach(function (group) {
        var items = $$('.gsap-stagger-item', group);
        if (!items.length) return;

        window.gsap.fromTo(items,
          { opacity: 0, y: 35, scale: 0.97 },
          {
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 0.75,
            stagger: 0.12,
            ease: 'power3.out',
            scrollTrigger: {
              trigger: group,
              start: 'top 85%',
              once: true
            }
          }
        );
      });

      // Ambient Parallax on Floating Orbs (Disabled on small screens)
      if (window.innerWidth >= 992) {
        $$('.floating-orb').forEach(function (orb) {
          window.gsap.to(orb, {
            y: '-=35',
            ease: 'none',
            scrollTrigger: {
              trigger: document.body,
              start: 'top top',
              end: 'bottom bottom',
              scrub: 1.5
            }
          });
        });
      }
    }

    // Standard Fallback with IntersectionObserver for all .rv items
    if ('IntersectionObserver' in window) {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) {
          if (!en.isIntersecting) return;
          en.target.classList.add('in');
          $$('.counter', en.target).forEach(runCounter);
          io.unobserve(en.target);
        });
      }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

      $$('.rv').forEach(function (el) { io.observe(el); });
    } else {
      $$('.rv').forEach(function (el) {
        el.classList.add('in');
        $$('.counter', el).forEach(runCounter);
      });
    }
  }

  /* ============================================================
     5. FAQ ACCORDION ENGINE
     ============================================================ */
  window.AZ = window.AZ || {};
  AZ.toggleFaq = function (btn) {
    var item = btn.closest('.faq-modern-item');
    if (!item) return;
    var wasOpen = item.classList.contains('open');
    $$('.faq-modern-item.open').forEach(function (el) {
      el.classList.remove('open');
    });
    if (!wasOpen) {
      item.classList.add('open');
    }
  };

  /* ============================================================
     6. RAPID QUOTE MODAL (Bootstrap 5.3 Styled, Hardware Removed)
     ============================================================ */
  AZ.openQuoteModal = function (preselectId) {
    var modalRoot = $('#global-quote-modal-root');
    if (!modalRoot) {
      modalRoot = document.createElement('div');
      modalRoot.id = 'global-quote-modal-root';
      document.body.appendChild(modalRoot);
    }

    var availableServices = [
      { id: 'website-growth', name: 'Website Growth Plan ($185/mo)', cat: 'Web' },
      { id: 'website-premium', name: 'Website Premium ($249/mo)', cat: 'Web' },
      { id: 'website-starter', name: 'Website Starter ($99/mo)', cat: 'Web' },
      { id: 'marketing-growth', name: 'SEO & Marketing Growth ($365/mo)', cat: 'SEO' },
      { id: 'marketing-starter', name: 'Local Marketing Starter ($285/mo)', cat: 'SEO' },
      { id: 'marketing-premium', name: 'Market Leader SEO ($399/mo)', cat: 'SEO' },
      { id: 'ai-voice-receptionist', name: 'AI Voice Receptionist', cat: 'AI' },
      { id: 'ai-whatsapp-concierge', name: 'WhatsApp AI Concierge', cat: 'AI' },
      { id: 'custom-business-software', name: 'Custom Cloud / Web Architecture', cat: 'Software' }
    ];

    var selectedItems = [];
    if (preselectId) {
      selectedItems.push(preselectId);
    }

    var optionsHtml = availableServices.map(function (opt) {
      var isSel = selectedItems.indexOf(opt.id) !== -1;
      return '<button type="button" data-val="' + esc(opt.id) + '" class="modal-pick-chip' + (isSel ? ' is-selected' : '') + '">' +
        '<span class="chip-indicator">' + (isSel ? iconSvg('check', 'h-3 w-3') : '<span class="chip-dot"></span>') + '</span>' +
        '<span class="chip-label">' + esc(opt.name) + '</span>' +
      '</button>';
    }).join('');

    var csrfToken = $('meta[name="csrf-token"]') ? $('meta[name="csrf-token"]').getAttribute('content') : '';

    modalRoot.innerHTML =
      '<div class="modal fade show d-block" id="rapidQuoteModal" tabindex="-1" style="background:rgba(2,6,23,0.88);backdrop-filter:blur(10px);z-index:9999;" role="dialog" aria-modal="true">' +
        '<div class="modal-dialog modal-dialog-centered modal-lg">' +
          '<div class="modal-content modal-content-azora p-4 p-md-5 animate-scaleIn position-relative shadow-2xl">' +
            '<div class="position-absolute top-0 end-0 translate-middle pointer-events-none" style="width:260px;height:260px;background:radial-gradient(circle,rgba(56,189,248,0.12) 0%,transparent 70%);filter:blur(40px);z-index:0;"></div>' +
            '<div class="position-relative" style="z-index:1;">' +
              '<div class="d-flex align-items-start justify-content-between border-bottom border-secondary border-opacity-25 pb-3">' +
                '<div>' +
                  '<div class="d-flex align-items-center gap-2 mb-1">' +
                    '<span class="font-mono-badge text-azora-cyan" style="font-size:0.7rem;letter-spacing:0.08em;">AZORA RAPID PROPOSAL</span>' +
                    '<span class="badge" style="border-radius:6px;background:rgba(16,185,129,0.15);border:1px solid rgba(16,185,129,0.3);color:#34d399;font-size:0.65rem;font-weight:600;padding:2px 7px;">● US TEAM ONLINE</span>' +
                  '</div>' +
                  '<h3 class="font-heading fw-bold text-white mb-1 fs-4">Request an Itemized Proposal</h3>' +
                  '<p class="text-slate-400 small mb-0">Select your digital growth, web design or AI requirements. Our US engineering team analyzes your scope and dispatches a transparent itemized proposal with zero obligation.</p>' +
                '</div>' +
                '<button type="button" class="modal-close-btn" onclick="AZ.closeQuoteModal()" aria-label="Close" title="Close modal">' +
                  iconSvg('x', 'h-4 w-4') +
                '</button>' +
              '</div>' +
              '<div class="mt-3">' +
                '<label class="form-label font-mono-badge text-slate-300 mb-2" style="font-size:0.68rem;letter-spacing:0.06em;">1. CHOOSE SERVICES &amp; TIERS (CLICK TO TOGGLE)</label>' +
                '<div id="modal-service-picks" class="d-flex flex-wrap">' + optionsHtml + '</div>' +
              '</div>' +
              '<form id="modal-rapid-quote-form" class="mt-2">' +
                (csrfToken ? '<input type="hidden" name="_token" value="' + csrfToken + '">' : '') +
                '<input type="text" name="website" style="display:none;" tabindex="-1" autocomplete="off">' +
                '<div id="modal-error-alert" class="alert alert-danger d-none border-0 small py-2 px-3 mb-3 rounded-2" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5;"></div>' +
                '<label class="form-label font-mono-badge text-slate-300 mb-2 mt-2" style="font-size:0.68rem;letter-spacing:0.06em;">2. ENTER BUSINESS &amp; CONTACT DETAILS</label>' +
                '<div class="row g-3">' +
                  '<div class="col-md-6">' +
                    '<label class="form-label font-mono-badge text-slate-400" style="font-size:0.65rem;">Business Name *</label>' +
                    '<input name="business" required placeholder="e.g. Acme Health LLC" class="form-control form-control-azora" />' +
                  '</div>' +
                  '<div class="col-md-6">' +
                    '<label class="form-label font-mono-badge text-slate-400" style="font-size:0.65rem;">Contact Name *</label>' +
                    '<input name="contact" required placeholder="Your full name" class="form-control form-control-azora" />' +
                  '</div>' +
                  '<div class="col-md-6">' +
                    '<label class="form-label font-mono-badge text-slate-400" style="font-size:0.65rem;">Email Address *</label>' +
                    '<input type="email" name="email" required placeholder="name@company.com" class="form-control form-control-azora" />' +
                  '</div>' +
                  '<div class="col-md-6">' +
                    '<label class="form-label font-mono-badge text-slate-400" style="font-size:0.65rem;">Phone Number</label>' +
                    '<input type="tel" name="phone" placeholder="(984) 388-8298" class="form-control form-control-azora" />' +
                  '</div>' +
                  '<div class="col-12">' +
                    '<label class="form-label font-mono-badge text-slate-400" style="font-size:0.65rem;">Project Goals / Scope Notes (Optional)</label>' +
                    '<textarea name="message" rows="2" placeholder="Describe your web objectives, target cities, or current system challenges..." class="form-control form-control-azora"></textarea>' +
                  '</div>' +
                '</div>' +
                '<div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center justify-content-between gap-3 mt-4 pt-3 border-top border-secondary border-opacity-25">' +
                  '<div class="d-flex flex-wrap align-items-center gap-2">' +
                    '<a href="tel:+19843888298" class="btn-dial-quick text-decoration-none" title="Call directly">' +
                      '<svg viewBox="0 0 24 24" class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:13px;height:13px;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>' +
                      '<span>+1 (984) 388-8298</span>' +
                    '</a>' +
                    '<a href="/plans" class="text-slate-400 text-decoration-none small hover-cyan d-inline-flex align-items-center gap-1 ms-sm-2" style="font-size:0.75rem;">' +
                      '<span>Compare Plans</span>' +
                    '</a>' +
                  '</div>' +
                  '<button type="submit" id="modal-submit-btn" class="btn-modern-primary py-2 px-4 fs-6 justify-content-center" style="border-radius:8px;">' +
                    '<span>Submit Proposal Request</span>' +
                  '</button>' +
                '</div>' +
                '<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-3 pt-1 text-slate-500 font-mono-badge" style="font-size:0.68rem;">' +
                  '<div class="d-flex align-items-center gap-3">' +
                    '<span>✓ Zero Obligation</span>' +
                    '<span>✓ 15-Minute Response</span>' +
                    '<span>✓ No Spam Guaranteed</span>' +
                  '</div>' +
                  '<a href="/quote" class="text-azora-cyan text-decoration-none fw-semibold hover-glow">Open Dedicated Configurator</a>' +
                '</div>' +
              '</form>' +
            '</div>' +
          '</div>' +
        '</div>' +
      '</div>';

    document.body.style.overflow = 'hidden';

    // Handle selection chip clicks
    var picksContainer = $('#modal-service-picks');
    if (picksContainer) {
      picksContainer.addEventListener('click', function (e) {
        var btn = e.target.closest('.modal-pick-chip');
        if (!btn) return;
        var val = btn.dataset.val;
        var idx = selectedItems.indexOf(val);
        var indicator = btn.querySelector('.chip-indicator');
        if (idx !== -1) {
          selectedItems.splice(idx, 1);
          btn.classList.remove('is-selected');
          if (indicator) indicator.innerHTML = '<span class="chip-dot"></span>';
        } else {
          selectedItems.push(val);
          btn.classList.add('is-selected');
          if (indicator) indicator.innerHTML = iconSvg('check', 'h-3 w-3');
        }
      });
    }

    // Handle Form Submit
    var form = $('#modal-rapid-quote-form');
    if (form) {
      form.addEventListener('submit', async function (e) {
        e.preventDefault();
        var submitBtn = $('#modal-submit-btn');
        if (submitBtn) {
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<span>Submitting Request…</span>';
        }

        var fd = new FormData(form);
        var now = new Date();
        var ref = 'AZ-' + String(now.getFullYear()).slice(2) + String(now.getMonth() + 1).padStart(2, '0') + String(now.getDate()).padStart(2, '0') + '-' + Math.random().toString(36).slice(2, 6).toUpperCase();

        var payload = {
          event_type: selectedItems.length ? 'quote_request' : 'general_inquiry',
          ref: ref,
          business: String(fd.get('business') || '').trim(),
          contact: String(fd.get('contact') || '').trim(),
          email: String(fd.get('email') || '').trim(),
          phone: String(fd.get('phone') || '').trim(),
          locations: '1',
          message: String(fd.get('message') || '').trim(),
          items: selectedItems.map(function (it) { return { id: it, name: it }; }),
          page_url: window.location.href,
          _token: csrfToken
        };

        try {
          localStorage.setItem('azora_last_quote', JSON.stringify(payload));
        } catch (storageErr) {}

        var errorAlert = $('#modal-error-alert');
        if (errorAlert) {
          errorAlert.classList.add('d-none');
          errorAlert.textContent = '';
        }

        try {
          var resp = await fetch('/lead', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(payload)
          });
          var resData = await resp.json().catch(function () { return {}; });

          if (!resp.ok) {
            if (submitBtn) {
              submitBtn.disabled = false;
              submitBtn.innerHTML = '<span>Submit Proposal Request</span>';
            }
            if (errorAlert) {
              errorAlert.classList.remove('d-none');
              if (resp.status === 422) {
                var firstErr = resData.errors ? Object.values(resData.errors)[0] : (resData.message || 'Please check the required fields.');
                errorAlert.textContent = Array.isArray(firstErr) ? firstErr[0] : firstErr;
              } else if (resp.status === 429) {
                errorAlert.textContent = 'Too many requests submitted. Please wait 60 seconds before trying again.';
              } else {
                errorAlert.textContent = 'An unexpected server error occurred. Please call +1 (984) 388-8298 directly.';
              }
            }
            return;
          }

          AZ.closeQuoteModal();
          window.location.href = '/success';
        } catch (fetchErr) {
          console.warn('AJAX submit network error:', fetchErr);
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<span>Submit Proposal Request</span>';
          }
          if (errorAlert) {
            errorAlert.classList.remove('d-none');
            errorAlert.textContent = 'Network connection failed. Please check your internet or call us at +1 (984) 388-8298.';
          }
        }
      });
    }
  };

  AZ.closeQuoteModal = function () {
    var modalRoot = $('#global-quote-modal-root');
    if (modalRoot) {
      modalRoot.innerHTML = '';
    }
    document.body.style.overflow = '';
  };

  /* ============================================================
     7. CONCIERGE CHATBOT WIDGET
     ============================================================ */
  function initConciergeChat() {
    var root = $('#concierge-root');
    if (!root) {
      root = document.createElement('div');
      root.id = 'concierge-root';
      document.body.appendChild(root);
    }

    root.innerHTML =
      '<div id="concierge-trigger" class="position-fixed bottom-0 end-0 m-3 m-md-4 z-3">' +
        '<button type="button" class="concierge-btn shadow-lg" onclick="AZ.openQuoteModal()" aria-label="Request an Itemized Proposal" style="border-radius:8px;">' +
          '<span class="concierge-icon-box d-flex align-items-center">' + iconSvg('chat', 'h-4 w-4') + '</span>' +
          '<span class="font-mono-badge fw-bold" style="font-size:0.75rem;letter-spacing:0.04em;">Rapid Proposal</span>' +
        '</button>' +
      '</div>';
  }

  /* ============================================================
     INITIALIZATION ON DOM READY
     ============================================================ */
  function init() {
    initGlobalCursor();
    initNavigation();
    initMotionSystem();
    initConciergeChat();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
