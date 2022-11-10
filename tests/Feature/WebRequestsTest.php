<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\UrlContent;

class WebRequestsTest extends TestCase
{
    public function test_url_download_web_request():void
    {
        $response = $this->get('/download-content');

        $response->assertDownload()->assertStatus(200);
    }

    public function test_queue_url_web_request():void
    {
        $urlContent = UrlContent::factory()->make();
        $response = $this->post('/queue-url', ['url' => $urlContent->url]);

        $response->assertStatus(302)->assertRedirect('/url-content');
    }

    public function test_url_content_web_request():void
    {
        $response = $this->get('/url-content');

        $response->assertStatus(200);
    }
}
