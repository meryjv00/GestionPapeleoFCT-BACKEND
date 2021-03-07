<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
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
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'isUser' =>[ \App\Http\Middleware\IsUserControl::class],
        'isPersona' =>[ \App\Http\Middleware\IsPersonaControl::class],
        'notUser' =>[ \App\Http\Middleware\notUser::class],
        'notPersona' =>[ \App\Http\Middleware\notPersona::class],
        'auth' =>[\App\Http\Middleware\Authenticate::class],
        'auth.basic' =>[\Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class],
        'isTutor' =>[\App\Http\Middleware\isTutor::class],
        'isProfe' =>[\App\Http\Middleware\isProfe::class],
        'isJeEst' =>[\App\Http\Middleware\isJeEst::class],
        'isDirect' =>[\App\Http\Middleware\isDirect::class],
        'isLogin' => [\App\Http\Middleware\IsLogin::class],
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
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'isLogin' => \App\Http\Middleware\IsLogin::class,
        'isUser' => \App\Http\Middleware\IsUserControl::class,
        'isPersona' => \App\Http\Middleware\IsPersonaControl::class,
        'notUser' => \App\Http\Middleware\notUser::class,
        'notPersona' => \App\Http\Middleware\notPersona::class,
        'isTutor' => \App\Http\Middleware\isTutor::class,
        'isProfe' => \App\Http\Middleware\isProfe::class,
        'isJeEst' => \App\Http\Middleware\isJeEst::class,
        'isDirect' => \App\Http\Middleware\isDirect::class,
    ];
}
