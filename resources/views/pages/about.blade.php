@extends('layouts.app')

@section('content')
<!-- HERO SECTION -->
<section class="position-relative overflow-hidden border-bottom border-secondary border-opacity-25 pb-5 pt-4 pt-lg-5">
  <div class="floating-orb floating-orb-primary position-absolute top-0 start-50 translate-middle-x pointer-events-none" style="width: 700px; height: 400px;" aria-hidden="true"></div>
  <div class="floating-orb floating-orb-indigo position-absolute top-50 start-0 translate-middle-y pointer-events-none" style="width: 300px; height: 300px;" aria-hidden="true"></div>

  <div class="container-xl position-relative px-3 px-sm-4 px-lg-5" style="z-index: 1;">
    <div class="rv in" style="max-width: 720px;">
      <span class="azora-badge mb-3">ABOUT AZORA SOLUTION</span>
      <h1 class="font-heading fw-bolder text-white display-5 display-lg-4 lh-sm tracking-tight mb-4">
        Engineering high-velocity <span class="text-gradient-cyan">digital growth</span> and modern web infrastructure.
      </h1>
      <p class="text-slate-300 fs-6 lh-lg mb-0">
        Azora Solution eliminates the fragmentation between high-converting digital storefronts, local search authority, and autonomous customer communication. We provide American enterprises with the infrastructure required to scale efficiently without capital exhaustion.
      </p>
    </div>

    <!-- Metrics Grid -->
    <div class="row g-3 g-sm-4 mt-4 rv in rv-d2 gsap-stagger-group">
      <div class="col-6 col-lg-3 gsap-stagger-item">
        <div class="glass-panel stat-box rounded-4 p-4 text-center h-100">
          <div class="font-heading display-6 fw-bolder text-white">
            <span class="counter" data-count="500">500</span><span class="text-azora-cyan">+</span>
          </div>
          <div class="font-mono-badge text-slate-400 small mt-2" style="font-size: 0.65rem;">Platforms Live</div>
        </div>
      </div>
      <div class="col-6 col-lg-3 gsap-stagger-item">
        <div class="glass-panel stat-box rounded-4 p-4 text-center h-100">
          <div class="font-heading display-6 fw-bolder text-white">
            <span class="counter" data-count="340">340</span><span class="text-azora-cyan">+</span>
          </div>
          <div class="font-mono-badge text-slate-400 small mt-2" style="font-size: 0.65rem;">Enterprises Powered</div>
        </div>
      </div>
      <div class="col-6 col-lg-3 gsap-stagger-item">
        <div class="glass-panel stat-box rounded-4 p-4 text-center h-100">
          <div class="font-heading display-6 fw-bolder text-white">
            $99<span class="text-azora-cyan fs-5 fw-bold">/mo</span>
          </div>
          <div class="font-mono-badge text-slate-400 small mt-2" style="font-size: 0.65rem;">Entry Plan /mo</div>
        </div>
      </div>
      <div class="col-6 col-lg-3 gsap-stagger-item">
        <div class="glass-panel stat-box rounded-4 p-4 text-center h-100">
          <div class="font-heading display-6 fw-bolder text-white">
            50<span class="text-azora-cyan fs-5 fw-bold"> States</span>
          </div>
          <div class="font-mono-badge text-slate-400 small mt-2" style="font-size: 0.65rem;">Nationwide Coverage</div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- WHAT WE DO -->
