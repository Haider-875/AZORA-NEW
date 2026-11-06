@extends('layouts.app')

@section('content')
<!-- HERO SECTION -->
<section class="position-relative overflow-hidden border-bottom border-secondary border-opacity-25 pb-5 pt-4 pt-lg-5">
  <div class="position-absolute top-0 start-50 translate-middle-x pointer-events-none" style="width: 750px; height: 400px; background: radial-gradient(circle, rgba(36,105,235,0.2) 0%, transparent 70%); filter: blur(100px); z-index: 0;" aria-hidden="true"></div>

  <div class="container-xl position-relative px-3 px-sm-4 px-lg-5 text-center" style="z-index: 1;">
    <div class="rv in mx-auto" style="max-width: 720px;">
      <span class="azora-badge mb-3">TAILORED PROPOSAL CONFIGURATOR</span>
      <h1 class="font-heading fw-bolder text-white display-5 display-lg-4 lh-sm tracking-tight mb-4">
        Build Your Custom <span class="text-gradient-cyan">Digital Stack</span>.
      </h1>
      <p class="text-slate-300 fs-6 lh-lg mb-0 mx-auto" style="max-width: 620px;">
        Select your desired website development packages, local SEO campaigns, or AI front-office voice agents. Our US engineering team will assemble your itemized proposal within 15 minutes.
      </p>
    </div>
  </div>
</section>

