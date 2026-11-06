<?php

namespace Tests\Feature;

use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class LeadFormValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_invalid_email_returns_422_with_validation_message(): void
    {
        Mail::fake();

        $payload = [
            'business' => 'Invalid Email Test',
            'contact' => 'John BadEmail',
            'email' => 'not-an-email-address',
            'phone' => '555-0101',
        ];

        $response = $this->postJson('/quote', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    public function test_empty_payload_handled_gracefully(): void
    {
        Mail::fake();

        $response = $this->postJson('/lead', []);

        // Should succeed as a general inquiry without unhandled exceptions
        $response->assertStatus(200);
        $response->assertJson(['ok' => true]);

        $this->assertDatabaseHas('leads', [
            'event_type' => 'general_inquiry',
        ]);
    }

    public function test_successful_submission_returns_json_with_ref(): void
    {
        Mail::fake();

        $payload = [
            'business' => 'Apex Healthcare Partners',
            'contact' => 'Dr. Marcus Vance',
            'email' => 'vance@apexhealth.com',
            'phone' => '984-388-8298',
            'locations' => '2-5',
            'items' => [
                ['name' => 'Website Premium Plan'],
                ['name' => 'Local Marketing Starter']
            ],
            'message' => 'Transitioning 3 regional clinics to a unified platform',
        ];

        $response = $this->postJson('/quote', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'ok' => true,
            'success' => true,
        ]);

        $ref = $response->json('ref');
        $this->assertNotNull($ref);
        $this->assertMatchesRegularExpression('/^AZ-\d{6}-[A-Z0-9]{4}$/', $ref);

        $this->assertDatabaseHas('leads', [
            'ref' => $ref,
            'business' => 'Apex Healthcare Partners',
            'contact' => 'Dr. Marcus Vance',
            'email' => 'vance@apexhealth.com',
            'locations' => '2-5',
        ]);
    }
}

