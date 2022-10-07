<?php

namespace App\Console\Commands;

use App\Repositories\UrlContentRepository;
use Illuminate\Console\Command;

class GetUrlResources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:display-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display all urls with statuses';

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
    public function handle(UrlContentRepository $urlRepository)
    {
        $urlsContents = $urlRepository->getAll()->toArray();
        
        $this->table(
            ['Id', 'Filename', 'Url', 'Status'],
            $urlsContents
        );
        return 0;
    }
}
