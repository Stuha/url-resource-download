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

    private $downloadService;
    private $urlContent;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UrlContentService $downloadService, UrlContent $urlContent)
    {
        $this->downloadService = $downloadService;
        $this->urlContent = $urlContent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->downloadService->downloadUrlResource($this->urlContent);
    }
}
