<?php

namespace Tests\Feature;

use App\Models\UrlContent;
use Tests\TestCase;

class CommandsTest extends TestCase
{
    public function test_get_url_resources():void
    {
        $urlContents = UrlContent::all(['id', 'filename', 'url', 'status'])
        ->toArray();
        
        $this->artisan('url:display-all')->expectsTable(
            [ 'Id','Filename', 'Url', 'Status'],
            $urlContents
        );
    }

    public function test_queue_url():void
    {
        $urlContent = UrlContent::factory()->create();

        $this->artisan("url:download $urlContent->url")->assertExitCode(0);
    }
}
