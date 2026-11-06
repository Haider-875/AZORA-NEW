<Codebase Structure>
**Analysis Date:** 2026-11-06

## Directory Layout

```
AZORA/
├── .agent/                             # Local agent configurations and profiles
├── .agents/                            # Installed agent skills and references
├── .gsd/                               # GSD workflow state and cache
├── .planning/                          # Project planning and codebase documentation
│   └── codebase/                       # Architectural and technical reference maps
├── adapters/                           # AI assistant prompt adapters (CLAUDE.md, GEMINI.md, GPT_OSS.md)
├── app/                                # Core application source code
│   ├── Http/
│   │   └── Controllers/                # HTTP request controllers (Page, Lead, Dashboard)
│   ├── Mail/                           # Mailable classes (LeadReceived)
│   ├── Models/                         # Eloquent ORM models (Lead, User)
│   └── Providers/                      # Service providers (AppServiceProvider)
├── bootstrap/                          # Framework bootstrap and routing configuration
│   ├── app.php                         # Application initialization, middleware, exceptions
│   └── cache/                          # Compiled services and package manifest cache
├── config/                             # Application configuration settings
├── database/                           # Database schemas, migrations, seeds, and SQLite storage
│   ├── factories/                      # Model testing factories
│   ├── migrations/                     # Database schema migration definitions
│   ├── seeders/                        # Database seeders
│   └── database.sqlite                 # Active SQLite database file
├── public/                             # Publicly accessible web root
│   ├── assets/                         # Static legacy vendor assets, styling, and client scripts
│   │   ├── css/                        # Custom stylesheets (azora-modern, hero-motion, etc.)
│   │   ├── fonts/                      # Static web font files
│   │   ├── img/                        # Image assets (plans, portfolio, products, terminals)
│   │   ├── js/                         # Legacy JS controllers (app, dashboard, data, lead-store)
│   │   └── vendor/                     # Third-party precompiled libraries (Bootstrap 5.3, GSAP)
│   ├── build/                          # Vite-compiled production bundles and asset manifests
│   ├── favicon.ico                     # Site favicon
│   ├── index.php                       # HTTP front controller entry point
│   ├── robots.txt                      # Search engine crawler instructions
│   └── sitemap.xml                     # XML sitemap for SEO discovery
├── resources/                          # Raw frontend templates, styles, and scripts
│   ├── css/                            # Modern CSS sources compiled by Vite (app.css, motion-cards.css)
│   ├── js/                             # Modern ES module scripts (app.js, motion-cards.js)
│   └── views/                          # Blade HTML view templates
│       ├── components/                 # Reusable Blade UI components (navbar, card, footer, etc.)
│       ├── dashboard/                  # Admin Command Center views (index, login)
│       ├── emails/                     # Mailable HTML email templates (lead-received)
│       ├── layouts/                    # Master page skeleton layouts (app.blade.php)
│       └── pages/                      # Public page views (home, about, services, plans, portfolio, quote)
├── routes/                             # Application route definitions
│   ├── console.php                     # Artisan CLI command registrations
│   └── web.php                         # Public pages, lead ingestion, and admin routes
├── scripts/                            # PowerShell and Bash development automation utilities
├── storage/                            # Framework logs, compiled templates, and session data
├── tests/                              # Automated test suites
│   ├── Feature/                        # HTTP and integration tests
│   ├── Unit/                           # Low-level unit tests
│   └── TestCase.php                    # Base test case abstraction
├── artisan                             # Laravel command-line interface binary
├── composer.json                       # PHP package and dependency manifest
├── package.json                        # Node.js and frontend dependency manifest
└── vite.config.js                      # Vite bundler and asset compiler configuration
```

## Directory Purposes

**`app/Http/Controllers/`:**
- Purpose: Orchestrates incoming HTTP requests, input validation, and view/response generation.
- Contains: Controller classes extending `App\Http\Controllers\Controller`.
- Key files: `PageController.php`, `LeadController.php`, `DashboardController.php`.

**`app/Models/`:**
- Purpose: Defines Eloquent ORM entity representations, data type casting, and query scopes.
- Contains: PHP model classes extending `Illuminate\Database\Eloquent\Model`.
- Key files: `Lead.php`, `User.php`.

**`app/Mail/`:**
- Purpose: Prepares structured email notifications dispatched to administrators.
- Contains: Mailable classes extending `Illuminate\Mail\Mailable`.
- Key files: `LeadReceived.php`.

**`resources/views/layouts/`:**
- Purpose: Establishes global HTML markup, meta tags, head scripts, and component mounting boundaries.
- Contains: Base Blade layout templates.
- Key files: `resources/views/layouts/app.blade.php`.

**`resources/views/components/`:**
- Purpose: Houses modular, self-contained Blade UI elements used across multiple public pages.
- Contains: Blade component files utilizing `@props`, slots, and custom attributes.
- Key files: `navbar.blade.php`, `card.blade.php`, `footer.blade.php`, `google-map.blade.php`, `terminal-carousel.blade.php`.

**`resources/views/pages/`:**
- Purpose: Renders public-facing marketing and commercial views.
- Contains: Full-page Blade views extending `layouts.app`.
- Key files: `home.blade.php`, `about.blade.php`, `services.blade.php`, `plans.blade.php`, `portfolio.blade.php`, `quote.blade.php`, `success.blade.php`.

