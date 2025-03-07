<?php

namespace App\Services;

use App\Models\SubscribedUser;

class SubscribeEmailService
{
    public function store($request)
    {
        try {
            SubscribedUser::create([
                'email' => $request->email
            ]);

            return response()->json([
                'message' => 'Subscribed successfully',
                'status' => 201
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while subscribing',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
