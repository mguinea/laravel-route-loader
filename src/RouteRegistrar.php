<?php

namespace Mguinea\RouteLoader;

use Illuminate\Routing\Router;

class RouteRegistrar
{
    private Router $router;

    private RouteLoaderInterface $routeLoader;

    public function __construct(
        Router $router,
        RouteLoaderInterface $routeLoader
    ) {
        $this->router = $router;
        $this->routeLoader = $routeLoader;
    }

    public function register(): void
    {
        $routes = $this->routeLoader->load();

        $routes->each(function (Route $pendingRoute) {
            $route = $this->router->addRoute($pendingRoute->methods(), $pendingRoute->uri(), $pendingRoute->action());

            if ($pendingRoute->middlewares()) {
                $route->middleware($pendingRoute->middlewares());
            }

            if ($pendingRoute->name()) {
                $route->name($pendingRoute->name());
            }

            if ($pendingRoute->wheres()) {
                $route->setWheres($pendingRoute->wheres());
            }

            if ($pendingRoute->domain()) {
                $route->domain($pendingRoute->domain());
            }
        });
    }
}
