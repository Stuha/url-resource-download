<?php

namespace App\Console\Commands;

use App\Jobs\QueueTaskForDownload;
use App\Services\UrlContentService;
use Illuminate\Console\Command;

class QueueUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:download {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queues url for downloading it\'s resources.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(UrlContentService $downloadService, QueueTaskForDownload $queueTask)
    {
        $url_validation_regex = "/^https?:\\/\\/(?:www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/"; 

        if (preg_match($url_validation_regex, $this->argument('url')) == false) {
           $this->error('Please enter valid url.');
        }
        
        $downloadService->setUrl($this->argument('url'));
        
        $queueTask->dispatch($downloadService);

        return 0;
    }
}
