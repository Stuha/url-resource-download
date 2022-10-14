<?php

namespace App\Jobs;

use App\Models\UrlContent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\UrlContentService;

class QueueTaskForDownload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private UrlContentService $urlContentService;
    private UrlContent $urlContent;

    public function __construct(UrlContentService $urlContentService, UrlContent $urlContent)
    {
        $this->urlContentService = $urlContentService;
        $this->urlContent = $urlContent;
    }

    public function handle():void
    {
        $this->urlContentService->downloadUrlResource($this->urlContent);
    }
}
