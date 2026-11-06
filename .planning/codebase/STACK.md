# Technology Stack
**Analysis Date:** 2026-11-06

## Languages

**Primary:**
- PHP 8.3 (`^8.3` in `composer.json`, runtime PHP 8.3.36) - Backend application logic, MVC architecture, HTTP routing, Eloquent models, controllers, mailables, and database migrations.

**Secondary:**
- JavaScript (ES6+ / Modern Vanilla JS & Modules) - Interactive frontend behavior, card motion engines, live hero metrics, quote submission modal handling, and cursor effects (`public/assets/js/app.js`, `public/assets/js/data.js`, `public/assets/js/hero-motion.js`, `resources/js/app.js`, `resources/js/motion-cards.js`, `resources/js/paymate-carousel.js`).
- Blade Templating (Laravel Blade) - Server-side rendering, component composition, layouts, and slot architecture (`resources/views/layouts/app.blade.php`, `resources/views/components/`, `resources/views/pages/`, `resources/views/dashboard/`).
- CSS3 / Glassmorphic Design System - Futuristic UI styling, mesh gradients, backdrop filters, animations, and custom CSS custom properties (`public/assets/css/azora-modern.css`, `public/assets/css/hero-motion.css`, `public/assets/css/paymate-carousel.css`, `resources/css/motion-cards.css`, `resources/css/app.css`).
- SQL (MySQL / MariaDB Dialect) - Relational schema migrations and indexed querying for customer leads and session persistence (`database/migrations/`).

## Runtime

**Environment:**
- PHP 8.3.36 (CLI / FPM, ZTS x64)
- Node.js v24.18.0

**Package Manager:**
- Composer 2.10.3
  - Lockfile: `composer.lock` present (`316,962` bytes)
- npm 11.16.0
  - Lockfile: `package-lock.json` present (`68,754` bytes)

## Frameworks

**Core:**
- Laravel Framework `^13.17` (Laravel 13) - Full-stack PHP framework providing routing, MVC, Eloquent ORM, CSRF protection, mailers, sessions, and request validation (`composer.json`).
- Bootstrap 5.3.3 (Local bundle) - Primary responsive grid system, modals, dropdowns, cards, forms, and responsive utilities (`public/assets/vendor/bootstrap/`).
- GSAP & ScrollTrigger - High-performance JavaScript animation engine for smooth scroll reveals and viewport-triggered motion (`public/assets/vendor/gsap/`).

**Testing:**
- PHPUnit `^12.5.12` - Automated unit and integration testing suite (`phpunit.xml`).
- Mockery `^1.6` - Mock object framework for PHP unit testing (`composer.json`).

**Build/Dev:**
- Vite `^8.0.0` - Fast frontend build tool and local development asset server (`vite.config.js`, `package.json`).
- `laravel-vite-plugin` `^3.1` - Laravel Vite integration plugin for Blade `@vite` directive and font loading.
- `concurrently` `^10.0.3` - Multi-process execution tool for running PHP and Vite dev servers concurrently.
- `laravel/pint` `^1.27` - Opinionated code style fixer for PHP (`composer.json`).
- `laravel/pail` `^1.2.5` - Real-time terminal log viewer for Laravel.

## Key Dependencies

**Critical:**
- `laravel/framework` (`^13.17`) - Underpins all controllers (`app/Http/Controllers/`), models (`app/Models/Lead.php`), mail dispatch (`app/Mail/LeadReceived.php`), and session state.
- `bootstrap` (5.3.3) - Responsive framework replacing Tailwind CSS across all public views and admin dashboard.
- `laravel-vite-plugin` (`^3.1`) - Handles asset compilation (`resources/css/app.css`, `resources/js/app.js`) and Bunny Font preloading.
- `gsap` (3.x) - Hardware-accelerated animation library powering dynamic motion cards and layout transitions.

**Infrastructure:**
- `laravel/tinker` (`^3.0`) - Interactive REPL environment for debugging and database querying.
- `fakerphp/faker` (`^1.23`) - Fake data generation for seeders and test fixtures.
- `nunomaduro/collision` (`^8.6`) - Rich error reporting and diagnostics for CLI commands.
- `@laravel/multiplex` (`^0.4.1`) - Background process management during local development.

## Configuration

**Environment:**
- Centralized in `.env` (instantiated from `.env.example`).
- Accessed via standard Laravel configuration files (`config/*.php`) and `env()` helpers.
- Key configs required:
  - `APP_NAME`, `APP_ENV`, `APP_KEY`, `APP_DEBUG`, `APP_URL`
  - `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
  - `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_FROM_ADDRESS`
  - `ADMIN_EMAIL`, `ADMIN_PASSWORD` (Admin command center credentials)

**Build:**
- `vite.config.js` - Configures Vite inputs (`resources/css/app.css`, `resources/js/app.js`), watch ignore rules, and font definitions.
- `composer.json` - Defines PHP version constraints, autoload rules (`App\\`, `Database\\Factories\\`, `Database\\Seeders\\`, `Tests\\`), and composer setup scripts.
- `package.json` - Defines Node module dependencies and Vite build/dev scripts.
- `phpunit.xml` - Test environment variables and test suite configurations.

## Platform Requirements

**Development:**
- PHP 8.2+ (PHP 8.3 recommended) with extensions: `pdo_mysql`, `curl`, `mbstring`, `openssl`, `fileinfo`.
- Composer 2.x
- Node.js 20+ & npm 10+
- MySQL Server 8.0+ / MariaDB 10.4+ or SQLite 3.35+
- Local HTTP server (via `php artisan serve` or XAMPP / Laragon / Herd)

**Production:**
- Linux / Windows Web Server (Nginx, Apache, or Caddy with PHP-FPM 8.3+)
- MySQL 8.0+ / MariaDB 10.5+ database server
- SSL Certificate (HTTPS mandatory for CSRF tokens and secure lead submissions)
- Node.js build step executed during deployment (`npm run build` generates production assets into `public/build/`)

---

*Stack analysis: 2026-11-06*
