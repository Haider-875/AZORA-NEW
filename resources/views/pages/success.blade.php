@extends('layouts.app')

@section('content')
<section class="position-relative overflow-hidden py-5 my-md-4">
  <div class="floating-orb floating-orb-primary position-absolute top-50 start-50 translate-middle pointer-events-none" style="width: 600px; height: 350px;" aria-hidden="true"></div>

  <div class="container-xl position-relative px-3 px-sm-4 text-center" style="max-width: 720px; z-index: 1;">
    
    <div class="glass-card-interactive rounded-4 p-4 p-md-5 border border-info border-opacity-25 shadow-lg animate-scaleIn">
      
      <!-- Checkmark Icon -->
      <div class="d-grid place-items-center rounded-circle mx-auto mb-4" style="width: 72px; height: 72px; background: rgba(16, 185, 129, 0.15); border: 2px solid rgba(16, 185, 129, 0.4);">
        <svg viewBox="0 0 24 24" style="width: 36px; height: 36px; color: #10B981;" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4.5 12.5l5 5 10-11"/>
        </svg>
      </div>

      <span class="azora-badge mb-3">PROPOSAL REQUEST CONFIRMED</span>
      <h1 class="font-heading fw-bolder text-white display-6 mb-3">
        Thank You! We've Received Your Scope.
      </h1>

      <p class="text-slate-300 fs-6 lh-base mb-4">
        Our US-based engineering team has received your inquiry. A formal itemized proposal will be dispatched to your email address shortly.
      </p>

      <!-- Reference Box -->
      @php
        $lead = session('lead');
        $ref = is_object($lead) ? ($lead->ref ?? null) : (is_array($lead) ? ($lead['ref'] ?? null) : null);
        $ref = $ref ?: ('AZ-' . date('ymd') . '-REQ');
      @endphp
      <div class="p-3 rounded-3 border border-secondary border-opacity-25 mb-4" style="background-color: #070B14;">
        <span class="font-mono-badge text-slate-400 small d-block">PROPOSAL TRACKING REFERENCE</span>
        <span class="font-mono-badge text-azora-cyan fs-5 fw-bold" id="success-ref">{{ $ref }}</span>
      </div>

      <!-- What to Expect -->
      <div class="row g-3 text-start small mb-4">
        <div class="col-sm-4">
          <div class="p-3 rounded-3 border border-secondary border-opacity-25 h-100" style="background: rgba(255,255,255,0.02);">
            <strong class="text-white d-block mb-1">1. Scope Review</strong>
            <span class="text-slate-400">Technical director audits your requirements.</span>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="p-3 rounded-3 border border-secondary border-opacity-25 h-100" style="background: rgba(255,255,255,0.02);">
            <strong class="text-white d-block mb-1">2. Itemized Quote</strong>
            <span class="text-slate-400">Delivered directly to your inbox with zero obligation.</span>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="p-3 rounded-3 border border-secondary border-opacity-25 h-100" style="background: rgba(255,255,255,0.02);">
            <strong class="text-white d-block mb-1">3. Rapid Launch</strong>
            <span class="text-slate-400">Direct kickoff within 48 hours of approval.</span>
          </div>
        </div>
      </div>

      <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
        <a href="{{ route('home') }}" class="btn-modern-primary py-2 px-4 small">
          <span>Return to Homepage</span>
        </a>
        <a href="{{ route('plans') }}" class="btn-modern-secondary py-2 px-4 small">
          <span>Explore Pricing &amp; Plans</span>
        </a>
      </div>

    </div>

  </div>
</section>
@endsection

