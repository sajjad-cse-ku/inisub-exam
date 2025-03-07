<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Services\BlogPostService;

class BlogPostController extends Controller
{
    public function __construct(protected BlogPostService $service) {}

    public function store(BlogPostRequest $request)
    {
        return $this->service->store($request);
    }
}
