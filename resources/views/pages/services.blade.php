@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/service-showcase.css') }}" />
@endpush

@section('content')
<!-- HERO SECTION -->
<section class="position-relative overflow-hidden border-bottom border-secondary border-opacity-25 pb-5 pt-4 pt-lg-5">
  <div class="floating-orb floating-orb-primary position-absolute top-0 start-50 translate-middle-x pointer-events-none" style="width: 750px; height: 400px;" aria-hidden="true"></div>
  <div class="floating-orb floating-orb-cyan position-absolute top-50 start-0 translate-middle-y pointer-events-none" style="width: 320px; height: 320px;" aria-hidden="true"></div>

  <div class="container-xl position-relative px-3 px-sm-4 px-lg-5" style="z-index: 1;">
    <div class="rv in" style="max-width: 760px;">
      <span class="azora-badge mb-3">INTEGRATED COMMERCE &amp; GROWTH</span>
      <h1 class="font-heading fw-bolder text-white display-5 display-lg-4 lh-sm tracking-tight mb-4">
        Integrated Digital Architecture Built For Modern <span class="text-gradient-cyan">Enterprises</span>.
      </h1>
      <p class="text-slate-300 fs-6 lh-lg mb-0">
        Each service is engineered to function stand-alone or integrate seamlessly into a powerful customer acquisition system. We eliminate fragmented software vendors with unified engineering and transparent pricing.
      </p>
    </div>
  </div>
</section>

