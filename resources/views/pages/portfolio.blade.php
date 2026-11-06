@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/paymate-carousel.css') }}" />
@endpush

@section('content')
<!-- HERO SECTION -->
<section class="position-relative overflow-hidden border-bottom border-secondary border-opacity-25 pb-5 pt-4 pt-lg-5">
  <div class="floating-orb floating-orb-primary position-absolute top-0 start-50 translate-middle-x pointer-events-none" style="width: 750px; height: 400px;" aria-hidden="true"></div>
  <div class="floating-orb floating-orb-cyan position-absolute top-50 start-0 translate-middle-y pointer-events-none" style="width: 320px; height: 320px;" aria-hidden="true"></div>

  <div class="container-xl position-relative px-3 px-sm-4 px-lg-5" style="z-index: 1;">
    <div class="rv in text-center mx-auto" style="max-width: 820px;">
      <span class="azora-badge mb-3">MEASURABLE COMMERCIAL IMPACT</span>
      <h1 class="font-heading fw-bolder text-white display-5 display-lg-4 lh-sm tracking-tight mb-4">
        Real Deployments. Measured <span class="text-gradient-cyan">Business Velocity</span>.
      </h1>
      <p class="text-slate-300 fs-6 lh-lg mb-0 mx-auto" style="max-width: 680px;">
        Explore live digital platforms and commerce systems engineered by Azora for high customer acquisition, sub-second velocity, and localized search dominance nationwide.
      </p>

      <!-- Metric Counters Ribbon -->
      <div class="row g-3 g-sm-4 mt-4 mx-auto gsap-stagger-group" style="max-width: 850px;">
        <div class="col-6 col-sm-3 gsap-stagger-item">
          <div class="glass-panel stat-box rounded-4 p-3 text-center">
            <div class="font-heading fs-2 fw-bolder text-white"><span class="counter" data-count="500">500</span><span class="text-azora-cyan">+</span></div>
            <div class="font-mono-badge text-slate-400 small mt-1" style="font-size: 0.65rem;">Platforms Live</div>
          </div>
        </div>
        <div class="col-6 col-sm-3 gsap-stagger-item">
          <div class="glass-panel stat-box rounded-4 p-3 text-center">
            <div class="font-heading fs-2 fw-bolder text-white"><span class="counter" data-count="340">340</span><span class="text-azora-cyan">+</span></div>
            <div class="font-mono-badge text-slate-400 small mt-1" style="font-size: 0.65rem;">Client Partners</div>
          </div>
        </div>
        <div class="col-6 col-sm-3 gsap-stagger-item">
          <div class="glass-panel stat-box rounded-4 p-3 text-center">
            <div class="font-heading fs-2 fw-bolder text-success">100<span class="fs-6 text-white text-opacity-50">%</span></div>
            <div class="font-mono-badge text-slate-400 small mt-1" style="font-size: 0.65rem;">US Engineering</div>
          </div>
        </div>
        <div class="col-6 col-sm-3 gsap-stagger-item">
          <div class="glass-panel stat-box rounded-4 p-3 text-center">
            <div class="font-heading fs-2 fw-bolder text-azora-cyan">&lt; 15<span class="fs-6 text-white text-opacity-50">m</span></div>
            <div class="font-mono-badge text-slate-400 small mt-1" style="font-size: 0.65rem;">Rapid Response</div>
          </div>
        </div>
      </div>

      <!-- Industry Filter Pills -->
      <div class="d-inline-flex flex-wrap justify-content-center gap-2 p-1 rounded-3 mt-4 border-secondary border-opacity-25">
        <button type="button" onclick="filterCase('all')" id="case-btn-all" class="filter-pill active">All Deployments</button>
        <button type="button" onclick="filterCase('trades')" id="case-btn-trades" class="filter-pill">Auto &amp; Trades</button>
        <button type="button" onclick="filterCase('medical')" id="case-btn-medical" class="filter-pill">Healthcare &amp; Corporate</button>
        <button type="button" onclick="filterCase('retail')" id="case-btn-retail" class="filter-pill">Specialty Commerce</button>
        <button type="button" onclick="filterCase('dining')" id="case-btn-dining" class="filter-pill">Dining &amp; Hospitality</button>
      </div>

    </div>
  </div>
</section>

