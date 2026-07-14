<?php

use App\Http\Middleware\AccessAdmin;
use App\Http\Middleware\AccessTentor;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->alias([
            'admin' => AccessAdmin::class,
            'tentor' => AccessTentor::class,
        ]);

        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->respond(function (Response $response, Throwable $exception, Request $request) {

            // API => biarkan Laravel mengembalikan JSON
            if ($request->expectsJson() || $request->is('api/*')) {
                return $response;
            }

            // WEB => tampilkan halaman error Inertia
            if (in_array($response->getStatusCode(), [403, 404, 419, 429, 500, 503])) {
                return Inertia::render('Error', [
                    'status' => $response->getStatusCode(),
                    'title' => match ($response->getStatusCode()) {
                        403 => 'Forbidden',
                        404 => 'Page Not Found',
                        419 => 'Page Expired',
                        429 => 'Too Many Requests',
                        500 => 'Internal Server Error',
                        503 => 'Service Unavailable',
                        default => 'Unexpected Error',
                    },
                    'message' => config('app.debug')
                        ? $exception->getMessage()
                        : 'Something went wrong.',
                ])
                    ->toResponse($request)
                    ->setStatusCode($response->getStatusCode());
            }

            return $response;
        });
    })
    ->create();
