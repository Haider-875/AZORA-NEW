@extends('layouts.app')

@section('content')
<!-- HERO SECTION -->
<section class="position-relative overflow-hidden border-bottom border-secondary border-opacity-25 pb-5 pt-4 pt-lg-5">
  <div class="floating-orb floating-orb-primary position-absolute top-0 start-50 translate-middle-x pointer-events-none" style="width: 750px; height: 400px;" aria-hidden="true"></div>
  <div class="floating-orb floating-orb-cyan position-absolute top-50 start-0 translate-middle-y pointer-events-none" style="width: 320px; height: 320px;" aria-hidden="true"></div>

  <div class="container-xl position-relative px-3 px-sm-4 px-lg-5" style="z-index: 1;">
    <div class="rv in" style="max-width: 760px;">
      <span class="azora-badge mb-3">TRANSPARENT VALUE ARCHITECTURE</span>
      <h1 class="font-heading fw-bolder text-white display-5 display-lg-4 lh-sm tracking-tight mb-4">
        Predictable Pricing For Rapid <span class="text-gradient-cyan">Business Growth</span>.
      </h1>
      <p class="text-slate-300 fs-6 lh-lg mb-4">
        No surprise invoices, no bloated retainer contracts, and no vendor lock-in. Choose an itemized website tier, local search campaign, or a custom scope tailored to your operational velocity.
      </p>

      <div class="d-flex flex-wrap gap-2">
        <a href="#website-plans" class="btn-modern-primary py-2 px-3 small">
          <span>Website Plans</span>
        </a>
        <a href="#marketing-plans" class="btn-modern-secondary py-2 px-3 small">
          <span>Local SEO Plans</span>
        </a>
        <a href="#compare-table" class="btn-modern-secondary py-2 px-3 small">
          <span>Feature Comparison</span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ======================= 1. WEBSITE DEVELOPMENT PACKAGES ======================= -->
