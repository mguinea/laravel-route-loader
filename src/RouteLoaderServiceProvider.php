<?php

namespace Mguinea\RouteLoader;

use Illuminate\Support\ServiceProvider;

class RouteLoaderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/route-loader.php' => config_path('route-loader.php'),
        ], 'config');

        $this->app->bind(RouteLoaderInterface::class, fn ($app) => $app->make($app->config['route-loader.loader']));

        $this->registerRoutes();
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/route-loader.php',
            'route-loader'
        );
    }

    private function registerRoutes(): void
    {
        if (! $this->shouldRegisterRoutes()) {
            return;
        }

        $routeRegistrar = (new RouteRegistrar(
            $this->app->router,
            $this->app->make(RouteLoaderInterface::class)
        ));
        $routeRegistrar->register();
    }

    private function shouldRegisterRoutes(): bool
    {
        if (! config('route-loader.enabled')) {
            return false;
        }

        /** @var \Illuminate\Contracts\Foundation\CachesRoutes $app */
        $app = $this->app;

        if ($app->routesAreCached()) {
            return false;
        }

        return true;
    }
}
