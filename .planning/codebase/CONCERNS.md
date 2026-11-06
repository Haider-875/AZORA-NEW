# Codebase Concerns

**Analysis Date:** 2026-11-06

## Tech Debt

**Legacy Hardware & Abandoned Supabase Scripts:**
- Issue: Static JavaScript files from the pre-Laravel architecture remain in `public/assets/js/` despite project documentation stating POS and hardware features were completely removed.
- Files: 
  - `public/assets/js/catalog-sync.js` (90 lines: references Supabase, Clover POS terminals, and retail hardware leases)
  - `public/assets/js/dashboard.js` (1,407 lines: legacy Supabase live lead dashboard and catalog manager)
  - `public/assets/js/lead-store.js` (142 lines: legacy Supabase direct fallback insert)
  - `public/assets/js/imgdata.js` (641 KB base64-encoded images of hardware terminals)
  - `resources/views/components/terminal-carousel.blade.php` (retains "PAYMATE-STYLE CARD MACHINE CAROUSEL" comments, CSS classes, and structure)
  - `resources/views/pages/portfolio.blade.php` (loads `paymate-carousel.css`, `paymate-carousel.js`, and `<x-terminal-carousel />`)
- Impact: 650+ KB of dead asset weight in repository, potential security confusion regarding obsolete Supabase client integrations, and styling/branding debt.
- Fix approach: Delete unreferenced legacy scripts (`catalog-sync.js`, `dashboard.js`, `lead-store.js`, `imgdata.js`). Rename and re-namespace `terminal-carousel.blade.php` and its associated CSS/JS to a generic portfolio showcase component (`portfolio-carousel`).

**Dual Asset Pipeline & Code Duplication:**
- Issue: Asset management is split between Vite (`resources/css/` & `resources/js/`) and manual static file links in `public/assets/`. Duplicate copies of CSS/JS files exist in both trees.
- Files:
  - `resources/css/paymate-carousel.css` duplicates `public/assets/css/paymate-carousel.css` (13,092 bytes each)
  - `resources/js/paymate-carousel.js` duplicates `public/assets/js/paymate-carousel.js`
  - `resources/views/layouts/app.blade.php` (invokes `@vite(['resources/css/app.css', 'resources/js/app.js'])` while also manually including static scripts from `public/assets/js/` and vendor assets)
- Impact: Developers risk editing one file while the page serves another. Build pipeline confusion and bloated network payloads.
- Fix approach: Unify all styles and scripts under `resources/` managed by Vite, or consolidate into `public/assets/` if keeping raw static assets. Eliminate duplicate files.

**Non-Standard Ad-Hoc Authentication Architecture:**
- Issue: Laravel's standard authentication subsystem (`App\Models\User`, guards, `auth` middleware, bcrypt hashing) is completely bypassed in favor of raw session variable checks.
- Files:
  - `app/Http/Controllers/DashboardController.php` (checks `session('admin_authenticated')`)
  - `app/Models/User.php` (unused)
  - `database/migrations/0001_01_01_000000_create_users_table.php` (orphaned migration)
  - `database/seeders/DatabaseSeeder.php` (seeds a test user that cannot log into the dashboard)
- Impact: Lacks password hashing standards in database, rate limiting, session regeneration protection, multi-user support, and role-based policies.
- Fix approach: Migrate dashboard authentication to Laravel's native authentication (`Auth::attempt()`) using the `User` model, or create an `Admin` guard with standard `auth` middleware.

---

## Known Bugs

**Ephemeral Admin Password Update (Loss on Session Expiry):**
- Symptoms: When an administrator changes their password via the Command Center settings modal, the password reverts back to the default fallback (`AzoraAdmin2026!`) as soon as the session expires, the browser closes, or login is attempted from another browser.
- Files: `app/Http/Controllers/DashboardController.php:125-153`
- Trigger: Submit new password via `POST /dashboard/password`. Controller executes `session(['admin_password_hash' => Hash::make($request->new_password)])` instead of saving to a database table or persistent config.
- Workaround: Keep browser session active continuously. Permanent fix requires persisting admin credentials in the `users` table.

**Client-Side Silent Failure on Failed Lead Submissions:**
- Symptoms: Prospective customers are shown the `/success` page and told their quote request succeeded even if the backend returns a 422 Unprocessable Entity, 500 Server Error, or network error occurs.
- Files: `public/assets/js/app.js:541-558`
- Trigger: Submit quote form with server unreachable or invalid payload. Catch block logs `console.warn` and unconditionally redirects: `window.location.href = '/success'`.
- Workaround: None for end user. Leads are permanently lost without notice. Fix requires inspecting `resp.ok`, checking `resData.ok`, and rendering visible error states.

