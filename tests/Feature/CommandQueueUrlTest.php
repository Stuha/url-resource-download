<?php

namespace Tests\Feature;

use App\Models\UrlContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommandQueueUrlTest extends TestCase
{
    public function test_queue_url():void
    {
        $urlContent = UrlContent::factory()->create();

        $this->artisan("url:download $urlContent->url")->assertExitCode(0);
    }
}
