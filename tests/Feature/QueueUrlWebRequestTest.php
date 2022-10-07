<?php

namespace Tests\Feature;

use App\Models\UrlContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QueueUrlWebRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_queue_url_web_request():void
    {
        $urlContent = UrlContent::factory()->make();
        $response = $this->post('/queue-url', ['url' => $urlContent->url]);

        $response->assertStatus(302)->assertRedirect('/url-content');
    }
}
