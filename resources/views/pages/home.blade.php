@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/cycle-motion.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/service-showcase.css') }}" />
@endpush

@section('content')
<!-- ======================= 1. HERO SECTION ======================= -->
<section class="position-relative overflow-hidden border-bottom border-secondary border-opacity-25 pb-5 pt-4 pt-sm-5 pt-lg-5">
  
  <!-- Dynamic Atmospheric Glows with Floating Motion -->
  <div class="floating-orb floating-orb-primary position-absolute top-0 start-50 translate-middle-x pointer-events-none" style="width: 800px; height: 450px;" aria-hidden="true"></div>
  <div class="floating-orb floating-orb-cyan position-absolute top-50 start-0 translate-middle-y pointer-events-none" style="width: 320px; height: 320px;" aria-hidden="true"></div>

  <!-- Ambient Violet Glow & Faint 64px Grid -->
  <div class="hero-ambient-glow" aria-hidden="true"></div>
  <div class="hero-faint-grid" aria-hidden="true"></div>

  <div class="container-xl position-relative px-3 px-sm-4 px-lg-5" style="z-index: 1;">
    <div class="row align-items-center g-4 g-lg-5">
      
      <!-- Left Hero Column -->
      <div class="col-lg-6 hero-entrance-col">
        <!-- Live Indicator Badge -->
        <div class="hero-badge d-inline-flex align-items-center gap-2 rounded-pill px-3 py-1 mb-3">
          <span class="rounded-circle bg-info" style="width: 8px; height: 8px; box-shadow: 0 0 10px #38BDF8;"></span>
          <span class="font-mono-badge text-azora-cyan fw-bold" style="font-size: 0.72rem; letter-spacing: 0.2em;">Next-Gen Web &amp; Digital Growth</span>
        </div>

        <!-- Main Headline -->
        <h1 class="hero-headline font-heading fw-bolder text-white display-5 display-lg-4 lh-sm tracking-tight mb-4">
          Engineering High-Velocity <span class="text-gradient-cyan">Web Platforms</span> &amp; <span class="text-gradient-primary">Digital Growth</span> Systems.
        </h1>

        <!-- Subheadline / Description -->
        <p class="hero-desc text-slate-300 fs-6 lh-lg mb-4" style="max-width: 620px;">
          Azora Solution empowers ambitious businesses with bespoke high-converting websites, top-tier Google local map pack dominance, and intelligent 24/7 AI front-office voice automation. Scale your enterprise with zero capital strain from <strong class="text-white">$99/month</strong>.
        </p>

        <!-- Hero Actions -->
        <div class="hero-actions d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-3 mb-5">
          <button type="button" onclick="AZ.openQuoteModal()" class="btn-modern-primary py-3 px-4 shadow-lg">
            <span>Build Custom Scope &amp; Quote</span>
          </button>
          <a href="{{ route('services') }}" class="btn-modern-secondary py-3 px-4 text-center">
            <span>Explore All Capabilities</span>
          </a>
        </div>

        <!-- Proof Metrics Row -->
        <div class="hero-metrics row g-2 g-sm-3 pt-4 border-top border-secondary border-opacity-25 text-center text-sm-start">
          <div class="col-6 col-sm-3">
            <div class="hero-metric-box p-3 h-100">
              <div class="font-heading fs-2 fw-bolder text-white">
                <span class="counter" data-count="500">500</span><span class="text-azora-cyan">+</span>
              </div>
              <div class="font-mono-badge text-slate-400 small mt-1" style="font-size: 0.65rem; letter-spacing: 0.04em;">Platforms Live</div>
            </div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="hero-metric-box p-3 h-100">
              <div class="font-heading fs-2 fw-bolder text-white">
                $45M<span class="text-azora-cyan">+</span>
              </div>
              <div class="font-mono-badge text-slate-400 small mt-1" style="font-size: 0.65rem; letter-spacing: 0.04em;">Client Revenue</div>
            </div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="hero-metric-box p-3 h-100">
              <div class="font-heading fs-2 fw-bolder text-white">
                <span class="counter" data-count="99">99</span>.9<span class="text-azora-cyan">%</span>
              </div>
              <div class="font-mono-badge text-slate-400 small mt-1" style="font-size: 0.65rem; letter-spacing: 0.04em;">Uptime Maintained</div>
            </div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="hero-metric-box p-3 h-100">
              <div class="font-heading fs-2 fw-bolder text-white">
                &lt; 15<span class="text-azora-cyan">s</span>
              </div>
              <div class="font-mono-badge text-slate-400 small mt-1" style="font-size: 0.65rem; letter-spacing: 0.04em;">AI Response Time</div>
            </div>
          </div>
        </div>

      </div>

      <!-- Right Column: Live Dashboard Motion Cluster -->
      <div class="col-lg-6 hero-motion-col">
        <!-- Visually Hidden Summary for Screen Readers (Accessibility Requirement) -->
        <div class="visually-hidden">
          Live operations preview: 486 organic leads generated, #1 Google Map pack ranking, and 24/7 AI front office taking customer calls in real-time.
        </div>

        <!-- 3D Perspective Wrapper -->
        <div class="hero-motion-wrapper" id="heroMotionWrapper" aria-hidden="true">
          <!-- Floating Amber Toast Badge -->
          <div class="hero-toast-badge" id="heroToastBadge">New lead +1</div>

          <!-- 3D Inner Cluster -->
          <div class="hero-motion-cluster" id="heroMotionCluster">
            
            <!-- CARD A: AI Front Office - live call -->
            <div class="hero-glass-card hero-card-call">
              <div class="call-header-row">
                <div class="call-live-indicator">
                  <span class="call-pulse-dot"></span>
                  <span>AI Front Office &middot; live call</span>
                </div>
                <div class="call-timer" id="heroCallTimer">00:14</div>
              </div>
              <div class="call-transcript-container" id="heroCallTranscript" aria-live="off">
                <!-- Dynamically typed character-by-character with blinking cursor -->
              </div>
            </div>

            <!-- CARDS B & C SUB-ROW (50/50 Grid) -->
            <div class="hero-subcards-row">
              
              <!-- CARD B: Organic leads -->
              <div class="hero-glass-card hero-card-leads">
                <div>
                  <div class="card-eyebrow">Organic leads</div>
                  <div class="leads-big-number" id="heroLeadsNumber">0</div>
                  <div class="leads-metric-delta">
                    <span>&#9650;</span>
                    <span>212% vs last quarter</span>
                  </div>
                </div>
                <div class="sparkline-wrapper">
                  <svg class="sparkline-svg" viewBox="0 0 180 40" preserveAspectRatio="none">
                    <defs>
                      <linearGradient id="sparklineGrad" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#22D3EE" stop-opacity="0.3"/>
                        <stop offset="100%" stop-color="#22D3EE" stop-opacity="0.0"/>
                      </linearGradient>
                    </defs>
                    <path d="M0,34 Q30,30 55,22 T105,24 T145,12 T180,4 L180,40 L0,40 Z" fill="url(#sparklineGrad)"/>
                    <path id="heroSparklinePath" class="sparkline-path" d="M0,34 Q30,30 55,22 T105,24 T145,12 T180,4"/>
                  </svg>
                </div>
              </div>

              <!-- CARD C: Map pack rank -->
              <div class="hero-glass-card hero-card-rank">
                <div>
                  <div class="card-eyebrow">Map pack rank</div>
                  <div class="rank-big-number" id="heroRankNumber">#8</div>
                  <div class="rank-caption" title='Google Maps · "plumber near me"'>Google Maps &middot; "plumber near me"</div>
                </div>
                <div class="voice-wave-container" aria-hidden="true">
                  <span class="wave-bar"></span>
                  <span class="wave-bar"></span>
                  <span class="wave-bar"></span>
                  <span class="wave-bar"></span>
                  <span class="wave-bar"></span>
                  <span class="wave-bar"></span>
                  <span class="wave-bar"></span>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ======================= 2. CORE SERVICES SHOWCASE & CAROUSEL ======================= -->
