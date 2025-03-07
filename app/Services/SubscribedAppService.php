<?php

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class SubscribedAppService
{
    public function store($request)
    {
        try {
            $app = Tenant::create([
                'app_name' => $request->app_name
            ]);

            $app->domains()->create([
                'domain' => $request->domain
            ]);

            return response()->json([
                'message' => 'Website registered successfully',
                'status' => 201
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while registering the website',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
