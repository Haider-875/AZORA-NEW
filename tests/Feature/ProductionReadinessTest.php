<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ProductionReadinessTest extends TestCase
{
    public function test_all_marketing_pages_load_cleanly(): void
    {
        $routes = ['/', '/about', '/services', '/plans', '/plans-services', '/portfolio', '/quote', '/success'];

        foreach ($routes as $route) {
            $startTime = microtime(true);
            $response = $this->get($route);
            $duration = (microtime(true) - $startTime) * 1000;

            $response->assertStatus(200);
            $this->assertLessThan(2000, $duration, "Page [{$route}] should respond in under 2000ms.");
        }
    }

    public function test_font_preconnect_and_display_swap_are_configured(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('rel="preconnect" href="https://fonts.googleapis.com"', false);
        $response->assertSee('rel="preconnect" href="https://fonts.gstatic.com"', false);
        $response->assertSee('display=swap', false);
    }

    public function test_app_key_is_properly_set(): void
    {
        $key = config('app.key');
        $this->assertNotEmpty($key, 'APP_KEY must not be empty.');
        $this->assertStringStartsWith('base64:', $key, 'APP_KEY must be a valid base64 string.');
    }

    public function test_production_cache_commands_run_successfully(): void
    {
        // Test route caching
        $routeCode = Artisan::call('route:cache');
        $this->assertEquals(0, $routeCode, 'route:cache should complete with exit code 0.');

        // Test view caching
        $viewCode = Artisan::call('view:cache');
        $this->assertEquals(0, $viewCode, 'view:cache should complete with exit code 0.');

        // Clear caches so development remains dynamic
        Artisan::call('route:clear');
        Artisan::call('view:clear');
    }
}
