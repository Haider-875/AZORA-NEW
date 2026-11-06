# External Integrations
**Analysis Date:** 2026-11-06

## APIs & External Services

**Lead Submission & Legacy Serverless Emulation:**
- Public REST API endpoint: `POST /api/lead` and `GET /api/lead` (`routes/web.php:40`)
  - Controller: `App\Http\Controllers\LeadController@store` (`app/Http/Controllers/LeadController.php`)
  - Purpose: Accepts JSON and form-encoded payloads for quote and contact submissions from frontend forms and external callers.
  - Auth: Public endpoint protected with anti-bot honeypot parameters (`website`, `fax_number`).
- Netlify Functions Shim: `POST|GET /.netlify/functions/send-lead-email` (`routes/web.php:41`)
  - Controller: `App\Http\Controllers\LeadController@store`
  - Purpose: Backward-compatibility proxy endpoint preserving functionality for legacy serverless webhook integrations.

**Transactional Email & Mail Transports:**
- Outbound Mail Service (`config/mail.php`, `config/services.php`)
  - Supported Drivers: SMTP, Mailgun, Postmark, Resend, Amazon SES, or Sendmail (`config/mail.php:32-34`).
  - Active Mailer: Configured dynamically via `MAIL_MAILER` (defaults to `log` or `smtp`).
  - Mailable: `App\Mail\LeadReceived` (`app/Mail/LeadReceived.php`) rendering Blade template `resources/views/emails/lead-received.blade.php`.
  - Auth / Credentials:
    - SMTP: `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_ENCRYPTION`
    - Postmark: `POSTMARK_API_KEY` (`config/services.php:18`)
    - Resend: `RESEND_API_KEY` (`config/services.php:22`)
    - Amazon SES: `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION` (`config/services.php:26-28`)
  - Failure Handling: Failures in email dispatch are caught in `LeadController@store` (`app/Http/Controllers/LeadController.php:90-96`), logged to Laravel Monolog, and recorded in MySQL (`leads.email_status = 'failed'`, `leads.email_error`).

## External CDNs & Assets

**Google Fonts CDN:**
- Services: `https://fonts.googleapis.com` & `https://fonts.gstatic.com` (Preconnected in `resources/views/layouts/app.blade.php:23-25`)
  - Font Families:
    - **Sora** (`weights: 400, 500, 600, 700, 800`) - Primary headings and display titles.
    - **Poppins** (`weights: 300, 400, 500, 600, 700`) - Body copy, subheadings, and UI controls.
    - **JetBrains Mono** (`weights: 400, 500, 600, 700`) - Badges, reference IDs, and technical callouts.

**Bunny Fonts CDN:**
- Service: Bunny Fonts CDN via `laravel-vite-plugin/fonts` (`vite.config.js:3,11-13`)
  - Font Family: **Instrument Sans** (`weights: 400, 500, 600`) - Integrated into Vite asset pipeline for modern typography optimization.

**Google Maps Interactive Embed:**
- Embed Provider: Google Maps Iframe API (`https://www.google.com/maps?q=...&output=embed`)
  - Component: `resources/views/components/google-map.blade.php:58-67`
  - Location Coordinates: `1015 Glendale Chase Ct, Morrisville, North Carolina 27560` (Operations Lab / US Headquarters)
  - Integration Type: Direct iframe embed (`output=embed`) with `referrerpolicy="no-referrer-when-downgrade"`.
  - Direct Navigation Action: External directions link to `https://www.google.com/maps?q=1015+Glendale+Chase+Ct,+Morrisville,+NC+27560` (`resources/views/components/google-map.blade.php:39`).
  - Auth / API Key: Zero API key requirement (zero external quota costs, resilient against API key leakage or billing caps).

**Self-Hosted Local Vendor Bundles (Zero CDN Downtime Risk):**
- Bootstrap 5.3.3 Bundle: `public/assets/vendor/bootstrap/bootstrap.bundle.min.js` (includes Popper.js) and `public/assets/vendor/bootstrap/bootstrap.min.css`.
- Bootstrap Icons: `public/assets/vendor/bootstrap/bootstrap-icons.min.css` with local WOFF/WOFF2 font binaries in `public/assets/vendor/bootstrap/fonts/`.
- GSAP & ScrollTrigger: `public/assets/vendor/gsap/gsap.min.js` and `public/assets/vendor/gsap/ScrollTrigger.min.js`.

## Payment & POS Integrations

**Status: Completely Removed & Deprecated**
- POS Hardware & Terminals:
  - All physical POS hardware, card terminal sales, and merchant hardware catalogs have been intentionally removed in favor of digital services (Web Development, SEO Systems, and AI Front-Office Automation).
  - Legacy routes `/hardware` and `/admin-inventory` permanently redirect via HTTP 301 (`routes/web.php:27-32`) to `/services` and `/dashboard` to safeguard search engine equity and backlinks.
  - POS terminal assets and static inventory images in `public/assets/img/terminals/` and `public/assets/img/products/` remain for archival reference or promotional mockups only.
