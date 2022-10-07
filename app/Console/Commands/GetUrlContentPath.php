<?php

namespace App\Console\Commands;

use App\Repositories\UrlContentRepository;
use Illuminate\Console\Command;
use App\Enums\Status;
use Illuminate\Support\Facades\Storage;

class GetUrlContentPath extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:download-content {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download url content from storage';

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
    public function handle(UrlContentRepository $urlContentRepository)
    {
        $urlContent = $urlContentRepository->getById($this->argument('id'));

        if (! isset($urlContent)) {
            $this->error('Url content not found, please make sure you entered valid id.');
        }

        if ($urlContent->status !== Status::COMPLETE) {
            $this->error('Please enter id of url with status completed.');
        }

        $urlToContent = Storage::url("public/$urlContent->id/$urlContent->filename");
        $this->info($urlToContent);
        
        return 0;
    }
}