<!-- FORM & CONFIGURATOR CONTAINER -->
<section class="position-relative py-5 py-lg-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5" style="max-width: 860px;">
    
    <div class="glass-card-interactive rounded-4 p-4 p-md-5 border border-secondary border-opacity-25 shadow-lg">
      
      <form id="main-quote-form" action="{{ route('quote.store') }}" method="POST">
        @csrf
        
        <!-- Honeypot -->
        <input type="text" name="website" style="display:none;" tabindex="-1" autocomplete="off">
        <input type="hidden" name="event_type" value="quote_submitted">

        @if($errors->any())
          <div class="alert alert-danger border-0 small py-2 px-3 mb-4 rounded-3" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5;">
            <ul class="mb-0 ps-3">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <h3 class="font-heading fw-bold text-white fs-5 mb-4 border-bottom border-secondary border-opacity-25 pb-3">
          1. Business &amp; Contact Details
        </h3>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label class="form-label font-mono-badge text-slate-300 small" for="q-business">
              Business Name <span class="text-azora-cyan">*</span>
            </label>
            <input id="q-business" name="business" value="{{ old('business') }}" class="form-control form-control-azora" placeholder="e.g. Gotham Medical Group LLC" required />
          </div>
          <div class="col-md-6">
            <label class="form-label font-mono-badge text-slate-300 small" for="q-contact">
              Contact Full Name <span class="text-azora-cyan">*</span>
            </label>
            <input id="q-contact" name="contact" value="{{ old('contact') }}" class="form-control form-control-azora" placeholder="e.g. Alex Henderson" required />
          </div>
          <div class="col-md-6">
            <label class="form-label font-mono-badge text-slate-300 small" for="q-email">
              Work Email <span class="text-azora-cyan">*</span>
            </label>
            <input id="q-email" name="email" value="{{ old('email') }}" type="email" class="form-control form-control-azora" placeholder="alex@company.com" required />
          </div>
          <div class="col-md-6">
            <label class="form-label font-mono-badge text-slate-300 small" for="q-phone">
              Phone Number
            </label>
            <input id="q-phone" name="phone" value="{{ old('phone') }}" type="tel" class="form-control form-control-azora" placeholder="(984) 388-8298" />
          </div>
          <div class="col-12">
            <label class="form-label font-mono-badge text-slate-300 small" for="q-locations">
              Active Physical Locations
            </label>
            <select id="q-locations" name="locations" class="form-select form-control-azora">
              <option value="1">1 Single Location</option>
              <option value="2-5">2 to 5 Locations</option>
              <option value="6-20">6 to 20 Multi-Unit Territory</option>
              <option value="20+">20+ Nationwide Enterprise</option>
            </select>
          </div>
        </div>

        <h3 class="font-heading fw-bold text-white fs-5 mt-5 mb-3 border-bottom border-secondary border-opacity-25 pb-3">
          2. Select Target Services &amp; Plans
        </h3>

        <p class="text-slate-400 small mb-3">Click any options to add or remove them from your itemized quote:</p>

        <div class="row g-3" id="service-selection-grid">
          
          <!-- Web Starter -->
          <div class="col-md-6">
            <div class="pick-item-card p-3 rounded-2 border cursor-pointer h-100 position-relative" data-motion-card data-id="website-starter" data-name="Website Starter ($99/mo)" onclick="toggleSelection(this)">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="font-mono-badge text-emerald-400 small">WEB ARCHITECTURE</span>
                <div class="d-flex align-items-center gap-2">
                  <span class="fw-bold text-white small">$99/mo</span>
                  <span class="card-check-box"><i class="bi bi-check-lg"></i></span>
                </div>
              </div>
              <h4 class="font-heading fw-bold text-white fs-6 mb-1">Website Starter Plan</h4>
              <p class="text-slate-400 small mb-0" style="font-size: 0.75rem;">Up to 5 custom responsive pages, quote forms, speed &amp; SEO setup.</p>
            </div>
          </div>

          <!-- Web Growth -->
          <div class="col-md-6">
            <div class="pick-item-card p-3 rounded-2 border cursor-pointer h-100 position-relative {{ $preselectedProduct === 'website-growth' ? 'selected' : '' }}" data-motion-card data-id="website-growth" data-name="Website Growth ($185/mo)" onclick="toggleSelection(this)">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="font-mono-badge text-azora-cyan small">POPULAR</span>
                <div class="d-flex align-items-center gap-2">
                  <span class="fw-bold text-azora-cyan small">$185/mo</span>
                  <span class="card-check-box"><i class="bi bi-check-lg"></i></span>
                </div>
              </div>
              <h4 class="font-heading fw-bold text-white fs-6 mb-1">Website Growth Plan</h4>
              <p class="text-slate-400 small mb-0" style="font-size: 0.75rem;">Up to 10 pages, conversion-focused layout, advanced technical SEO.</p>
            </div>
          </div>

          <!-- Web Premium -->
          <div class="col-md-6">
            <div class="pick-item-card p-3 rounded-2 border cursor-pointer h-100 position-relative {{ $preselectedProduct === 'website-premium' ? 'selected' : '' }}" data-motion-card data-id="website-premium" data-name="Website Premium ($249/mo)" onclick="toggleSelection(this)">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="font-mono-badge text-slate-400 small">ENTERPRISE</span>
                <div class="d-flex align-items-center gap-2">
                  <span class="fw-bold text-white small">$249/mo</span>
                  <span class="card-check-box"><i class="bi bi-check-lg"></i></span>
                </div>
              </div>
              <h4 class="font-heading fw-bold text-white fs-6 mb-1">Website Premium Plan</h4>
              <p class="text-slate-400 small mb-0" style="font-size: 0.75rem;">Unlimited sections, custom funnels, priority engineering &amp; analytics.</p>
            </div>
          </div>

          <!-- Local SEO Starter -->
          <div class="col-md-6">
            <div class="pick-item-card p-3 rounded-2 border cursor-pointer h-100 position-relative {{ $preselectedProduct === 'marketing-starter' ? 'selected' : '' }}" data-motion-card data-id="marketing-starter" data-name="Local SEO Starter ($285/mo)" onclick="toggleSelection(this)">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="font-mono-badge text-purple-400 small">ORGANIC SEO</span>
                <div class="d-flex align-items-center gap-2">
                  <span class="fw-bold text-white small">$285/mo</span>
                  <span class="card-check-box"><i class="bi bi-check-lg"></i></span>
                </div>
              </div>
              <h4 class="font-heading fw-bold text-white fs-6 mb-1">Local Marketing Starter</h4>
              <p class="text-slate-400 small mb-0" style="font-size: 0.75rem;">Google Business Profile optimization, local citations &amp; keyword scans.</p>
            </div>
          </div>

          <!-- SEO Growth -->
          <div class="col-md-6">
            <div class="pick-item-card p-3 rounded-2 border cursor-pointer h-100 position-relative {{ $preselectedProduct === 'marketing-growth' ? 'selected' : '' }}" data-motion-card data-id="marketing-growth" data-name="Growth SEO Plan ($365/mo)" onclick="toggleSelection(this)">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="font-mono-badge text-azora-cyan small">RECOMMENDED</span>
                <div class="d-flex align-items-center gap-2">
                  <span class="fw-bold text-azora-cyan small">$365/mo</span>
                  <span class="card-check-box"><i class="bi bi-check-lg"></i></span>
                </div>
              </div>
              <h4 class="font-heading fw-bold text-white fs-6 mb-1">Growth Marketing &amp; Local SEO</h4>
              <p class="text-slate-400 small mb-0" style="font-size: 0.75rem;">Google Top 3 Map Pack campaign, on-page optimization &amp; ranking reports.</p>
            </div>
          </div>

          <!-- AI Voice Receptionist -->
          <div class="col-md-6">
            <div class="pick-item-card p-3 rounded-2 border cursor-pointer h-100 position-relative {{ $preselectedProduct === 'ai-voice-receptionist' ? 'selected' : '' }}" data-motion-card data-id="ai-voice-receptionist" data-name="AI Voice Receptionist" onclick="toggleSelection(this)">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="font-mono-badge text-warning small">AI AUTOMATION</span>
                <div class="d-flex align-items-center gap-2">
                  <span class="fw-bold text-warning small">24/7 Agent</span>
                  <span class="card-check-box"><i class="bi bi-check-lg"></i></span>
                </div>
              </div>
              <h4 class="font-heading fw-bold text-white fs-6 mb-1">AI Voice Receptionist</h4>
              <p class="text-slate-400 small mb-0" style="font-size: 0.75rem;">Natural human-like voice answering, lead qualification, and appointment booking.</p>
            </div>
          </div>

        </div>

        <!-- Hidden input holding JSON items -->
        <input type="hidden" name="items" id="selected-items-json" value="[]">

        <h3 class="font-heading fw-bold text-white fs-5 mt-5 mb-3 border-bottom border-secondary border-opacity-25 pb-3">
          3. Project Notes &amp; Scope Objectives
        </h3>

        <div class="mb-4">
          <label class="form-label font-mono-badge text-slate-300 small" for="q-message">
            Special Scope Goals (Optional)
          </label>
          <textarea id="q-message" name="message" rows="3" class="form-control form-control-azora" placeholder="Describe your current site, target local cities, booking requirements, or digital goals..."></textarea>
        </div>

        <button type="submit" class="btn-modern-primary w-100 py-3 fs-6 justify-content-center shadow-lg" style="border-radius: 8px;">
          <span>Generate Formal Itemized Proposal</span>
        </button>

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 text-slate-400 font-mono-badge mt-4 pt-3 border-top border-secondary border-opacity-25" style="font-size: 0.72rem;">
          <div class="d-flex flex-wrap align-items-center gap-3">
            <span>● No Credit Card Required</span>
            <span>● Zero Obligation</span>
            <span>● Response Under 15m</span>
          </div>
          <div class="d-flex align-items-center gap-3">
            <a href="tel:+19843888298" class="text-azora-cyan text-decoration-none fw-semibold d-inline-flex align-items-center gap-1 hover-glow">
              <i class="bi bi-telephone-fill"></i> +1 (984) 388-8298
            </a>
            <span class="text-secondary">|</span>
            <a href="{{ route('plans') }}" class="text-slate-300 text-decoration-none hover-cyan">
              Compare Plans
            </a>
            <span class="text-secondary">|</span>
            <a href="{{ route('portfolio') }}" class="text-slate-300 text-decoration-none hover-cyan">
              Portfolio
            </a>
          </div>
        </div>

      </form>

    </div>

  </div>