- Payment Gateways:
  - Direct merchant payment gateways (such as Stripe, PayPal, Square, Authorize.Net) are not active in this codebase.
  - Transactions follow a high-ticket consultative B2B workflow: custom quote requests and proposals are captured via the rapid quote builder (`app/Http/Controllers/LeadController.php`), persisted to the database, and negotiated directly by the sales engineering team.

## Data Storage

**Databases:**
- MySQL / MariaDB (Primary Relational Engine)
  - Connection Config: `config/database.php:47-81`
  - Connection Env: `DB_CONNECTION=mysql`, `DB_HOST`, `DB_PORT=3306`, `DB_DATABASE=azora_db`, `DB_USERNAME`, `DB_PASSWORD`
  - Client / ORM: Laravel Eloquent ORM / PDO MySQL (`App\Models\Lead`, `App\Models\User`)
  - Schema: `database/migrations/2026_11_04_175120_create_leads_table.php` (stores reference IDs, contact details, requested items, honeypot telemetry, email delivery status)
- SQLite (Local Development / Testing Fallback)
  - Connection Config: `config/database.php:35-45`
  - Database file: `database/database.sqlite`

**File Storage:**
- Local Filesystem:
  - Driver: Local disk (`storage/app/private`, `storage/app/public` via `config/filesystems.php:35-51`).
  - Public Assets: Directly served through web server from `public/assets/` directory.

**Caching:**
- Database / File Cache:
  - Config: `config/cache.php:39-65`
  - Tables: `cache` and `cache_locks` defined in `database/migrations/0001_01_01_000001_create_cache_table.php`.

## Authentication & Identity

**Auth Provider:**
- Custom Admin Session Guard (`app/Http/Controllers/DashboardController.php`)
  - Implementation: Single-administrator portal protected by session flag (`admin_authenticated`).
  - Verification: Matches against `ADMIN_EMAIL` and `ADMIN_PASSWORD` from `.env`, with support for Bcrypt password hashes stored in `session('admin_password_hash')` (`app/Http/Controllers/DashboardController.php:33-47`).
  - Session Management: Standard Laravel cookie session driver (`config/session.php`).
- Native User Management:
  - Migration `database/migrations/0001_01_01_000000_create_users_table.php` and `App\Models\User` present for future expansion into full multi-user authentication.

## Monitoring & Observability

**Error Tracking:**
- Framework Default: Built-in Laravel Exception Handler and Collision CLI runner (`nunomaduro/collision`). No external APM/Sentry SDK currently installed.

**Logs:**
- Laravel Monolog Engine (`config/logging.php`):
  - Stack driver writing to `storage/logs/laravel.log`.
  - Real-time terminal tailing enabled via `laravel/pail` (`php artisan pail`).
  - Lead submission errors explicitly logged via `Log::error()` (`app/Http/Controllers/LeadController.php:91`).

## CI/CD & Deployment

**Hosting:**
- Self-hosted Linux/Windows Server (Nginx / Apache / Caddy with PHP 8.3-FPM) or Laravel Cloud / Forge / DigitalOcean.

**CI Pipeline:**
- None detected in `.github/workflows/`.
- Automated setup orchestrated via Composer scripts (`composer.json:34-42`):
  ```bash
  composer run setup
  ```
  Runs `composer install`, sets up `.env`, runs `php artisan key:generate`, executes `php artisan migrate --force`, and builds assets via `npm run build`.

## Environment Configuration

**Required env vars:**
- `APP_NAME`, `APP_ENV`, `APP_KEY`, `APP_DEBUG`, `APP_URL`
- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_FROM_ADDRESS`, `MAIL_FROM_NAME`
- `ADMIN_EMAIL`, `ADMIN_PASSWORD` (Admin command center)

**Optional service vars:**
- `POSTMARK_API_KEY`, `RESEND_API_KEY`
- `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`
- `SLACK_BOT_USER_OAUTH_TOKEN`, `SLACK_BOT_USER_DEFAULT_CHANNEL`

**Secrets location:**
- Stored exclusively in `.env` in repository root, never checked into version control.

## Webhooks & Callbacks

**Incoming:**
- `POST /lead`, `POST /quote`, `POST /contact` (`routes/web.php:35-37`): Lead intake webhook for web forms and asynchronous fetch/AJAX requests.
- `GET|POST /api/lead` (`routes/web.php:40`): Public API endpoint for CRM ingestion or external lead dispatch.
- `GET|POST /.netlify/functions/send-lead-email` (`routes/web.php:41`): Legacy webhook endpoint mapping incoming submissions to `LeadController@store`.

**Outgoing:**
- Transactional notification emails dispatched to configured administrator address (`sales@azorasolution.com` or `config('mail.from.address')`) via configured mail transport.

---

*Integration audit: 2026-11-06*
