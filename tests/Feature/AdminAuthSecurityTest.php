<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthSecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed an admin user for testing
        User::create([
            'name' => 'Azora Administrator',
            'email' => 'admin@azorasolution.com',
            'password' => Hash::make('AzoraAdmin2026!'),
        ]);
    }

    public function test_unauthenticated_user_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/login');
    }

    public function test_unauthenticated_user_cannot_export_leads_csv(): void
    {
        $response = $this->get('/dashboard/export');

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/login');
    }

    public function test_unauthenticated_user_cannot_mark_lead_or_delete_lead(): void
    {
        $lead = Lead::create([
            'ref' => 'AZ-TEST-001',
            'event_type' => 'quote_request',
            'business' => 'Acme Test Corp',
            'contact' => 'John Doe',
            'email' => 'john@acme.com',
            'phone' => '555-1234',
            'message' => 'Test inquiry',
        ]);

        $markResponse = $this->post("/dashboard/lead/{$lead->id}/read");
        $markResponse->assertStatus(302);
        $markResponse->assertRedirect('/dashboard/login');

        $deleteResponse = $this->delete("/dashboard/lead/{$lead->id}");
        $deleteResponse->assertStatus(302);
        $deleteResponse->assertRedirect('/dashboard/login');

        $this->assertDatabaseHas('leads', ['id' => $lead->id]);
    }

    public function test_admin_can_authenticate_with_valid_credentials(): void
    {
        $response = $this->post('/dashboard/login', [
            'email' => 'admin@azorasolution.com',
            'password' => 'AzoraAdmin2026!',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    public function test_admin_cannot_authenticate_with_invalid_credentials(): void
    {
        $response = $this->from('/dashboard/login')->post('/dashboard/login', [
            'email' => 'admin@azorasolution.com',
            'password' => 'WrongPassword123!',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_admin_can_logout(): void
    {
        $user = User::where('email', 'admin@azorasolution.com')->first();

        $response = $this->actingAs($user)->post('/dashboard/logout');

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard/login');
        $this->assertGuest();
    }

    public function test_authenticated_admin_can_access_dashboard_and_export(): void
    {
        $user = User::where('email', 'admin@azorasolution.com')->first();

        $dashboardResponse = $this->actingAs($user)->get('/dashboard');
        $dashboardResponse->assertStatus(200);

        $exportResponse = $this->actingAs($user)->get('/dashboard/export');
        $exportResponse->assertStatus(200);
        $this->assertTrue(str_contains($exportResponse->headers->get('content-type'), 'text/csv'));
    }

    public function test_admin_password_change_persists_to_database(): void
    {
        $user = User::where('email', 'admin@azorasolution.com')->first();

        $response = $this->actingAs($user)->postJson('/dashboard/password', [
            'current_password' => 'AzoraAdmin2026!',
            'new_password' => 'NewSecurePassword2026#',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['ok' => true]);

        // Refresh user and verify new password works
        $user->refresh();
        $this->assertTrue(Hash::check('NewSecurePassword2026#', $user->password));

        // Attempt login with new password
        $loginResponse = $this->post('/dashboard/login', [
            'email' => 'admin@azorasolution.com',
            'password' => 'NewSecurePassword2026#',
        ]);
        $loginResponse->assertStatus(302);
        $loginResponse->assertRedirect('/dashboard');
    }
}