</section>

<!-- HEADQUARTERS MAP -->
<section class="position-relative py-5">
  <div class="container-xl px-3 px-sm-4 px-lg-5">
    <x-google-map />
  </div>
</section>
@endsection

@push('styles')
<style>
  .pick-item-card {
    background-color: #0B1320;
    border-radius: 8px !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    cursor: pointer;
  }
  .pick-item-card:hover {
    border-color: rgba(56, 189, 248, 0.45) !important;
    background-color: rgba(14, 23, 38, 0.95);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.6);
  }
  .pick-item-card.selected {
    border-color: #38BDF8 !important;
    background: linear-gradient(145deg, rgba(36, 105, 235, 0.22) 0%, rgba(56, 189, 248, 0.12) 100%) !important;
    box-shadow: 0 0 20px rgba(56, 189, 248, 0.25) !important;
  }
  .pick-item-card .card-check-box {
    width: 20px;
    height: 20px;
    border-radius: 6px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.18);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: transparent;
    font-size: 0.75rem;
    transition: all 0.2s ease;
    flex-shrink: 0;
  }
  .pick-item-card:hover .card-check-box {
    border-color: rgba(56, 189, 248, 0.5);
  }
  .pick-item-card.selected .card-check-box {
    background: #38BDF8;
    border-color: #38BDF8;
    color: #001D64;
    box-shadow: 0 0 10px rgba(56, 189, 248, 0.5);
  }
</style>
@endpush

@push('scripts')
<script>
  var selectedItems = [];

  function updateHiddenJson() {
    var input = document.getElementById('selected-items-json');
    if (input) {
      input.value = JSON.stringify(selectedItems);
    }
  }

  function toggleSelection(card) {
    var id = card.dataset.id;
    var name = card.dataset.name;
    var idx = -1;
    for (var i = 0; i < selectedItems.length; i++) {
      if (selectedItems[i].id === id) { idx = i; break; }
    }

    if (idx !== -1) {
      selectedItems.splice(idx, 1);
      card.classList.remove('selected');
    } else {
      selectedItems.push({ id: id, name: name });
      card.classList.add('selected');
    }
    updateHiddenJson();
  }

  // Pre-seed any already selected items on page load
  document.addEventListener('DOMContentLoaded', function () {
    var selectedCards = document.querySelectorAll('.pick-item-card.selected');
    selectedCards.forEach(function (c) {
      selectedItems.push({ id: c.dataset.id, name: c.dataset.name });
    });
    updateHiddenJson();
  });
</script>
@endpush

