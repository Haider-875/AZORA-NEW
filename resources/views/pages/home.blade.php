@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/cycle-motion.css') }}" />
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
        <div class="hero-badge d-inline-flex align-items-center gap-2 rounded-pill px-3 py-1 mb-3 border border-info border-opacity-25" style="background: rgba(56, 189, 248, 0.1);">
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
        <div class="hero-metrics row g-3 pt-4 border-top border-secondary border-opacity-25 text-center text-sm-start">
          <div class="col-6 col-sm-3">
            <div class="font-heading fs-2 fw-bolder text-white">
              <span class="counter" data-count="500">500</span><span class="text-azora-cyan">+</span>
            </div>
            <div class="font-mono-badge text-slate-400 small mt-1" style="font-size: 0.65rem;">Platforms Live</div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="font-heading fs-2 fw-bolder text-white">
              $45M<span class="text-azora-cyan">+</span>
            </div>
            <div class="font-mono-badge text-slate-400 small mt-1" style="font-size: 0.65rem;">Client Revenue</div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="font-heading fs-2 fw-bolder text-white">
              <span class="counter" data-count="99">99</span>.9<span class="text-azora-cyan">%</span>
            </div>
            <div class="font-mono-badge text-slate-400 small mt-1" style="font-size: 0.65rem;">Uptime Maintained</div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="font-heading fs-2 fw-bolder text-white">
              &lt; 15<span class="text-azora-cyan">s</span>
            </div>
            <div class="font-mono-badge text-slate-400 small mt-1" style="font-size: 0.65rem;">AI Response Time</div>
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

