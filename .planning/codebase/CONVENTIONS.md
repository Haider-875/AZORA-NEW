<!-- refreshed: 2026-11-06 -->
# Coding Conventions

**Analysis Date:** 2026-11-06

## Naming Patterns

**Files:**
- **PHP Classes & Controllers:** StudlyCaps / PascalCase (`app/Http/Controllers/LeadController.php`, `app/Http/Controllers/DashboardController.php`, `app/Http/Controllers/PageController.php`, `app/Models/Lead.php`, `app/Mail/LeadReceived.php`, `app/Providers/AppServiceProvider.php`).
- **Blade Views & Components:** kebab-case with `.blade.php` extension (`resources/views/layouts/app.blade.php`, `resources/views/components/card.blade.php`, `resources/views/components/navbar.blade.php`, `resources/views/components/terminal-carousel.blade.php`, `resources/views/pages/plans-services.blade.php`, `resources/views/emails/lead-received.blade.php`).
- **CSS & SCSS Assets:** kebab-case (`resources/css/motion-cards.css`, `resources/css/paymate-carousel.css`, `public/assets/css/azora-modern.css`, `public/assets/css/hero-motion.css`).
- **JavaScript Assets:** kebab-case (`resources/js/motion-cards.js`, `resources/js/paymate-carousel.js`, `public/assets/js/app.js`, `public/assets/js/hero-motion.js`, `public/assets/js/lead-store.js`).
- **Database Migrations:** snake_case timestamped files (`database/migrations/2026_11_04_175120_create_leads_table.php`, `database/migrations/0001_01_01_000000_create_users_table.php`).
- **Test Files:** StudlyCaps matching target class with `Test.php` suffix (`tests/Feature/ExampleTest.php`, `tests/Unit/ExampleTest.php`).

**Functions & Methods:**
- **PHP Controller Actions & Helpers:** camelCase (`store()`, `markRead()`, `destroy()`, `exportCsv()`, `authenticate()`, `plansServices()`).
- **PHP Model Scopes:** camelCase with `scope` prefix (`scopeUnread()`, `scopeQuotes()` in `app/Models/Lead.php`).
- **PHP Test Methods:** snake_case with `test_` prefix (`test_the_application_returns_a_successful_response()`, `test_that_true_is_true()`).
- **JavaScript Functions:** camelCase for standalone and object methods (`scrambleNumberElement()`, `initMotionCards()`, `revealCard()`, `openQuoteModal()`, `runCounter()`).
- **Route Names:** dot-separated lowercase / kebab identifiers (`home`, `lead.store`, `lead.markRead`, `dashboard.login`, `dashboard.export`, `plans.services` in `routes/web.php`).

**Variables:**
- **PHP Properties & Variables:** camelCase for properties and local variables (`$eventType`, `$adminEmail`, `$preselectedProduct`, `$leadReceived`).
- **PHP Model Attributes & DB Columns:** snake_case matching schema (`$lead->event_type`, `$lead->is_read`, `$lead->email_status`, `$lead->page_url`).
- **JavaScript Variables & Parameters:** camelCase (`prefersReduced`, `cardIndexMap`, `startTime`, `targetText`).
- **JavaScript Global Constants:** UPPER_SNAKE_CASE (`SCRAMBLE_GLYPHS`, `SVG_PATHS`, `SERVICES`).

**Types:**
- **PHP Typehints:** Strict scalar and return types on modern methods and mailables (`Envelope`, `Content`, `array`, `void`, `Lead $lead` in `app/Mail/LeadReceived.php` and `tests/TestCase.php`).
- **PHP Model Casts:** Explicit `$casts` property mapping attributes to native types (`'items' => 'array'`, `'is_read' => 'boolean'`, `'email_sent_at' => 'datetime'` in `app/Models/Lead.php`).

---

## Code Style

**Formatting:**
- **Tool:** Laravel Pint (`laravel/pint: ^1.27`) preset to default Laravel / PSR-12 code style standards.
- **Key Settings:** Defined via `.editorconfig`:
  - Indent style: spaces
  - Indent size: 4 spaces for PHP, Blade, and CSS; 2 spaces for YAML
  - End of line: LF
  - Trailing whitespace: trimmed on save (`trim_trailing_whitespace = true`)
  - Final newline: enforced (`insert_final_newline = true`)

