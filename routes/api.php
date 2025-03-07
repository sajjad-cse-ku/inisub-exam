<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubscribedAppController;

Route::post('/create-website', [SubscribedAppController::class, 'store']);
