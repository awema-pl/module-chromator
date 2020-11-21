<?php

namespace AwemaPL\Chromator;

use AwemaPL\BaseJS\AwemaProvider;
use AwemaPL\Chromator\Listeners\EventSubscriber;
use AwemaPL\Chromator\Sections\Tokens\Repositories\Contracts\TokenRepository;
use AwemaPL\Chromator\Sections\Tokens\Repositories\EloquentTokenRepository;
use AwemaPL\Chromator\Sections\Users\Repositories\Contracts\UserRepository;
use AwemaPL\Chromator\Sections\Users\Repositories\EloquentUserRepository;
use AwemaPL\Navigation\Middlewares\AddNavigationComponent;
use AwemaPL\Chromator\Sections\Creators\Http\Middleware\StorageDownload;
use AwemaPL\Chromator\Sections\Creators\Repositories\Contracts\HistoryRepository;
use AwemaPL\Chromator\Sections\Creators\Repositories\EloquentHistoryRepository;
use AwemaPL\Chromator\Sections\Installations\Http\Middleware\GlobalMiddleware;
use AwemaPL\Chromator\Sections\Installations\Http\Middleware\GroupMiddleware;
use AwemaPL\Chromator\Sections\Installations\Http\Middleware\Installation;
use AwemaPL\Chromator\Sections\Installations\Http\Middleware\RouteMiddleware;
use AwemaPL\Chromator\Contracts\Chromator as ChromatorContract;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;

class ChromatorServiceProvider extends AwemaProvider
{

    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'chromator');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'chromator');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->bootMiddleware();
        app('chromator')->includeLangJs();
        app('chromator')->menuMerge();
        app('chromator')->mergePermissions();
        Event::subscribe(EventSubscriber::class);
        parent::boot();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/chromator.php', 'chromator');
        $this->mergeConfigFrom(__DIR__ . '/../config/chromator-menu.php', 'chromator-menu');
        $this->app->bind(ChromatorContract::class, Chromator::class);
        $this->app->singleton('chromator', ChromatorContract::class);
        $this->registerRepositories();
        parent::register();
    }


    public function getPackageName(): string
    {
        return 'chromator';
    }

    public function getPath(): string
    {
        return __DIR__;
    }

    /**
     * Register and bind package repositories
     *
     * @return void
     */
    protected function registerRepositories()
    {
        $this->app->bind(HistoryRepository::class, EloquentHistoryRepository::class);
        $this->app->bind(TokenRepository::class, EloquentTokenRepository::class);
    }

    /**
     * Boot middleware
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function bootMiddleware()
    {
        $this->bootGlobalMiddleware();
        $this->bootRouteMiddleware();
        $this->bootGroupMiddleware();
    }

    /**
     * Boot route middleware
     */
    private function bootRouteMiddleware()
    {
        $router = app('router');
        $router->aliasMiddleware('chromator', RouteMiddleware::class);
    }

    /**
     * Boot group middleware
     */
    private function bootGroupMiddleware()
    {
        $kernel = $this->app->make(\Illuminate\Contracts\Http\Kernel::class);
        $kernel->appendMiddlewareToGroup('web', GroupMiddleware::class);
        $kernel->appendMiddlewareToGroup('web', Installation::class);
    }

    /**
     * Boot global middleware
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function bootGlobalMiddleware()
    {
        $kernel = $this->app->make(\Illuminate\Contracts\Http\Kernel::class);
        $kernel->pushMiddleware(GlobalMiddleware::class);
        $kernel->pushMiddleware(StorageDownload::class);
    }
}
