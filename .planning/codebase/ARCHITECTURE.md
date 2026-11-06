<!-- refreshed: 2026-11-06 -->
<Architecture>
**Analysis Date:** 2026-11-06

## System Overview

```text
┌─────────────────────────────────────────────────────────────────────────┐
│                       Client / Presentation Layer                       │
├─────────────────────┬─────────────────────┬─────────────────────────────┤
│  Blade Layouts      │  Blade Components   │  Client JS & Motion Engine  │
│  `resources/views/  │  `resources/views/  │  `public/assets/js/app.js`  │
│   layouts/app.blade`│   components/*.blade│  `resources/js/motion-cards`│
└──────────┬──────────┴──────────┬──────────┴──────────────┬──────────────┘
           │                     │                         │
           ▼                     ▼                         ▼
┌─────────────────────────────────────────────────────────────────────────┐
│                      HTTP Routing & Middleware Layer                    │
│    `routes/web.php` · `bootstrap/app.php` (CSRF Whitelist, API JSON)    │
└─────────────────────────────────┬───────────────────────────────────────┘
                                  │
                                  ▼
┌─────────────────────────────────────────────────────────────────────────┐
│                         Controller / Logic Layer                        │
├───────────────────────┬─────────────────────────┬───────────────────────┤
│  PageController       │  LeadController         │  DashboardController  │
│  `app/Http/Controllers│  `app/Http/Controllers/ │  `app/Http/Controllers│
│   /PageController.php`│   LeadController.php`   │   /DashboardController│
└───────────┬───────────┴────────────┬────────────┴───────────┬───────────┘
            │                        │                        │
            ▼                        ▼                        ▼
┌─────────────────────────────────────────────────────────────────────────┐
│                     Domain, Persistence & Mail Layer                    │
├────────────────────────────────┬────────────────────────────────────────┤
│  Eloquent Models               │  Mailable Notifications                │
│  `app/Models/Lead.php`         │  `app/Mail/LeadReceived.php`           │
│  `app/Models/User.php`         │  `resources/views/emails/lead-received`│
├────────────────────────────────┴────────────────────────────────────────┤
│  Database Storage: SQLite (`database/database.sqlite`) / MySQL          │
└─────────────────────────────────────────────────────────────────────────┘
```

## Component Responsibilities

| Component | Responsibility | File |
|-----------|----------------|------|
| `PageController` | Handles public page routing, metadata injection (`$title`, `$metaDescription`, `$canonical`), and query parameter forwarding | `app/Http/Controllers/PageController.php` |
| `LeadController` | Validates inquiries/quotes, executes honeypot spam filters, persists `Lead` Eloquent records, triggers notification emails, and supports CSV export | `app/Http/Controllers/LeadController.php` |
| `DashboardController` | Manages single-tenant admin authentication sessions, calculates 7-day metric arrays, renders Command Center, and updates credentials | `app/Http/Controllers/DashboardController.php` |
| `Lead` Model | Eloquent representation of client leads, handles JSON array attribute casting (`items`), and defines query scopes (`scopeUnread`, `scopeQuotes`) | `app/Models/Lead.php` |
| `User` Model | Standard Laravel authenticatable model with factory integration | `app/Models/User.php` |
| `LeadReceived` Mailable | HTML alert email mailable dispatched to site administrators upon quote submission | `app/Mail/LeadReceived.php` |
| Master Layout | Base HTML document scaffolding, Google Fonts, Bootstrap 5.3, Vite bundle integration, custom cursor, and dynamic modal mounting nodes | `resources/views/layouts/app.blade.php` |
| Navigation Component | Sticky glass header navigation with responsive dropdowns, service links, and mobile drawer | `resources/views/components/navbar.blade.php` |
| Motion Card Component | Reusable container featuring beam accents, monospace counter scrambling, and accessible attributes | `resources/views/components/card.blade.php` |
| Terminal Carousel | Interactive 3D portfolio showcase displaying sector case histories and metrics | `resources/views/components/terminal-carousel.blade.php` |
| Google Map Bento | Headquarters contact and embedded Google Maps iframe bento widget | `resources/views/components/google-map.blade.php` |
| Global Footer | Canonical links, contact details, copyright, and social profiles | `resources/views/components/footer.blade.php` |

## Pattern Overview

**Overall:** Laravel Monolithic MVC with Server-Side Blade Templating and Hybrid Client-Side Motion Assets.

**Key Characteristics:**
- **Thin Controllers, Direct Eloquent Operations:** Controllers validate requests using `$request->validate()` and invoke Eloquent ORM operations directly without an intermediary service repository layer.
- **Blade Component Architecture:** UI widgets and recurring visual elements (`<x-navbar>`, `<x-card>`, `<x-footer>`, `<x-google-map>`, `<x-terminal-carousel>`) are implemented as autonomous, prop-driven Blade components.
- **Dual Client Asset Pipeline:** The frontend utilizes Vite (`vite.config.js`) for modern bundled components (`resources/css/app.css`, `resources/js/app.js`), while static vendor engines (Bootstrap 5.3, GSAP 3.x, ScrollTrigger) and legacy data stores live in `public/assets/`.

## Layers

**Presentation Layer:**
- Purpose: Render accessible, SEO-optimized, responsive dark-mode web interfaces.
- Location: `resources/views/`
- Contains: Master layouts (`resources/views/layouts/app.blade.php`), page templates (`resources/views/pages/`), UI components (`resources/views/components/`), dashboard screens (`resources/views/dashboard/`), and email layouts (`resources/views/emails/`).
- Depends on: Assets served from `public/assets/` and bundles compiled by Vite.
- Used by: HTTP request responses returned by controllers.

**HTTP & Routing Layer:**
- Purpose: Direct incoming URI requests, enforce security middleware, exempt API endpoints from CSRF, and handle redirects.
- Location: `routes/web.php` and `bootstrap/app.php`
- Contains: Route definitions, 301 legacy hardware redirects, CSRF exemption filters, and JSON response configuration.
- Depends on: `app/Http/Controllers/*`.
- Used by: Web server gateway (PHP FastCGI / FrankenPHP / Artisan).

**Application / Controller Layer:**
- Purpose: Coordinate request handling, parameter sanitization, model orchestration, and view dispatching.
- Location: `app/Http/Controllers/`
- Contains: `PageController.php`, `LeadController.php`, `DashboardController.php`, and base `Controller.php`.
- Depends on: `app/Models/Lead.php`, `app/Mail/LeadReceived.php`, `Illuminate\Support\Facades\*`.
- Used by: Route bindings defined in `routes/web.php`.

**Domain & Persistence Layer:**
- Purpose: Encapsulate data structure, data type casting, querying scopes, and database storage.
- Location: `app/Models/` and `database/`
- Contains: `Lead.php`, `User.php`, database migrations (`database/migrations/`), and SQLite database file (`database/database.sqlite`).
- Depends on: Laravel Eloquent ORM and database driver (SQLite / MySQL PDO).
- Used by: `LeadController.php`, `DashboardController.php`.

**Notification Layer:**
- Purpose: Generate and transmit email alerts when users submit leads.
- Location: `app/Mail/`
- Contains: `LeadReceived.php` mailable and `resources/views/emails/lead-received.blade.php`.
- Depends on: Laravel Mail subsystem and configured SMTP/mail transport.
- Used by: `LeadController::store`.

## Data Flow

### Primary Request Path: Lead / Quote Submission

1. **Submission Entry Point:** User submits quote form via AJAX POST to `/quote` or `/lead` (`resources/views/pages/quote.blade.php`).
2. **CSRF & Route Resolution:** Handled by `routes/web.php:35-37`. Note: `bootstrap/app.php:15-19` validates or exempts tokens based on path.
3. **Bot Trap & Validation:** `LeadController::store` (`app/Http/Controllers/LeadController.php:19-38`) verifies honeypot fields (`website`, `fax_number`). If filled, silently returns success without writing to the database. Validates incoming parameters (`business`, `contact`, `email`, `phone`, `locations`, `message`, `items`).
4. **Data Normalization & Unique Ref Generation:** `LeadController::store` (`app/Http/Controllers/LeadController.php:41-63`) decodes JSON or arrays in `items`, sets `event_type`, and generates ref string (`AZ-ymd-XXXX`).
5. **Persistence:** Saved into SQLite/MySQL database via `Lead::create([...])` (`app/Http/Controllers/LeadController.php:66-80`).
6. **Email Dispatch:** Dispatches mailable `Mail::to($recipient)->send(new LeadReceived($lead))` (`app/Http/Controllers/LeadController.php:82-96`). Updates `$lead->email_status` to `'sent'` or `'failed'`.
7. **Response Delivery:** Returns structured JSON response (`app/Http/Controllers/LeadController.php:100-107`) or 302 redirect with flash data to `/success` (`app/Http/Controllers/LeadController.php:110`).

### Public Marketing Page Request Flow

1. User sends HTTP GET request (e.g. `/`, `/services`, `/plans`, `/portfolio`, `/about`).
2. `routes/web.php:15-24` resolves route to matching method in `PageController`.
3. `PageController` generates metadata array (`title`, `metaDescription`, `canonical`, `activeNav`) and renders view in `resources/views/pages/`.
4. Blade template compiles layout (`resources/views/layouts/app.blade.php`), renders `<x-navbar>`, embeds view `@section('content')`, injects `<x-footer>`, and loads Vite + static assets.
5. Rendered HTML is returned to the client browser.

### Admin Command Center Flow

1. Admin accesses `/dashboard/login` (`DashboardController::login`).
2. Submits credentials via POST to `/dashboard/login` (`DashboardController::authenticate`). Checks email and password against `.env` settings or hashed session overrides.
3. Upon authentication, `session(['admin_authenticated' => true])` is saved.
4. Admin is redirected to `/dashboard` (`DashboardController::index`).
5. `DashboardController::index` queries `Lead::count()`, calculates 7-day daily activity counts, constructs monthly snapshots, and fetches the 50 most recent leads.
6. Renders `resources/views/dashboard/index.blade.php`.

**State Management:**
- **Server State:** Cookie-based session storage tracks administrative login status (`session('admin_authenticated')`, `session('admin_password_hash')`).
- **Database State:** Stored in SQLite (`database/database.sqlite`) or MySQL using `leads`, `users`, `jobs`, `cache` tables.
- **Client State:** Global JavaScript variables in `window.AZ_DATA` (`public/assets/js/data.js`), runtime lead helper `window.AZStore` (`public/assets/js/lead-store.js`), and in-flight request tracking maps.

## Key Abstractions

**Blade Component Slots & Props:**
- Purpose: Encapsulate interactive UI patterns with configurable attributes while preserving semantic markup.
- Examples: `resources/views/components/card.blade.php`, `resources/views/components/navbar.blade.php`, `resources/views/components/terminal-carousel.blade.php`.
- Pattern: Component-based Blade templates with `@props` declarations and slot interpolation.

**Eloquent Scope Modifiers:**
- Purpose: Provide reusable query constraints for lead filtering.
- Examples: `Lead::scopeUnread` (`app/Models/Lead.php:41-44`), `Lead::scopeQuotes` (`app/Models/Lead.php:49-52`).
- Pattern: Active Record Query Scope.

**Mailable Envelope & Content Value Objects:**
- Purpose: Standardize email transmission structure in Laravel.
- Examples: `app/Mail/LeadReceived.php:29-47`.
- Pattern: Laravel Mailable Envelope/Content configuration.

## Entry Points

**Web HTTP Entry:**
- Location: `public/index.php`
- Triggers: Inbound web server HTTP request.
- Responsibilities: Boots Composer autoloader, loads `bootstrap/app.php`, processes request through HTTP kernel and router, and transmits response back to client.

**CLI Console Entry:**
- Location: `artisan`
- Triggers: Terminal execution (`php artisan [command]`).
- Responsibilities: Boots CLI kernel and console commands defined in `routes/console.php`.

**Frontend Asset Entry:**
- Location: `resources/js/app.js` and `resources/css/app.css`
- Triggers: Vite compilation (`npm run build` or `npm run dev`).
- Responsibilities: Compiles modern CSS, imports `motion-cards.js`, and packages production assets into `public/build/`.

## Architectural Constraints

- **Threading:** PHP single-threaded shared-nothing process execution model. Background work (e.g. queue jobs) relies on the `jobs` database table and CLI worker process (`php artisan queue:work`).
- **Global State:** Client-side JavaScript injects global objects (`window.AZ_DATA`, `window.AZStore`, `window.AZ`). Modifying these objects at runtime alters site-wide behavior.
- **CSRF Whitelisting:** `bootstrap/app.php:15-19` bypasses CSRF verification for `/lead`, `/api/*`, and `/.netlify/*`. External tools or scripts can POST directly to these endpoints without a CSRF token.
- **Single-Tenant Admin Authentication:** Admin dashboard authentication does not use Laravel's native multi-user database authentication (`Auth::attempt()`); it uses a custom session flag evaluated against environment variables.

## Anti-Patterns

### Direct `env()` Access Inside Controller Code

**What happens:** `DashboardController.php:33-34` calls `env('ADMIN_EMAIL')` and `env('ADMIN_PASSWORD')` directly inside controller action methods.
**Why it's wrong:** When Laravel configurations are cached via `php artisan config:cache` in production, `env()` returns `null` for all keys outside `config/` files, locking admins out of the dashboard.
**Do this instead:** Define administrative keys in `config/services.php` or `config/auth.php` and read them using `config('services.admin.email')` and `config('services.admin.password')`.

### Split Asset Architecture (Unversioned Static Assets vs Vite Bundles)

**What happens:** The layout (`resources/views/layouts/app.blade.php`) mixes `@vite(...)` compilation with hardcoded static `<script>` and `<link>` tags pointing directly to `public/assets/`.
**Why it's wrong:** Modifying files in `public/assets/js/` or `public/assets/css/` does not generate cache-busting content hashes, causing client browsers to serve stale cached scripts after updates.
**Do this instead:** Import all custom stylesheets and scripts into `resources/css/app.css` and `resources/js/app.js`, allowing Vite to compile and version them in `public/build/`.

### Client-Side Database Fallback with Exposed Third-Party Secrets

**What happens:** `public/assets/js/lead-store.js:19-42` contains fallback logic attempting to write directly to Supabase from the client browser using `window.AZ_SUPABASE_CONFIG`.
**Why it's wrong:** Bypasses Laravel server-side validation, creates dual sources of truth, and exposes client credentials.
**Do this instead:** Keep lead intake exclusively within Laravel's `LeadController::store`, storing data in the primary database and dispatching asynchronous jobs for external synchronization.

## Error Handling

**Strategy:** Hybrid error handling combining global JSON interception with controller-level try-catch fallback.

**Patterns:**
- **Global API Exception Interception:** Configured in `bootstrap/app.php:21-25` via `$exceptions->shouldRenderJsonWhen(...)`, ensuring API and AJAX requests receive structured JSON error payloads instead of HTML error pages.
- **Resilient Notification Failover:** In `LeadController.php:82-96`, lead storage is isolated from mail transmission via `try-catch (\Throwable $e)`. If SMTP fails, the lead is successfully preserved with `email_status = 'failed'` and `email_error` logged to the database.

## Cross-Cutting Concerns

**Logging:** Uses Laravel's built-in PSR-3 logger (`Illuminate\Support\Facades\Log`). All lead email transmission exceptions are written to `storage/logs/laravel.log`.
**Validation:** Form inputs are validated in controllers using `$request->validate([...])`. Honeypot fields (`website`, `fax_number`) provide automated anti-bot protection.
**Authentication:** Managed via custom session tokens (`session('admin_authenticated')`) checked at controller entry points.

---

*Architecture analysis: 2026-11-06*