**`resources/views/dashboard/`:**
- Purpose: Houses the administrative Command Center and login views.
- Contains: Admin dashboard templates.
- Key files: `index.blade.php`, `login.blade.php`.

**`public/assets/`:**
- Purpose: Serves static assets, vendor distribution files, catalog definitions, and client scripts.
- Contains: CSS files, JavaScript scripts, images, and pre-packaged vendor distributions.
- Key files: `public/assets/js/app.js`, `public/assets/js/data.js`, `public/assets/js/dashboard.js`, `public/assets/css/azora-modern.css`.

**`resources/css/` & `resources/js/`:**
- Purpose: Modern modular CSS and JavaScript sources compiled by Vite into production assets.
- Contains: ES modules, custom properties, and motion card logic.
- Key files: `resources/js/app.js`, `resources/js/motion-cards.js`, `resources/css/app.css`.

## Key File Locations

**Entry Points:**
- `public/index.php`: Web HTTP front controller; bootstraps application and processes all web requests.
- `artisan`: CLI binary; loads console kernel for running Artisan tasks and migrations.
- `routes/web.php`: Primary routing manifest declaring page controllers, lead endpoints, and admin URLs.
- `resources/js/app.js`: Main JavaScript entry point processed by Vite bundler.
- `resources/css/app.css`: Main CSS entry point processed by Vite bundler.

**Configuration:**
- `bootstrap/app.php`: Global framework configuration, route mapping, CSRF exceptions, and exception handling.
- `config/app.php`: Core application configuration (timezone, locale, encryption keys).
- `config/database.php`: Database connection profiles (SQLite default, MySQL optional).
- `config/mail.php`: Mail transport settings and sender address definitions.
- `vite.config.js`: Bundler configuration and font prefetching rules.

**Core Logic:**
- `app/Http/Controllers/LeadController.php`: Manages lead creation, honeypot spam protection, and notifications.
- `app/Http/Controllers/DashboardController.php`: Implements admin authentication and Command Center metrics generation.
- `app/Models/Lead.php`: Data model defining fillable columns, JSON casting, and query filters.

**Testing:**
- `tests/TestCase.php`: Base test case establishing the application test environment.
- `tests/Feature/ExampleTest.php`: Feature-level HTTP integration tests.
- `tests/Unit/ExampleTest.php`: Isolated unit tests.

## Naming Conventions

**Files:**
- Controllers: UpperCamelCase with `Controller` suffix (`PageController.php`, `LeadController.php`).
- Models: Singular UpperCamelCase (`Lead.php`, `User.php`).
- Blade Views & Components: kebab-case with `.blade.php` extension (`lead-received.blade.php`, `terminal-carousel.blade.php`).
- Migrations: Timestamped snake_case (`2026_11_04_175120_create_leads_table.php`).
- Static JS & CSS: kebab-case (`azora-modern.css`, `lead-store.js`, `motion-cards.js`).

**Directories:**
- Application namespaces: UpperCamelCase matching PSR-4 standards (`app/Http/Controllers`, `app/Models`).
- View and asset directories: lowercase or kebab-case (`resources/views/components`, `public/assets/img/plans`).

## Where to Add New Code

**New Marketing Page:**
- Controller Action: Add method returning view and metadata to `app/Http/Controllers/PageController.php`.
- Route: Define named route in `routes/web.php` (e.g. `Route::get('/terms', [PageController::class, 'terms'])->name('terms');`).
- View Template: Create `resources/views/pages/{name}.blade.php` extending `'layouts.app'`.
- Navigation Link: Add entry to `resources/views/components/navbar.blade.php` and `resources/views/components/footer.blade.php`.
- Test: Add HTTP test to `tests/Feature/PageTest.php`.

**New UI Component:**
- Implementation: Create `resources/views/components/{component-name}.blade.php`.
- Props & Styling: Declare `@props([...])` at top of file and add corresponding styles to `resources/css/` or `public/assets/css/azora-modern.css`.
- Usage: Invoke in Blade views as `<x-{component-name} :prop="$value" />`.

**New API or Lead Ingestion Endpoint:**
- Action Method: Add handling logic to `app/Http/Controllers/LeadController.php` or a new specialized controller.
- CSRF Handling: If accepting external unauthenticated webhook requests, add path pattern to `validateCsrfTokens(except: [...])` in `bootstrap/app.php`.
- Route: Add `Route::post(...)` in `routes/web.php`.

**Utilities & Shared Helpers:**
- Backend Helpers: Add dedicated service or action classes in `app/Services/` or `app/Actions/`.
- Frontend Helpers: Add utility functions in `resources/js/` and export as ES modules.

## Special Directories

**`public/build/`:**
- Purpose: Contains production-compiled JavaScript bundles, CSS stylesheets, fonts, and manifest files.
- Generated: Yes (via `npm run build` using Vite).
- Committed: Yes (committed to ensure immediate deployment without server-side Node.js build steps).

**`storage/`:**
- Purpose: Stores framework cache, compiled Blade templates, application logs (`storage/logs/laravel.log`), and local file attachments.
- Generated: Yes (populated dynamically at runtime).
- Committed: No (directory skeleton tracked via `.gitignore`).

**`database/`:**
- Purpose: Contains migration definitions and active local SQLite database (`database/database.sqlite`).
- Generated: SQLite database is generated/modified via migrations (`php artisan migrate`).
- Committed: SQLite file is tracked in repository for local self-contained operation.

---

*Structure analysis: 2026-11-06*
