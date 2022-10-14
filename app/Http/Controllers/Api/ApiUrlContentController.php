<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UrlContentRequest;
use App\Http\Resources\UrlContentCollection;
use App\Services\UrlContentService;
use App\Repositories\UrlContentRepository;
use App\Jobs\QueueTaskForDownload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


class ApiUrlContentController extends Controller
{

    private UrlContentService $urlContentService;

    public function __construct(
        UrlContentRepository $contentRepository, 
        UrlContentService $urlContentService, 
        QueueTaskForDownload $queueTask)
    {
        $this->contentRepository = $contentRepository;
        $this->urlContentService = $urlContentService;
        $this->queueTaskJob = $queueTask;
    }
  
    public function index():JsonResponse
    {
        $urlsContents = $this->contentRepository->getAll();

        $urlsContentsCollection = new UrlContentCollection($urlsContents);
      
        return $urlsContentsCollection->response();
    }

    public function store(UrlContentRequest $request):JsonResponse
    {
        $this->urlContentService->setUrl($request->url);
        $urlContent = $this->urlContentService->createUrlResource($this->contentRepository);

        $this->queueTaskJob->dispatch($this->urlContentService, $urlContent);

        return response()->json(['queued_for_execution' => true], Response::HTTP_OK);
    }
}