<section class="position-relative border-bottom border-secondary border-opacity-25 py-5 py-lg-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    
    <div class="text-center mx-auto mb-5 rv" style="max-width: 680px;">
      <span class="azora-badge mb-3">OUR CORE COMPETENCIES</span>
      <h2 class="font-heading fw-bolder text-white display-6 mb-3">
        What We Do
      </h2>
      <p class="text-slate-300 lh-base">
        A cohesive suite of bespoke web architecture, local search dominance, and AI front-office automation designed to eliminate operational friction.
      </p>
    </div>

    <div class="row g-4 gsap-stagger-group">
      
      <div class="col-md-6 col-lg-4 gsap-stagger-item rv in">
        <div class="glass-card-interactive p-4 h-100" data-motion-card>
          <div class="card-icon-box mb-3 text-azora-cyan" style="background: rgba(56, 189, 248, 0.15);">
            <svg viewBox="0 0 24 24" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 8h10M7 12h10M7 16h4"/>
            </svg>
          </div>
          <h3 class="font-heading fw-bold text-white fs-5 mb-2">Enterprise Web Platforms</h3>
          <p class="text-slate-300 small lh-base mb-0">
            Custom engineered web platforms, modern client portals, and responsive architectures with sub-second performance and enterprise security.
          </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 gsap-stagger-item rv in rv-d2">
        <div class="glass-card-interactive p-4 h-100" data-motion-card>
          <div class="card-icon-box mb-3 text-emerald-400" style="background: rgba(16, 185, 129, 0.15);">
            <svg viewBox="0 0 24 24" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.7 2.6 4 5.7 4 9s-1.3 6.4-4 9c-2.7-2.6-4-5.7-4-9s1.3-6.4 4-9z"/>
            </svg>
          </div>
          <h3 class="font-heading fw-bold text-white fs-5 mb-2">Bespoke Website Development</h3>
          <p class="text-slate-300 small lh-base mb-0">
            Clean, mobile-optimized business websites built for conversion, transforming traffic into calls, quotes, and loyal customers.
          </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 gsap-stagger-item rv in rv-d3">
        <div class="glass-card-interactive p-4 h-100" data-motion-card>
          <div class="card-icon-box mb-3 text-purple-400" style="background: rgba(192, 132, 252, 0.15);">
            <svg viewBox="0 0 24 24" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 21s-7-6-7-11a7 7 0 0 1 14 0c0 5-7 11-7 11z"/><circle cx="12" cy="10" r="2.6"/>
            </svg>
          </div>
          <h3 class="font-heading fw-bold text-white fs-5 mb-2">Local SEO &amp; Google Map Pack</h3>
          <p class="text-slate-300 small lh-base mb-0">
            Systematic Google Business Profile optimization and geo-targeted ranking strategies that capture nearby customers with immediate intent.
          </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 gsap-stagger-item rv in">
        <div class="glass-card-interactive p-4 h-100" data-motion-card>
          <div class="card-icon-box mb-3 text-info" style="background: rgba(56, 189, 248, 0.15);">
            <svg viewBox="0 0 24 24" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M3 17l6-6 4 4 8-8"/><path d="M15 7h6v6"/>
            </svg>
          </div>
          <h3 class="font-heading fw-bold text-white fs-5 mb-2">Organic Growth Campaigns</h3>
          <p class="text-slate-300 small lh-base mb-0">
            Targeted campaign landing pages, content strategies, and multi-channel conversion tracking designed to establish predictable lead flow.
          </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-8 gsap-stagger-item rv in rv-d2">
        <div class="glass-card-interactive p-4 h-100" data-motion-card>
          <div class="card-icon-box mb-3 text-amber-400" style="background: rgba(251, 191, 36, 0.15);">
            <svg viewBox="0 0 24 24" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
          </div>
          <h3 class="font-heading fw-bold text-white fs-5 mb-2">Autonomous AI Front-Office &amp; Support</h3>
          <p class="text-slate-300 small lh-base mb-0">
            Natural voice phone answering, WhatsApp appointment scheduling, proactive website updates, uptime monitoring, and direct US engineering support.
          </p>
        </div>
      </div>
    </div>

    </div>

  </div>
</section>

<!-- UNIFIED ARCHITECTURE CALLOUT -->
<section class="position-relative border-bottom border-secondary border-opacity-25 py-5 py-lg-5" style="background-color: #070B14;">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    
    <div class="glass-panel rounded-4 p-4 p-lg-5 border border-secondary border-opacity-25">
      <div class="row align-items-center g-4">
        <div class="col-lg-6">
          <span class="font-mono-badge text-azora-cyan fw-bold small">UNIFIED ARCHITECTURE</span>
          <h3 class="font-heading fw-bold text-white fs-3 mt-2 mb-3">
            One Strategic Partner for All Digital Infrastructure.
          </h3>
          <p class="text-slate-300 small lh-lg mb-4">
            Most businesses deal with 3 to 5 disconnected agencies for web design, hosting, local SEO, and customer support. Azora Solution unifies these disciplines under one roof with measurable accountability and transparent pricing.
          </p>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge rounded-pill bg-white bg-opacity-10 text-white font-mono-badge px-3 py-2">No Contracts</span>
            <span class="badge rounded-pill bg-white bg-opacity-10 text-white font-mono-badge px-3 py-2">Direct US Team</span>
            <span class="badge rounded-pill bg-white bg-opacity-10 text-white font-mono-badge px-3 py-2">Fast Response</span>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="p-4 rounded-4 border border-secondary border-opacity-25" style="background-color: #0B1320;">
            <h4 class="font-heading fw-bold text-white fs-5 mb-3">Company Headquarters</h4>
            <div class="d-flex align-items-start gap-3 text-slate-300 mb-3">
              <i class="bi bi-geo-alt-fill text-azora-cyan fs-5 mt-1"></i>
              <div>
                <strong class="text-white d-block">Morrisville Location:</strong>
                <span>1015 GLENDALE CHASE CT, Morrisville, North Carolina, United States, 27560</span>
              </div>
            </div>
            <div class="d-flex align-items-center gap-3 text-slate-300 mb-3">
              <i class="bi bi-telephone-fill text-azora-cyan fs-5"></i>
              <a href="tel:+19843888298" class="text-slate-300 text-decoration-none hover-white">(984) 388-8298</a>
            </div>
            <div class="d-flex align-items-center gap-3 text-slate-300 mb-4">
              <i class="bi bi-envelope-fill text-azora-cyan fs-5"></i>
              <a href="mailto:info@azorasolution.com" class="text-slate-300 text-decoration-none hover-white">info@azorasolution.com</a>
            </div>
            <button type="button" onclick="AZ.openQuoteModal()" class="btn-modern-primary w-100 py-2 small justify-content-center">
              <span>Request a Custom Quote</span>
            </button>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- HEADQUARTERS MAP -->
<section class="position-relative py-5 py-lg-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    <x-google-map />
  </div>
</section>
@endsection

