<?php
// bootstrap/app.php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $m) {
        $m->statefulApi(); // 1) Sanctum: habilita el estado frontend (cookies) para SPA
        $m->throttleApi(); // 2) Throttle: añade throttle:api al grupo 'api'

        // Opcional: si quieres inyectar un binding extra en API:
        // $m->appendToGroup('api', \Illuminate\Routing\Middleware\SubstituteBindings::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