<section id="services" class="service-showcase-section border-bottom border-secondary border-opacity-25">
  <div class="service-ambient-glow service-ambient-glow-1" aria-hidden="true"></div>
  <div class="service-ambient-glow service-ambient-glow-2" aria-hidden="true"></div>
  <div class="service-blueprint-grid" aria-hidden="true"></div>

  <div class="container-xl position-relative px-3 px-sm-4 px-lg-5" style="z-index: 2;">
    <!-- Section Header Row with Controls Hub -->
    <div class="service-header-wrap">
      <div class="row align-items-end justify-content-between g-4">
        <div class="col-lg-8">
          <div class="service-section-eyebrow mb-3">
            <span class="service-eyebrow-dot"></span>
            <span>INTEGRATED COMMERCE &amp; GROWTH</span>
          </div>
          <h2 class="font-heading service-section-title text-white">
            Full-Spectrum Digital <span class="text-gradient-cyan">Capabilities</span>
          </h2>
          <p class="service-section-desc text-slate-300 mb-0">
            Eliminate fragmented contractors. Azora engineers unified, high-converting digital platforms, search dominance, and autonomous voice intelligence.
          </p>
        </div>
        <div class="col-lg-4 text-lg-end d-flex justify-content-start justify-content-lg-end">
          <div class="service-nav-cluster">
            <button type="button" class="service-nav-btn prev" id="servicePrevBtn" aria-label="Previous service slide">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 18l-6-6 6-6"/></svg>
            </button>
            <span class="service-slide-counter" id="serviceSlideCounter" aria-live="polite">
              <span class="current-num">01</span> / 03
            </span>
            <button type="button" class="service-nav-btn next" id="serviceNextBtn" aria-label="Next service slide">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Carousel Viewport & Track -->
    <div class="service-carousel-viewport" id="serviceCarouselViewport" role="region" aria-roledescription="carousel" aria-label="Azora Core Services">
      <div class="service-carousel-track" id="serviceCarouselTrack">
        
        <!-- Slide 1: Custom Website Development -->
        <div class="service-carousel-slide" role="group" aria-roledescription="slide" aria-label="1 of 3: Custom Website Development">
          <div class="service-premium-card service-card-web">
            <div class="service-card-spotlight" aria-hidden="true"></div>
            <div class="service-card-top">
              <div class="service-card-header">
                <span class="service-badge-pill">PILLAR 01 · FULL-STACK WEB</span>
                <div class="service-icon-pod">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                  </svg>
                </div>
              </div>
              <h3 class="font-heading service-card-title">Custom Website Development</h3>
              <p class="service-card-desc">
                Lightning-fast, mobile-first business platforms built with clean code and conversion science. No clunky bloated page builders.
              </p>
              <div class="service-micro-stage">
                <div class="stage-browser-header">
                  <div class="stage-dots"><span></span><span></span><span></span></div>
                  <span class="stage-url-bar">azorasolution.com/web</span>
                </div>
                <div class="stage-vitals-row">
                  <span class="vital-chip"><i class="bi bi-lightning-charge-fill"></i> 99 Score</span>
                  <div class="vital-bar-wrap"><div class="vital-bar-fill"></div></div>
                  <span class="font-mono-badge small" style="font-size: 0.65rem; color: #10B981;">&lt; 0.4s TTFB</span>
                </div>
              </div>
              <ul class="service-features-list">
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Bespoke UX/UI design &amp; responsive layout</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Sub-second load times &amp; Core Web Vitals</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>High-conversion quoting &amp; lead funnels</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Continuous hosting &amp; 99.9% uptime SLA</span></li>
              </ul>
            </div>
            <div class="service-card-bottom">
              <div class="service-pricing-row">
                <span class="service-price-tag">From <strong>$99</strong>/mo</span>
                <span class="service-badge-guarantee">Flexible Month-to-Month</span>
              </div>
              <a href="{{ route('plans') }}#website-plans" class="btn-service-showcase" data-magnetic-btn>
                <span>Explore Web Plans</span>
                <svg class="cta-arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </a>
            </div>
          </div>
        </div>

        <!-- Slide 2: Local SEO & Map Pack -->
        <div class="service-carousel-slide" role="group" aria-roledescription="slide" aria-label="2 of 3: Local SEO and Map Pack">
          <div class="service-premium-card service-card-seo">
            <div class="service-card-spotlight" aria-hidden="true"></div>
            <div class="service-card-top">
              <div class="service-card-header">
                <span class="service-badge-pill">PILLAR 02 · ORGANIC DOMINANCE</span>
                <div class="service-icon-pod">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 6l-9.5 9.5-5-5L1 18"/></svg>
                </div>
              </div>
              <h3 class="font-heading service-card-title">Local SEO &amp; Organic Rankings</h3>
              <p class="service-card-desc">
                Capture high-value search intent when customers search for your services in your immediate geographic operating zone.
              </p>
              <div class="service-micro-stage">
                <div class="stage-seo-radar">
                  <div class="radar-left">
                    <div class="radar-target">
                      <div class="radar-ring"></div>
                      <div class="radar-ring radar-ring-2"></div>
                      <div class="radar-center-pin"></div>
                    </div>
                    <span class="radar-rank-badge">#1 Google Map Pack</span>
                  </div>
                  <span class="radar-delta">▲ +212% Calls</span>
                </div>
              </div>
              <ul class="service-features-list">
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Google Business Profile optimization</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Local keyword strategy &amp; citations sync</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Review acquisition &amp; reputation shield</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Monthly transparent ROI &amp; ranking audits</span></li>
              </ul>
            </div>
            <div class="service-card-bottom">
              <div class="service-pricing-row">
                <span class="service-price-tag">From <strong>$285</strong>/mo</span>
                <span class="service-badge-guarantee">Guaranteed Market Reach</span>
              </div>
              <a href="{{ route('plans') }}#marketing-plans" class="btn-service-showcase" data-magnetic-btn>
                <span>Explore SEO Packages</span>
                <svg class="cta-arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </a>
            </div>
          </div>
        </div>

        <!-- Slide 3: AI Front-Office Agents -->
        <div class="service-carousel-slide" role="group" aria-roledescription="slide" aria-label="3 of 3: AI Front-Office Agents">
          <div class="service-premium-card service-card-ai">
            <div class="service-card-spotlight" aria-hidden="true"></div>
            <div class="service-card-top">
              <div class="service-card-header">
                <span class="service-badge-pill">PILLAR 03 · AUTONOMOUS AGENTS</span>
                <div class="service-icon-pod">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3z"/>
                    <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                    <line x1="12" y1="19" x2="12" y2="23"/>
                    <line x1="8" y1="23" x2="16" y2="23"/>
                  </svg>
                </div>
              </div>
              <h3 class="font-heading service-card-title">AI Front-Office Voice &amp; Chat</h3>
              <p class="service-card-desc">
                Never miss a high-ticket customer again. 24/7 intelligent voice answering, calendar booking, and WhatsApp conversational qualification.
              </p>
              <div class="service-micro-stage">
                <div class="stage-ai-waves">
                  <div class="ai-wave-bars">
                    <span class="ai-wave-bar"></span><span class="ai-wave-bar"></span>
                    <span class="ai-wave-bar"></span><span class="ai-wave-bar"></span>
                    <span class="ai-wave-bar"></span>
                  </div>
                  <span class="ai-status-chip">● Live Voice &middot; &lt; 2 Rings</span>
                </div>
              </div>
              <ul class="service-features-list">
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Instant call pickup within 2 rings 24/7/365</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Human-level qualification &amp; scheduling</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Automated quote dispatch &amp; instant SMS alert</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Direct two-way CRM &amp; calendar sync</span></li>
              </ul>
            </div>
            <div class="service-card-bottom">
              <div class="service-pricing-row">
                <span class="service-price-tag">Bespoke <strong>AI Architecture</strong></span>
                <span class="service-badge-guarantee">Zero Capital Strain</span>
              </div>
              <button type="button" onclick="AZ.openQuoteModal('ai-voice-receptionist')" class="btn-service-showcase" data-magnetic-btn>
                <span>Inquire for Custom AI</span>
                <svg class="cta-arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </button>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Pagination Progress Dots -->
    <div class="service-pagination-wrap" id="servicePaginationWrap" role="tablist">
      <button type="button" class="service-page-dot is-active" data-slide-to="0" aria-label="Slide 1"></button>
      <button type="button" class="service-page-dot" data-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" class="service-page-dot" data-slide-to="2" aria-label="Slide 3"></button>
    </div>
  </div>
