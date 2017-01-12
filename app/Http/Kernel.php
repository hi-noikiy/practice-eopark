<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

    /**
     *
     * HTTP 核心也定义了一份 HTTP 中间件清单，
     * 所有的请求在被应用程序处理之前都必须经过它们。这些中间件有负责处理 HTTP session 的读写，
     * 决定应用程序是否处于维护模式，查验跨站请求伪造（CSRF）标记，以及其他更多的功能。
     *
     *
     */


    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,

        ],

        'api' => [
            'throttle:60,1',
        ],

        'device' => [
            \App\Http\Middleware\DeviceMiddleware::class,
        ]
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'adminAuth' => \App\Http\Middleware\admin\adminAuthMiddleware::class,
        'updateCache' => \App\Http\Middleware\admin\UpdateCacheMiddleware::class,
    ];
}
