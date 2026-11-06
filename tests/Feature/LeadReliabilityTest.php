<?php

namespace Tests\Feature;

use App\Mail\LeadReceived;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class LeadReliabilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_lead_notification_mail_is_queued_properly(): void
    {
        Mail::fake();

        $payload = [
            'business' => 'Acme Cloud Dynamics',
            'contact' => 'Alice Smith',
            'email' => 'alice@acmecloud.com',
            'phone' => '555-1212',
            'message' => 'Looking for enterprise SEO rollout',
            'items' => [['name' => 'SEO Growth Plan']],
        ];

        $response = $this->postJson('/quote', $payload);

        $response->assertStatus(200);
        $response->assertJson(['ok' => true]);

        $this->assertDatabaseHas('leads', [
            'email' => 'alice@acmecloud.com',
            'email_status' => 'queued',
        ]);

        Mail::assertQueued(LeadReceived::class, function ($mail) {
            return $mail->lead->email === 'alice@acmecloud.com';
        });
    }

    public function test_duplicate_submission_within_60_seconds_returns_existing_lead(): void
    {
        Mail::fake();

        $payload = [
            'business' => 'Duplicate Corp',
            'contact' => 'Bob Builder',
            'email' => 'bob@duplicate.com',
            'phone' => '555-3434',
            'message' => 'Need 10 custom pages',
        ];

        // First submission
        $firstResponse = $this->postJson('/lead', $payload);
        $firstResponse->assertStatus(200);
        $firstRef = $firstResponse->json('ref');

        // Immediate second submission with identical email & business
        $secondResponse = $this->postJson('/lead', $payload);
        $secondResponse->assertStatus(200);
        $secondResponse->assertJson([
            'ok' => true,
            'duplicate' => true,
            'ref' => $firstRef,
        ]);

        // Assert exactly ONE lead was created in database
        $this->assertEquals(1, Lead::where('email', 'bob@duplicate.com')->count());

        // Assert email was only queued once
        Mail::assertQueued(LeadReceived::class, 1);
    }

    public function test_distinct_submissions_create_separate_leads(): void
    {
        Mail::fake();

        $payload1 = [
            'business' => 'Branch North',
            'contact' => 'Carol Danvers',
            'email' => 'carol@north.com',
            'message' => 'First branch quote',
        ];

        $payload2 = [
            'business' => 'Branch South',
            'contact' => 'Carol Danvers',
            'email' => 'carol@south.com',
            'message' => 'Second branch quote',
        ];

        $this->postJson('/lead', $payload1)->assertStatus(200);
        $this->postJson('/lead', $payload2)->assertStatus(200);

        $this->assertEquals(1, Lead::where('email', 'carol@north.com')->count());
        $this->assertEquals(1, Lead::where('email', 'carol@south.com')->count());
        Mail::assertQueued(LeadReceived::class, 2);
    }

    public function test_lead_is_persisted_even_if_queue_dispatch_fails(): void
    {
        // Force Mail to throw an exception on queue
        Mail::shouldReceive('to->queue')
            ->once()
            ->andThrow(new \Exception('Queue daemon connection timed out'));

        $payload = [
            'business' => 'Fault Tolerant LLC',
            'contact' => 'Dave Miller',
            'email' => 'dave@faulttolerant.com',
            'phone' => '555-7777',
            'message' => 'Testing email failure tolerance',
        ];

        $response = $this->postJson('/quote', $payload);

        // HTTP response must still succeed
        $response->assertStatus(200);
        $response->assertJson(['ok' => true]);

        // Lead must exist in database with email_status = 'failed'
        $lead = Lead::where('email', 'dave@faulttolerant.com')->first();
        $this->assertNotNull($lead);
        $this->assertEquals('failed', $lead->email_status);
        $this->assertStringContainsString('Queue daemon connection timed out', $lead->email_error);
    }
}