---

## Security Considerations

**Critical Broken Access Control on Lead Management Endpoints (Data Leak & Destruction):**
- Risk: Complete exposure of customer PII (names, business names, email addresses, phone numbers, inquiry messages) and unauthorized modification/deletion of lead records.
- Files:
  - `routes/web.php:52-56`
  - `app/Http/Controllers/LeadController.php:116-192`
- Current mitigation: None. Routes are defined outside any auth middleware or controller-level session checks.
- Recommendations:
  1. Wrap admin lead actions in an authentication middleware group:
     ```php
     Route::middleware(['auth'])->group(function () {
         Route::post('/dashboard/lead/{id}/read', [LeadController::class, 'markRead'])->name('lead.markRead');
         Route::delete('/dashboard/lead/{id}', [LeadController::class, 'destroy'])->name('lead.destroy');
         Route::get('/dashboard/export', [LeadController::class, 'exportCsv'])->name('dashboard.export');
         Route::post('/dashboard/password', [DashboardController::class, 'updatePassword'])->name('dashboard.password');
     });
     ```
  2. Add session validation directly inside `LeadController::markRead`, `destroy`, and `exportCsv` as defense-in-depth.

**Stored Cross-Site Scripting (XSS) in Admin Dashboard Drawer:**
- Risk: Malicious payload submitted via public quote forms executes in the admin's browser session, enabling session hijacking, CSRF token theft, or admin account compromise.
- Files:
  - `resources/views/dashboard/index.blade.php:609-619`
  - `app/Http/Controllers/LeadController.php:35, 40-45`
- Current mitigation: Honeypot check filters simple automated bots, but does not sanitize payload contents.
- Recommendations:
  1. Replace raw `innerHTML` concatenation in `viewLeadDetails()` with text content assignment or sanitized DOM creation (`document.createElement`).
  2. Escape lead items using HTML entities before displaying in the drawer.
  3. Fix single-quote attribute injection vulnerability at lines 335 & 428 (`onclick='viewLeadDetails(@json($lead))'`) by binding data via data attributes: `data-lead="{{ json_encode($lead, JSON_HEX_APOS | JSON_HEX_QUOT) }}"`.

**CSRF Verification Disabled for Lead Ingestion:**
- Risk: Cross-Site Request Forgery bypass allows malicious third-party websites to submit forged quote requests from a victim's browser, flooding the admin inbox and polluting MySQL.
- Files: `bootstrap/app.php:14-20`
- Current mitigation: Basic honeypot field (`website`, `fax_number`).
- Recommendations: Remove `'lead'` from `$middleware->validateCsrfTokens(except: [...])`. Require valid CSRF token on all web submissions. If external API access is required, restrict exemptions strictly to authenticated API routes (`/api/*`) using API tokens or Sanctum.

**Missing Rate Limiting (DoS, Brute Force & Email Flooding):**
- Risk: No throttle middleware is applied to `/dashboard/login`, `/lead`, `/quote`, `/contact`, or `/api/lead`. Attackers can brute-force admin credentials or flood the system with automated leads, exhausting outbound SMTP quotas and overwhelming database storage.
- Files: `routes/web.php:34-46`
- Current mitigation: None.
- Recommendations: Apply Laravel's built-in `throttle:login` (e.g. 5 attempts per minute) to `/dashboard/login` and `throttle:leads` (e.g. 10 requests per minute per IP) to submission routes.

**Permissive Lead Validation:**
- Risk: In `LeadController::store`, every single input field (`business`, `contact`, `email`, `phone`, `locations`, `message`, `items`, `page_url`, `ref`) is defined as `nullable`. An empty POST payload `{}` will pass validation, insert a blank record, and attempt to send an email.
- Files: `app/Http/Controllers/LeadController.php:27-38`
- Current mitigation: None.
- Recommendations: Require at least one reliable contact method (e.g., `'email' => 'required_without:phone|nullable|email:rfc,dns'`, `'phone' => 'required_without:email|nullable|string'`).