<section id="website-plans" class="position-relative border-bottom border-secondary border-opacity-25 py-5 py-lg-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    
    <div class="mb-5 rv">
      <span class="font-mono-badge text-azora-cyan small">01 &bull; WEB ARCHITECTURE</span>
      <h2 class="font-heading fw-bolder text-white display-6 mt-1 mb-2">
        Custom Website Development Packages
      </h2>
      <p class="text-slate-300 small mb-0" style="max-width: 640px;">
        High-performance, mobile-first business platforms engineered for high conversion rates, speed, and continuous security maintenance.
      </p>
    </div>

    <div class="row g-4 align-items-stretch gsap-stagger-group">
      
      <!-- Starter Plan -->
      <div class="col-md-6 col-lg-4 gsap-stagger-item rv in">
        <div class="glass-card-interactive p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
          <div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="font-mono-badge text-slate-400 small">STARTER</span>
              <span class="badge bg-secondary bg-opacity-25 text-slate-300 font-mono-badge" style="font-size: 0.6rem;">LOCAL BRANDS</span>
            </div>
            <h3 class="font-heading fw-bold text-white fs-4 mb-2">Website Starter</h3>
            <p class="text-slate-400 small mb-3">Everything a small business needs to establish a professional, credible web presence.</p>
            <div class="d-flex align-items-baseline gap-1 my-3">
              <span class="font-heading display-6 fw-bolder text-white">$99</span>
              <span class="text-slate-400 small">/month</span>
            </div>
            <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-2 mb-4 border-top border-secondary border-opacity-25 pt-3">
              <li><i class="bi bi-check2 text-info me-2"></i> Professional business website</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Mobile-responsive UI design</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Up to 5 custom website pages</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Contact &amp; rapid quote forms</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Basic SEO metadata setup</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Security, SSL &amp; speed optimization</li>
            </ul>
          </div>
          <a href="{{ route('quote', ['type' => 'plan', 'product' => 'website-starter']) }}" class="btn-modern-secondary w-100 py-2 text-center small">
            <span>Get Started</span>
          </a>
        </div>
      </div>

      <!-- Growth Plan (Featured) -->
      <div class="col-md-6 col-lg-4 gsap-stagger-item rv in rv-d2">
        <div class="glass-card-interactive pricing-card-highlight p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
          <div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="font-mono-badge text-azora-cyan small">GROWTH</span>
              <span class="badge bg-primary rounded-pill font-mono-badge" style="font-size: 0.6rem;">MOST POPULAR</span>
            </div>
            <h3 class="font-heading fw-bold text-white fs-4 mb-2">Website Growth</h3>
            <p class="text-slate-300 small mb-3">A complete growth-focused website built to turn traffic into calls, leads, and clients.</p>
            <div class="d-flex align-items-baseline gap-1 my-3">
              <span class="font-heading display-6 fw-bolder text-azora-cyan">$185</span>
              <span class="text-slate-400 small">/month</span>
            </div>
            <ul class="list-unstyled small text-white d-flex flex-column gap-2 mb-4 border-top border-secondary border-opacity-25 pt-3">
              <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> <strong>Everything in Starter</strong></li>
              <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Up to 10 custom website pages</li>
              <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Conversion-focused UI architecture</li>
              <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Advanced technical SEO structure</li>
              <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Google Business Profile integration</li>
              <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Monthly website updates &amp; tweaks</li>
            </ul>
          </div>
          <a href="{{ route('quote', ['type' => 'plan', 'product' => 'website-growth']) }}" class="btn-modern-primary w-100 py-2 text-center small">
            <span>Choose Growth</span>
          </a>
        </div>
      </div>

      <!-- Premium Plan -->
      <div class="col-md-6 col-lg-4 gsap-stagger-item rv in rv-d3">
        <div class="glass-card-interactive p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
          <div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="font-mono-badge text-slate-400 small">PREMIUM</span>
              <span class="badge bg-secondary bg-opacity-25 text-slate-300 font-mono-badge" style="font-size: 0.6rem;">SCALING TEAMS</span>
            </div>
            <h3 class="font-heading fw-bold text-white fs-4 mb-2">Website Premium</h3>
            <p class="text-slate-400 small mb-3">A premium digital presence for businesses ready to compete and dominate their sector.</p>
            <div class="d-flex align-items-baseline gap-1 my-3">
              <span class="font-heading display-6 fw-bolder text-white">$249</span>
              <span class="text-slate-400 small">/month</span>
            </div>
            <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-2 mb-4 border-top border-secondary border-opacity-25 pt-3">
              <li><i class="bi bi-check2 text-info me-2"></i> <strong>Everything in Growth</strong></li>
              <li><i class="bi bi-check2 text-info me-2"></i> Unlimited content &amp; landing sections</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Advanced conversion optimization funnels</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Custom analytics &amp; goal attribution setup</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Priority engineering support queue</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Continuous improvements &amp; A/B speed audit</li>
            </ul>
          </div>
          <a href="{{ route('quote', ['type' => 'plan', 'product' => 'website-premium']) }}" class="btn-modern-secondary w-100 py-2 text-center small">
            <span>Go Premium</span>
          </a>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ======================= 2. LOCAL SEO & MARKETING PLANS ======================= -->
