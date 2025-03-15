<?php

use App\Http\Middleware\AgeCheckMiddleware;
use App\Http\Middleware\LogHttpRequests;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Middleware Aliases

        $middleware->alias([
            'AgeCheckMiddleware' => AgeCheckMiddleware::class,
            'is_admin' => AdminMiddleware::class,
            // Other Middlewares
        ]);

        // Global Middleware (Executes on every HTTP Requests)
        $middleware->web(append:[
            \App\Http\Middleware\LogHttpRequests::class,
            
            // Other Middlewares
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
