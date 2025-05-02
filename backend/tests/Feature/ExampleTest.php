<?php

// tests/Feature/EventTest.php
namespace Tests\Feature;

use Tests\TestCase;

class EventTest extends TestCase
{
    public function test_event_creation()
    {
        $response = $this->postJson('/events', [
            'name' => 'Test Event',
            'description' => 'This is a test event',
        ]);
        $response->assertStatus(201);
    }

    public function test_get_events()
    {
        $response = $this->getJson('/events');
        $response->assertStatus(200);
    }
}
