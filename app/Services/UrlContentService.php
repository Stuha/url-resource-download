<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Repositories\UrlContentRepository;
use App\Enums\Status;
use App\Models\UrlContent;

class UrlContentService
{
    private string $url = '';

    public function downloadUrlResource():void
    {
        $urlRepository = new UrlContentRepository();

        $urlResource = $this->createUrlResource($urlRepository);
        $content = $this->getUrlContent($urlRepository, $urlResource->id);

        Storage::disk('local')->put("public/$urlResource->id/$urlResource->filename",  $content);

        $urlRepository->update($urlResource->id, ['status' => Status::COMPLETE]);
    }

    public function setUrl(string $url):void
    {
        $this->url = $url;
    }

    private function createUrlResource(UrlContentRepository $urlRepository):UrlContent
    {
        $urlResource['filename'] = basename($this->url);
        $urlResource['url'] = $this->url;

        return $urlRepository->create($urlResource);
    }

    private function getUrlContent(UrlContentRepository $urlRepository, int $id):string
    {
        try {
            $urlRepository->update($id, ['status' => Status::DOWNLOADING]);

            $content = file_get_contents($this->url);
        } catch (\Throwable $th) {
            $urlRepository->update($id, ['status' => Status::ERROR]);
        }
        
        return $content;
    }
}
