<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiUrlContenRequestTest extends TestCase
{
    public function test_api_content_request()
    {
        $response = $this->get('api/url-contents');

        $response->assertStatus(200);
    }
}
