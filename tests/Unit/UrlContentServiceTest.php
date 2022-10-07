<?php

namespace Tests\Unit;

use App\Models\UrlContent;
use App\Repositories\UrlContentRepository;
use Tests\TestCase;
use App\Enums\Status;

class UrlContentServiceTest extends TestCase
{

    public function test_save_url_resource():void
    {
        $dummyUrlResource = UrlContent::factory()->create();

        $urlRepository = new UrlContentRepository;
    
        $urlResource['filename'] = basename($dummyUrlResource->url);
        $urlResource['url'] = $dummyUrlResource->url;

        $urlResourceSaved = $urlRepository->create($urlResource);
       
        $this->assertEquals($dummyUrlResource->url, $urlResourceSaved->url);

    }

    public function test_download_url_resource():void
    {
        $urlRepository = new UrlContentRepository;

        $dummyUrlResource = UrlContent::factory()->create()->toArray();

        array_shift($dummyUrlResource);

        $urlResourceSaved = $urlRepository->create($dummyUrlResource);
        
        try {
            $urlRepository->update($urlResourceSaved->id, ['status' => Status::DOWNLOADING]);
            $urlResource = $urlRepository->getById($urlResourceSaved->id);

            $this->assertSame(Status::DOWNLOADING, $urlResource->status);

            $this->content = file_get_contents($this->url);

        } catch (\Throwable $th) {
            $urlRepository->update($urlResource->id, ['status' => Status::ERROR]);
            $urlResourceError = $urlRepository->getById($urlResource->id);

            $this->assertSame(Status::ERROR, $urlResourceError->status);
        }

        $urlRepository->update($urlResource->id, ['status' => Status::COMPLETE]);
        $urlResourceComplete = $urlRepository->getById($urlResource->id);

        $this->assertSame(Status::COMPLETE, $urlResourceComplete->status);
    }
}