<!-- ======================= 2. CORE SERVICES SECTION ======================= -->
<section id="services" class="position-relative border-bottom border-secondary border-opacity-25 py-5 py-lg-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    
    <div class="text-center mx-auto mb-5 rv" style="max-width: 680px;">
      <span class="azora-badge mb-3">INTEGRATED COMMERCE &amp; GROWTH</span>
      <h2 class="font-heading fw-bolder text-white display-6 mb-3">
        Everything You Need to Dominate Your Market
      </h2>
      <p class="text-slate-300 lh-base">
        Eliminate fragmented contractors. Azora provides unified, enterprise-grade digital architecture built to convert visitors into lifelong clients.
      </p>
    </div>

    <div class="row g-4 gsap-stagger-group">
      
      <!-- Service 1: Website Development -->
      <div class="col-md-6 col-lg-4 gsap-stagger-item rv in">
        <div class="glass-card-interactive p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
          <div>
            <div class="card-icon-box mb-3 text-emerald-400" style="background: rgba(16, 185, 129, 0.15);">
              <svg viewBox="0 0 24 24" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
              </svg>
            </div>
            <h3 class="font-heading fw-bold text-white fs-5 mb-2">Custom Website Development</h3>
            <p class="text-slate-400 small lh-base mb-4">
              Lightning-fast, mobile-first business platforms built with clean code and conversion science. No clunky bloated page builders.
            </p>
            <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-2 mb-4">
              <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-success"></i> Bespoke UX/UI design</li>
              <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-success"></i> Sub-second load times &amp; SEO markup</li>
              <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-success"></i> Lead generation &amp; quoting funnels</li>
            </ul>
          </div>
          <div class="border-top border-secondary border-opacity-25 pt-3">
            <a href="{{ route('plans') }}#website-plans" class="text-azora-cyan text-decoration-none fw-bold small d-inline-flex align-items-center gap-1">
              <span>View Website Plans from $99/mo</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Service 2: Local SEO & Map Pack Dominance -->
      <div class="col-md-6 col-lg-4 gsap-stagger-item rv in rv-d2">
        <div class="glass-card-interactive p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
          <div>
            <div class="card-icon-box mb-3 text-purple-400" style="background: rgba(192, 132, 252, 0.15);">
              <svg viewBox="0 0 24 24" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M23 6l-9.5 9.5-5-5L1 18"/>
              </svg>
            </div>
            <h3 class="font-heading fw-bold text-white fs-5 mb-2">Local SEO &amp; Organic Rankings</h3>
            <p class="text-slate-400 small lh-base mb-4">
              Capture high-value search intent when customers search for your services in your immediate geographic operating zone.
            </p>
            <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-2 mb-4">
              <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-success"></i> Google Business Profile optimization</li>
              <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-success"></i> Local keyword strategy &amp; citations</li>
              <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-success"></i> Monthly transparent ROI reports</li>
            </ul>
          </div>
          <div class="border-top border-secondary border-opacity-25 pt-3">
            <a href="{{ route('plans') }}#marketing-plans" class="text-azora-cyan text-decoration-none fw-bold small d-inline-flex align-items-center gap-1">
              <span>View SEO Packages from $285/mo</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Service 3: AI Front Office Automation -->
      <div class="col-md-6 col-lg-4 gsap-stagger-item rv in rv-d3">
        <div class="glass-card-interactive p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
          <div>
            <div class="card-icon-box mb-3 text-amber-400" style="background: rgba(251, 191, 36, 0.15);">
              <svg viewBox="0 0 24 24" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 2l1.9 5.6 5.8.2-4.6 3.6 1.7 5.8-4.8-3.4-4.8 3.4 1.7-5.8L4.3 7.8l5.8-.2z"/>
              </svg>
            </div>
            <h3 class="font-heading fw-bold text-white fs-5 mb-2">AI Front-Office Agents</h3>
            <p class="text-slate-400 small lh-base mb-4">
              Never miss a high-ticket customer again. 24/7 intelligent voice answering, calendar booking, and WhatsApp conversational qualification.
            </p>
            <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-2 mb-4">
              <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-success"></i> Instant call pickup within 2 rings</li>
              <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-success"></i> Automated quote dispatch</li>
              <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-success"></i> Real-time CRM synchronization</li>
            </ul>
          </div>
          <div class="border-top border-secondary border-opacity-25 pt-3">
            <button type="button" onclick="AZ.openQuoteModal('ai-voice-receptionist')" class="btn btn-link p-0 text-azora-cyan text-decoration-none fw-bold small d-inline-flex align-items-center gap-1">
              <span>Inquire for Custom AI Setup</span>
            </button>
          </div>
        </div>
      </div>

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
            <x-card number="01" title="Discovery &amp; Blueprint" description="We map your commercial goals, competitors, target keywords, and user conversion pathways." class="h-100" />
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
            <x-card number="04" title="Organic Scale &amp; Support" description="Continuous monitoring, Google Map Pack dominance, speed maintenance, and regular strategic updates." class="h-100" />
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
          <div class="glass-card-interactive p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
            <div>
              <span class="font-mono-badge text-slate-400 small">STARTER</span>
              <h3 class="font-heading fw-bold text-white fs-4 mt-1 mb-2">Website Starter</h3>
              <p class="text-slate-400 small mb-3">Everything a business needs to establish credibility online.</p>
              <div class="d-flex align-items-baseline gap-1 my-3">
                <span class="font-heading display-6 fw-bolder text-white">$99</span>
                <span class="text-slate-400 small">/month</span>
              </div>
              <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-2 mb-4">
                <li><i class="bi bi-check2 text-info me-2"></i> Professional business website</li>
                <li><i class="bi bi-check2 text-info me-2"></i> Mobile-responsive design</li>
                <li><i class="bi bi-check2 text-info me-2"></i> Up to 5 pages</li>
                <li><i class="bi bi-check2 text-info me-2"></i> Contact &amp; quote forms</li>
                <li><i class="bi bi-check2 text-info me-2"></i> Basic SEO setup &amp; speed optimization</li>
              </ul>
            </div>
            <a href="{{ route('quote', ['type' => 'plan', 'product' => 'website-starter']) }}" class="btn-modern-secondary w-100 py-2 text-center">
              <span>Get Started</span>
            </a>
          </div>
        </div>

        <!-- Growth Plan (Featured) -->
        <div class="col-md-6 col-lg-4 gsap-stagger-item rv in rv-d2">
          <div class="glass-card-interactive pricing-card-highlight p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
            <div>
              <div class="d-flex justify-content-between align-items-center">
                <span class="font-mono-badge text-azora-cyan small">GROWTH</span>
                <span class="badge bg-primary rounded-pill font-mono-badge" style="font-size: 0.6rem;">MOST POPULAR</span>
              </div>
              <h3 class="font-heading fw-bold text-white fs-4 mt-1 mb-2">Website Growth</h3>
              <p class="text-slate-300 small mb-3">Turn visitors into phone calls, quote requests, and booked jobs.</p>
              <div class="d-flex align-items-baseline gap-1 my-3">
                <span class="font-heading display-6 fw-bolder text-azora-cyan">$185</span>
                <span class="text-slate-400 small">/month</span>
              </div>
              <ul class="list-unstyled small text-white d-flex flex-column gap-2 mb-4">
                <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Everything in Starter</li>
                <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Up to 10 website pages</li>
                <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Conversion-optimized architecture</li>
                <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Advanced technical SEO schema</li>
                <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Monthly updates &amp; security maintenance</li>
              </ul>
            </div>
            <a href="{{ route('quote', ['type' => 'plan', 'product' => 'website-growth']) }}" class="btn-modern-primary w-100 py-2 text-center">
              <span>Choose Growth</span>
            </a>
          </div>
        </div>

        <!-- Premium Plan -->
        <div class="col-md-6 col-lg-4 gsap-stagger-item rv in rv-d3">
          <div class="glass-card-interactive p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
            <div>
              <span class="font-mono-badge text-slate-400 small">PREMIUM</span>
              <h3 class="font-heading fw-bold text-white fs-4 mt-1 mb-2">Website Premium</h3>
              <p class="text-slate-400 small mb-3">Maximum visibility and performance for ambitious scaling brands.</p>
              <div class="d-flex align-items-baseline gap-1 my-3">
                <span class="font-heading display-6 fw-bolder text-white">$249</span>
                <span class="text-slate-400 small">/month</span>
              </div>
              <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-2 mb-4">
                <li><i class="bi bi-check2 text-info me-2"></i> Everything in Growth</li>
                <li><i class="bi bi-check2 text-info me-2"></i> Unlimited content sections</li>
                <li><i class="bi bi-check2 text-info me-2"></i> Advanced conversion funnels</li>
                <li><i class="bi bi-check2 text-info me-2"></i> Priority engineering support</li>
                <li><i class="bi bi-check2 text-info me-2"></i> Continuous improvements &amp; A/B testing</li>
              </ul>
            </div>
            <a href="{{ route('quote', ['type' => 'plan', 'product' => 'website-premium']) }}" class="btn-modern-secondary w-100 py-2 text-center">
              <span>Go Premium</span>
            </a>
          </div>
        </div>

      </div>
    </div>

    <!-- Marketing Plans Pane -->
    <div id="pricing-pane-marketing" class="d-none">
      <div class="row g-4 justify-content-center gsap-stagger-group">
        
        <!-- Local Starter -->
        <div class="col-md-6 col-lg-4 gsap-stagger-item">
          <div class="glass-card-interactive p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
            <div>
              <span class="font-mono-badge text-slate-400 small">LOCAL STARTER</span>
              <h3 class="font-heading fw-bold text-white fs-4 mt-1 mb-2">Local Marketing Starter</h3>
              <p class="text-slate-400 small mb-3">Strong local presence to help nearby clients find and trust you.</p>
              <div class="d-flex align-items-baseline gap-1 my-3">
                <span class="font-heading display-6 fw-bolder text-white">$285</span>
                <span class="text-slate-400 small">/month</span>
              </div>
              <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-2 mb-4">
                <li><i class="bi bi-check2 text-info me-2"></i> Google Business Profile optimization</li>
                <li><i class="bi bi-check2 text-info me-2"></i> Local keyword strategy</li>
                <li><i class="bi bi-check2 text-info me-2"></i> Citation &amp; directory sync</li>
                <li><i class="bi bi-check2 text-info me-2"></i> Monthly performance report</li>
              </ul>
            </div>
            <a href="{{ route('quote', ['type' => 'plan', 'product' => 'marketing-starter']) }}" class="btn-modern-secondary w-100 py-2 text-center">
              <span>Get Started</span>
            </a>
          </div>
        </div>

        <!-- Marketing Growth -->
        <div class="col-md-6 col-lg-4 gsap-stagger-item">
          <div class="glass-card-interactive pricing-card-highlight p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
            <div>
              <div class="d-flex justify-content-between align-items-center">
                <span class="font-mono-badge text-azora-cyan small">GROWTH</span>
                <span class="badge bg-primary rounded-pill font-mono-badge" style="font-size: 0.6rem;">RECOMMENDED</span>
              </div>
              <h3 class="font-heading fw-bold text-white fs-4 mt-1 mb-2">SEO &amp; Growth Marketing</h3>
              <p class="text-slate-300 small mb-3">Deep optimization for businesses serious about dominating their town.</p>
              <div class="d-flex align-items-baseline gap-1 my-3">
                <span class="font-heading display-6 fw-bolder text-azora-cyan">$365</span>
                <span class="text-slate-400 small">/month</span>
              </div>
              <ul class="list-unstyled small text-white d-flex flex-column gap-2 mb-4">
                <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Everything in Local Starter</li>
                <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Advanced high-intent keyword targeting</li>
                <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> On-page technical SEO &amp; content</li>
                <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Competitor monitoring &amp; ranking audit</li>
                <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Monthly strategy call &amp; review</li>
              </ul>
            </div>
            <a href="{{ route('quote', ['type' => 'plan', 'product' => 'marketing-growth']) }}" class="btn-modern-primary w-100 py-2 text-center">
              <span>Choose Growth</span>
            </a>
          </div>
        </div>

        <!-- Market Leader -->
        <div class="col-md-6 col-lg-4 gsap-stagger-item">
          <div class="glass-card-interactive p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
            <div>
              <span class="font-mono-badge text-slate-400 small">LEADER</span>
              <h3 class="font-heading fw-bold text-white fs-4 mt-1 mb-2">Market Leader Plan</h3>
              <p class="text-slate-400 small mb-3">Unrivaled organic footprint for businesses scaling multi-territory.</p>
              <div class="d-flex align-items-baseline gap-1 my-3">
                <span class="font-heading display-6 fw-bolder text-white">$399</span>
                <span class="text-slate-400 small">/month</span>
              </div>
              <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-2 mb-4">
                <li><i class="bi bi-check2 text-info me-2"></i> Everything in Growth Marketing</li>
                <li><i class="bi bi-check2 text-info me-2"></i> Multi-location ranking campaigns</li>
                <li><i class="bi bi-check2 text-info me-2"></i> Landing page conversion strategy</li>
                <li><i class="bi bi-check2 text-info me-2"></i> Continuous lead pipeline optimization</li>
              </ul>
            </div>
            <a href="{{ route('quote', ['type' => 'plan', 'product' => 'marketing-premium']) }}" class="btn-modern-secondary w-100 py-2 text-center">
              <span>Go Market Leader</span>
            </a>
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
        <button type="button" class="btn w-100 text-start p-4 d-flex justify-content-between align-items-center text-white" onclick="AZ.toggleFaq(this)">
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
        <button type="button" class="btn w-100 text-start p-4 d-flex justify-content-between align-items-center text-white" onclick="AZ.toggleFaq(this)">
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
        <button type="button" class="btn w-100 text-start p-4 d-flex justify-content-between align-items-center text-white" onclick="AZ.toggleFaq(this)">
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
        <button type="button" class="btn w-100 text-start p-4 d-flex justify-content-between align-items-center text-white" onclick="AZ.toggleFaq(this)">
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
@endpush

