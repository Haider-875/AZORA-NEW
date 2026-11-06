<!-- refreshed: 2026-11-06 -->
# Testing Patterns

**Analysis Date:** 2026-11-06

## Test Framework

**Runner:**
- PHPUnit `12.5.43` (via `./vendor/bin/phpunit`)
- Laravel Framework Testing Harness (`laravel/framework: ^13.17`) via `php artisan test`
- Reporter: `nunomaduro/collision: ^8.6` / `laravel/pao: ^1.0.6`
- Config: `phpunit.xml`

**Assertion Library:**
- PHPUnit native assertions (`PHPUnit\Framework\Assert`)
- Laravel `TestResponse` assertions (`$response->assertStatus(200)`, `$response->assertJson()`, etc.)

**Run Commands:**
```bash
php ./vendor/bin/phpunit                  # Run all tests directly via PHPUnit
php artisan test                         # Run all tests via Laravel Artisan runner
composer test                            # Run configuration clear + artisan test runner
php ./vendor/bin/phpunit --testsuite Unit        # Run Unit test suite only
php ./vendor/bin/phpunit --testsuite Feature     # Run Feature test suite only
php ./vendor/bin/phpunit tests/Feature/ExampleTest.php  # Run specific test file
php ./vendor/bin/phpunit --filter test_the_application_returns_a_successful_response  # Run single test method
php artisan test --coverage              # Run tests with code coverage (requires Xdebug/PCOV)
```

---

## Test File Organization

**Location:**
- Separate test directory rooted at `tests/`.
- Segregated into two distinct suites:
  - `tests/Unit/`: Isolated PHPUnit tests without heavy framework boots.
  - `tests/Feature/`: HTTP integration tests, controller flows, and database interactions extending Laravel's `TestCase`.

**Naming:**
- Filename matches targeted subject with `Test.php` suffix (e.g., `ExampleTest.php`, future: `LeadControllerTest.php`, `LeadModelTest.php`).
- Namespaces follow PSR-4 mapping defined in `composer.json`:
  - `Tests\Unit` maps to `tests/Unit/`
  - `Tests\Feature` maps to `tests/Feature/`

**Structure:**
```
tests/
├── Feature/
│   └── ExampleTest.php       # HTTP endpoint integration tests
├── Unit/
│   └── ExampleTest.php       # Pure unit tests
└── TestCase.php              # Abstract base test class bootstrapping Laravel
```

---

## Test Structure

**Suite Configuration (`phpunit.xml`):**
Configured with in-memory SQLite database and array cache/session drivers to isolate test executions from development environments:
```xml
<testsuites>
    <testsuite name="Unit">
        <directory>tests/Unit</directory>
    </testsuite>
    <testsuite name="Feature">
        <directory>tests/Feature</directory>
    </testsuite>
</testsuites>
<php>
    <env name="APP_ENV" value="testing"/>
    <env name="DB_CONNECTION" value="sqlite"/>
    <env name="DB_DATABASE" value=":memory:"/>
    <env name="CACHE_STORE" value="array"/>
    <env name="MAIL_MAILER" value="array"/>
    <env name="QUEUE_CONNECTION" value="sync"/>
    <env name="SESSION_DRIVER" value="array"/>
</php>
```

**Base Test Class (`tests/TestCase.php`):**
```php
<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    // Common setup, authentication helpers, or database traits
}
```

**Feature Test Pattern (`tests/Feature/ExampleTest.php`):**
Extends `Tests\TestCase` to boot the full Laravel application lifecycle:
```php
<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
```

**Unit Test Pattern (`tests/Unit/ExampleTest.php`):**
Extends `PHPUnit\Framework\TestCase` directly for fast, framework-agnostic execution:
```php
<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
}
```

---

## Mocking

**Framework:**
- `mockery/mockery: ^1.6` installed via Composer.
- Built-in Laravel testing fakes (`Mail::fake()`, `Event::fake()`, `Queue::fake()`, `Http::fake()`).

**Standard Laravel Mocking Patterns:**
When testing notification emails triggered during lead generation (`LeadController::store`):
```php
use App\Mail\LeadReceived;
use Illuminate\Support\Facades\Mail;

public function test_lead_submission_sends_notification_email(): void
{
    Mail::fake();

    $response = $this->postJson('/lead', [
        'business' => 'Acme Corp',
        'contact'  => 'John Doe',
        'email'    => 'john@example.com',
        'phone'    => '555-0199',
    ]);

    $response->assertOk();

    Mail::assertSent(LeadReceived::class, function ($mail) {
        return $mail->hasTo('sales@azorasolution.com') &&
               $mail->lead->business === 'Acme Corp';
    });
}
```

**What to Mock:**
- External outbound email delivery (`Mail::fake()`).
- External HTTP integrations or serverless gateways.
- Clock / time when asserting timestamps (`$this->travelTo(...)`).

**What NOT to Mock:**
- Database operations: Run migrations in-memory (`use RefreshDatabase;` on SQLite `:memory:`).
- Eloquent models and query builders: Exercise real queries against SQLite.
- Validation logic: Test actual request rules.

---

## Fixtures and Factories

**Current Factory Inventory:**
- `database/factories/UserFactory.php` exists for default user scaffolding.
- `database/factories/LeadFactory.php` is **currently missing** despite `Lead` model declaring `use HasFactory;`.

**Factory Pattern (`database/factories/UserFactory.php`):**
```php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
```

