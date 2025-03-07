<?php

declare(strict_types=1);

use App\Http\Controllers\Api\BlogPostController;
use App\Http\Controllers\Api\SubscribedUserController;
use Illuminate\Http\Request;
use App\Models\SubscribedUser;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
    Route::post('/api/subscribe', [SubscribedUserController::class, 'store']);
    Route::post('/api/blog-posts/store', [BlogPostController::class, 'store']);
});
