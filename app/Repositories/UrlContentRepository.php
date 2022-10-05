<?php

namespace App\Repositories;

use App\Models\UrlContent;

class UrlContentRepository 
{
    public function getAll() 
    {
        return UrlContent::all(['id', 'filename', 'url', 'status']);
    }

    public function getById($urlContentId) 
    {
        return UrlContent::findOrFail($urlContentId);
    }

    public function create(array $urlContent) 
    {
        return UrlContent::create($urlContent);
    }

    public function update($urlContentId, array $newDetails) 
    {
        return UrlContent::whereId($urlContentId)->update($newDetails);
    }
}