<!-- ======================= FLAGSHIP CLIENT DEPLOYMENTS (ALTERNATING SHOWCASE) ======================= -->
<section class="position-relative border-bottom border-secondary border-opacity-25 py-5 py-lg-5" id="flagship-showcase">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    
    <div class="text-center mx-auto mb-5 pb-3" style="max-width: 720px;">
      <span class="azora-badge mb-2">FLAGSHIP CLIENT DEPLOYMENTS</span>
      <h2 class="font-heading fw-bold text-white fs-2 mb-3">
        Engineered Systems. <span class="text-gradient-cyan">Live in Production</span>.
      </h2>
      <p class="text-slate-300 fs-6 lh-base mb-0">
        Review real client platforms deployed across automotive care, family healthcare, and specialty commerce — engineered by Azora to capture high-intent leads and drive measurable transactions.
      </p>
    </div>

    <div class="showcase-list" id="flagship-container">

      <!-- SHOWCASE 1: NORTH FORK AUTO (Left Image, Right Briefing) -->
      <div class="case-item mb-5 pb-4 pb-lg-5" data-category="trades" data-motion-card>
        <div class="row align-items-center g-4 g-lg-5">
          
          <!-- Left: Interactive Browser Mockup -->
          <div class="col-lg-6">
            <a href="https://www.northforkauto.com/" target="_blank" rel="noopener noreferrer" class="browser-window-card group" title="Visit North Fork Auto live platform">
              <div class="browser-window-header">
                <div class="browser-window-dots">
                  <span class="browser-window-dot dot-red"></span>
                  <span class="browser-window-dot dot-yellow"></span>
                  <span class="browser-window-dot dot-green"></span>
                </div>
                <div class="browser-window-url">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                  <span>https://www.northforkauto.com/</span>
                </div>
                <div class="browser-window-live-badge">
                  <span class="browser-window-live-dot"></span>
                  <span>Live Build</span>
                </div>
              </div>
              
              <div class="browser-window-canvas position-relative">
                <img src="{{ asset('assets/img/portfolio/northforkauto.jpg') }}" alt="North Fork Auto Platform Deployment Preview" class="img-fluid" loading="lazy">
                
                <div class="browser-window-overlay-top">
                  <span class="badge rounded-pill bg-dark bg-opacity-75 text-white border border-secondary border-opacity-50 px-3 py-1 font-mono-badge" style="font-size: 0.68rem; backdrop-filter: blur(8px);">
                    Talkeetna, Alaska · Automotive Services
                  </span>
                </div>

                <div class="browser-window-overlay-bottom">
                  <span class="browser-stat-pill">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                    <span>0.3s Load Time · 100% Core Web Vitals</span>
                  </span>
                  <span class="btn btn-sm btn-dark bg-opacity-75 border border-white-10 text-azora-cyan font-mono-badge d-none d-sm-inline-flex align-items-center gap-1" style="font-size: 0.68rem;">
                    Inspect Live
                  </span>
                </div>
              </div>
            </a>
          </div>

          <!-- Right: Detailed Briefing -->
          <div class="col-lg-6">
            <div class="d-flex align-items-center gap-2 mb-2">
              <span class="briefing-tag-pill">
                <span class="browser-window-live-dot" style="width: 5px; height: 5px;"></span>
                Auto Care &amp; Fleet Systems
              </span>
              <!-- <span class="badge rounded-pill bg-success bg-opacity-15 text-success font-mono-badge" style="font-size: 0.65rem;">VERIFIED CLIENT</span> -->
            </div>

            <h2 class="font-heading fw-bold text-white fs-2 mb-2">
              North Fork Auto
            </h2>
            <p class="text-slate-300 fs-6 lh-base mb-3">
              Trusted, full-service automotive repair facility and commercial fleet care hub serving drivers across Talkeetna and the Mat-Su Valley corridor in Alaska.
            </p>

            <!-- 3-Pillar Briefing Breakdown -->
            <div class="d-flex flex-column gap-2 mb-3">
              <div class="briefing-card-box">
                <div class="d-flex align-items-baseline gap-2">
                  <strong class="text-white small font-heading text-nowrap">Operational Need:</strong>
                  <span class="text-slate-400 small">Manual telephone scheduling created bottlenecks during morning rush hours and missed after-hours service requests from regional motorists.</span>
                </div>
              </div>

              <div class="briefing-card-box">
                <div class="d-flex align-items-baseline gap-2">
                  <strong class="text-azora-cyan small font-heading text-nowrap">Azora Solution:</strong>
                  <span class="text-slate-400 small">Engineered high-speed web architecture with mobile service booking funnels, transparent digital repair menus, and geo-targeted Local SEO dominance.</span>
                </div>
              </div>

              <div class="briefing-card-box border-success border-opacity-25" style="background: rgba(16, 185, 129, 0.05);">
                <div class="d-flex align-items-baseline gap-2">
                  <strong class="text-success small font-heading text-nowrap">Measured Result:</strong>
                  <span class="text-slate-300 small">Shifted 62% of bookings to online instant requests, achieving #1 Google Map Pack ranking in Talkeetna and +185% organic service lead velocity.</span>
                </div>
              </div>
            </div>

            <!-- Live Metrics Row -->
            <div class="d-flex gap-2 mb-3">
              <div class="briefing-metric-badge">
                <div class="font-heading fs-5 fw-bold text-azora-cyan">+185%</div>
                <div class="text-slate-400 small" style="font-size: 0.68rem;">Online Bookings</div>
              </div>
              <div class="briefing-metric-badge">
                <div class="font-heading fs-5 fw-bold text-success">#1 Rank</div>
                <div class="text-slate-400 small" style="font-size: 0.68rem;">Google 3-Pack</div>
              </div>
              <div class="briefing-metric-badge">
                <div class="font-heading fs-5 fw-bold text-white">0.3s</div>
                <div class="text-slate-400 small" style="font-size: 0.68rem;">Page Velocity</div>
              </div>
            </div>

            <!-- Tech Stack & Links -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pt-3 border-top border-secondary border-opacity-25">
              <div class="d-flex flex-wrap gap-1">
                <span class="tech-tag-chip">Modern Web</span>
                <span class="tech-tag-chip">Local SEO</span>
                <span class="tech-tag-chip">Mobile First</span>
                <span class="tech-tag-chip">Core Web Vitals</span>
              </div>
              <div class="d-flex align-items-center gap-2">
                <a href="https://www.northforkauto.com/" target="_blank" rel="noopener noreferrer" class="btn-modern-primary py-2 px-3 small" style="font-size: 0.78rem; border-radius: 8px;">
                  <span>Visit Live Site</span> <i class="bi bi-box-arrow-up-right ms-1"></i>
                </a>
                <button type="button" onclick="AZ.openQuoteModal('website-growth')" class="btn-modern-secondary py-2 px-3 small" style="font-size: 0.78rem; border-radius: 8px;">
                  <span>Request Similar Scope</span>
                </button>
              </div>
            </div>

          </div>

        </div>
      </div>

      <!-- SHOWCASE 2: CARE SOURCE INDY (Right Image, Left Briefing) -->
      <div class="case-item mb-5 pb-4 pb-lg-5" data-category="medical" data-motion-card>
        <div class="row align-items-center g-4 g-lg-5">
          
          <!-- Right on desktop, top on mobile: order-1 order-lg-2 -->
          <div class="col-lg-6 order-1 order-lg-2">
            <a href="https://caresourceindy.com/" target="_blank" rel="noopener noreferrer" class="browser-window-card group" title="Visit Care Source Indy live platform">
              <div class="browser-window-header">
                <div class="browser-window-dots">
                  <span class="browser-window-dot dot-red"></span>
                  <span class="browser-window-dot dot-yellow"></span>
                  <span class="browser-window-dot dot-green"></span>
                </div>
                <div class="browser-window-url">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                  <span>https://caresourceindy.com/</span>
                </div>
                <div class="browser-window-live-badge">
                  <span class="browser-window-live-dot"></span>
                  <span>Live Build</span>
                </div>
              </div>
              
              <div class="browser-window-canvas position-relative">
                <img src="{{ asset('assets/img/portfolio/caresourceindy.jpg') }}" alt="Care Source Indy Platform Deployment Preview" class="img-fluid" loading="lazy">
                
                <div class="browser-window-overlay-top">
                  <span class="badge rounded-pill bg-dark bg-opacity-75 text-white border border-secondary border-opacity-50 px-3 py-1 font-mono-badge" style="font-size: 0.68rem; backdrop-filter: blur(8px);">
                    Indianapolis, IN · Healthcare &amp; In-Home Support
                  </span>
                </div>

                <div class="browser-window-overlay-bottom">
                  <span class="browser-stat-pill">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    <span>HIPAA Aligned · 99/100 Accessibility</span>
                  </span>
                  <span class="btn btn-sm btn-dark bg-opacity-75 border border-white-10 text-azora-cyan font-mono-badge d-none d-sm-inline-flex align-items-center gap-1" style="font-size: 0.68rem;">
                    Inspect Live
                  </span>
                </div>
              </div>
            </a>
          </div>

          <!-- Left on desktop, bottom on mobile: order-2 order-lg-1 -->
          <div class="col-lg-6 order-2 order-lg-1">
            <div class="d-flex align-items-center gap-2 mb-2">
              <span class="briefing-tag-pill">
                <span class="browser-window-live-dot" style="width: 5px; height: 5px;"></span>
                Healthcare &amp; In-Home Care
              </span>
              <!-- <span class="badge rounded-pill bg-success bg-opacity-15 text-success font-mono-badge" style="font-size: 0.65rem;">VERIFIED CLIENT</span> -->
            </div>

            <h2 class="font-heading fw-bold text-white fs-2 mb-2">
              Care Source Indy
            </h2>
            <p class="text-slate-300 fs-6 lh-base mb-3">
              Compassionate, family-first in-home attendant care, companion support, and specialized caregiver coordination platform serving families throughout Indianapolis and Central Indiana.
            </p>

            <!-- 3-Pillar Briefing Breakdown -->
            <div class="d-flex flex-column gap-2 mb-3">
              <div class="briefing-card-box">
                <div class="d-flex align-items-baseline gap-2">
                  <strong class="text-white small font-heading text-nowrap">Operational Need:</strong>
                  <span class="text-slate-400 small">Families dealing with urgent eldercare decisions felt overwhelmed by complex state agency jargon and experienced friction requesting consultations.</span>
                </div>
              </div>

              <div class="briefing-card-box">
                <div class="d-flex align-items-baseline gap-2">
                  <strong class="text-azora-cyan small font-heading text-nowrap">Azora Solution:</strong>
                  <span class="text-slate-400 small">Designed a clean, WCAG-compliant accessible web portal with simplified family intake questionnaires, caregiver screening details, and rapid consultation routing.</span>
                </div>
              </div>

              <div class="briefing-card-box border-success border-opacity-25" style="background: rgba(16, 185, 129, 0.05);">
                <div class="d-flex align-items-baseline gap-2">
                  <strong class="text-success small font-heading text-nowrap">Measured Result:</strong>
                  <span class="text-slate-300 small">Qualified family consultation inquiries grew by +140%, intake processing time decreased from 3 days to under 4 hours, and patient satisfaction ratings reached 99.4%.</span>
                </div>
              </div>
            </div>

            <!-- Live Metrics Row -->
            <div class="d-flex gap-2 mb-3">
              <div class="briefing-metric-badge">
                <div class="font-heading fs-5 fw-bold text-azora-cyan">+140%</div>
                <div class="text-slate-400 small" style="font-size: 0.68rem;">Family Inquiries</div>
              </div>
              <div class="briefing-metric-badge">
                <div class="font-heading fs-5 fw-bold text-success">99/100</div>
                <div class="text-slate-400 small" style="font-size: 0.68rem;">A11y Compliance</div>
              </div>
              <div class="briefing-metric-badge">
                <div class="font-heading fs-5 fw-bold text-white">&lt; 4 hrs</div>
                <div class="text-slate-400 small" style="font-size: 0.68rem;">Intake Velocity</div>
              </div>
            </div>

            <!-- Tech Stack & Links -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pt-3 border-top border-secondary border-opacity-25">
              <div class="d-flex flex-wrap gap-1">
                <span class="tech-tag-chip">Healthcare UX</span>
                <span class="tech-tag-chip">HIPAA Aligned</span>
                <span class="tech-tag-chip">Family Funnels</span>
                <span class="tech-tag-chip">Rapid Intake</span>
              </div>
              <div class="d-flex align-items-center gap-2">
                <a href="https://caresourceindy.com/" target="_blank" rel="noopener noreferrer" class="btn-modern-primary py-2 px-3 small" style="font-size: 0.78rem; border-radius: 8px;">
                  <span>Visit Live Site</span> <i class="bi bi-box-arrow-up-right ms-1"></i>
                </a>
                <button type="button" onclick="AZ.openQuoteModal('website-premium')" class="btn-modern-secondary py-2 px-3 small" style="font-size: 0.78rem; border-radius: 8px;">
                  <span>Request Similar Scope</span>
                </button>
              </div>
            </div>

          </div>

        </div>
      </div>

      <!-- SHOWCASE 3: FUTURE FIND SHOP (Left Image, Right Briefing) -->
      <div class="case-item mb-4" data-category="retail" data-motion-card>
        <div class="row align-items-center g-4 g-lg-5">
          
          <!-- Left: Interactive Browser Mockup -->
          <div class="col-lg-6">
            <a href="https://futurefindshop.com/" target="_blank" rel="noopener noreferrer" class="browser-window-card group" title="Visit Future Find Shop live storefront">
              <div class="browser-window-header">
                <div class="browser-window-dots">
                  <span class="browser-window-dot dot-red"></span>
                  <span class="browser-window-dot dot-yellow"></span>
                  <span class="browser-window-dot dot-green"></span>
                </div>
                <div class="browser-window-url">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                  <span>https://futurefindshop.com/</span>
                </div>
                <div class="browser-window-live-badge">
                  <span class="browser-window-live-dot"></span>
                  <span>Live Build</span>
                </div>
              </div>
              
              <div class="browser-window-canvas position-relative">
                <img src="{{ asset('assets/img/portfolio/futurefindshop.jpg') }}" alt="Future Find Shop Omnichannel Storefront Preview" class="img-fluid" loading="lazy">
                
                <div class="browser-window-overlay-top">
                  <span class="badge rounded-pill bg-dark bg-opacity-75 text-white border border-secondary border-opacity-50 px-3 py-1 font-mono-badge" style="font-size: 0.68rem; backdrop-filter: blur(8px);">
                    United States · Specialty E-Commerce
                  </span>
                </div>

                <div class="browser-window-overlay-bottom">
                  <span class="browser-stat-pill">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    <span>Instant Checkout · +210% Conversion</span>
                  </span>
                  <span class="btn btn-sm btn-dark bg-opacity-75 border border-white-10 text-azora-cyan font-mono-badge d-none d-sm-inline-flex align-items-center gap-1" style="font-size: 0.68rem;">
                    Inspect Live
                  </span>
                </div>
              </div>
            </a>
          </div>

          <!-- Right: Detailed Briefing -->
          <div class="col-lg-6">
            <div class="d-flex align-items-center gap-2 mb-2">
              <span class="briefing-tag-pill">
                <span class="browser-window-live-dot" style="width: 5px; height: 5px;"></span>
                Specialty Retail &amp; Commerce
              </span>
              <!-- <span class="badge rounded-pill bg-success bg-opacity-15 text-success font-mono-badge" style="font-size: 0.65rem;">VERIFIED CLIENT</span> -->
            </div>

            <h2 class="font-heading fw-bold text-white fs-2 mb-2">
              Future Find Shop
            </h2>
            <p class="text-slate-300 fs-6 lh-base mb-3">
              High-velocity digital storefront and specialty lifestyle commerce platform engineered for omnichannel discovery, fast catalog indexing, and one-click mobile checkout nationwide.
            </p>

            <!-- 3-Pillar Briefing Breakdown -->
            <div class="d-flex flex-column gap-2 mb-3">
              <div class="briefing-card-box">
                <div class="d-flex align-items-baseline gap-2">
                  <strong class="text-white small font-heading text-nowrap">Operational Need:</strong>
                  <span class="text-slate-400 small">Sluggish product pages and complex checkout steps led to a 74% mobile cart abandonment rate on social ad traffic campaigns.</span>
                </div>
              </div>

              <div class="briefing-card-box">
                <div class="d-flex align-items-baseline gap-2">
                  <strong class="text-azora-cyan small font-heading text-nowrap">Azora Solution:</strong>
                  <span class="text-slate-400 small">Engineered a lightweight mobile storefront architecture with dynamic category discovery, instant slide-out cart drawers, and friction-free payment integrations.</span>
                </div>
              </div>

              <div class="briefing-card-box border-success border-opacity-25" style="background: rgba(16, 185, 129, 0.05);">
                <div class="d-flex align-items-baseline gap-2">
                  <strong class="text-success small font-heading text-nowrap">Measured Result:</strong>
                  <span class="text-slate-300 small">Checkout completion rates surged by +210%, cart drop-off fell by 38%, and interactive page speeds averaged 0.42s across all 50 US states.</span>
                </div>
              </div>
            </div>

            <!-- Live Metrics Row -->
            <div class="d-flex gap-2 mb-3">
              <div class="briefing-metric-badge">
                <div class="font-heading fs-5 fw-bold text-azora-cyan">+210%</div>
                <div class="text-slate-400 small" style="font-size: 0.68rem;">Mobile Checkout</div>
              </div>
              <div class="briefing-metric-badge">
                <div class="font-heading fs-5 fw-bold text-success">-38%</div>
                <div class="text-slate-400 small" style="font-size: 0.68rem;">Cart Abandonment</div>
              </div>
              <div class="briefing-metric-badge">
                <div class="font-heading fs-5 fw-bold text-white">0.42s</div>
                <div class="text-slate-400 small" style="font-size: 0.68rem;">Interactive Speed</div>
              </div>
            </div>

            <!-- Tech Stack & Links -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pt-3 border-top border-secondary border-opacity-25">
              <div class="d-flex flex-wrap gap-1">
                <span class="tech-tag-chip">Omnichannel Commerce</span>
                <span class="tech-tag-chip">Instant Checkout</span>
                <span class="tech-tag-chip">Catalog Speed</span>
                <span class="tech-tag-chip">Conversion Rate Opt</span>
              </div>
              <div class="d-flex align-items-center gap-2">
                <a href="https://futurefindshop.com/" target="_blank" rel="noopener noreferrer" class="btn-modern-primary py-2 px-3 small" style="font-size: 0.78rem; border-radius: 8px;">
                  <span>Visit Live Store</span> <i class="bi bi-box-arrow-up-right ms-1"></i>
                </a>
                <button type="button" onclick="AZ.openQuoteModal('marketing-growth')" class="btn-modern-secondary py-2 px-3 small" style="font-size: 0.78rem; border-radius: 8px;">
                  <span>Request Similar Scope</span>
                </button>
              </div>
            </div>

          </div>

        </div>
      </div>

    </div>

  </div>