</section>

<!-- ======================= 3. DEVELOPMENT FRAMEWORK / PROCESS ======================= -->
<section id="engineering-cycle-section" class="cycle-section-wrap position-relative border-bottom border-secondary border-opacity-25 py-5 py-lg-5">
  <!-- Atmospheric Drift Glow & Particles -->
  <div class="cycle-bg-glow" aria-hidden="true"></div>
  <div class="cycle-particles-wrap" aria-hidden="true">
    <span class="cycle-particle"></span>
    <span class="cycle-particle"></span>
    <span class="cycle-particle"></span>
    <span class="cycle-particle"></span>
    <span class="cycle-particle"></span>
    <span class="cycle-particle"></span>
    <span class="cycle-particle"></span>
    <span class="cycle-particle"></span>
    <span class="cycle-particle"></span>
    <span class="cycle-particle"></span>
  </div>

  <!-- Traveling Pulse Indicator along 01 -> 02 -> 04 -> 03 -> 01 Loop -->
  <div id="cycle-travel-pulse" class="cycle-travel-pulse" aria-hidden="true"></div>

  <div class="container-xl position-relative px-3 px-sm-4 px-lg-5" style="z-index: 2;">
    
    <div class="row align-items-center g-5">
      <!-- Left Column: Entrance Sequence -->
      <div class="col-lg-5">
        <span class="azora-badge cycle-pill mb-3">HOW WE DELIVER</span>
        <h2 class="font-heading fw-bolder text-white display-6 mb-3">
          <span class="cycle-heading-mask">
            <span class="cycle-heading-line cycle-heading-line-1">Predictable 4-Stage</span>
          </span>
          <span class="cycle-heading-mask">
            <span class="cycle-heading-line cycle-heading-line-2">Engineering Cycle</span>
          </span>
        </h2>
        <p class="text-slate-300 lh-base mb-4 cycle-paragraph">
          From the initial architecture blueprint to continuous growth optimization, our team delivers transparent milestones with zero guesswork.
        </p>
        <button type="button" onclick="AZ.openQuoteModal()" class="btn-modern-primary cycle-btn py-2 px-4 small">
          <span>Get Started Today</span>
        </button>
      </div>

      <!-- Right Column: 4 Staggered Engineering Cards -->
      <div class="col-lg-7">
        <div class="row g-3 cycle-cards-grid">
          <!-- Card 01 -->
          <div class="col-sm-6">
            <x-card number="01" title="Discovery & Blueprint" description="We map your commercial goals, competitors, target keywords, and user conversion pathways." class="h-100" />
          </div>

          <!-- Card 02 -->
          <div class="col-sm-6">
            <x-card number="02" title="High-Fidelity Architecture" description="Custom responsive design crafted specifically for your brand with modern UX interaction patterns." class="h-100" />
          </div>

          <!-- Card 03 -->
          <div class="col-sm-6">
            <x-card number="03" title="Full-Stack Deployment" description="Clean code engineering, enterprise cloud hosting, and rigorous multi-device testing." class="h-100" />
          </div>

          <!-- Card 04 -->
          <div class="col-sm-6">
            <x-card number="04" title="Organic Scale & Support" description="Continuous monitoring, Google Map Pack dominance, speed maintenance, and regular strategic updates." class="h-100" />
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ======================= 4. TRANSPARENT PRICING PLANS ======================= -->
<section id="pricing" class="position-relative border-bottom border-secondary border-opacity-25 py-5 py-lg-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    
    <div class="text-center mx-auto mb-5 rv" style="max-width: 680px;">
      <span class="azora-badge mb-3">TRANSPARENT VALUE</span>
      <h2 class="font-heading fw-bolder text-white display-6 mb-3">
        Engineered Plans with Zero Hidden Fees
      </h2>
      <p class="text-slate-300 lh-base">
        Select a high-ROI monthly plan or combine website design and organic marketing for maximum market impact.
      </p>

      <!-- Pricing Tab Filters -->
        <button type="button" class="filter-pill" id="price-tab-marketing" onclick="switchPriceTab('marketing')">Local SEO &amp; Marketing</button>
      <button type="button" class="filter-pill active" id="price-tab-web" onclick="switchPriceTab('web')">Website Development</button>
    </div>

    <!-- Web Plans Pane -->
    <div id="pricing-pane-web">
      <div class="row g-4 justify-content-center gsap-stagger-group">
        
        <!-- Starter Plan -->
        <div class="col-md-6 col-lg-4 gsap-stagger-item rv in">
          <div class="service-premium-card service-card-web h-100" data-motion-card>
            <div class="service-card-spotlight" aria-hidden="true"></div>
            <div class="service-card-top">
              <div class="service-card-header">
                <span class="service-badge-pill">TIER 01 · FOUNDATION</span>
                <span class="font-mono-badge small" style="font-size: 0.65rem; color: #10B981;">LOCAL BRANDS</span>
              </div>
              <h3 class="font-heading service-card-title mt-2">Website Starter</h3>
              <p class="service-card-desc">
                Everything a business needs to establish credibility online and turn searchers into calls.
              </p>
              <div class="service-micro-stage my-3">
                <div class="d-flex align-items-baseline justify-content-between p-2">
                  <div class="d-flex align-items-baseline gap-1">
                    <span class="font-heading display-6 fw-bolder text-white">$99</span>
                    <span class="service-badge-guarantee">/month</span>
                  </div>
                  <span class="vital-chip"><i class="bi bi-shield-check"></i> 5 Pages</span>
                </div>
              </div>
              <ul class="service-features-list">
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Professional custom responsive website</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Up to 5 conversion-focused pages</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Interactive contact &amp; rapid quote forms</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Basic SEO metadata &amp; speed optimization</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Managed cloud hosting &amp; SSL included</span></li>
              </ul>
            </div>
            <div class="service-card-bottom">
              <div class="service-pricing-row">
                <span class="service-price-tag">From <strong>$99</strong>/mo</span>
                <span class="service-badge-guarantee">Month-to-Month</span>
              </div>
              <a href="{{ route('quote', ['type' => 'plan', 'product' => 'website-starter']) }}" class="btn-service-showcase" data-magnetic-btn>
                <span>Get Started</span>
                <svg class="cta-arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </a>
            </div>
          </div>
        </div>

        <!-- Growth Plan (Featured) -->
        <div class="col-md-6 col-lg-4 gsap-stagger-item rv in rv-d2">
          <div class="service-premium-card service-card-ai pricing-card-highlight h-100" data-motion-card style="--card-accent: #38BDF8;">
            <div class="service-card-spotlight" aria-hidden="true"></div>
            <div class="service-card-top">
              <div class="service-card-header">
                <span class="service-badge-pill" style="background: rgba(56, 189, 248, 0.15); border-color: rgba(56, 189, 248, 0.4);">TIER 02 · MOST POPULAR</span>
                <span class="badge bg-primary rounded-pill font-mono-badge" style="font-size: 0.6rem;">HIGH CONVERSION</span>
              </div>
              <h3 class="font-heading service-card-title mt-2">Website Growth</h3>
              <p class="service-card-desc">
                Engineered to turn traffic into consistent customer phone calls, quote requests, and booked appointments.
              </p>
              <div class="service-micro-stage my-3">
                <div class="d-flex align-items-baseline justify-content-between p-2">
                  <div class="d-flex align-items-baseline gap-1">
                    <span class="font-heading display-6 fw-bolder text-gradient-cyan">$185</span>
                    <span class="service-badge-guarantee">/month</span>
                  </div>
                  <span class="vital-chip" style="color: #38BDF8; border-color: rgba(56, 189, 248, 0.3);"><i class="bi bi-star-fill"></i> Best ROI</span>
                </div>
              </div>
              <ul class="service-features-list">
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span><strong>Everything in Starter</strong></span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Up to 10 bespoke high-performance pages</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Conversion-optimized booking architecture</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Advanced technical SEO &amp; rich snippets</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Monthly content updates &amp; security maintenance</span></li>
              </ul>
            </div>
            <div class="service-card-bottom">
              <div class="service-pricing-row">
                <span class="service-price-tag">From <strong>$185</strong>/mo</span>
                <span class="service-badge-guarantee">Guaranteed Performance</span>
              </div>
              <a href="{{ route('quote', ['type' => 'plan', 'product' => 'website-growth']) }}" class="btn-service-showcase" data-magnetic-btn>
                <span>Choose Growth</span>
                <svg class="cta-arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </a>
            </div>
          </div>
        </div>

        <!-- Premium Plan -->
        <div class="col-md-6 col-lg-4 gsap-stagger-item rv in rv-d3">
          <div class="service-premium-card service-card-seo h-100" data-motion-card style="--card-accent: #C084FC; --card-spotlight: rgba(192, 132, 252, 0.12); --card-border-glow: rgba(192, 132, 252, 0.35);">
            <div class="service-card-spotlight" aria-hidden="true"></div>
            <div class="service-card-top">
              <div class="service-card-header">
                <span class="service-badge-pill" style="color: #C084FC; border-color: rgba(192, 132, 252, 0.28); background: rgba(192, 132, 252, 0.08);">TIER 03 · ENTERPRISE</span>
                <span class="font-mono-badge small" style="font-size: 0.65rem; color: #C084FC;">SCALE BRANDS</span>
              </div>
              <h3 class="font-heading service-card-title mt-2">Website Premium</h3>
              <p class="service-card-desc">
                Maximum visibility and performance for ambitious businesses scaling multi-territory operations.
              </p>
              <div class="service-micro-stage my-3">
                <div class="d-flex align-items-baseline justify-content-between p-2">
                  <div class="d-flex align-items-baseline gap-1">
                    <span class="font-heading display-6 fw-bolder text-white" style="color: #C084FC !important;">$249</span>
                    <span class="service-badge-guarantee">/month</span>
                  </div>
                  <span class="vital-chip" style="color: #C084FC; border-color: rgba(192, 132, 252, 0.3);"><i class="bi bi-lightning-charge"></i> Priority SLA</span>
                </div>
              </div>
              <ul class="service-features-list">
                <li class="service-feature-item"><span class="service-feature-bullet" style="color: #C084FC;">✦</span><span><strong>Everything in Growth</strong></span></li>
                <li class="service-feature-item"><span class="service-feature-bullet" style="color: #C084FC;">✦</span><span>Unlimited content sections &amp; landing pages</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet" style="color: #C084FC;">✦</span><span>Advanced multi-step conversion funnels</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet" style="color: #C084FC;">✦</span><span>Priority engineering &amp; same-day turnaround</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet" style="color: #C084FC;">✦</span><span>Continuous A/B testing &amp; speed audits</span></li>
              </ul>
            </div>
            <div class="service-card-bottom">
              <div class="service-pricing-row">
                <span class="service-price-tag">From <strong style="color: #C084FC;">$249</strong>/mo</span>
                <span class="service-badge-guarantee">Full Turnkey SLA</span>
              </div>
              <a href="{{ route('quote', ['type' => 'plan', 'product' => 'website-premium']) }}" class="btn-service-showcase" data-magnetic-btn>
                <span>Go Premium</span>
                <svg class="cta-arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Marketing Plans Pane -->
    <div id="pricing-pane-marketing" class="d-none">
      <div class="row g-4 justify-content-center gsap-stagger-group">
        
        <!-- Local Starter -->
        <div class="col-md-6 col-lg-4 gsap-stagger-item">
          <div class="service-premium-card service-card-web h-100" data-motion-card>
            <div class="service-card-spotlight" aria-hidden="true"></div>
            <div class="service-card-top">
              <div class="service-card-header">
                <span class="service-badge-pill">GROWTH 01 · LOCAL</span>
                <span class="font-mono-badge small" style="font-size: 0.65rem; color: #10B981;">GEO TARGET</span>
              </div>
              <h3 class="font-heading service-card-title mt-2">Local Marketing Starter</h3>
              <p class="service-card-desc">
                Strong local presence to help nearby customers find, trust, and call your business first.
              </p>
              <div class="service-micro-stage my-3">
                <div class="d-flex align-items-baseline justify-content-between p-2">
                  <div class="d-flex align-items-baseline gap-1">
                    <span class="font-heading display-6 fw-bolder text-white">$285</span>
                    <span class="service-badge-guarantee">/month</span>
                  </div>
                  <span class="vital-chip"><i class="bi bi-geo-alt-fill"></i> Local Map</span>
                </div>
              </div>
              <ul class="service-features-list">
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Google Business Profile audit &amp; optimization</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>High-intent local keyword strategy</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>40+ local citations &amp; directory sync</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Monthly ranking &amp; call volume analytics</span></li>
              </ul>
            </div>
            <div class="service-card-bottom">
              <div class="service-pricing-row">
                <span class="service-price-tag">From <strong>$285</strong>/mo</span>
                <span class="service-badge-guarantee">No Long Contracts</span>
              </div>
              <a href="{{ route('quote', ['type' => 'plan', 'product' => 'marketing-starter']) }}" class="btn-service-showcase" data-magnetic-btn>
                <span>Get Started</span>
                <svg class="cta-arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </a>
            </div>
          </div>
        </div>

        <!-- Marketing Growth -->
        <div class="col-md-6 col-lg-4 gsap-stagger-item">
          <div class="service-premium-card service-card-seo pricing-card-highlight h-100" data-motion-card>
            <div class="service-card-spotlight" aria-hidden="true"></div>
            <div class="service-card-top">
              <div class="service-card-header">
                <span class="service-badge-pill">GROWTH 02 · ACCELERATOR</span>
                <span class="badge bg-primary rounded-pill font-mono-badge" style="font-size: 0.6rem;">RECOMMENDED</span>
              </div>
              <h3 class="font-heading service-card-title mt-2">SEO &amp; Growth Marketing</h3>
              <p class="service-card-desc">
                Deep search engine dominance for businesses serious about owning the #1 spot in their market.
              </p>
              <div class="service-micro-stage my-3">
                <div class="d-flex align-items-baseline justify-content-between p-2">
                  <div class="d-flex align-items-baseline gap-1">
                    <span class="font-heading display-6 fw-bolder text-gradient-cyan">$365</span>
                    <span class="service-badge-guarantee">/month</span>
                  </div>
                  <span class="vital-chip" style="color: #38BDF8; border-color: rgba(56, 189, 248, 0.3);"><i class="bi bi-graph-up-arrow"></i> +212% Calls</span>
                </div>
              </div>
              <ul class="service-features-list">
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span><strong>Everything in Local Starter</strong></span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Aggressive commercial keyword positioning</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Technical on-page schema &amp; content optimization</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Competitor backlink gap analysis &amp; defense</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Monthly strategic review &amp; roadmap call</span></li>
              </ul>
            </div>
            <div class="service-card-bottom">
              <div class="service-pricing-row">
                <span class="service-price-tag">From <strong>$365</strong>/mo</span>
                <span class="service-badge-guarantee">Guaranteed Dominance</span>
              </div>
              <a href="{{ route('quote', ['type' => 'plan', 'product' => 'marketing-growth']) }}" class="btn-service-showcase" data-magnetic-btn>
                <span>Choose Growth</span>
                <svg class="cta-arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </a>
            </div>
          </div>
        </div>

        <!-- Market Leader -->
        <div class="col-md-6 col-lg-4 gsap-stagger-item">
          <div class="service-premium-card service-card-seo h-100" data-motion-card style="--card-accent: #C084FC; --card-spotlight: rgba(192, 132, 252, 0.12); --card-border-glow: rgba(192, 132, 252, 0.35);">
            <div class="service-card-spotlight" aria-hidden="true"></div>
            <div class="service-card-top">
              <div class="service-card-header">
                <span class="service-badge-pill" style="color: #C084FC; border-color: rgba(192, 132, 252, 0.28); background: rgba(192, 132, 252, 0.08);">GROWTH 03 · DOMINANCE</span>
                <span class="font-mono-badge small" style="font-size: 0.65rem; color: #C084FC;">REGIONAL LEADER</span>
              </div>
              <h3 class="font-heading service-card-title mt-2">Market Leader Plan</h3>
              <p class="service-card-desc">
                Unrivaled organic footprint for companies targeting multi-territory dominance and high-ticket clients.
              </p>
              <div class="service-micro-stage my-3">
                <div class="d-flex align-items-baseline justify-content-between p-2">
                  <div class="d-flex align-items-baseline gap-1">
                    <span class="font-heading display-6 fw-bolder text-white" style="color: #C084FC !important;">$399</span>
                    <span class="service-badge-guarantee">/month</span>
                  </div>
                  <span class="vital-chip" style="color: #C084FC; border-color: rgba(192, 132, 252, 0.3);"><i class="bi bi-trophy-fill"></i> #1 Rank</span>
                </div>
              </div>
              <ul class="service-features-list">
                <li class="service-feature-item"><span class="service-feature-bullet" style="color: #C084FC;">✦</span><span><strong>Everything in Growth Marketing</strong></span></li>
                <li class="service-feature-item"><span class="service-feature-bullet" style="color: #C084FC;">✦</span><span>Multi-location Google Map Pack dominance</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet" style="color: #C084FC;">✦</span><span>Dedicated landing page CRO &amp; call tracking</span></li>
                <li class="service-feature-item"><span class="service-feature-bullet" style="color: #C084FC;">✦</span><span>Continuous pipeline conversion defense</span></li>
              </ul>
            </div>
            <div class="service-card-bottom">
              <div class="service-pricing-row">
                <span class="service-price-tag">From <strong style="color: #C084FC;">$399</strong>/mo</span>
                <span class="service-badge-guarantee">Full Regional Scope</span>
              </div>
              <a href="{{ route('quote', ['type' => 'plan', 'product' => 'marketing-premium']) }}" class="btn-service-showcase" data-magnetic-btn>
                <span>Go Market Leader</span>
                <svg class="cta-arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
        </div>

      </div>
    </div>

  </div>
