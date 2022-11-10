<?php

namespace Tests\Feature;

use App\Models\UrlContent;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiUrlRequestsTest extends TestCase
{
    public function test_api_queue_url_request():void
    {
        $urlContent = UrlContent::factory()->create();
      
        $response = $this->post('api/url-content', ['url' => $urlContent->url]);
     
        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
       
        $response->assertJson(['queued_for_execution' => true]);
    }

    public function test_api_content_request()
    {
        $response = $this->get('api/url-content');

        $response->assertStatus(200);
    }
}
