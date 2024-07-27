<?php

namespace Mguinea\RouteLoader;

class DemoRouteLoader implements RouteLoaderInterface
{
    public function load(): RouteCollection
    {
        return new RouteCollection(
            [
                new Route('route-loader-demo', function() {
                    return "Demo";
                })
            ]
        );
    }
}
