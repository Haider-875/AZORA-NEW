<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Azora Admin | Command Center Login</title>
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%230B1320'/%3E%3Cpath d='M32 14 50 50h-8.6L32 26.4 22.6 50H14z' fill='%23fff'/%3E%3Ccircle cx='32' cy='45' r='4.4' fill='%232469EB'/%3E%3C/svg%3E" />
  
  <!-- Google Fonts: Sora (Headings) & Poppins (Subheadings & Paragraphs) -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Sora:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet" />

  <!-- Bootstrap 5.3 -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap-icons.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/azora-modern.css') }}" />
</head>
<body class="bg-mesh-dark d-flex align-items-center justify-content-center min-vh-100 p-3">
  
  <div class="glass-panel p-4 p-sm-5 rounded-4 border border-secondary border-opacity-25 shadow-lg w-100 animate-scaleIn" style="max-width: 440px;">
    
    <!-- Brand Icon -->
    <div class="d-flex align-items-center gap-3 mb-4">
      <div class="d-grid place-items-center rounded-3 text-white" style="width: 44px; height: 44px; background: linear-gradient(135deg, #2469EB, #1D4ED8); box-shadow: 0 0 20px rgba(36,105,235,0.6);">
        <svg viewBox="0 0 24 24" style="width: 22px; height: 22px;" fill="none" stroke="currentColor" stroke-width="2.5">
          <path d="M12 3l9 18h-4.4L12 9.6 7.4 21H3z" />
          <circle cx="12" cy="18" r="1.8" fill="#38BDF8" stroke="none" />
        </svg>
      </div>
      <div>
        <h2 class="font-heading fw-bolder text-white fs-4 mb-0">AZORA</h2>
        <span class="font-mono-badge text-azora-cyan" style="font-size: 0.6rem; letter-spacing: 0.25em;">Admin Command Center</span>
      </div>
    </div>

    <h1 class="font-heading fw-bold text-white fs-5 mb-2">Sign in to Command Center</h1>
    <p class="text-slate-400 small mb-4">Manage customer leads, quote requests, and performance analytics.</p>

    @if($errors->any())
      <div class="alert alert-danger border-0 small py-2 px-3 mb-4 rounded-3" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5;">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ route('dashboard.authenticate') }}" method="POST">
      @csrf
      
      <div class="mb-3">
        <label class="form-label font-mono-badge text-slate-300 small" style="font-size: 0.65rem;">ADMIN EMAIL</label>
        <div class="input-group">
          <span class="input-group-text border-secondary border-opacity-25 text-slate-400" style="background-color: #070B14;"><i class="bi bi-envelope"></i></span>
          <input type="email" name="email" class="form-control form-control-azora" value="{{ old('email', 'admin@azorasolution.com') }}" required />
        </div>
      </div>

      <div class="mb-4">
        <label class="form-label font-mono-badge text-slate-300 small" style="font-size: 0.65rem;">PASSWORD</label>
        <div class="input-group">
          <span class="input-group-text border-secondary border-opacity-25 text-slate-400" style="background-color: #070B14;"><i class="bi bi-lock"></i></span>
          <input type="password" name="password" class="form-control form-control-azora" placeholder="••••••••••••" required />
        </div>
      </div>

      <button type="submit" class="btn-modern-primary w-100 py-2 fs-6 justify-content-center shadow-lg">
        <span>Sign In to Dashboard</span>
      </button>

      <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="text-slate-400 text-decoration-none small">
          Return to Website
        </a>
      </div>
    </form>

  </div>

</body>
</html>

