@props(['active' => ''])

<!-- ======================= GLOBAL NAVIGATION HEADER ======================= -->
<header id="site-header" class="fixed-top transition-all" style="z-index: 1040;">
  <div class="container-xl px-3 px-sm-4">
    <div id="header-inner" class="glass-nav-header mt-3 d-flex align-items-center justify-content-between px-3 px-sm-4 py-2 py-sm-3">
      
      <!-- Brand Logo (Centered and Aligned) -->
      <a href="{{ route('home') }}" class="navbar-brand-modern group" aria-label="Azora Solutions Home">
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

      <!-- Desktop Navigation Menu -->
      <nav class="d-none d-lg-flex align-items-center gap-1" id="nav-links">
        <a href="{{ route('home') }}" class="nav-link-modern {{ $active === 'home' ? 'active' : '' }}">Home</a>
        
        <!-- Reusable Services Dropdown -->
        <div class="azora-dropdown">
          <a href="{{ route('services') }}" class="nav-link-modern azora-dropdown-toggle {{ $active === 'services' ? 'active' : '' }}" role="button" aria-expanded="false">
            Services
            <svg viewBox="0 0 20 20" style="width: 14px; height: 14px; opacity: 0.75;" fill="currentColor">
              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
          </a>

          <!-- Dropdown Menu items -->
          <div class="azora-dropdown-menu">
            <a href="{{ route('plans') }}#website-plans" class="azora-dropdown-item">
              <span class="azora-dropdown-item-icon" style="background: rgba(16, 185, 129, 0.15); color: #34D399;">
                <svg viewBox="0 0 24 24" style="width: 18px; height: 18px;" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                </svg>
              </span>
              <div>
                <div class="fw-bold text-white small">Website Development</div>
                <div class="text-slate-400" style="font-size: 0.75rem;">Custom high-converting web architecture</div>
              </div>
            </a>

            <a href="{{ route('plans') }}#marketing-plans" class="azora-dropdown-item">
              <span class="azora-dropdown-item-icon" style="background: rgba(192, 132, 252, 0.15); color: #C084FC;">
                <svg viewBox="0 0 24 24" style="width: 18px; height: 18px;" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M23 6l-9.5 9.5-5-5L1 18"/>
                </svg>
              </span>
              <div>
                <div class="fw-bold text-white small">Digital Growth &amp; SEO</div>
                <div class="text-slate-400" style="font-size: 0.75rem;">Google Map Pack &amp; organic ranking</div>
              </div>
            </a>

            <a href="{{ route('services') }}#ai-front-office" class="azora-dropdown-item">
              <span class="azora-dropdown-item-icon" style="background: rgba(251, 191, 36, 0.15); color: #FBBF24;">
                <svg viewBox="0 0 24 24" style="width: 18px; height: 18px;" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 2l1.9 5.6 5.8.2-4.6 3.6 1.7 5.8-4.8-3.4-4.8 3.4 1.7-5.8L4.3 7.8l5.8-.2z"/>
                </svg>
              </span>
              <div>
                <div class="fw-bold text-white small">AI Front Office</div>
                <div class="text-slate-400" style="font-size: 0.75rem;">WhatsApp &amp; Voice Receptionist</div>
              </div>
            </a>

            <a href="{{ route('services') }}#custom-software" class="azora-dropdown-item">
              <span class="azora-dropdown-item-icon" style="background: rgba(56, 189, 248, 0.15); color: #38BDF8;">
                <svg viewBox="0 0 24 24" style="width: 18px; height: 18px;" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 3v18M3 9h18"/>
                </svg>
              </span>
              <div>
                <div class="fw-bold text-white small">Enterprise Cloud Software</div>
                <div class="text-slate-400" style="font-size: 0.75rem;">Scalable systems &amp; automation</div>
              </div>
            </a>

            <div class="border-top border-secondary border-opacity-25 my-1"></div>

            <a href="{{ route('services') }}" class="azora-dropdown-item py-2">
              <span class="small text-azora-cyan fw-bold">Explore All Solutions</span>
            </a>
          </div>
        </div>

        <a href="{{ route('plans') }}" class="nav-link-modern {{ $active === 'plans' ? 'active' : '' }}">Pricing &amp; Plans</a>
        <a href="{{ route('portfolio') }}" class="nav-link-modern {{ $active === 'portfolio' ? 'active' : '' }}">Portfolio</a>
        <a href="{{ route('about') }}" class="nav-link-modern {{ $active === 'about' ? 'active' : '' }}">About Us</a>
      </nav>

      <!-- Right Quick Action CTAs -->
      <div class="d-flex align-items-center gap-2 gap-sm-3">
        <a href="tel:+19843888298" class="nav-phone-btn d-none d-lg-inline-flex py-2 px-3" style="font-size: 0.8rem;" title="Call Azora Solutions: (984) 388-8298" aria-label="Call Azora Solutions at (984) 388-8298">
          <i class="bi bi-telephone-fill text-azora-cyan" style="font-size: 0.75rem;"></i>
          <span>(984) 388-8298</span>
        </a>

        <!-- Animated Light/Dark Theme Switcher -->
        <button type="button" class="theme-toggle-btn d-inline-flex" id="theme-toggle-btn" aria-label="Toggle light or dark theme" title="Switch Theme" onclick="AZ.toggleTheme()">
          <span class="theme-toggle-track">
            <span class="theme-toggle-thumb">
              <i class="bi bi-sun-fill icon-sun" aria-hidden="true"></i>
              <i class="bi bi-moon-stars-fill icon-moon" aria-hidden="true"></i>
            </span>
          </span>
        </button>

        <button type="button" onclick="AZ.openQuoteModal()" class="btn-modern-primary d-none d-sm-inline-flex py-2 px-3" style="font-size: 0.8rem;">
          <span>Get a Quote</span>
        </button>

        <!-- Mobile Navigation Trigger -->
        <button id="menu-btn" aria-label="Toggle navigation" class="nav-mobile-trigger d-lg-none" type="button">
          <svg id="menu-ic-open" viewBox="0 0 24 24" style="width: 20px; height: 20px;" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h10"/></svg>
          <svg id="menu-ic-close" class="d-none" viewBox="0 0 24 24" style="width: 20px; height: 20px;" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
      </div>

    </div>

    <!-- Mobile Drawer Menu (Bootstrap Responsive & Premium Luxury Finish) -->
    <div id="mobile-menu" class="mobile-nav-panel mt-2 p-3 p-sm-4 d-none d-lg-none" role="dialog" aria-modal="true" aria-label="Mobile Navigation Menu">
      <div class="mobile-nav-inner">
        
        <!-- Header Eyebrow with Mobile Theme Switcher -->
        <div class="d-flex justify-content-between align-items-center pb-2 mb-2 border-bottom border-white border-opacity-10">
          <span class="mobile-nav-eyebrow">NAVIGATION DIRECTORY</span>
          <div class="d-flex align-items-center gap-2">
            <button type="button" class="theme-toggle-btn" aria-label="Toggle light or dark theme" title="Switch Theme" onclick="AZ.toggleTheme()">
              <span class="theme-toggle-track">
                <span class="theme-toggle-thumb">
                  <i class="bi bi-sun-fill icon-sun" aria-hidden="true"></i>
                  <i class="bi bi-moon-stars-fill icon-moon" aria-hidden="true"></i>
                </span>
              </span>
            </button>
            <span class="mobile-nav-status">
              <span class="pulse-dot-online"></span> LIVE 24/7
            </span>
          </div>
        </div>

        <!-- Primary Navigation List -->
        <nav class="d-flex flex-column gap-1 mb-2">
          <a href="{{ route('home') }}" class="mobile-nav-link {{ $active === 'home' ? 'active' : '' }}">
            <span class="mobile-nav-num">01</span>
            <span class="mobile-nav-label">Home</span>
            @if($active === 'home')
              <span class="mobile-active-indicator">CURRENT</span>
            @endif
          </a>

          <!-- Services Accordion / Submenu -->
          <div>
            <a href="{{ route('services') }}" class="mobile-nav-link {{ $active === 'services' ? 'active' : '' }}">
              <span class="mobile-nav-num">02</span>
              <span class="mobile-nav-label">Services</span>
              @if($active === 'services')
                <span class="mobile-active-indicator">CURRENT</span>
              @endif
            </a>

            <!-- Sub Services Grid -->
            <div class="mobile-services-grid mt-1">
              <a href="{{ route('plans') }}#website-plans" class="mobile-service-chip">
                <span class="mobile-chip-icon web">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </span>
                <div>
                  <span class="mobile-chip-title">Web Development</span>
                  <span class="mobile-chip-sub">High-Speed Funnels</span>
                </div>
              </a>

              <a href="{{ route('plans') }}#marketing-plans" class="mobile-service-chip">
                <span class="mobile-chip-icon seo">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 6l-9.5 9.5-5-5L1 18"/></svg>
                </span>
                <div>
                  <span class="mobile-chip-title">Local SEO &amp; Growth</span>
                  <span class="mobile-chip-sub">Map Pack Dominance</span>
                </div>
              </a>

              <a href="{{ route('services') }}#ai-front-office" class="mobile-service-chip">
                <span class="mobile-chip-icon ai">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l1.9 5.6 5.8.2-4.6 3.6 1.7 5.8-4.8-3.4-4.8 3.4 1.7-5.8L4.3 7.8l5.8-.2z"/></svg>
                </span>
                <div>
                  <span class="mobile-chip-title">AI Front Office</span>
                  <span class="mobile-chip-sub">24/7 Voice &amp; Chat</span>
                </div>
              </a>

              <a href="{{ route('services') }}#custom-software" class="mobile-service-chip">
                <span class="mobile-chip-icon cloud">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 3v18M3 9h18"/></svg>
                </span>
                <div>
                  <span class="mobile-chip-title">Custom Software</span>
                  <span class="mobile-chip-sub">Cloud Backends</span>
                </div>
              </a>
            </div>
          </div>

          <a href="{{ route('plans') }}" class="mobile-nav-link {{ $active === 'plans' ? 'active' : '' }}">
            <span class="mobile-nav-num">03</span>
            <span class="mobile-nav-label">Plans &amp; Pricing</span>
            @if($active === 'plans')
              <span class="mobile-active-indicator">CURRENT</span>
            @endif
          </a>

          <a href="{{ route('portfolio') }}" class="mobile-nav-link {{ $active === 'portfolio' ? 'active' : '' }}">
            <span class="mobile-nav-num">04</span>
            <span class="mobile-nav-label">Client Portfolio</span>
            @if($active === 'portfolio')
              <span class="mobile-active-indicator">CURRENT</span>
            @endif
          </a>

          <a href="{{ route('about') }}" class="mobile-nav-link {{ $active === 'about' ? 'active' : '' }}">
            <span class="mobile-nav-num">05</span>
            <span class="mobile-nav-label">About Azora</span>
            @if($active === 'about')
              <span class="mobile-active-indicator">CURRENT</span>
            @endif
          </a>
        </nav>

        <!-- Direct CTA Buttons -->
        <div class="mobile-nav-ctas d-flex flex-column gap-2 pt-2 border-top border-white border-opacity-10">
          <a href="tel:+19843888298" class="mobile-phone-btn" title="Call (984) 388-8298">
            <i class="bi bi-telephone-fill text-azora-cyan"></i>
            <span>Call (984) 388-8298</span>
          </a>
          <button type="button" onclick="AZ.openQuoteModal()" class="btn-modern-primary py-2 text-center w-100 justify-content-center" style="font-size: 0.85rem; border-radius: 8px;">
            <span>Request a Custom Quote</span>
          </button>
        </div>

        <!-- Giant AZORA Watermark with Bottom Fade (Signature Style) -->
        <div class="mobile-menu-watermark-wrap" aria-hidden="true">
          <span class="mobile-menu-giant-watermark">AZORA</span>
        </div>

      </div>
    </div>

  </div>
</header>
