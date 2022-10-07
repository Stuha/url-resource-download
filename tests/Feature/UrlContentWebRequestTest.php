<?php

namespace Tests\Feature;

use Tests\TestCase;


class UrlContentWebRequestTest extends TestCase
{
    public function test_url_content_web_request():void
    {
        $response = $this->get('/url-content');

        $response->assertStatus(200);
    }
}
