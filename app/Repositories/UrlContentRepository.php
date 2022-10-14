<?php

namespace App\Repositories;

use App\Models\UrlContent;
use Illuminate\Database\Eloquent\Collection;

class UrlContentRepository 
{
    public function getAll():Collection
    {
        return UrlContent::all(['id', 'filename', 'url', 'status']);
    }

    public function getById(int $urlContentId):UrlContent
    {
        return UrlContent::findOrFail($urlContentId);
    }

    public function create(array $urlContent):UrlContent
    {
        return UrlContent::create($urlContent);
    }

    public function update(int $urlContentId, array $newDetails):int
    {
        return UrlContent::whereId($urlContentId)->update($newDetails);
    }
}