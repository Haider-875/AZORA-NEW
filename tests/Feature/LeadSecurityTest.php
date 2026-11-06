<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LeadSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_lead_submission_is_throttled_after_limit(): void
    {
        $payload = [
            'business' => 'Throttling Test Corp',
            'contact' => 'Jane Speed',
            'email' => 'jane@speed.com',
            'phone' => '555-9999',
            'message' => 'Rate limit assertion test',
        ];

        // Send 10 allowed requests within 1 minute window
        for ($i = 0; $i < 10; $i++) {
            $response = $this->postJson('/quote', $payload);
            $this->assertTrue(in_array($response->getStatusCode(), [200, 302]));
        }

        // The 11th request MUST be rejected with HTTP 429 Too Many Requests
        $eleventhResponse = $this->postJson('/quote', $payload);
        $eleventhResponse->assertStatus(429);
    }

    public function test_malicious_script_tags_are_sanitized_at_ingestion(): void
    {
        $maliciousPayload = [
            'business' => '<script>alert("xss-corp")</script>Secure Corp',
            'contact' => '<b>Hacker</b> Joe',
            'email' => 'hacker@example.com',
            'phone' => '555-0000',
            'message' => '<img src=x onerror=alert(1)> Urgent quote please',
            'items' => [
                ['name' => '<script>stealCookie()</script>Custom Scope Item']
            ],
        ];

        $response = $this->postJson('/lead', $maliciousPayload);
        $response->assertStatus(200);

        // Verify database contains sanitized text without raw executable tags
        $lead = Lead::where('email', 'hacker@example.com')->first();
        $this->assertNotNull($lead);

        $this->assertStringNotContainsString('<script>', $lead->business);
        $this->assertStringNotContainsString('<script>', $lead->message);
        $this->assertStringNotContainsString('<img', $lead->message);
        $this->assertEquals('Secure Corp', $lead->business);
        $this->assertEquals('Hacker Joe', $lead->contact);
        $this->assertEquals('Urgent quote please', $lead->message);

        // Check normalized items
        $this->assertIsArray($lead->items);
        $this->assertEquals('Custom Scope Item', $lead->items[0]['name']);
    }

    public function test_honeypot_bot_rejection_still_works(): void
    {
        $botPayload = [
            'business' => 'Spam Bot LLC',
            'email' => 'spambot@internet.com',
            'website' => 'http://spam-link.ru', // honeypot trap field
        ];

        $response = $this->postJson('/lead', $botPayload);
        $response->assertStatus(200);
        $response->assertJson(['ok' => true, 'ref' => 'AZ-' . date('ymd') . '-BOT']);

        // Assert bot submission is NOT stored in real leads table
        $this->assertDatabaseMissing('leads', ['email' => 'spambot@internet.com']);
    }

    public function test_dashboard_renders_sanitized_lead_attributes_safely(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@azorasolution.com',
            'password' => Hash::make('AzoraAdmin2026!'),
        ]);

        $lead = Lead::create([
            'ref' => 'AZ-SEC-01',
            'event_type' => 'quote_request',
            'business' => 'Safety & Sons',
            'contact' => 'Sarah Connor',
            'email' => 'sarah@skynet.com',
            'phone' => '555-TERMINATOR',
            'message' => 'Need defense systems',
            'items' => [['name' => 'Cyber Glass Theme']],
        ]);

        $response = $this->actingAs($admin)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Safety &amp; Sons', false);
        $response->assertSee('AZ-SEC-01');
    }
}
