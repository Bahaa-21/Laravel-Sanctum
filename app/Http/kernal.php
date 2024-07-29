<?php

namespace App\Http;

use Defuse\Crypto\Core;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Http\Middleware\HandleCors;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        'abilities' => \Laravel\Sanctum\Http\Middleware\CheckAbilities::class,
        'ability' => \Laravel\Sanctum\Http\Middleware\CheckForAnyAbility::class,
    ];
}
