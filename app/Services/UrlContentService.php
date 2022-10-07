<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Repositories\UrlContentRepository;
use App\Enums\Status;
use App\Models\UrlContent;

class UrlContentService
{
    private string $url = '';
    private string $content = '';

    public function downloadUrlResource():void
    {
        $urlRepository = new UrlContentRepository();

        $urlResource = $this->createUrlResource($urlRepository);
        $this->setUrlContent($urlRepository, $urlResource->id);

        Storage::disk('local')->put("public/$urlResource->id/$urlResource->filename",  $this->content);

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

    private function setUrlContent(UrlContentRepository $urlRepository, int $id):void
    {
        try {
            $urlRepository->update($id, ['status' => Status::DOWNLOADING]);

            $this->content = file_get_contents($this->url);
        } catch (\Throwable $th) {
            $urlRepository->update($id, ['status' => Status::ERROR]);
        }
    }
}