**Linting:**
- **Tool:** Laravel Pint CLI (`php ./vendor/bin/pint --test` for audit; `php ./vendor/bin/pint` for automated formatting).
- **Enforced Rules:**
  - `ordered_imports`: imports sorted alphabetically within groups.
  - `fully_qualified_strict_types`: imports required instead of inline fully-qualified class names.
  - `blank_line_before_statement`: blank lines before return statements.
  - `binary_operator_spaces`: aligned and uniform binary operator spacing.
  - `not_operator_with_successor_space`: consistent boolean negation spacing.

---

## CSS Architecture & Class Naming

The frontend uses a hybrid architecture combining Bootstrap 5.3 utilities, design system tokens, and specialized scoped component classes.

**1. CSS Design Tokens (`:root`):**
Defined in `public/assets/css/azora-modern.css` and `resources/css/motion-cards.css`:
- `--az-bg: #070B14;` (Dark mesh background)
- `--az-surface: #0F192C;` / `--az-surface-card: rgba(16, 27, 46, 0.72);` (Glassmorphic cards)
- `--az-primary: #2469EB;` / `--az-cyan: #38BDF8;` / `--az-emerald: #10B981;` (Accent palette)
- `--az-transition-fast: 0.2s cubic-bezier(0.16, 1, 0.3, 1);`

**2. Component Class Naming Tiers:**
- **Design System Components:** Prefixed with `azora-`, `nav-`, or `btn-modern-` (`.azora-dropdown`, `.azora-dropdown-menu`, `.azora-dropdown-item`, `.nav-link-modern`, `.navbar-brand-modern`, `.btn-modern-primary`, `.btn-modern-secondary`, `.glass-nav-header`).
- **Motion Cards System:** Semantic component names with element indicators (`.motion-card`, `.motion-card-beam`, `.motion-card-number`, `.motion-card-title`, `.motion-card-desc`).
- **Paymate 3D Carousel (BEM-like Scoped Prefix):** Prefixed with `pm-car-*` (`.pm-car`, `.pm-car-strip`, `.pm-car-card`, `.pm-car-pic`, `.pm-car-shot`, `.pm-car-shot-bar`, `.pm-car-shot-dots`, `.pm-car-body`, `.pm-car-chip`, `.pm-car-sector`, `.pm-car-metric`).
- **Utility Layer (Bootstrap 5.3 + Tailwind Tokens):**
  - Layout & Flexbox: `container-xl`, `d-flex`, `align-items-center`, `justify-content-between`, `gap-2`, `row`, `col-lg-6`.
  - Spacing: `px-3`, `px-sm-4`, `py-2`, `mt-3`, `mb-4`.
  - Typography: `font-heading` (Sora), `font-mono-badge` (JetBrains Mono), `text-white`, `text-slate-300`, `text-slate-400`, `text-azora-cyan`, `fw-bold`, `fs-6`, `lh-lg`.
  - Interactive States: `.is-visible`, `.is-cur`, `.is-drag`.

---

## JavaScript Patterns

**1. Module & Script Architecture:**
- **Vite Bundler Pipeline:** `resources/js/app.js` is the entrypoint configured in `vite.config.js`. It imports ES modules (`import './motion-cards.js';`) and compiles via Vite 8.
- **Direct Public Scripts:** `public/assets/js/` contains standalone IIFE libraries (`app.js`, `hero-motion.js`, `data.js`, `catalog-sync.js`) loaded directly via `<script src="{{ asset('assets/js/...') }}">`.

**2. Execution Pattern & Encapsulation:**
- All non-bundled scripts use strict IIFEs to protect the global namespace:
```javascript
(function () {
  'use strict';
  // Module implementation
})();
```

**3. DOM Selection & Micro-Helpers:**
Standardized helper functions used across `public/assets/js/app.js`:
```javascript
function $(selector, root) { return (root || document).querySelector(selector); }
function $$(selector, root) { return Array.prototype.slice.call((root || document).querySelectorAll(selector)); }
function esc(s) { return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]; }); }
```

**4. Performance & Accessibility (Reduced Motion):**
Every animation system strictly checks `prefers-reduced-motion` before scheduling RAF or GSAP tweens:
```javascript
var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
if (prefersReduced) {
  card.classList.add('is-visible');
  return;
}
```

**5. CSRF Handling & Fetch Submissions:**
CSRF tokens are read from `<meta name="csrf-token">` and passed via headers:
```javascript
var csrfToken = $('meta[name="csrf-token"]') ? $('meta[name="csrf-token"]').getAttribute('content') : '';

var resp = await fetch('/lead', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'X-CSRF-TOKEN': csrfToken
  },
  body: JSON.stringify(payload)
});
```

---

## Blade Component Conventions

