<?php

use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Middleware\PreventBackHistory;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\URL;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');
        $middleware->redirectGuestsTo(fn()=>route('login'));
        $middleware->redirectUsersTo(fn()=>route('dashboard'));

        $middleware->alias([
            'role' => EnsureUserHasRole::class,
            'prevent-back' => PreventBackHistory::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->booted(function (): void {
        if (request()->hasHeader('x-forwarded-proto')) {
            URL::forceScheme('https');
        }
    })->create();
