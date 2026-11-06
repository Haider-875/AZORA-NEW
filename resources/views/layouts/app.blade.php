<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>{{ $title ?? 'Azora Solution | Website Development & Digital Marketing Services' }}</title>
  <meta name="description" content="{{ $metaDescription ?? 'Azora Solution provides custom website development, local SEO growth systems, and AI front-office automation for modern businesses.' }}" />
  <link rel="canonical" href="{{ $canonical ?? url()->current() }}" />

  <!-- Favicon -->
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%230B1320'/%3E%3Cpath d='M32 14 50 50h-8.6L32 26.4 22.6 50H14z' fill='%23fff'/%3E%3Ccircle cx='32' cy='45' r='4.4' fill='%232469EB'/%3E%3C/svg%3E" />

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website" />
  <meta property="og:url" content="{{ $canonical ?? url()->current() }}" />
  <meta property="og:site_name" content="Azora Solution" />
  <meta property="og:title" content="{{ $title ?? 'Azora Solution' }}" />
  <meta property="og:description" content="{{ $metaDescription ?? 'Custom website development, local SEO, and AI front-office automation.' }}" />
  <meta property="og:image" content="{{ asset('assets/img/plans/plan-website-growth.svg') }}" />

  <!-- Google Fonts: Sora (Headings) & Poppins (Subheadings & Paragraphs) -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Sora:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Bootstrap 5.3 CSS (Primary Framework) -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}" />
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap-icons.min.css') }}" />

  <!-- Azora Modern Futuristic Design System -->
  <link rel="stylesheet" href="{{ asset('assets/css/azora-modern.css') }}" />
  <!-- Hero Motion Dashboard Cluster Styles -->
  <link rel="stylesheet" href="{{ asset('assets/css/hero-motion.css') }}" />

  <!-- Vite Sitewide Motion Cards System -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <noscript><style>[data-motion-card]{opacity:1 !important;transform:none !important;}</style></noscript>

  <script>document.documentElement.className += ' js';</script>

  <!-- Schema.org JSON-LD Structured Data -->
  <script type="application/ld+json">
  {!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
      [
        '@type' => 'ProfessionalService',
        '@id' => url('/') . '/#organization',
        'name' => 'Azora Solution',
        'url' => url('/'),
        'logo' => asset('assets/img/portfolio/caresourceindy-logo.png'),
        'image' => asset('assets/img/plans/plan-website-growth.svg'),
        'description' => 'High-performance commercial web engineering, local SEO growth systems, and AI front-office automation for American businesses.',
        'telephone' => '+19843888298',
        'email' => 'hello@azorasolution.com',
        'address' => [
          '@type' => 'PostalAddress',
          'streetAddress' => '1015 GLENDALE CHASE CT',
          'addressLocality' => 'Morrisville',
          'addressRegion' => 'NC',
          'postalCode' => '27560',
          'addressCountry' => 'US',
        ],
        'geo' => [
          '@type' => 'GeoCoordinates',
          'latitude' => 35.8324,
          'longitude' => -78.8256,
        ],
        'priceRange' => '$$$',
      ],
      [
        '@type' => 'WebSite',
        '@id' => url('/') . '/#website',
        'url' => url('/'),
        'name' => 'Azora Solution',
        'publisher' => [
          '@id' => url('/') . '/#organization',
        ],
      ],
    ],
  ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
  </script>
  @stack('styles')
</head>

<body class="bg-mesh-dark">
  <!-- Interactive Custom Cursor Elements -->
  <div class="cursor-core" aria-hidden="true"></div>
  <div class="cursor-ring" aria-hidden="true"></div>

  <!-- Reusable Global Navbar -->
  <x-navbar :active="$activeNav ?? ''" />

  <!-- Main Content Slot -->
  <main id="app" style="min-height: 80vh; padding-top: 96px;">
    @yield('content')
  </main>

  <!-- Reusable Master Global Footer -->
  <x-footer />

  <!-- Containers for Dynamic Modals & Widgets -->
  <div id="global-quote-modal-root"></div>
  <div id="concierge-root"></div>

  <!-- Bootstrap 5.3 Bundle JavaScript (Includes Popper for dropdowns & tooltips) -->
  <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>

  <!-- GSAP & ScrollTrigger Animation Engine -->
  <script src="{{ asset('assets/vendor/gsap/gsap.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/gsap/ScrollTrigger.min.js') }}"></script>

  <!-- Azora Data & App Logic -->
  <script src="{{ asset('assets/js/data.js') }}"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script>
  <!-- Hero Live Motion Dashboard Logic -->
  <script src="{{ asset('assets/js/hero-motion.js') }}" defer></script>

  @stack('scripts')
</body>
</html>