**1. File Placement & Discovery:**
- Components reside in `resources/views/components/` and are invoked using kebab-case Blade tags (`<x-card>`, `<x-navbar>`, `<x-footer>`, `<x-google-map>`, `<x-terminal-carousel>`).

**2. Component Definition Pattern:**
Observed in `resources/views/components/card.blade.php`:
```blade
@props([
    'number' => null,
    'title' => null,
    'description' => null,
    'href' => null,
    'class' => '',
])

@php
    $isLink = !empty($href);
    $tag = $isLink ? 'a' : 'div';
@endphp

<{{ $tag }}
    @if($isLink) href="{{ $href }}" @endif
    {{ $attributes->merge([
        'class' => 'motion-card ' . trim($class),
        'data-motion-card' => '',
        'tabindex' => $isLink ? null : '0',
        'role' => $isLink ? null : 'region',
        'aria-label' => $title ? strip_tags($title) : null,
    ]) }}
>
    {{-- Card structure --}}
    {{ $slot }}
</{{ $tag }}>
```

**3. Key Blade Conventions:**
- Declare inputs via `@props([...])` at the top with sensible defaults (`null` or `''`).
- Handle semantic tag variations dynamically (`$tag = $isLink ? 'a' : 'div'`).
- Use `$attributes->merge(['class' => '...'])` to preserve external classes and data attributes.
- Include accessibility defaults (`role`, `aria-label`, `tabindex`, `aria-hidden="true"`).
- Provide slot insertion (`{{ $slot }}`) for flexible child content.
- Use `{{-- Blade comment syntax --}}` for component internals rather than HTML comments.

---

## Import Organization

**PHP Imports (`use` statements):**
1. Framework facades & interfaces (`Illuminate\Http\Request`, `Illuminate\Support\Facades\Log`, `Illuminate\Support\Str`)
2. Application models & services (`App\Models\Lead`, `App\Mail\LeadReceived`)
3. Alphabetical order within each namespace segment (enforced by Pint `ordered_imports`).

Example from `app/Http/Controllers/LeadController.php`:
```php
namespace App\Http\Controllers;

use App\Mail\LeadReceived;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
```

**JavaScript Imports:**
ES module imports placed at the top of bundled files (`resources/js/app.js`):
```javascript
import './motion-cards.js';
```

---

## Error Handling

**Backend (Laravel):**
- **Form & Payload Validation:** Handled via `$request->validate([...])`. Returns 422 with validation errors automatically for JSON or redirects back with `$errors`.
- **Resource Resolution:** Use `Model::findOrFail($id)` in controllers to throw `ModelNotFoundException` (resulting in standard 404 responses).
- **Try/Catch Blocks:** Used around non-critical external services (e.g., mail sending in `app/Http/Controllers/LeadController.php`):
```php
try {
    Mail::to($recipient)->send(new LeadReceived($lead));
    $lead->update(['email_status' => 'sent', 'email_sent_at' => now()]);
} catch (\Throwable $e) {
    Log::error('Lead notification email failed: ' . $e->getMessage());
    $lead->update(['email_status' => 'failed', 'email_error' => $e->getMessage()]);
}
```
- **Honeypot Bot Traps:** Anti-spam inputs (`website`, `fax_number`) silently short-circuit to success without executing database writes, preventing crawler alerting.

**Frontend:**
- Async fetch handlers wrap network requests in `try ... catch (err)` blocks, updating inline UI notice containers (`#quote-status-box` or `.alert-danger`) without blocking page state.

---

## Logging

**Framework:**
- Laravel `Illuminate\Support\Facades\Log` facade configured with `stack` channel in `config/logging.php`.

**Patterns:**
- Errors in background jobs or third-party dispatch logged with descriptive prefix:
  `Log::error('Lead notification email failed: ' . $e->getMessage());`
- Critical errors written to `storage/logs/laravel.log`.

---

## Function Design

**Size:**
- Single-purpose methods under 50 lines in controllers; larger actions (like `store()` in `LeadController.php`) delegate formatting and status transitions cleanly.

**Parameters:**
- Controllers typehint `Request $request` or route parameters `$id`.
- Blade components accept props via associative array in `@props`.

**Return Values:**
- View rendering returns `view('pages.<name>', $data)`.
- API / AJAX returns `response()->json(['ok' => true, ...])`.
- Streaming endpoints use `response()->stream($callback, 200, $headers)`.
- Web submissions redirect using named routes: `redirect()->route('success')->with('lead', $lead)`.

---

*Convention analysis: 2026-11-06*