**Required Lead Factory Scaffold (Recommended Implementation):**
```php
namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [
            'ref' => 'AZ-' . date('ymd') . '-' . strtoupper(Str::random(4)),
            'event_type' => fake()->randomElement(['quote_request', 'contact_request', 'general_inquiry']),
            'business' => fake()->company(),
            'contact' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'locations' => '1',
            'message' => fake()->paragraph(),
            'items' => [['id' => 'website-growth', 'name' => 'Website Growth Platform']],
            'page_url' => 'https://azorasolution.com/quote',
            'user_agent' => fake()->userAgent(),
            'email_status' => 'pending',
            'is_read' => false,
        ];
    }
}
```

---

## Coverage

**Requirements:**
- No strict minimum code coverage threshold currently enforced in CI or `phpunit.xml`.

**View Coverage:**
```bash
php artisan test --coverage --min=80
```
*(Requires Xdebug or PCOV PHP extension installed)*

---

## Test Types

**Unit Tests (`tests/Unit/`):**
- **Scope:** Fast tests verifying isolated business calculations, string formatting, array normalization, or model scopes.
- **Approach:** Extend `PHPUnit\Framework\TestCase` without booting the framework or database connection.

**Feature / Integration Tests (`tests/Feature/`):**
- **Scope:** Complete HTTP lifecycle tests: routing, middleware, request validation, controller business logic, database transactions, and Blade view rendering.
- **Approach:** Extend `Tests\TestCase`, utilize `Illuminate\Foundation\Testing\RefreshDatabase`, and execute HTTP verbs (`$this->get()`, `$this->post()`, `$this->delete()`).

**E2E / Browser Tests:**
- **Status:** Not currently configured. No Laravel Dusk, Playwright, or Cypress suites present in repo.

---

## Common Patterns

**Async / Notification Testing:**
```php
public function test_email_failure_records_error_in_lead(): void
{
    // Force Mail to throw an exception
    Mail::shouldReceive('to->send')->andThrow(new \Exception('SMTP connection timeout'));

    $this->postJson('/lead', [
        'business' => 'Failure Test Corp',
        'email'    => 'fail@example.com',
    ]);

    $this->assertDatabaseHas('leads', [
        'business'     => 'Failure Test Corp',
        'email_status' => 'failed',
    ]);
}
```

**Honeypot Anti-Bot Testing:**
```php
public function test_bot_submission_with_honeypot_is_silently_accepted_without_db_write(): void
{
    $response = $this->postJson('/lead', [
        'business' => 'Spam Bot LLC',
        'email'    => 'bot@spam.com',
        'website'  => 'http://spamsite.com', // Honeypot trap filled
    ]);

    $response->assertOk()
             ->assertJson(['ok' => true, 'ref' => 'AZ-' . date('ymd') . '-BOT']);

    $this->assertDatabaseMissing('leads', [
        'email' => 'bot@spam.com',
    ]);
}
```

**Admin Authentication & Session Testing:**
```php
public function test_admin_dashboard_requires_authentication(): void
{
    $response = $this->get('/dashboard');
    $response->assertRedirect('/dashboard/login');
}

public function test_authenticated_admin_can_view_dashboard(): void
{
    $response = $this->withSession(['admin_authenticated' => true])
                     ->get('/dashboard');

    $response->assertOk()
             ->assertViewIs('dashboard.index');
}
```

---

## Test Coverage Gaps

The AZORA application currently contains only **2 baseline placeholder tests** (1 Unit, 1 Feature). The following core application features represent critical coverage gaps:

| Component / Route | Untested Behaviors | Priority |
|-------------------|-------------------|----------|
| `LeadController@store` (`/lead`, `/quote`, `/contact`, `/api/lead`) | Validation errors (422), valid lead insertion, honeypot detection (`website`/`fax_number`), unique ref generation, email dispatch success/failure states, JSON vs redirect response. | **CRITICAL** |
| `LeadController@markRead` (`POST /dashboard/lead/{id}/read`) | Marking unread lead as read, updating `read_at` timestamp, JSON response. | **HIGH** |
| `LeadController@destroy` (`DELETE /dashboard/lead/{id}`) | Deleting lead from database, handling JSON vs redirect responses. | **HIGH** |
| `LeadController@exportCsv` (`GET /dashboard/export`) | Streamed CSV output, header validation (`text/csv`), monthly query filtering. | **MEDIUM** |
| `DashboardController@authenticate` (`POST /dashboard/login`) | Credential verification against `ADMIN_EMAIL` / `ADMIN_PASSWORD`, session injection (`admin_authenticated`), invalid password error redirection. | **HIGH** |
| `DashboardController@logout` (`POST /dashboard/logout`) | Session forgetting `admin_authenticated` and `admin_email`, redirect to login. | **MEDIUM** |
| `DashboardController@index` (`GET /dashboard`) | Auth protection redirect, metrics calculation (total leads, 7-day activity, monthly snapshots). | **HIGH** |
| `PageController` (Public Pages) | HTTP 200 checks for `/`, `/about`, `/services`, `/plans`, `/plans-services`, `/portfolio`, `/quote`, `/success`. | **HIGH** |
| Legacy Hardware Redirects (`routes/web.php`) | 301 permanent redirects from `/hardware` to `/services` and `/admin-inventory` to `/dashboard`. | **MEDIUM** |
| `Lead` Model (`app/Models/Lead.php`) | Array casting on `items`, boolean casting on `is_read`, scopes (`scopeUnread`, `scopeQuotes`). | **MEDIUM** |
| `LeadReceived` Mailable (`app/Mail/LeadReceived.php`) | Subject string interpolation with business name and reference ID, email view compilation. | **MEDIUM** |
| Frontend Motion / Carousel Logic (`resources/js/`) | Zero automated client-side testing for motion card reveal, scramble effect, and drag interaction physics. | **LOW** |

---

*Testing analysis: 2026-11-06*
