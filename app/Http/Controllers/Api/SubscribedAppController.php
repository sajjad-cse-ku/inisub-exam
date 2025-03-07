<?php

namespace App\Http\Controllers\Api;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribedAppStoreRequest;
use App\Services\SubscribedAppService;

class SubscribedAppController extends Controller
{

    public function __construct(protected SubscribedAppService $service) {}

    public function store(SubscribedAppStoreRequest $request)
    {
        return $this->service->store($request);
    }
}
