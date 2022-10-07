<?php

namespace Tests\Feature;

use App\Models\UrlContent;
use Tests\TestCase;

class CommandGetUrlResourcesTest extends TestCase
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
}
