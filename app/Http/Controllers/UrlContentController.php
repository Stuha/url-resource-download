<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlContentRequest;
use Illuminate\Http\Request;
use App\Repositories\UrlContentRepository;
use App\Services\UrlContentService;
use App\Jobs\QueueTaskForDownload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UrlContentController extends Controller
{
    private $urlContentService;

    public function __construct(
        UrlContentRepository $contentRepository, 
        UrlContentService $urlContentService, 
        QueueTaskForDownload $queueTask)
    {
        $this->contentRepository = $contentRepository;
        $this->urlContentService = $urlContentService;
        $this->queueTaskJob = $queueTask;
    }

    public function read():View
    {
        $contents = $this->contentRepository->getAll();

        return view('url-content', compact('contents'));
    }

    public function store(UrlContentRequest $request):RedirectResponse
    {
        $this->urlContentService->setUrl($request->url);
        
        $this->queueTaskJob->dispatch($this->urlContentService);
        
        return redirect('url-content');
        
    }

    public function downloadContent(Request $request):StreamedResponse
    {
        return Storage::download("public/$request->id/$request->filename");
    }
}
