<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Azora Admin | Command Center</title>
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%230B1320'/%3E%3Cpath d='M32 14 50 50h-8.6L32 26.4 22.6 50H14z' fill='%23fff'/%3E%3Ccircle cx='32' cy='45' r='4.4' fill='%232469EB'/%3E%3C/svg%3E" />
  
  <!-- Google Fonts: Sora (Headings) & Poppins (Subheadings & Paragraphs) -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Sora:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet" />

  <!-- Bootstrap 5.3 Framework -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/bootstrap-icons.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/azora-modern.css') }}" />

  <style>
    .dashboard-sidebar {
      width: 250px;
      min-height: 100vh;
      background-color: #070B14;
      border-right: 1px solid rgba(255, 255, 255, 0.08);
      position: fixed;
      left: 0;
      top: 0;
      bottom: 0;
      z-index: 1020;
    }
    .dashboard-main {
      margin-left: 250px;
      min-height: 100vh;
      background-color: #0B1320;
    }
    .dashboard-topbar {
      height: 70px;
      background: rgba(11, 19, 32, 0.85);
      backdrop-filter: blur(15px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      position: sticky;
      top: 0;
      z-index: 1010;
    }
    .nav-btn {
      width: 100%;
      text-align: start;
      background: transparent;
      border: 0;
      color: #94A3B8;
      padding: 0.75rem 1rem;
      border-radius: 0.65rem;
      font-weight: 600;
      font-size: 0.85rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      transition: all 0.2s ease;
    }
    .nav-btn:hover, .nav-btn.active {
      background: rgba(255, 255, 255, 0.08);
      color: #FFFFFF;
    }
    .nav-btn.active {
      background: rgba(36, 105, 235, 0.2);
      color: #38BDF8;
      border: 1px solid rgba(56, 189, 248, 0.25);
    }
    .stat-box {
      background: #0F192C;
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 1rem;
      padding: 1.5rem;
    }
    .bar-pill {
      background: linear-gradient(180deg, #38BDF8, #2469EB);
      border-radius: 6px 6px 2px 2px;
      width: 32px;
      min-height: 4px;
      transition: height 0.5s ease;
    }
    @media (max-width: 991px) {
      .dashboard-sidebar {
        width: 100%;
        position: relative;
        min-height: auto;
      }
      .dashboard-main {
        margin-left: 0;
      }
    }
  </style>
</head>
<body class="text-white">

  <!-- Sidebar -->
  <aside class="dashboard-sidebar p-3 d-flex flex-column justify-content-between">
    <div>
      <!-- Brand Header -->
      <div class="d-flex align-items-center gap-3 pb-3 mb-3 border-bottom border-secondary border-opacity-25">
        <div class="d-grid place-items-center rounded-3 text-white" style="width: 38px; height: 38px; background: linear-gradient(135deg, #2469EB, #1D4ED8);">
          <svg viewBox="0 0 24 24" style="width: 18px; height: 18px;" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M12 3l9 18h-4.4L12 9.6 7.4 21H3z" />
            <circle cx="12" cy="18" r="1.8" fill="#38BDF8" stroke="none" />
          </svg>
        </div>
        <div>
          <strong class="font-heading fs-6 text-white d-block lh-1">AZORA</strong>
          <span class="font-mono-badge text-azora-cyan" style="font-size: 0.55rem; letter-spacing: 0.2em;">COMMAND CENTER</span>
        </div>
      </div>

      <!-- Navigation Tabs -->
      <nav class="d-flex flex-column gap-1">
        <button type="button" class="nav-btn active" id="btn-sec-overview" onclick="showSection('overview')">
          <i class="bi bi-grid-1x2"></i> Overview
        </button>
        <button type="button" class="nav-btn" id="btn-sec-leads" onclick="showSection('leads')">
          <i class="bi bi-people"></i> Customer Leads
          @if($unreadCount > 0)
            <span class="badge bg-danger rounded-pill ms-auto" style="font-size: 0.65rem;">{{ $unreadCount }}</span>
          @endif
        </button>
        <button type="button" class="nav-btn" id="btn-sec-reports" onclick="showSection('reports')">
          <i class="bi bi-graph-up"></i> Reports &amp; Analytics
        </button>
        <a href="{{ route('home') }}" class="nav-btn text-decoration-none mt-2">
          <i class="bi bi-globe"></i> View Website
        </a>
      </nav>
    </div>

    <!-- Userbox & Logout -->
    <div class="pt-3 border-top border-secondary border-opacity-25">
      <div class="p-2 rounded-3 border border-secondary border-opacity-25 mb-3" style="background: rgba(255,255,255,0.02);">
        <span class="font-mono-badge text-slate-400 d-block" style="font-size: 0.6rem;">AUTHENTICATED AS</span>
        <span class="small text-white text-truncate d-block fw-semibold">{{ session('admin_email', 'admin@azorasolution.com') }}</span>
        <button type="button" class="btn btn-sm btn-link p-0 text-azora-cyan text-decoration-none small mt-1" data-bs-toggle="modal" data-bs-target="#passwordModal">
          Change Password
        </button>
      </div>

      <form action="{{ route('dashboard.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-danger w-100 py-2 d-flex align-items-center justify-content-center gap-2">
          <i class="bi bi-box-arrow-right"></i> Log out
        </button>
      </form>
    </div>
  </aside>

  <!-- Main Content Area -->
  <main class="dashboard-main">
    
    <!-- Topbar -->
    <header class="dashboard-topbar px-4 d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center gap-3">
        <span class="badge rounded-pill bg-success bg-opacity-15 text-success font-mono-badge border border-success border-opacity-25 px-3 py-1">
          ● Live MySQL Database Connected
        </span>
      </div>

      <div class="d-flex align-items-center gap-2">
        <a href="{{ route('dashboard.export') }}" class="btn btn-sm btn-primary py-2 px-3">
          <i class="bi bi-download me-1"></i> Export Leads CSV
        </a>
      </div>
    </header>

    <div class="p-4 p-lg-5">
      
      <!-- ======================= 1. OVERVIEW SECTION ======================= -->
      <section id="section-overview">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
          <div>
            <span class="font-mono-badge text-azora-cyan small">OVERVIEW</span>
            <h1 class="font-heading fw-bold text-white fs-3 mb-0">Your Business At A Glance</h1>
            <p class="text-slate-400 small mb-0">Live customer leads, inquiries, and conversion analytics.</p>
          </div>
          <div class="text-slate-400 font-mono-badge small" style="font-size: 0.7rem;">
            Updated: {{ now()->format('M j, Y, g:i A') }}
          </div>
        </div>

        <!-- 4 Stat Cards -->
        <div class="row g-3 g-lg-4 mb-4">
          <div class="col-sm-6 col-xl-3">
            <div class="stat-box">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="font-mono-badge text-slate-400 small" style="font-size: 0.65rem;">TOTAL INQUIRIES</span>
                <span class="badge bg-success bg-opacity-15 text-success font-mono-badge">LIVE</span>
              </div>
              <div class="font-heading fs-1 fw-bolder text-white">{{ $totalLeads }}</div>
              <span class="text-slate-400 small">Lifetime recorded events</span>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="stat-box">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="font-mono-badge text-slate-400 small" style="font-size: 0.65rem;">QUOTE REQUESTS</span>
                <i class="bi bi-receipt text-azora-cyan"></i>
              </div>
              <div class="font-heading fs-1 fw-bolder text-azora-cyan">{{ $quotesCount }}</div>
              <span class="text-slate-400 small">Itemized scope proposals</span>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="stat-box">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="font-mono-badge text-slate-400 small" style="font-size: 0.65rem;">TODAY</span>
                <i class="bi bi-calendar-event text-warning"></i>
              </div>
              <div class="font-heading fs-1 fw-bolder text-white">{{ $todayCount }}</div>
              <span class="text-slate-400 small">New today</span>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="stat-box">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="font-mono-badge text-slate-400 small" style="font-size: 0.65rem;">LAST 7 DAYS</span>
                <i class="bi bi-star text-info"></i>
              </div>
              <div class="font-heading fs-1 fw-bolder text-white">{{ $last7DaysCount }}</div>
              <span class="text-slate-400 small">Rolling 7-day velocity</span>
            </div>
          </div>
        </div>

        <!-- 7-Day Activity Chart & Monthly Snapshot -->
        <div class="row g-4 mb-4">
          <div class="col-lg-8">
            <div class="stat-box h-100">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                  <h3 class="font-heading fw-bold text-white fs-5 mb-0">7-Day Lead Velocity</h3>
                  <p class="text-slate-400 small mb-0">Inbound customer quote activity by day.</p>
                </div>
                <span class="badge bg-primary bg-opacity-25 text-azora-cyan font-mono-badge">REALTIME</span>
              </div>
              
              <div class="d-flex align-items-end justify-content-between gap-2 pt-4" style="height: 200px;">
                @php
                  $maxCount = 1;
                  foreach($dailyActivity as $d) { if($d['count'] > $maxCount) $maxCount = $d['count']; }
                @endphp
                @foreach($dailyActivity as $day)
                  @php
                    $pct = max(10, round(($day['count'] / $maxCount) * 160));
                  @endphp
                  <div class="d-flex flex-column align-items-center flex-fill">
                    <span class="small font-mono-badge text-white mb-2">{{ $day['count'] }}</span>
                    <div class="bar-pill" style="height: {{ $pct }}px;"></div>
                    <span class="font-mono-badge text-slate-400 small mt-2" style="font-size: 0.65rem;">{{ $day['day'] }}</span>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="stat-box h-100">
              <h3 class="font-heading fw-bold text-white fs-5 mb-1">Monthly Snapshot</h3>
              <p class="text-slate-400 small mb-4">Recent monthly event totals.</p>
              
              <div class="d-flex flex-column gap-3">
                @foreach($monthlySnapshots as $snap)
                  <div class="d-flex justify-content-between align-items-center p-2 rounded-2 border border-secondary border-opacity-10" style="background: rgba(255,255,255,0.02);">
                    <span class="small text-slate-300 font-mono-badge">{{ $snap['label'] }}</span>
                    <strong class="font-heading text-azora-cyan">{{ $snap['count'] }} leads</strong>
                  </div>
                @endforeach
              </div>

              <div class="mt-4 pt-3 border-top border-secondary border-opacity-25">
                <button type="button" onclick="showSection('leads')" class="btn btn-outline-light w-100 py-2 small">
                  View All Customer Leads
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Leads Table Preview -->
        <div class="stat-box overflow-hidden">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h3 class="font-heading fw-bold text-white fs-5 mb-0">Recent Customer Inquiries</h3>
              <p class="text-slate-400 small mb-0">{{ $recentLeads->count() }} records loaded</p>
            </div>
            <button type="button" onclick="showSection('leads')" class="btn btn-sm btn-outline-secondary text-white">
              View All
            </button>
          </div>

          <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0" style="background-color: #0F192C;">
              <thead>
                <tr class="border-bottom border-secondary border-opacity-25 font-mono-badge text-slate-400 small">
                  <th>CUSTOMER</th>
                  <th>CONTACT</th>
                  <th>REQUEST TYPE</th>
                  <th>DATE</th>
                  <th>STATUS</th>
                  <th>ACTIONS</th>
                </tr>
              </thead>
              <tbody class="small text-slate-300">
                @forelse($recentLeads->take(10) as $lead)
                  <tr>
                    <td>
                      <strong class="text-white d-block">{{ $lead->business ?: 'New Prospect' }}</strong>
                      <span class="font-mono-badge text-azora-cyan" style="font-size: 0.65rem;">{{ $lead->ref }}</span>
                    </td>
                    <td>
                      <div>{{ $lead->contact ?: 'N/A' }}</div>
                      <small class="text-slate-400">{{ $lead->email ?: $lead->phone }}</small>
                    </td>
                    <td>
                      <span class="badge bg-primary bg-opacity-25 text-azora-cyan font-mono-badge">
                        {{ ucwords(str_replace('_', ' ', $lead->event_type)) }}
                      </span>
                    </td>
                    <td>
                      <span class="text-slate-400">{{ $lead->created_at ? $lead->created_at->format('M j, Y') : 'N/A' }}</span>
                    </td>
                    <td>
                      @if($lead->is_read)
                        <span class="badge bg-secondary font-mono-badge" style="font-size: 0.6rem;">READ</span>
                      @else
                        <span class="badge bg-success font-mono-badge" style="font-size: 0.6rem;">NEW</span>
                      @endif
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-info py-1 px-2 btn-lead-view" data-lead="{{ json_encode($lead, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) }}">
                        Inspect
                      </button>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center py-4 text-slate-400">No customer leads found yet.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- ======================= 2. LEADS MANAGEMENT SECTION ======================= -->
      <section id="section-leads" class="d-none">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
          <div>
            <span class="font-mono-badge text-azora-cyan small">LEAD MANAGEMENT</span>
            <h1 class="font-heading fw-bold text-white fs-3 mb-0">Customer Leads &amp; Proposals</h1>
            <p class="text-slate-400 small mb-0">Filter, inspect, export, or manage every incoming inquiry.</p>
          </div>
          <a href="{{ route('dashboard.export') }}" class="btn btn-primary py-2 px-3 small">
            <i class="bi bi-download me-1"></i> Export All to CSV
          </a>
        </div>

        <div class="stat-box">
          <!-- Filters Toolbar -->
          <div class="row g-2 mb-4">
            <div class="col-md-5">
              <input type="text" id="leadSearchInput" class="form-control form-control-azora" placeholder="Search customer, business, email, phone, reference..." onkeyup="filterLeadsTable()" />
            </div>
            <div class="col-md-4">
              <select id="leadTypeFilter" class="form-select form-control-azora" onchange="filterLeadsTable()">
                <option value="all">All Event Types</option>
                <option value="quote">Quote Requests</option>
                <option value="website">Website Development</option>
                <option value="seo">Local SEO</option>
                <option value="contact">Contact Requests</option>
              </select>
            </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-outline-secondary w-100 text-white" onclick="resetFilters()">
                Reset Filters
              </button>
            </div>
          </div>

          <!-- All Leads Table -->
          <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0" id="allLeadsTable" style="background-color: #0F192C;">
              <thead>
                <tr class="border-bottom border-secondary border-opacity-25 font-mono-badge text-slate-400 small">
                  <th>REFERENCE</th>
                  <th>BUSINESS &amp; CONTACT</th>
                  <th>REQUESTED ITEMS</th>
                  <th>SUBMITTED</th>
                  <th>ACTIONS</th>
                </tr>
              </thead>
              <tbody class="small text-slate-300">
                @foreach($recentLeads as $lead)
                  <tr class="lead-row" data-type="{{ strtolower($lead->event_type) }}" data-search="{{ strtolower($lead->business . ' ' . $lead->contact . ' ' . $lead->email . ' ' . $lead->phone . ' ' . $lead->ref) }}">
                    <td>
                      <span class="font-mono-badge text-azora-cyan fw-bold d-block">{{ $lead->ref }}</span>
                      <small class="text-slate-400">{{ ucwords(str_replace('_', ' ', $lead->event_type)) }}</small>
                    </td>
                    <td>
                      <strong class="text-white d-block">{{ $lead->business ?: 'New Prospect' }}</strong>
                      <div>{{ $lead->contact ?: 'N/A' }} &bull; <a href="mailto:{{ $lead->email }}" class="text-azora-cyan text-decoration-none">{{ $lead->email }}</a></div>
                      @if($lead->phone)
                        <div class="text-slate-400">{{ $lead->phone }}</div>
                      @endif
                    </td>
                    <td>
                      @if(!empty($lead->items) && is_array($lead->items))
                        <span class="text-slate-300">
                          {{ count($lead->items) }} item(s) selected
                        </span>
                      @elseif($lead->message)
                        <span class="text-slate-400 text-truncate d-inline-block" style="max-width: 200px;">{{ $lead->message }}</span>
                      @else
                        <span class="text-slate-500">General Inquiry</span>
                      @endif
                    </td>
                    <td>
                      <span class="text-slate-400">{{ $lead->created_at ? $lead->created_at->format('M j, Y, g:i A') : 'N/A' }}</span>
                    </td>
                    <td>
                      <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-info py-1 px-2 btn-lead-view" data-lead="{{ json_encode($lead, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) }}">
                          View
                        </button>
                        <form action="{{ route('lead.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Permanently delete this customer lead?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </section>

      <!-- ======================= 3. REPORTS & ANALYTICS SECTION ======================= -->
      <section id="section-reports" class="d-none">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
          <div>
            <span class="font-mono-badge text-azora-cyan small">ANALYTICS &amp; METRICS</span>
            <h1 class="font-heading fw-bold text-white fs-3 mb-0">Reports &amp; Analytics</h1>
            <p class="text-slate-400 small mb-0">Inspect monthly performance trends and download records.</p>
          </div>
          <a href="{{ route('dashboard.export') }}" class="btn btn-primary py-2 px-3 small">
            <i class="bi bi-download me-1"></i> Download Historical CSV
          </a>
        </div>

        <div class="row g-4 mb-4">
          <div class="col-md-4">
            <div class="stat-box text-center">
              <span class="font-mono-badge text-slate-400 small">LIFETIME LEADS</span>
              <div class="font-heading fs-1 fw-bold text-white my-2">{{ $totalLeads }}</div>
              <span class="text-success small"><i class="bi bi-graph-up"></i> Inbound Volume</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-box text-center">
              <span class="font-mono-badge text-slate-400 small">FORMAL QUOTES</span>
              <div class="font-heading fs-1 fw-bold text-azora-cyan my-2">{{ $quotesCount }}</div>
              <span class="text-azora-cyan small">Custom Scope Generators</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-box text-center">
              <span class="font-mono-badge text-slate-400 small">CURRENT MONTH</span>
              <div class="font-heading fs-1 fw-bold text-warning my-2">{{ $monthlySnapshots[0]['count'] ?? 0 }}</div>
              <span class="text-slate-400 small">This month to date</span>
            </div>
          </div>
        </div>

        <div class="stat-box">
          <h3 class="font-heading fw-bold text-white fs-5 mb-3">Enterprise Scope Overview</h3>
          <p class="text-slate-300 small lh-lg">
            Azora's lead engine captures inquiries from the website homepage, rapid quote modal, plan configurator, and 24/7 AI front-office assistant. All leads are persisted securely in MySQL and instantly emailed to your configured sales inbox with zero external dependency.
          </p>
        </div>
      </section>

    </div>
  </main>

  <!-- Lead Detail Modal -->
  <div class="modal fade" id="leadDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content modal-content-azora p-4">
        <div class="d-flex justify-content-between align-items-center border-bottom border-secondary border-opacity-25 pb-3">
          <div>
            <span class="font-mono-badge text-azora-cyan small" id="m-ref">REFERENCE</span>
            <h3 class="font-heading fw-bold text-white fs-5 mb-0" id="m-business">Business Details</h3>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary text-white" data-bs-dismiss="modal">✕</button>
        </div>

        <div class="modal-body px-0 py-3">
          <div class="row g-3 mb-4">
            <div class="col-sm-6">
              <span class="font-mono-badge text-slate-400 small d-block">CONTACT NAME</span>
              <strong class="text-white" id="m-contact">N/A</strong>
            </div>
            <div class="col-sm-6">
              <span class="font-mono-badge text-slate-400 small d-block">EMAIL ADDRESS</span>
              <span id="m-email">N/A</span>
            </div>
            <div class="col-sm-6">
              <span class="font-mono-badge text-slate-400 small d-block">PHONE NUMBER</span>
              <span id="m-phone">N/A</span>
            </div>
            <div class="col-sm-6">
              <span class="font-mono-badge text-slate-400 small d-block">LOCATIONS</span>
              <span id="m-locations">N/A</span>
            </div>
          </div>

          <div class="mb-3">
            <span class="font-mono-badge text-slate-400 small d-block mb-1">REQUESTED ITEMS / SERVICES</span>
            <div id="m-items" class="p-3 rounded-3 border border-secondary border-opacity-25" style="background-color: #070B14;">
              None specified
            </div>
          </div>

          <div>
            <span class="font-mono-badge text-slate-400 small d-block mb-1">SCOPE NOTES / MESSAGE</span>
            <div id="m-message" class="p-3 rounded-3 border border-secondary border-opacity-25 text-slate-300 small" style="background-color: #070B14; white-space: pre-wrap;">
              No notes provided.
            </div>
          </div>
        </div>

        <div class="modal-footer border-top border-secondary border-opacity-25 px-0 pb-0 d-flex justify-content-between">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <a href="#" id="m-reply-btn" class="btn btn-primary">Reply by Email</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Password Change Modal -->
  <div class="modal fade" id="passwordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-content-azora p-4">
        <div class="d-flex justify-content-between align-items-center border-bottom border-secondary border-opacity-25 pb-3">
          <h3 class="font-heading fw-bold text-white fs-5 mb-0">Change Admin Password</h3>
          <button type="button" class="btn btn-sm btn-outline-secondary text-white" data-bs-dismiss="modal">✕</button>
        </div>

        <form id="changePasswordForm" class="mt-3">
          <div class="mb-3">
            <label class="form-label font-mono-badge text-slate-400 small">CURRENT PASSWORD</label>
            <input type="password" name="current_password" class="form-control form-control-azora" required />
          </div>
          <div class="mb-3">
            <label class="form-label font-mono-badge text-slate-400 small">NEW PASSWORD</label>
            <input type="password" name="new_password" class="form-control form-control-azora" minlength="8" required />
          </div>
          <div id="passwordAlert" class="small mb-3 d-none"></div>

          <button type="submit" class="btn btn-primary w-100 py-2">
            Update Password
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5.3 Bundle -->
  <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>

  <script>
    function showSection(name) {
      var sections = ['overview', 'leads', 'reports'];
      sections.forEach(function (s) {
        var el = document.getElementById('section-' + s);
        var btn = document.getElementById('btn-sec-' + s);
        if (s === name) {
          if (el) el.classList.remove('d-none');
          if (btn) btn.classList.add('active');
        } else {
          if (el) el.classList.add('d-none');
          if (btn) btn.classList.remove('active');
        }
      });
    }

    function viewLeadDetails(lead) {
      document.getElementById('m-ref').textContent = lead.ref || 'AZ-REF';
      document.getElementById('m-business').textContent = lead.business || 'Unnamed Prospect';
      document.getElementById('m-contact').textContent = lead.contact || 'Not provided';
      document.getElementById('m-email').textContent = lead.email || 'Not provided';
      document.getElementById('m-phone').textContent = lead.phone || 'Not provided';
      document.getElementById('m-locations').textContent = (lead.locations || '1') + ' location(s)';
      document.getElementById('m-message').textContent = lead.message || 'No additional notes.';
      
      var itemsBox = document.getElementById('m-items');
      itemsBox.innerHTML = '';
      if (lead.items && Array.isArray(lead.items) && lead.items.length > 0) {
        var ul = document.createElement('ul');
        ul.className = 'list-unstyled mb-0 small';
        lead.items.forEach(function (it) {
          var name = typeof it === 'object' ? (it.name || it.id || '') : String(it);
          var li = document.createElement('li');
          li.textContent = '• ' + name;
          ul.appendChild(li);
        });
        itemsBox.appendChild(ul);
      } else {
        var span = document.createElement('span');
        span.className = 'text-slate-500';
        span.textContent = 'None specified';
        itemsBox.appendChild(span);
      }

      var replyBtn = document.getElementById('m-reply-btn');
      if (lead.email) {
        replyBtn.href = 'mailto:' + lead.email + '?subject=Regarding your Azora Solutions quote (' + lead.ref + ')';
        replyBtn.classList.remove('d-none');
      } else {
        replyBtn.classList.add('d-none');
      }

      var modal = new bootstrap.Modal(document.getElementById('leadDetailModal'));
      modal.show();

      // Mark as read in background
      var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      fetch('/dashboard/lead/' + lead.id + '/read', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken }
      });
    }

    document.addEventListener('click', function (e) {
      var btn = e.target.closest('.btn-lead-view');
      if (btn && btn.dataset.lead) {
        try {
          var leadData = JSON.parse(btn.dataset.lead);
          viewLeadDetails(leadData);
        } catch (err) {
          console.error('Failed to parse lead dataset:', err);
        }
      }
    });

    function filterLeadsTable() {
      var query = document.getElementById('leadSearchInput').value.toLowerCase();
      var type = document.getElementById('leadTypeFilter').value.toLowerCase();
      var rows = document.querySelectorAll('.lead-row');

      rows.forEach(function (row) {
        var searchStr = row.dataset.search || '';
        var rowType = row.dataset.type || '';
        var matchesQuery = query === '' || searchStr.indexOf(query) !== -1;
        var matchesType = type === 'all' || rowType.indexOf(type) !== -1;

        if (matchesQuery && matchesType) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }

    function resetFilters() {
      document.getElementById('leadSearchInput').value = '';
      document.getElementById('leadTypeFilter').value = 'all';
      filterLeadsTable();
    }

    // Password change AJAX
    document.getElementById('changePasswordForm').addEventListener('submit', async function (e) {
      e.preventDefault();
      var form = e.target;
      var fd = new FormData(form);
      var alertBox = document.getElementById('passwordAlert');
      var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      try {
        var resp = await fetch('/dashboard/password', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({
            current_password: fd.get('current_password'),
            new_password: fd.get('new_password')
          })
        });

        var json = await resp.json();
        alertBox.classList.remove('d-none');
        if (json.ok) {
          alertBox.className = 'alert alert-success p-2 small';
          alertBox.textContent = json.message || 'Password updated successfully.';
          setTimeout(function () {
            var modal = bootstrap.Modal.getInstance(document.getElementById('passwordModal'));
            if (modal) modal.hide();
          }, 1500);
        } else {
          alertBox.className = 'alert alert-danger p-2 small';
          alertBox.textContent = json.error || 'Failed to update password.';
        }
      } catch (err) {
        alertBox.className = 'alert alert-danger p-2 small';
        alertBox.textContent = 'Server error occurred.';
      }
    });
  </script>
</body>
</html>