</section>

<!-- ======================= 5. FREQUENTLY ASKED QUESTIONS ======================= -->
<section id="faq" class="position-relative border-bottom border-secondary border-opacity-25 py-5 py-lg-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5" style="max-width: 900px;">
    
    <div class="text-center mx-auto mb-5 rv">
      <span class="azora-badge mb-3">CLEAR ANSWERS</span>
      <h2 class="font-heading fw-bolder text-white display-6 mb-3">
        Frequently Asked Questions
      </h2>
      <p class="text-slate-300">
        Everything you need to know about partnering with Azora Solution.
      </p>
    </div>

    <div class="d-flex flex-column gap-2">
      
      <div class="faq-modern-item open">
        <button type="button" class="btn w-100 text-start p-4 d-flex justify-content-between align-items-center faq-toggle-btn" onclick="AZ.toggleFaq(this)">
          <span class="fw-bold fs-6">How quickly can our new website be launched?</span>
          <i class="bi bi-chevron-down text-azora-cyan"></i>
        </button>
        <div class="faq-modern-panel px-4 pb-4">
          <p class="text-slate-400 small lh-base mb-0">
            Standard websites typically launch within 7 to 14 business days from scope confirmation. Complex enterprise architectures with custom booking integrations take 3 to 4 weeks. You have a dedicated US project manager guiding every phase.
          </p>
        </div>
      </div>

      <div class="faq-modern-item">
        <button type="button" class="btn w-100 text-start p-4 d-flex justify-content-between align-items-center faq-toggle-btn" onclick="AZ.toggleFaq(this)">
          <span class="fw-bold fs-6">Are there long-term contracts or hidden setup fees?</span>
          <i class="bi bi-chevron-down text-azora-cyan"></i>
        </button>
        <div class="faq-modern-panel px-4 pb-4">
          <p class="text-slate-400 small lh-base mb-0">
            No. Our plans operate on month-to-month terms without restrictive lock-ins. We earn your business every month through performance, measurable organic rankings, and responsive engineering support.
          </p>
        </div>
      </div>

      <div class="faq-modern-item">
        <button type="button" class="btn w-100 text-start p-4 d-flex justify-content-between align-items-center faq-toggle-btn" onclick="AZ.toggleFaq(this)">
          <span class="fw-bold fs-6">How does the 24/7 AI Voice Receptionist work?</span>
          <i class="bi bi-chevron-down text-azora-cyan"></i>
        </button>
        <div class="faq-modern-panel px-4 pb-4">
          <p class="text-slate-400 small lh-base mb-0">
            Our AI voice assistant links directly to your business phone line. It answers calls with human-like conversation, qualifies leads, schedules appointments, and sends instant SMS summaries to your phone within 15 seconds.
          </p>
        </div>
      </div>

      <div class="faq-modern-item">
        <button type="button" class="btn w-100 text-start p-4 d-flex justify-content-between align-items-center faq-toggle-btn" onclick="AZ.toggleFaq(this)">
          <span class="fw-bold fs-6">What makes Azora different from standard marketing agencies?</span>
          <i class="bi bi-chevron-down text-azora-cyan"></i>
        </button>
        <div class="faq-modern-panel px-4 pb-4">
          <p class="text-slate-400 small lh-base mb-0">
            We are software engineers and commercial architects, not marketers using generic WordPress templates. Every line of code is engineered for speed, conversion, security, and measurable ROI.
          </p>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ======================= 6. HEADQUARTERS & GOOGLE MAPS ======================= -->
