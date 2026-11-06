<?php

namespace Tests\Unit;

use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_lead_items_are_cast_to_array(): void
    {
        $lead = Lead::create([
            'ref' => 'AZ-UNIT-01',
            'business' => 'Unit Test Corp',
            'email' => 'unit@test.com',
            'items' => [
                ['id' => 'website-starter', 'name' => 'Website Starter Plan'],
                ['id' => 'marketing-starter', 'name' => 'Local SEO Starter']
            ],
        ]);

        $lead->refresh();

        $this->assertIsArray($lead->items);
        $this->assertCount(2, $lead->items);
        $this->assertEquals('website-starter', $lead->items[0]['id']);
    }

    public function test_unread_scope_returns_only_unread_leads(): void
    {
        Lead::create([
            'ref' => 'AZ-UNREAD',
            'email' => 'unread@test.com',
            'is_read' => false,
        ]);

        Lead::create([
            'ref' => 'AZ-READ',
            'email' => 'read@test.com',
            'is_read' => true,
            'read_at' => now(),
        ]);

        $unread = Lead::unread()->get();

        $this->assertCount(1, $unread);
        $this->assertEquals('AZ-UNREAD', $unread->first()->ref);
    }

    public function test_quotes_scope_returns_only_quote_events(): void
    {
        Lead::create([
            'ref' => 'AZ-QUOTE',
            'event_type' => 'quote_request',
            'email' => 'quote@test.com',
        ]);

        Lead::create([
            'ref' => 'AZ-GENERAL',
            'event_type' => 'general_inquiry',
            'email' => 'general@test.com',
        ]);

        $quotes = Lead::quotes()->get();

        $this->assertCount(1, $quotes);
        $this->assertEquals('AZ-QUOTE', $quotes->first()->ref);
    }

    public function test_timestamp_attributes_are_cast_to_datetime_instances(): void
    {
        $lead = Lead::create([
            'ref' => 'AZ-TIME',
            'email' => 'time@test.com',
            'read_at' => now(),
            'email_sent_at' => now(),
        ]);

        $lead->refresh();

        $this->assertInstanceOf(\DateTimeInterface::class, $lead->read_at);
        $this->assertInstanceOf(\DateTimeInterface::class, $lead->email_sent_at);
    }
}

