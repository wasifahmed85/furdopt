<?php

use App\Http\Middleware\AuthGates;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\VisitorCount;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['auth','web', 'gate','admin'])->name('admin.')->prefix('admin')
                ->group(__DIR__ . '/../routes/backend.php');
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'gate' => AuthGates::class,
            'user' => UserMiddleware::class,
            'admin' => AdminMiddleware::class,
            'VisitorCount' => VisitorCount::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
