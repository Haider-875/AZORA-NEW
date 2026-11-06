<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SecurityBoundaryRegressionTest extends TestCase
{
    use RefreshDatabase;

    public function test_csrf_is_exempt_for_api_and_serverless_lead_intake(): void
    {
        Mail::fake();

        $payload = [
            'business' => 'API Client Enterprise',
            'contact' => 'Dev Ops',
            'email' => 'devops@apiclient.com',
            'phone' => '555-4321',
            'message' => 'Automated CRM lead push',
        ];

        // Raw POST to /api/lead without session CSRF token
        $apiResponse = $this->postJson('/api/lead', $payload);
        $apiResponse->assertStatus(200);
        $apiResponse->assertJson(['ok' => true]);

        // Raw POST to /.netlify/functions/send-lead-email without session CSRF token
        $payload['email'] = 'devops2@apiclient.com';
        $netlifyResponse = $this->postJson('/.netlify/functions/send-lead-email', $payload);
        $netlifyResponse->assertStatus(200);
        $netlifyResponse->assertJson(['ok' => true]);
    }

    public function test_non_existent_routes_return_404(): void
    {
        $response = $this->get('/definitely-not-a-real-page-' . uniqid());

        $response->assertStatus(404);
    }

    public function test_lead_deletion_requires_authenticated_session(): void
    {
        $lead = Lead::create([
            'ref' => 'AZ-BOUNDARY-01',
            'business' => 'Boundary Target LLC',
            'email' => 'target@boundary.com',
        ]);

        // Unauthenticated DELETE must be rejected
        $guestResponse = $this->delete("/dashboard/lead/{$lead->id}");
        $guestResponse->assertStatus(302);
        $guestResponse->assertRedirect('/dashboard/login');
        $this->assertDatabaseHas('leads', ['id' => $lead->id]);

        // Authenticated admin DELETE succeeds
        $admin = User::create([
            'name' => 'Admin Boss',
            'email' => 'boss@azorasolution.com',
            'password' => bcrypt('AdminPassword123#'),
        ]);

        $authResponse = $this->actingAs($admin)->delete("/dashboard/lead/{$lead->id}");
        $authResponse->assertStatus(302);
        $this->assertDatabaseMissing('leads', ['id' => $lead->id]);
    }

    public function test_export_csv_streams_proper_headers_for_admin(): void
    {
        $admin = User::create([
            'name' => 'Admin Boss',
            'email' => 'exportboss@azorasolution.com',
            'password' => bcrypt('AdminPassword123#'),
        ]);

        Lead::create([
            'ref' => 'AZ-CSV-01',
            'business' => 'Acme CSV Test',
            'email' => 'acme@csvtest.com',
            'phone' => '555-8888',
        ]);

        $response = $this->actingAs($admin)->get('/dashboard/export');

        $response->assertStatus(200);
        $this->assertTrue(str_contains(strtolower($response->headers->get('content-type')), 'text/csv'));
        $this->assertTrue(str_contains($response->headers->get('content-disposition'), 'attachment; filename="azora-leads-'));
    }
}
