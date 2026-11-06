@extends('layouts.app')

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
        <div class="glass-card-interactive p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-25 font-mono-badge" style="font-size: 0.65rem;">
                WEB ARCHITECTURE
              </span>
              <span class="font-mono-badge text-azora-cyan fw-bold small">From $99/mo</span>
            </div>

            <div class="card-icon-box mb-3 text-emerald-400" style="background: rgba(16, 185, 129, 0.15);">
              <svg viewBox="0 0 24 24" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.7 2.6 4 5.7 4 9s-1.3 6.4-4 9c-2.7-2.6-4-5.7-4-9s1.3-6.4 4-9z"/>
              </svg>
            </div>

            <h3 class="font-heading fw-bold text-white fs-4 mb-2">Custom Website Development</h3>
            <p class="text-slate-300 small lh-base mb-4">
              High-performance, mobile-first websites tailored for local businesses, lead capture, online quoting, and streamlined customer conversions.
            </p>

            <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-2 mb-4 border-top border-secondary border-opacity-25 pt-3">
              <li><i class="bi bi-check2 text-azora-cyan me-2"></i> Custom responsive UI &amp; brand styling</li>
              <li><i class="bi bi-check2 text-azora-cyan me-2"></i> Fast load speed &amp; Core Web Vitals optimization</li>
              <li><i class="bi bi-check2 text-azora-cyan me-2"></i> Interactive quote, contact &amp; appointment forms</li>
              <li><i class="bi bi-check2 text-azora-cyan me-2"></i> Continuous hosting, SSL &amp; maintenance updates</li>
            </ul>
          </div>

          <div class="d-flex gap-2 pt-2 border-top border-secondary border-opacity-25">
            <a href="{{ route('plans') }}#website-plans" class="btn-modern-secondary flex-fill py-2 text-center small"><span>View Plans</span></a>
            <button type="button" onclick="AZ.openQuoteModal('website-growth')" class="btn-modern-primary flex-fill py-2 small">
              <span>Quote Web</span>
            </button>
          </div>
        </div>
      </div>

      <!-- SERVICE 2: Local SEO & Google Presence -->
      <div id="seo-growth" class="col-md-6 col-xl-4 gsap-stagger-item rv in rv-d2">
        <div class="glass-card-interactive pricing-card-highlight p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge rounded-pill bg-primary bg-opacity-25 text-azora-cyan border border-primary border-opacity-25 font-mono-badge" style="font-size: 0.65rem;">
                ● HIGH DEMAND
              </span>
              <span class="font-mono-badge text-azora-cyan fw-bold small">From $285/mo</span>
            </div>

            <div class="card-icon-box mb-3 text-azora-cyan" style="background: rgba(56, 189, 248, 0.2);">
              <svg viewBox="0 0 24 24" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 21s-7-6-7-11a7 7 0 0 1 14 0c0 5-7 11-7 11z"/><circle cx="12" cy="10" r="2.6"/>
              </svg>
            </div>

            <h3 class="font-heading fw-bold text-white fs-4 mb-2">Local SEO &amp; Google Map Pack</h3>
            <p class="text-slate-300 small lh-base mb-4">
              Rank in Google's Top 3 Local Map Pack and capture nearby high-intent searchers ready to call, visit, or buy.
            </p>

            <ul class="list-unstyled small text-slate-200 d-flex flex-column gap-2 mb-4 border-top border-secondary border-opacity-25 pt-3">
              <li><i class="bi bi-check2 text-azora-cyan me-2"></i> Google Business Profile auditing &amp; continuous optimization</li>
              <li><i class="bi bi-check2 text-azora-cyan me-2"></i> High-intent geo-targeted keyword positioning</li>
              <li><i class="bi bi-check2 text-azora-cyan me-2"></i> Local citation cleanup &amp; 60+ directory syndication</li>
              <li><i class="bi bi-check2 text-azora-cyan me-2"></i> Transparent monthly ranking &amp; conversion reporting</li>
            </ul>
          </div>

          <div class="d-flex gap-2 pt-2 border-top border-secondary border-opacity-25">
            <a href="{{ route('plans') }}#marketing-plans" class="btn-modern-secondary flex-fill py-2 text-center small"><span>View Plans</span></a>
            <button type="button" onclick="AZ.openQuoteModal('marketing-growth')" class="btn-modern-primary flex-fill py-2 small">
              <span>Quote SEO</span>
            </button>
          </div>
        </div>
      </div>

      <!-- SERVICE 3: Growth Marketing & Lead Gen -->
      <div class="col-md-6 col-xl-4 gsap-stagger-item rv in rv-d3">
        <div class="glass-card-interactive p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge rounded-pill bg-purple bg-opacity-10 text-purple-400 border border-purple border-opacity-25 font-mono-badge" style="font-size: 0.65rem;">
                LEAD ACQUISITION
              </span>
              <span class="font-mono-badge text-purple-400 fw-bold small">Scalable Scope</span>
            </div>

            <div class="card-icon-box mb-3 text-purple-400" style="background: rgba(192, 132, 252, 0.15);">
              <svg viewBox="0 0 24 24" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 17l6-6 4 4 8-8"/><path d="M15 7h6v6"/>
              </svg>
            </div>

            <h3 class="font-heading fw-bold text-white fs-4 mb-2">Growth Campaigns &amp; Funnels</h3>
            <p class="text-slate-300 small lh-base mb-4">
              Targeted digital campaigns, conversion funnels, and landing pages designed to generate predictable customer pipeline.
            </p>

            <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-2 mb-4 border-top border-secondary border-opacity-25 pt-3">
              <li><i class="bi bi-check2 text-purple-400 me-2"></i> High-converting campaign landing pages</li>
              <li><i class="bi bi-check2 text-purple-400 me-2"></i> Competitor positioning &amp; keyword gap strategy</li>
              <li><i class="bi bi-check2 text-purple-400 me-2"></i> Multi-channel lead tracking &amp; call attribution</li>
              <li><i class="bi bi-check2 text-purple-400 me-2"></i> Ongoing strategy reviews and conversion optimization</li>
            </ul>
          </div>

          <div class="pt-2 border-top border-secondary border-opacity-25">
            <button type="button" onclick="AZ.openQuoteModal('marketing-premium')" class="btn-modern-primary w-100 py-2 small justify-content-center">
              <span>Launch Growth Campaign</span>
            </button>
          </div>
        </div>
      </div>

      <!-- SERVICE 4: AI Front Office -->
      <div id="ai-front-office" class="col-md-6 col-xl-4 gsap-stagger-item rv in">
        <div class="glass-card-interactive p-4 h-100 d-flex flex-column justify-content-between" data-motion-card>
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge rounded-pill bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 font-mono-badge" style="font-size: 0.65rem;">
                AI FRONT OFFICE
              </span>
              <span class="font-mono-badge text-warning fw-bold small">24/7 Operations</span>
            </div>

            <div class="card-icon-box mb-3 text-amber-400" style="background: rgba(251, 191, 36, 0.15);">
              <svg viewBox="0 0 24 24" style="width: 24px; height: 24px;" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 2l1.9 5.6 5.8.2-4.6 3.6 1.7 5.8-4.8-3.4-4.8 3.4 1.7-5.8L4.3 7.8l5.8-.2z"/>
              </svg>
            </div>

            <h3 class="font-heading fw-bold text-white fs-4 mb-2">AI Voice &amp; WhatsApp Reception</h3>
            <p class="text-slate-300 small lh-base mb-4">
              An intelligent front office that answers calls in natural voice, replies on WhatsApp, qualifies leads, and schedules appointments.
            </p>

            <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-2 mb-4 border-top border-secondary border-opacity-25 pt-3">
              <li><i class="bi bi-check2 text-warning me-2"></i> Natural human-like conversational voice receptionist</li>
              <li><i class="bi bi-check2 text-warning me-2"></i> WhatsApp auto-replies, FAQs &amp; estimates</li>
              <li><i class="bi bi-check2 text-warning me-2"></i> Automated calendar booking &amp; CRM pipeline routing</li>
              <li><i class="bi bi-check2 text-warning me-2"></i> Zero calls or inbound inquiries left unaddressed</li>
            </ul>
          </div>

          <div class="pt-2 border-top border-secondary border-opacity-25">
            <button type="button" onclick="AZ.openQuoteModal('ai-voice-receptionist')" class="btn-modern-primary w-100 py-2 small justify-content-center">
              <span>Deploy AI Reception</span>
            </button>
          </div>
        </div>
      </div>

      <!-- SERVICE 5: Enterprise Cloud Systems & Custom Software -->
      <div id="custom-software" class="col-md-12 col-xl-8 gsap-stagger-item rv in rv-d2">
        <div class="glass-card-interactive p-4 p-md-5 h-100 d-flex flex-column justify-content-between" data-motion-card>
          <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span class="badge rounded-pill bg-info bg-opacity-10 text-azora-cyan border border-info border-opacity-25 font-mono-badge" style="font-size: 0.65rem;">
                CUSTOM CLOUD ARCHITECTURE
              </span>
              <span class="font-mono-badge text-azora-cyan fw-bold small">Enterprise Scope</span>
            </div>

            <div class="row g-4 align-items-center">
              <div class="col-lg-6">
                <h3 class="font-heading fw-bold text-white fs-3 mb-3">Custom Enterprise Software &amp; Cloud Workflows</h3>
                <p class="text-slate-300 small lh-lg mb-0">
                  When off-the-shelf software doesn't fit your operational workflow, Azora engineers bespoke web platforms, client portals, automated quotation systems, and secure cloud databases built with Laravel, PHP, and scalable database backends.
                </p>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled small text-slate-300 d-flex flex-column gap-3 mb-0">
                  <li class="d-flex align-items-start gap-2">
                    <i class="bi bi-shield-check text-azora-cyan fs-5 mt-n1"></i>
                    <span>Secure role-based authentication, admin dashboards &amp; reporting</span>
                  </li>
                  <li class="d-flex align-items-start gap-2">
                    <i class="bi bi-cpu text-azora-cyan fs-5 mt-n1"></i>
                    <span>High-throughput API integrations, webhooks &amp; automated notification pipelines</span>
                  </li>
                  <li class="d-flex align-items-start gap-2">
                    <i class="bi bi-cloud-check text-azora-cyan fs-5 mt-n1"></i>
                    <span>Reliable database schema design, automated backups, and 99.9% uptime SLA</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 pt-4 border-top border-secondary border-opacity-25 mt-4">
            <span class="text-slate-400 small">Bespoke integrations, custom business software, and enterprise pipelines</span>
            <button type="button" onclick="AZ.openQuoteModal('custom-business-software')" class="btn-modern-primary py-2 px-4 small">
              <span>Request Software Architecture Scope</span>
            </button>
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