**Direct `env()` Calls in Controllers Breaking with `config:cache`:**
- Risk: In production, executing `php artisan config:cache` causes `env()` calls outside `config/*.php` to return `null`. This breaks admin authentication and causes hardcoded fallback credentials to be used.
- Files: `app/Http/Controllers/DashboardController.php:33-34, 136`
- Current mitigation: Fallback strings (`admin@azorasolution.com`, `AzoraAdmin2026!`) hardcoded into PHP source code.
- Recommendations: Move admin credentials into `config/azora.php` and access them via `config('azora.admin_email')` and `config('azora.admin_password')`. Never hardcode fallback passwords in source files.

---

## Performance Bottlenecks

**Synchronous Email Dispatch on HTTP Request:**
- Problem: Sending transactional lead notification emails occurs synchronously during the user's web request.
- Files:
  - `app/Http/Controllers/LeadController.php:84-86`
  - `app/Mail/LeadReceived.php:12-14`
- Cause: `LeadReceived` implements `Mailable` but does NOT implement `Illuminate\Contracts\Queue\ShouldQueue`. The user request blocks while performing DNS lookup, TLS handshake, and SMTP conversation.
- Improvement path: Implement `ShouldQueue` on `LeadReceived` and configure the database queue (`QUEUE_CONNECTION=database`). Lead submissions will respond in <50ms instead of 1,500ms-5,000ms.

**Unindexed `created_at` and Full-Table Scans on Admin Dashboard:**
- Problem: Loading `/dashboard` runs 16 individual queries that scan the entire `leads` table.
- Files:
  - `app/Http/Controllers/DashboardController.php:74-109`
  - `database/migrations/2026_11_04_175120_create_leads_table.php:14-33`
- Cause:
  1. `created_at` timestamp is not indexed in the migration.
  2. 7 sequential queries execute `whereDate('created_at', $date)->count()` in a loop, applying date functions that prevent index utilization.
  3. 4 sequential queries execute string LIKE operations on timestamps: `where('created_at', 'like', "{$monthKey}%")->count()`.
  4. `Lead::latest()->take(50)->get()` performs table sort on unindexed `created_at`.
- Improvement path:
  1. Add an index to `created_at` in a new migration: `$table->index('created_at')`.
  2. Replace loop queries with a single aggregated query grouped by date:
     ```php
     $dailyActivity = Lead::where('created_at', '>=', now()->subDays(6)->startOfDay())
         ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
         ->groupBy('date')
         ->pluck('count', 'date');
     ```

---

## Fragile Areas

**Single-Quote JSON String Injection in Blade Attributes:**
- Files: `resources/views/dashboard/index.blade.php:335, 428`
- Why fragile: Passing `@json($lead)` inside single-quoted HTML attributes (`onclick='viewLeadDetails(@json($lead))'`) will break JavaScript parsing if any customer submits a name, business, or message containing single quotes or unescaped apostrophes (e.g. `O'Connor` or `Joe's Cafe`). This results in `Uncaught SyntaxError` and disables the modal for that lead.
- Safe modification: Pass the lead ID and look up data from a pre-rendered data store, or attach click event listeners using `dataset` attributes encoded with `htmlspecialchars()`.
- Test coverage: Zero tests exist for dashboard modal rendering or quote escaping.

**Honeypot-Only Spam Defense:**
- Files: `app/Http/Controllers/LeadController.php:19-25`
- Why fragile: Sophisticated scrapers and headless browser bots do not fill hidden inputs with common names like `website` or `fax_number`. Once spammers identify the form, they can flood the database and SMTP server.
- Safe modification: Implement time-gate checks (e.g. form submitted in under 3 seconds = bot) and integrate Cloudflare Turnstile or Google reCAPTCHA v3.
- Test coverage: No automated tests verifying bot filtration or honeypot behavior.

---

## Scaling Limits

**SQLite vs MySQL Deployment Ambiguity:**
- Current capacity: `config/database.php` specifies `'default' => env('DB_CONNECTION', 'sqlite')`. A `database/database.sqlite` file is present in the repository, while documentation claims production targets MySQL (`azora_db`).
- Limit: SQLite file locking will cause `database is locked` concurrency errors under simultaneous quote submissions and admin dashboard activity.
- Scaling path: Enforce MySQL connection in `.env.example` and production environments. Add `database.sqlite` to `.gitignore` to prevent committing live or local SQLite databases.

