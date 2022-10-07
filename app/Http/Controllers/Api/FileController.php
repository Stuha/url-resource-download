<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\UrlContentRepository;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{
    public function __construct(UrlContentRepository $urlContentRepository)
    {
        $this->urlContentRepository = $urlContentRepository;
    }

    public function downloadContent(Request $request):BinaryFileResponse
    {
        $urlContent = $this->urlContentRepository->getById($request->id);
     
        return response()->download(storage_path("app/public/$urlContent->id/$urlContent->filename"));
    }
}
