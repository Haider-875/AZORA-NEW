<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('pages.home');
        $response->assertSee('Azora Solution');
    }

    public function test_about_page_loads_successfully(): void
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
        $response->assertViewIs('pages.about');
        $response->assertSee('American Engineering');
    }

    public function test_services_page_loads_successfully(): void
    {
        $response = $this->get('/services');

        $response->assertStatus(200);
        $response->assertViewIs('pages.services');
        $response->assertSee('Digital Solutions');
    }

    public function test_plans_page_loads_successfully(): void
    {
        $response = $this->get('/plans');

        $response->assertStatus(200);
        $response->assertViewIs('pages.plans');
        $response->assertSee('Pricing &amp; Plans', false);
    }

    public function test_plans_services_page_loads_successfully(): void
    {
        $response = $this->get('/plans-services');

        $response->assertStatus(200);
        $response->assertViewIs('pages.plans-services');
    }

    public function test_portfolio_page_and_alias_load_successfully(): void
    {
        $response = $this->get('/portfolio');
        $response->assertStatus(200);
        $response->assertViewIs('pages.portfolio');

        // Test alias
        $aliasResponse = $this->get('/client-success');
        $aliasResponse->assertStatus(200);
        $aliasResponse->assertViewIs('pages.portfolio');
    }

    public function test_quote_page_and_alias_load_with_query_parameters(): void
    {
        $response = $this->get('/quote?product=website-growth');
        $response->assertStatus(200);
        $response->assertViewIs('pages.quote');
        $response->assertViewHas('preselectedProduct', 'website-growth');

        // Test alias
        $aliasResponse = $this->get('/get-a-quote');
        $aliasResponse->assertStatus(200);
        $aliasResponse->assertViewIs('pages.quote');
    }

    public function test_success_page_loads_successfully(): void
    {
        $response = $this->get('/success');

        $response->assertStatus(200);
        $response->assertViewIs('pages.success');
    }

    public function test_deprecated_hardware_route_returns_301_redirect(): void
    {
        $response = $this->get('/hardware');

        $response->assertStatus(301);
        $response->assertRedirect('/services');
    }

    public function test_deprecated_admin_inventory_route_returns_301_redirect(): void
    {
        $response = $this->get('/admin-inventory');

        $response->assertStatus(301);
        $response->assertRedirect('/dashboard');
    }

    public function test_admin_route_redirects_unauthenticated_to_login(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/login');
    }

    public function test_admin_route_redirects_authenticated_to_dashboard(): void
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
    }
}