**In-Memory CSV Stream Export:**
- Current capacity: `LeadController::exportCsv` queries all leads matching the month without cursor pagination: `$leads = $query->get()`.
- Limit: When lead count exceeds 5,000-10,000 records, fetching full Eloquent models with JSON casts into memory will exceed PHP memory limits (`memory_limit = 128M`).
- Scaling path: Use chunked streaming via `Lead::chunk(500, function ($leads) { ... })` or Laravel's `LazyCollection` (`$query->cursor()`).

---

## Dependencies at Risk

**Abandoned and Unpinned Dependencies:**
- Package: `laravel/framework` (`^13.17`)
  - Risk: Repository is running on bleeding-edge / preview Laravel 13 framework skeletons. Ecosystem packages or third-party extensions may have compatibility constraints with PHP 8.3/8.4 and Laravel 13 features.
  - Impact: Potential vendor incompatibilities or API deprecations during future composer updates.
  - Mitigation plan: Pin dependencies strictly in `composer.json` and ensure test suites run on continuous integration.
- Package: `@laravel/multiplex` (`^0.4.1` in optionalDependencies)
  - Risk: Optional development package with low ecosystem adoption.

---

## Missing Critical Features

**Database-Backed Admin User Management:**
- Problem: No admin user model, password reset mechanism, or multi-admin support exists.
- Blocks: Team collaboration, secure credential rotation, audit logging of lead actions (who deleted or marked a lead as read).

**Transactional Email Queuing:**
- Problem: Asynchronous background worker setup (`QUEUE_CONNECTION=database` with queue worker process) is not enabled or implemented in Mailables.
- Blocks: Resilient quote handling during SMTP outages or third-party mail provider latency.

**Lead Status Workflow & Notes:**
- Problem: Leads only have `is_read` (true/false).
- Blocks: CRM pipeline stages (Contacted, In Progress, Proposal Sent, Won, Lost) and internal sales notes.

---

## Test Coverage Gaps

**Untested Area: Lead Ingestion & Validation**
- What's not tested: Submitting valid quotes, empty payloads, honeypot traps, and AJAX JSON responses in `LeadController::store`.
- Files: `app/Http/Controllers/LeadController.php`
- Risk: Regressions in proposal capture could silently drop prospective customer inquiries.
- Priority: High

**Untested Area: Admin Authorization & Lead Actions**
- What's not tested: Unauthenticated access to `markRead`, `destroy`, `exportCsv`, and `index`.
- Files: `app/Http/Controllers/DashboardController.php`, `app/Http/Controllers/LeadController.php`
- Risk: Broken access control allows public unauthorized data leak and record deletion.
- Priority: High

**Untested Area: CSV Export Data Integrity**
- What's not tested: Date filtering, column mapping, and CSV structure generation.
- Files: `app/Http/Controllers/LeadController.php:145-192`
- Risk: Broken reports or memory crashes during administrative data exports.
- Priority: Medium

**Untested Area: Mailable Rendering**
- What's not tested: `LeadReceived` envelope formatting, subject line generation, and Blade email template rendering.
- Files: `app/Mail/LeadReceived.php`, `resources/views/emails/lead-received.blade.php`
- Risk: Email sending crashes on missing fields (e.g. null items or null contact).
- Priority: Medium

---

## Prioritized Remediation Roadmap

1. **Immediate (Security - High Priority):**
   - Add auth middleware protection to `/dashboard/lead/*` and `/dashboard/export`.
   - Sanitize lead `items` rendering in `dashboard/index.blade.php` to prevent Stored XSS.
   - Fix single-quote attribute breakout in `viewLeadDetails()` calls.
   - Apply rate limiting (`throttle:60,1` and `throttle:5,1`) on submission and login endpoints.
   - Enforce non-nullable validation on contact fields (require email or phone).

2. **Short-Term (Reliability & Performance):**
   - Implement `ShouldQueue` on `LeadReceived` mailable to decouple email dispatch from HTTP request lifecycle.
   - Add index to `created_at` on `leads` table and optimize aggregate queries in `DashboardController`.
   - Fix frontend AJAX handler in `app.js` to inspect response status and display actionable errors instead of redirecting on failure.
   - Migrate admin authentication to standard Laravel database-backed `users` table with persistent password hashing.

3. **Medium-Term (Cleanup & Tech Debt):**
   - Remove unused legacy scripts (`catalog-sync.js`, `dashboard.js`, `lead-store.js`, `imgdata.js`).
   - Clean up Paymate / terminal remnants and unify asset pipelines under Vite.
   - Build automated test suite covering lead submission, validation, honeypot filtering, and dashboard access control.

---

*Concerns audit: 2026-11-06*
