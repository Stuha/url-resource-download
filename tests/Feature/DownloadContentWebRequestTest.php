<?php

namespace Tests\Feature;

use Tests\TestCase;

class DownloadContentWebRequestTest extends TestCase
{
    public function test_url_download_web_request():void
    {
        $response = $this->get('/download-content');

        $response->assertDownload()->assertStatus(200);
    }
}