<section id="marketing-plans" class="position-relative border-bottom border-secondary border-opacity-25 py-5 py-lg-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    
    <div class="mb-5 rv">
      <span class="font-mono-badge text-azora-cyan small">02 &bull; ORGANIC DOMINANCE</span>
      <h2 class="font-heading fw-bolder text-white display-6 mt-1 mb-2">
        Local SEO &amp; Organic Growth Plans
      </h2>
      <p class="text-slate-300 small mb-0" style="max-width: 640px;">
        Capture the highest-converting traffic on Google: local searchers looking for services in your geographic market right now.
      </p>
    </div>

    <div class="row g-4 align-items-stretch gsap-stagger-group">
      
      <!-- Local Starter -->
      <div class="col-md-6 col-lg-4 gsap-stagger-item rv in">
        <div class="glass-card-interactive p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
          <div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="font-mono-badge text-slate-400 small">LOCAL STARTER</span>
              <span class="badge bg-secondary bg-opacity-25 text-slate-300 font-mono-badge" style="font-size: 0.6rem;">FOUNDATION</span>
            </div>
            <h3 class="font-heading fw-bold text-white fs-4 mb-2">Local Marketing Starter</h3>
            <p class="text-slate-400 small mb-3">A strong local foundation to help nearby customers discover and choose your business.</p>
            <div class="d-flex align-items-baseline gap-1 my-3">
              <span class="font-heading display-6 fw-bolder text-white">$285</span>
              <span class="text-slate-400 small">/month</span>
            </div>
            <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-2 mb-4 border-top border-secondary border-opacity-25 pt-3">
              <li><i class="bi bi-check2 text-info me-2"></i> Google Business Profile optimization</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Local keyword strategy &amp; competitor scan</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Citation audit &amp; directory consistency</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Monthly performance &amp; rankings report</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Monthly strategy review with engineer</li>
            </ul>
          </div>
          <a href="{{ route('quote', ['type' => 'plan', 'product' => 'marketing-starter']) }}" class="btn-modern-secondary w-100 py-2 text-center small">
            <span>Get Started</span>
          </a>
        </div>
      </div>

      <!-- Growth Marketing (Featured) -->
      <div class="col-md-6 col-lg-4 gsap-stagger-item rv in rv-d2">
        <div class="glass-card-interactive pricing-card-highlight p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
          <div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="font-mono-badge text-azora-cyan small">GROWTH</span>
              <span class="badge bg-primary rounded-pill font-mono-badge" style="font-size: 0.6rem;">RECOMMENDED</span>
            </div>
            <h3 class="font-heading fw-bold text-white fs-4 mb-2">Growth Marketing &amp; Local SEO</h3>
            <p class="text-slate-300 small mb-3">A comprehensive campaign combining local SEO, on-page optimization, and content strategy.</p>
            <div class="d-flex align-items-baseline gap-1 my-3">
              <span class="font-heading display-6 fw-bolder text-azora-cyan">$365</span>
              <span class="text-slate-400 small">/month</span>
            </div>
            <ul class="list-unstyled small text-white d-flex flex-column gap-2 mb-4 border-top border-secondary border-opacity-25 pt-3">
              <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> <strong>Everything in Local Starter</strong></li>
              <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Advanced high-intent keyword targeting</li>
              <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> On-page technical SEO optimization</li>
              <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Local content &amp; landing page strategy</li>
              <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Competitor backlink &amp; ranking monitoring</li>
              <li><i class="bi bi-check2-circle text-azora-cyan me-2"></i> Monthly ROI &amp; customer inquiry report</li>
            </ul>
          </div>
          <a href="{{ route('quote', ['type' => 'plan', 'product' => 'marketing-growth']) }}" class="btn-modern-primary w-100 py-2 text-center small">
            <span>Choose Growth</span>
          </a>
        </div>
      </div>

      <!-- Market Leader -->
      <div class="col-md-6 col-lg-4 gsap-stagger-item rv in rv-d3">
        <div class="glass-card-interactive p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
          <div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <span class="font-mono-badge text-slate-400 small">LEADER</span>
              <span class="badge bg-secondary bg-opacity-25 text-slate-300 font-mono-badge" style="font-size: 0.6rem;">MARKET LEADER</span>
            </div>
            <h3 class="font-heading fw-bold text-white fs-4 mb-2">Market Leader Marketing</h3>
            <p class="text-slate-400 small mb-3">Our highest tier for businesses demanding top rankings across multiple services or locations.</p>
            <div class="d-flex align-items-baseline gap-1 my-3">
              <span class="font-heading display-6 fw-bolder text-white">$399</span>
              <span class="text-slate-400 small">/month</span>
            </div>
            <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-2 mb-4 border-top border-secondary border-opacity-25 pt-3">
              <li><i class="bi bi-check2 text-info me-2"></i> <strong>Everything in Growth</strong></li>
              <li><i class="bi bi-check2 text-info me-2"></i> Advanced multi-location SEO campaigns</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Authority content &amp; conversion landing pages</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Comprehensive competitor tracking</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Lead generation funnel optimization</li>
              <li><i class="bi bi-check2 text-info me-2"></i> Priority engineering strategy &amp; dedicated support</li>
            </ul>
          </div>
          <a href="{{ route('quote', ['type' => 'plan', 'product' => 'marketing-premium']) }}" class="btn-modern-secondary w-100 py-2 text-center small">
            <span>Go Market Leader</span>
          </a>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ======================= 3. FEATURE COMPARISON MATRIX (LUXURY ARCHITECTURAL VIEW) ======================= -->
