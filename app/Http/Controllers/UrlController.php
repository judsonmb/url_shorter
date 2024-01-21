<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUrlRequest;
use App\Models\Url;
use App\Services\UrlService;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function __construct(
        public readonly UrlService $service,
    )
    {
    }

    public function index()
    {
        $urls = $this->service->getUserUrls(1);

        return response()->json($urls, 200);
    }

    public function store(CreateUrlRequest $request)
    {
        $url = $this->service->createUrl($request->validated(), 1);

        return response()->json($url, 201);
    }

    public function redirect(request $request, string $urlKey)
    {
        $url = $this->service->getUrlByUrlKey($urlKey);

        return redirect($url);
    }
}