</section>

<!-- ======================= SECTOR DEPLOYMENTS (PAYMATE CARD MACHINE CAROUSEL) ======================= -->
<section class="pm-car-section position-relative border-bottom border-secondary border-opacity-25 py-5 py-lg-5" id="case-histories">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
      <div>
        <p class="azora-badge mb-2">SECTOR DEPLOYMENTS</p>
        <h2 class="font-heading fw-bold text-white fs-2 mb-2">
          Sector Case Histories <em class="fst-italic text-azora-cyan fw-normal">for Every Industry.</em>
        </h2>
        <p class="text-slate-400 small mb-0" style="max-width: 680px;">
          Cross-industry engineering records across dining, specialty commerce, emergency field trades, healthcare, and enterprise B2B. Drag through the range.
        </p>
      </div>
      <div class="text-md-end">
        <button type="button" onclick="AZ.openQuoteModal('website-growth')" class="btn-modern-primary py-2 px-3 small" style="font-size: 0.82rem; border-radius: 8px;">
          <span>Request Spec Analysis</span>
        </button>
      </div>
    </div>

    <!-- Paymate 3D Card Machine Carousel with Azora Sector Data -->
    <x-terminal-carousel />

  </div>
</section>

<!-- HEADQUARTERS MAP -->
<section class="position-relative py-5 py-lg-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    <x-google-map />
  </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/paymate-carousel.js') }}"></script>
<script>
  function filterCase(cat) {
    var btns = ['all', 'trades', 'medical', 'retail', 'dining'];
    btns.forEach(function(b) {
      var el = document.getElementById('case-btn-' + b);
      if (el) {
        if (b === cat) {
          el.className = 'filter-pill active';
        } else {
          el.className = 'filter-pill';
        }
      }
    });

    var items = document.querySelectorAll('.case-item');
    var toShow = [];
    items.forEach(function(item) {
      if (cat === 'all' || item.dataset.category === cat) {
        item.style.display = '';
        toShow.push(item);
      } else {
        item.style.display = 'none';
      }
    });

    if (typeof window.gsap !== 'undefined' && toShow.length) {
      window.gsap.fromTo(toShow, 
        { opacity: 0, y: 16, scale: 0.98 }, 
        { opacity: 1, y: 0, scale: 1, duration: 0.4, stagger: 0.05, ease: 'power3.out' }
      );
    }
  }
</script>
@endpush