<section id="compare-table" class="position-relative border-bottom border-secondary border-opacity-25 py-5 py-lg-5 overflow-hidden" style="background-color: #070B14;">
  <!-- Ambient backdrop lighting -->
  <div class="position-absolute top-0 start-50 translate-middle-x pointer-events-none" style="width: 850px; height: 420px; background: radial-gradient(ellipse, rgba(36, 105, 235, 0.18) 0%, rgba(56, 189, 248, 0.06) 45%, transparent 70%); filter: blur(80px); z-index: 0;" aria-hidden="true"></div>

  <div class="container-xl position-relative px-3 px-sm-4 px-lg-5" style="z-index: 1;">
    
    <!-- Section Heading -->
    <div class="text-center mx-auto mb-5 rv" style="max-width: 720px;">
      <span class="azora-badge mb-3">SIDE-BY-SIDE MATRIX</span>
      <h2 class="font-heading fw-bolder text-white display-6 mb-3">
        Compare Web Engineering <span class="text-gradient-cyan">Capabilities</span>
      </h2>
      <p class="text-slate-300 small lh-lg mb-0">
        A transparent, line-by-line architectural breakdown to help you choose the right tier for your market. Zero hidden fees, zero vendor lock-in.
      </p>
    </div>

    <!-- Luxury Matrix Glass Bento Card -->
    <div class="spec-matrix-wrapper">
      <div class="table-responsive mb-0">
        <table class="spec-matrix-table align-middle">
          <thead>
            <tr>
              <th style="width: 38%;">
                <span class="font-mono-badge text-azora-cyan d-block mb-1" style="font-size: 0.68rem; letter-spacing: 0.08em;">ARCHITECTURE MATRIX</span>
                <span class="font-heading fw-bold text-white fs-5">Plan Specifications</span>
              </th>
              
              <!-- Starter Column -->
              <th class="text-center" style="width: 20%;">
                <span class="matrix-badge-tier">FOUNDATION</span>
                <h4 class="font-heading fw-bold text-white fs-6 mb-1">Starter</h4>
                <div class="d-flex align-items-baseline justify-content-center gap-1 my-1">
                  <span class="font-heading fs-4 fw-bolder text-white">$99</span>
                  <span class="text-slate-400 small">/mo</span>
                </div>
              </th>

              <!-- Growth Column (Highlighted Flagship) -->
              <th class="text-center col-growth" style="width: 22%;">
                <span class="matrix-badge-popular">MOST POPULAR</span>
                <h4 class="font-heading fw-bold text-white fs-6 mb-1">Website Growth</h4>
                <div class="d-flex align-items-baseline justify-content-center gap-1 my-1">
                  <span class="font-heading fs-3 fw-bolder text-azora-cyan">$185</span>
                  <span class="text-azora-cyan small">/mo</span>
                </div>
              </th>

              <!-- Premium Column -->
              <th class="text-center" style="width: 20%;">
                <span class="matrix-badge-tier">ENTERPRISE</span>
                <h4 class="font-heading fw-bold text-white fs-6 mb-1">Premium</h4>
                <div class="d-flex align-items-baseline justify-content-center gap-1 my-1">
                  <span class="font-heading fs-4 fw-bolder text-white">$249</span>
                  <span class="text-slate-400 small">/mo</span>
                </div>
              </th>
            </tr>
          </thead>

          <tbody>
            <!-- CATEGORY 1: CORE WEB ARCHITECTURE -->
            <tr class="matrix-category-row">
              <td colspan="4">
                1. Core Web Architecture &amp; Performance
              </td>
            </tr>
            
            <tr class="matrix-row">
              <td>
                <span class="spec-feature-title">Included Custom Pages</span>
                <p class="spec-feature-desc">Tailored responsive design layouts built from scratch without generic templates.</p>
              </td>
              <td class="text-center"><span class="badge-matrix-muted">Up to 5 Pages</span></td>
              <td class="text-center col-growth"><span class="badge-matrix-cyan">Up to 10 Pages</span></td>
              <td class="text-center"><span class="badge-matrix-white">Unlimited Sections</span></td>
            </tr>

            <tr class="matrix-row">
              <td>
                <span class="spec-feature-title">Google PageSpeed &amp; Core Web Vitals</span>
                <p class="spec-feature-desc">Sub-second load times engineered with semantic HTML, zero bloat, and optimized assets.</p>
              </td>
              <td class="text-center"><span class="badge-matrix-muted">90+ Score</span></td>
              <td class="text-center col-growth"><span class="badge-matrix-cyan">95+ Guaranteed</span></td>
              <td class="text-center"><span class="badge-matrix-white">98+ Ultra-Speed</span></td>
            </tr>

            <tr class="matrix-row">
              <td>
                <span class="spec-feature-title">Mobile Responsive &amp; Retina Ready</span>
                <p class="spec-feature-desc">Precision multi-viewport scaling tested across iPhone, Android, iPad, and 4K displays.</p>
              </td>
              <td class="text-center text-success fs-5"><i class="bi bi-check-lg"></i></td>
              <td class="text-center col-growth text-azora-cyan fs-5 fw-bold"><i class="bi bi-check-lg"></i></td>
              <td class="text-center text-azora-cyan fs-5 fw-bold"><i class="bi bi-check-lg"></i></td>
            </tr>

            <tr class="matrix-row">
              <td>
                <span class="spec-feature-title">Interactive Rapid Quote &amp; Lead Capture</span>
                <p class="spec-feature-desc">Server-validated inquiry forms with anti-spam honeypot and instant email alerts.</p>
              </td>
              <td class="text-center text-success fs-5"><i class="bi bi-check-lg"></i></td>
              <td class="text-center col-growth text-azora-cyan fs-5 fw-bold"><i class="bi bi-check-lg"></i></td>
              <td class="text-center text-azora-cyan fs-5 fw-bold"><i class="bi bi-check-lg"></i></td>
            </tr>

            <tr class="matrix-row">
              <td>
                <span class="spec-feature-title">100% Full Source Code Ownership</span>
                <p class="spec-feature-desc">You own your complete code, assets, and Git repository with zero proprietary lock-in.</p>
              </td>
              <td class="text-center text-success fs-5"><i class="bi bi-check-lg"></i></td>
              <td class="text-center col-growth text-azora-cyan fs-5 fw-bold"><i class="bi bi-check-lg"></i></td>
              <td class="text-center text-azora-cyan fs-5 fw-bold"><i class="bi bi-check-lg"></i></td>
            </tr>

            <!-- CATEGORY 2: SEARCH ENGINE & LOCAL VISIBILITY -->
            <tr class="matrix-category-row">
              <td colspan="4">
                2. Search Engine Optimization &amp; Local Reach
              </td>
            </tr>

            <tr class="matrix-row">
              <td>
                <span class="spec-feature-title">Technical SEO &amp; Rich Schema Markup</span>
                <p class="spec-feature-desc">Structured JSON-LD schema for LocalBusiness, XML sitemaps, and robots configuration.</p>
              </td>
              <td class="text-center"><span class="badge-matrix-muted">Foundational</span></td>
              <td class="text-center col-growth"><span class="badge-matrix-cyan">Advanced Local Schema</span></td>
              <td class="text-center"><span class="badge-matrix-white">Full Enterprise Graph</span></td>
            </tr>

            <tr class="matrix-row">
              <td>
                <span class="spec-feature-title">Google Business Profile (GBP) Integration</span>
                <p class="spec-feature-desc">Live Google review feed synchronization and Top 3 Map Pack optimization routing.</p>
              </td>
              <td class="text-center text-slate-600 font-mono">—</td>
              <td class="text-center col-growth text-azora-cyan fs-5 fw-bold"><i class="bi bi-check-lg"></i></td>
              <td class="text-center text-azora-cyan fs-5 fw-bold"><i class="bi bi-check-lg"></i></td>
            </tr>

            <tr class="matrix-row">
              <td>
                <span class="spec-feature-title">Conversion Funnel &amp; A/B Split Testing</span>
                <p class="spec-feature-desc">Multi-step user path optimization to maximize call clicks, bookings, and form submissions.</p>
              </td>
              <td class="text-center text-slate-600 font-mono">—</td>
              <td class="text-center col-growth text-slate-600 font-mono">—</td>
              <td class="text-center text-azora-cyan fs-5 fw-bold"><i class="bi bi-check-lg"></i></td>
            </tr>

            <!-- CATEGORY 3: CONTINUOUS ENGINEERING & SUPPORT -->
            <tr class="matrix-category-row">
              <td colspan="4">
                3. Continuous Engineering &amp; US Support SLA
              </td>
            </tr>

            <tr class="matrix-row">
              <td>
                <span class="spec-feature-title">Monthly Code Revisions &amp; Content Updates</span>
                <p class="spec-feature-desc">Send design tweaks, copy changes, or new section requests directly to our team.</p>
              </td>
              <td class="text-center"><span class="badge-matrix-muted">1 Request / mo</span></td>
              <td class="text-center col-growth"><span class="badge-matrix-cyan">Included Monthly</span></td>
              <td class="text-center"><span class="badge-matrix-white">Continuous Priority</span></td>
            </tr>

            <tr class="matrix-row">
              <td>
                <span class="spec-feature-title">Hosting, Cloudflare CDN &amp; Daily Backups</span>
                <p class="spec-feature-desc">Ultra-fast global edge caching, SSL certificates, automated daily snapshots, and DDoS shield.</p>
              </td>
              <td class="text-center text-success fs-5"><i class="bi bi-check-lg"></i></td>
              <td class="text-center col-growth text-azora-cyan fs-5 fw-bold"><i class="bi bi-check-lg"></i></td>
              <td class="text-center text-azora-cyan fs-5 fw-bold"><i class="bi bi-check-lg"></i></td>
            </tr>

            <tr class="matrix-row">
              <td>
                <span class="spec-feature-title">Direct US Senior Engineering Support</span>
                <p class="spec-feature-desc">Dedicated US-based technical support SLA with direct phone and email escalation.</p>
              </td>
              <td class="text-center"><span class="badge-matrix-muted">Email (24h SLA)</span></td>
              <td class="text-center col-growth"><span class="badge-matrix-cyan">Priority Phone &amp; Email (2h)</span></td>
              <td class="text-center"><span class="badge-matrix-white">Dedicated Tech Director (15m)</span></td>
            </tr>
          </tbody>

          <tfoot>
            <tr>
              <td class="p-4">
                <span class="font-heading fw-bold text-white d-block mb-1">Ready to upgrade your web architecture?</span>
                <span class="text-slate-400 small">All plans are monthly with zero lock-in contracts.</span>
              </td>
              <td class="p-4 text-center">
                <a href="{{ route('quote', ['type' => 'plan', 'product' => 'website-starter']) }}" class="btn-modern-secondary py-2 px-3 small w-100 text-center" style="border-radius: 8px;">
                  <span>Get Started</span>
                </a>
              </td>
              <td class="p-4 text-center col-growth">
                <a href="{{ route('quote', ['type' => 'plan', 'product' => 'website-growth']) }}" class="btn-modern-primary py-2 px-3 small w-100 text-center shadow-lg" style="border-radius: 8px;">
                  <span>Choose Growth</span>
                </a>
              </td>
              <td class="p-4 text-center">
                <a href="{{ route('quote', ['type' => 'plan', 'product' => 'website-premium']) }}" class="btn-modern-secondary py-2 px-3 small w-100 text-center" style="border-radius: 8px;">
                  <span>Go Premium</span>
                </a>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

  </div>
</section>

<!-- ======================= 4. CUSTOM STACK CTA ======================= -->
<section class="position-relative py-5 py-lg-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    
    <div class="glass-card-interactive p-4 p-md-5 text-center" data-motion-card>
      <span class="azora-badge mb-3">MULTI-LOCATION &amp; CUSTOM SCOPE</span>
      <h2 class="font-heading fw-bolder text-white display-6 mb-3">
        Need Multiple Locations Or A Custom Technology Stack?
      </h2>
      <p class="text-slate-300 small lh-lg mx-auto mb-4" style="max-width: 620px;">
        We build bespoke enterprise platforms for franchise operators, multi-unit retail brands, and regional service contractors. Talk directly to our technical directors for custom scope pricing.
      </p>
      <button type="button" onclick="AZ.openQuoteModal()" class="btn-modern-primary py-3 px-5 shadow-lg">
        <span>Build a Tailored Enterprise Quote</span>
      </button>
    </div>

  </div>
</section>

<!-- HEADQUARTERS MAP -->
<section class="position-relative pb-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    <x-google-map />
  </div>
</section>
@endsection