<section id="contact-map" class="position-relative py-5 py-lg-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    <x-google-map />
  </div>
</section>
@endsection

@push('scripts')
<script>
  function switchHeroTab(tab) {
    var tabs = ['web', 'seo', 'ai'];
    tabs.forEach(function (t) {
      var btn = document.getElementById('tab-btn-' + t);
      var pane = document.getElementById('demo-pane-' + t);
      if (t === tab) {
        if (btn) {
          btn.style.backgroundColor = '#2469EB';
          btn.classList.add('text-white');
          btn.classList.remove('text-slate-400');
        }
        if (pane) pane.classList.remove('d-none');
      } else {
        if (btn) {
          btn.style.backgroundColor = 'transparent';
          btn.classList.remove('text-white');
          btn.classList.add('text-slate-400');
        }
        if (pane) pane.classList.add('d-none');
      }
    });
  }

  function switchPriceTab(tab) {
    var webBtn = document.getElementById('price-tab-web');
    var mktBtn = document.getElementById('price-tab-marketing');
    var webPane = document.getElementById('pricing-pane-web');
    var mktPane = document.getElementById('pricing-pane-marketing');

    if (tab === 'web') {
      if (webBtn) webBtn.classList.add('active');
      if (mktBtn) mktBtn.classList.remove('active');
      if (webPane) webPane.classList.remove('d-none');
      if (mktPane) mktPane.classList.add('d-none');
    } else {
      if (mktBtn) mktBtn.classList.add('active');
      if (webBtn) webBtn.classList.remove('active');
      if (mktPane) mktPane.classList.remove('d-none');
      if (webPane) webPane.classList.add('d-none');
    }
  }
</script>
<script src="{{ asset('assets/js/cycle-motion.js') }}" defer></script>
<script src="{{ asset('assets/js/service-showcase.js') }}" defer></script>
@endpush

