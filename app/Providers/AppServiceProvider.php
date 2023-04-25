<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        URL::forceScheme('http');

        Paginator::useBootstrap();

        Response::macro('success', function ($data = [], $message = null) {
            return response()->json([
                'info' => [
                    'status' => true,
                    'message' => $message,
                ],
                'data' => $data,
            ]);
        });

        Response::macro('message', function ($message) {
            return response()->json([
                'info' => [
                    'status' => true,
                    'message' => $message,
                ],
                'data' => null,
            ]);
        });

        Response::macro('error', function ($message, $code = SymfonyResponse::HTTP_BAD_REQUEST, $data = null) {
            return response()->json([
                'info' => [
                    'status' => false,
                    'message' => $message,
                ],
                'data' => $data,
            ], $code);
        });

        Carbon::setLocale('uk_UA');
    }
}
