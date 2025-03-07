<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SubscribeEmailService;
use App\Http\Requests\StoreSubscribedUserRequest;

class SubscribedUserController extends Controller
{
    public function __construct(protected SubscribeEmailService $service) {}

    public function store(StoreSubscribedUserRequest $request)
    {
        return $this->service->store($request);
    }
}
