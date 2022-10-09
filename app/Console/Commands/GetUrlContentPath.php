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
    protected $signature = 'url:storage-path {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get url path from storage';

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
        try {
            $urlContent = $urlContentRepository->getById($this->argument('id'));

        } catch (\Throwable $th) {
            $this->error('Url content not found, please make sure you entered valid id.');
            return 1;
        }

        if ($urlContent->status !== Status::COMPLETE) {
            $this->error('Please enter id of url with status completed.');
            return 1;
        }

        $urlToContent = Storage::url("public/$urlContent->id/$urlContent->filename");
        
        $this->info($urlToContent);
        
        return 0;
    }
}
