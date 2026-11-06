<!-- ======================= MASTER GLOBAL FOOTER ======================= -->
<footer class="footer-portfolio-master text-slate-300 pt-5 pb-4">
  <div class="container-xl position-relative px-4 px-sm-4 px-lg-5">
    <div class="row g-4 g-lg-5">
      
      <!-- Column 1: Brand, Tagline & Social Media -->
      <div class="col-lg-4 col-md-6">
        <a href="{{ route('home') }}" class="navbar-brand-modern mb-3" aria-label="Azora Solutions Home">
          <span class="brand-icon-box">
            <svg viewBox="0 0 64 64" class="brand-logo-svg" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M32 14L50 50H41.4L32 26.4L22.6 50H14L32 14Z" fill="#FFFFFF"/>
              <circle cx="32" cy="43" r="4.2" fill="#38BDF8"/>
            </svg>
          </span>
          <span class="brand-text-box">
            <span class="brand-title">AZORA</span>
            <span class="brand-sub">Solutions</span>
          </span>
        </a>

        <p class="text-slate-400 small lh-base mb-4" style="max-width: 330px;">
          Conversion-engineered websites, local search growth, and AI front-office automation unified under one roof.
        </p>

        <!-- Social Media Circle Buttons -->
        <div class="d-flex align-items-center gap-2">
          <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="LinkedIn">
            <i class="bi bi-linkedin"></i>
          </a>
          <a href="https://x.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="X Twitter">
            <i class="bi bi-twitter-x"></i>
          </a>
          <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Facebook">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Instagram">
            <i class="bi bi-instagram"></i>
          </a>
        </div>
      </div>

      <!-- Column 2: Company Links -->
      <div class="col-lg-2 col-md-3 col-6">
        <h5 class="font-mono-badge text-slate-400 mb-3 fw-bold" style="font-size: 0.72rem; letter-spacing: 0.2em;">COMPANY</h5>
        <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
          <li><a href="{{ route('home') }}" class="text-slate-400 text-decoration-none hover-white">Home</a></li>
          <li><a href="{{ route('services') }}" class="text-slate-400 text-decoration-none hover-white">Services</a></li>
          <li><a href="{{ route('plans') }}" class="text-slate-400 text-decoration-none hover-white">Plans &amp; Pricing</a></li>
          <li><a href="{{ route('portfolio') }}" class="text-slate-400 text-decoration-none hover-white">Case Studies</a></li>
          <li><a href="{{ route('about') }}" class="text-slate-400 text-decoration-none hover-white">About Us</a></li>
        </ul>
      </div>

      <!-- Column 3: Services Links -->
      <div class="col-lg-3 col-md-3 col-6">
        <h5 class="font-mono-badge text-slate-400 mb-3 fw-bold" style="font-size: 0.72rem; letter-spacing: 0.2em;">SERVICES</h5>
        <ul class="list-unstyled small d-flex flex-column gap-2 mb-0">
          <li><a href="{{ route('plans') }}#website-plans" class="text-slate-400 text-decoration-none hover-white">Website Development</a></li>
          <li><a href="{{ route('plans') }}#marketing-plans" class="text-slate-400 text-decoration-none hover-white">Local SEO &amp; Maps Dominance</a></li>
          <li><a href="{{ route('services') }}" class="text-slate-400 text-decoration-none hover-white">Lead Generation Campaigns</a></li>
          <li><a href="{{ route('services') }}" class="text-slate-400 text-decoration-none hover-white">Managed Support &amp; Maintenance</a></li>
          <li><a href="{{ route('services') }}#ai-front-office" class="text-slate-400 text-decoration-none hover-white">AI Front-Office &amp; Support</a></li>
        </ul>
      </div>

      <!-- Column 4: Get In Touch -->
      <div class="col-lg-3 col-md-6">
        <h5 class="font-mono-badge text-slate-400 mb-3 fw-bold" style="font-size: 0.72rem; letter-spacing: 0.2em;">GET IN TOUCH</h5>
        <div class="d-flex flex-column gap-3 mb-4">
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-envelope text-azora-cyan fs-6"></i>
            <a href="mailto:hello@azorasolution.com" class="text-slate-300 text-decoration-none hover-white small">hello@azorasolution.com</a>
          </div>
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-telephone text-azora-cyan fs-6"></i>
            <a href="tel:+19843888298" class="text-slate-300 text-decoration-none hover-white small">+1 (984) 388-8298</a>
          </div>
          <div class="d-flex align-items-start gap-2">
            <i class="bi bi-geo-alt text-azora-cyan fs-6 mt-1"></i>
            <div class="small text-slate-400 lh-sm">
              <span class="d-block text-slate-300">Serving merchants nationwide</span>
              <span>1015 GLENDALE CHASE CT, Morrisville, NC</span>
            </div>
          </div>
        </div>

        <button type="button" onclick="AZ.openQuoteModal()" class="footer-btn-project">
          <span>Start a Project</span>
        </button>
      </div>

    </div>
  </div>

  <!-- Full-Width Giant AZORA Watermark with Bottom Fade -->
  <div class="footer-watermark-wrap select-none pointer-events-none" aria-hidden="true">
    <span class="footer-giant-watermark">AZORA</span>
  </div>

  <div class="container-xl position-relative px-4 px-sm-4 px-lg-5">
    <!-- Bottom Copyright & Legal Links -->
    <div class="pt-4 border-top border-secondary border-opacity-10 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 text-slate-500" style="font-size: 0.8rem;">
      <div>
        &copy; 2026 Azora Solutions LLC. All rights reserved.
      </div>
      <div class="d-flex flex-wrap gap-2 gap-md-3 text-slate-400" style="font-size: 0.78rem;">
        <span>Web Development</span>
        <span class="text-secondary">&bull;</span>
        <span>Local SEO &amp; Marketing</span>
        <span class="text-secondary">&bull;</span>
        <span>AI Systems</span>
      </div>
    </div>

  </div>
</footer>