<!-- WHAT WE DELIVER -->
<section class="position-relative border-bottom border-secondary border-opacity-25 py-5 py-lg-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    
    <div class="text-center mx-auto mb-5 rv" style="max-width: 680px;">
      <span class="azora-badge mb-3">WHAT WE DELIVER</span>
      <h2 class="font-heading fw-bolder text-white display-6 mb-3">
        Full-Spectrum Digital Capabilities
      </h2>
      <p class="text-slate-300 lh-base">
        Engineered for speed, high conversion rates, organic ranking power, and autonomous operations.
      </p>
    </div>

    <div class="row g-4 align-items-stretch gsap-stagger-group">
      
      <!-- SERVICE 1: Website Design & Dev -->
      <div id="website-development" class="col-md-6 col-xl-4 gsap-stagger-item rv in">
        <div class="service-premium-card service-card-web h-100" data-motion-card>
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
              High-performance, mobile-first websites tailored for local businesses, lead capture, online quoting, and streamlined customer conversions.
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
              <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Custom responsive UI &amp; brand styling</span></li>
              <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Fast load speed &amp; Core Web Vitals optimization</span></li>
              <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Interactive quote, contact &amp; appointment forms</span></li>
              <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Continuous hosting, SSL &amp; maintenance updates</span></li>
            </ul>
          </div>
          <div class="service-card-bottom">
            <div class="service-pricing-row">
              <span class="service-price-tag">From <strong>$99</strong>/mo</span>
              <span class="service-badge-guarantee">Flexible Month-to-Month</span>
            </div>
            <div class="d-flex gap-2">
              <a href="{{ route('plans') }}#website-plans" class="btn-service-showcase flex-fill py-2 text-center" data-magnetic-btn>
                <span>View Plans</span>
              </a>
              <button type="button" onclick="AZ.openQuoteModal('website-growth')" class="btn-service-showcase flex-fill py-2" data-magnetic-btn>
                <span>Quote Web</span>
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- SERVICE 2: Local SEO & Google Presence -->
      <div id="seo-growth" class="col-md-6 col-xl-4 gsap-stagger-item rv in rv-d2">
        <div class="service-premium-card service-card-seo h-100" data-motion-card>
          <div class="service-card-spotlight" aria-hidden="true"></div>
          <div class="service-card-top">
            <div class="service-card-header">
              <span class="service-badge-pill">PILLAR 02 · ORGANIC DOMINANCE</span>
              <div class="service-icon-pod">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 21s-7-6-7-11a7 7 0 0 1 14 0c0 5-7 11-7 11z"/><circle cx="12" cy="10" r="2.6"/>
                </svg>
              </div>
            </div>
            <h3 class="font-heading service-card-title">Local SEO &amp; Google Map Pack</h3>
            <p class="service-card-desc">
              Rank in Google's Top 3 Local Map Pack and capture nearby high-intent searchers ready to call, visit, or buy.
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
              <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Google Business Profile auditing &amp; continuous optimization</span></li>
              <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>High-intent geo-targeted keyword positioning</span></li>
              <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Local citation cleanup &amp; 60+ directory syndication</span></li>
              <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Transparent monthly ranking &amp; conversion reporting</span></li>
            </ul>
          </div>
          <div class="service-card-bottom">
            <div class="service-pricing-row">
              <span class="service-price-tag">From <strong>$285</strong>/mo</span>
              <span class="service-badge-guarantee">Guaranteed Market Reach</span>
            </div>
            <div class="d-flex gap-2">
              <a href="{{ route('plans') }}#marketing-plans" class="btn-service-showcase flex-fill py-2 text-center" data-magnetic-btn>
                <span>View Plans</span>
              </a>
              <button type="button" onclick="AZ.openQuoteModal('marketing-growth')" class="btn-service-showcase flex-fill py-2" data-magnetic-btn>
                <span>Quote SEO</span>
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- SERVICE 3: Growth Marketing & Lead Gen -->
      <div class="col-md-6 col-xl-4 gsap-stagger-item rv in rv-d3">
        <div class="service-premium-card service-card-seo h-100" data-motion-card style="--card-accent: #C084FC; --card-spotlight: rgba(192, 132, 252, 0.12); --card-border-glow: rgba(192, 132, 252, 0.35);">
          <div class="service-card-spotlight" aria-hidden="true"></div>
          <div class="service-card-top">
            <div class="service-card-header">
              <span class="service-badge-pill" style="color: #C084FC; border-color: rgba(192, 132, 252, 0.28); background: rgba(192, 132, 252, 0.08);">PILLAR 03 · LEAD ACQUISITION</span>
              <div class="service-icon-pod" style="color: #C084FC; background: rgba(192, 132, 252, 0.15);">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M3 17l6-6 4 4 8-8"/><path d="M15 7h6v6"/>
                </svg>
              </div>
            </div>
            <h3 class="font-heading service-card-title">Growth Campaigns &amp; Funnels</h3>
            <p class="service-card-desc">
              Targeted digital campaigns, conversion funnels, and landing pages designed to generate predictable customer pipeline.
            </p>
            <div class="service-micro-stage">
              <div class="d-flex align-items-center justify-content-between p-2">
                <span class="vital-chip" style="color: #C084FC; background: rgba(192, 132, 252, 0.1); border-color: rgba(192, 132, 252, 0.25);"><i class="bi bi-funnel-fill"></i> Multi-Channel Lead Sync</span>
                <span class="radar-delta" style="color: #C084FC;">▲ 4.8x Velocity</span>
              </div>
            </div>
            <ul class="service-features-list">
              <li class="service-feature-item"><span class="service-feature-bullet" style="color: #C084FC;">✦</span><span>High-converting campaign landing pages</span></li>
              <li class="service-feature-item"><span class="service-feature-bullet" style="color: #C084FC;">✦</span><span>Competitor positioning &amp; keyword gap strategy</span></li>
              <li class="service-feature-item"><span class="service-feature-bullet" style="color: #C084FC;">✦</span><span>Multi-channel lead tracking &amp; call attribution</span></li>
              <li class="service-feature-item"><span class="service-feature-bullet" style="color: #C084FC;">✦</span><span>Ongoing strategy reviews and conversion optimization</span></li>
            </ul>
          </div>
          <div class="service-card-bottom">
            <div class="service-pricing-row">
              <span class="service-price-tag">Scalable <strong>Growth Scope</strong></span>
              <span class="service-badge-guarantee">Zero Retainer Lock-in</span>
            </div>
            <button type="button" onclick="AZ.openQuoteModal('marketing-premium')" class="btn-service-showcase w-100 py-2 justify-content-center" data-magnetic-btn>
              <span>Launch Growth Campaign</span>
              <svg class="cta-arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- SERVICE 4: AI Front Office -->
      <div id="ai-front-office" class="col-md-6 col-xl-4 gsap-stagger-item rv in">
        <div class="service-premium-card service-card-ai h-100" data-motion-card>
          <div class="service-card-spotlight" aria-hidden="true"></div>
          <div class="service-card-top">
            <div class="service-card-header">
              <span class="service-badge-pill">PILLAR 04 · AUTONOMOUS AGENTS</span>
              <div class="service-icon-pod">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3z"/>
                  <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                  <line x1="12" y1="19" x2="12" y2="23"/>
                  <line x1="8" y1="23" x2="16" y2="23"/>
                </svg>
              </div>
            </div>
            <h3 class="font-heading service-card-title">AI Voice &amp; WhatsApp Reception</h3>
            <p class="service-card-desc">
              An intelligent front office that answers calls in natural voice, replies on WhatsApp, qualifies leads, and schedules appointments.
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
              <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Natural human-like conversational voice receptionist</span></li>
              <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>WhatsApp auto-replies, FAQs &amp; estimates</span></li>
              <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Automated calendar booking &amp; CRM pipeline routing</span></li>
              <li class="service-feature-item"><span class="service-feature-bullet">✦</span><span>Zero calls or inbound inquiries left unaddressed</span></li>
            </ul>
          </div>
          <div class="service-card-bottom">
            <div class="service-pricing-row">
              <span class="service-price-tag">Bespoke <strong>AI Architecture</strong></span>
              <span class="service-badge-guarantee">24/7 Operations</span>
            </div>
            <button type="button" onclick="AZ.openQuoteModal('ai-voice-receptionist')" class="btn-service-showcase w-100 py-2 justify-content-center" data-magnetic-btn>
              <span>Deploy AI Reception</span>
              <svg class="cta-arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </button>
          </div>
        </div>
      </div>

      <!-- SERVICE 5: Enterprise Cloud Systems & Custom Software -->
      <div id="custom-software" class="col-md-12 col-xl-8 gsap-stagger-item rv in rv-d2">
        <div class="service-premium-card service-card-web h-100 p-4 p-md-5" data-motion-card style="--card-accent: #38BDF8;">
          <div class="service-card-spotlight" aria-hidden="true"></div>
          <div class="service-card-top">
            <div class="service-card-header">
              <span class="service-badge-pill">PILLAR 05 · CLOUD ARCHITECTURE</span>
              <div class="service-icon-pod">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
                  <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
                  <line x1="6" y1="6" x2="6.01" y2="6"></line>
                  <line x1="6" y1="18" x2="6.01" y2="18"></line>
                </svg>
              </div>
            </div>

            <div class="row g-4 align-items-center">
              <div class="col-lg-6">
                <h3 class="font-heading service-card-title fs-3 mb-3">Custom Enterprise Software &amp; Cloud Workflows</h3>
                <p class="service-card-desc lh-lg mb-0">
                  When off-the-shelf software doesn't fit your operational workflow, Azora engineers bespoke web platforms, client portals, automated quotation systems, and secure cloud databases built with Laravel, PHP, and scalable database backends.
                </p>
              </div>
              <div class="col-lg-6">
                <div class="service-micro-stage mb-3">
                  <div class="d-flex align-items-center justify-content-between p-2">
                    <span class="vital-chip"><i class="bi bi-shield-lock-fill"></i> Enterprise Cloud SLA</span>
                    <span class="font-mono-badge small" style="font-size: 0.7rem; color: #10B981;">99.9% Uptime</span>
                  </div>
                </div>
                <ul class="service-features-list border-0 pt-0 mb-0">
                  <li class="service-feature-item">
                    <span class="service-feature-bullet">✦</span>
                    <span>Secure role-based authentication, admin dashboards &amp; reporting</span>
                  </li>
                  <li class="service-feature-item">
                    <span class="service-feature-bullet">✦</span>
                    <span>High-throughput API integrations, webhooks &amp; automated notification pipelines</span>
                  </li>
                  <li class="service-feature-item">
                    <span class="service-feature-bullet">✦</span>
                    <span>Reliable database schema design, automated backups, and 99.9% uptime SLA</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="service-card-bottom mt-4">
            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
              <span class="service-badge-guarantee">Bespoke integrations, custom business software, and enterprise cloud pipelines</span>
              <button type="button" onclick="AZ.openQuoteModal('custom-business-software')" class="btn-service-showcase py-2 px-4" data-magnetic-btn>
                <span>Request Software Scope</span>
                <svg class="cta-arrow-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </button>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- HEADQUARTERS & MAP -->
<section class="position-relative py-5 py-lg-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    <x-google-map />
  </div>
</section>
@endsection

