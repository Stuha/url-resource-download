<?php

namespace Tests\Feature;

use App\Models\UrlContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApiQueueUrlRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_queue_url_request():void
    {
        $urlContent = UrlContent::factory()->create();
      
        $response = $this->post('api/url-contents', ['url' => $urlContent->url]);
     
        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
       
        $response->assertJson(['queued_for_execution' => true]);
    }
}
