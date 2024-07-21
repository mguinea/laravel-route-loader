<?php

namespace Mguinea\RouteLoader;

use Illuminate\Routing\Router;
use Illuminate\Support\Arr;

class Route
{
    /** @var array<int, string> */
    public array $methods;

    /** @var array<int, class-string> */
    public array $middleware;

    public array $wheres;

    /**
     * @param array<int, string>|string $method
     * @param string|null $uri
     * @param string|null $fullUri
     * @param string|null $name
     * @param array<int, class-string>|string $middleware
     * @param string|null $domain
     */
    public function __construct(
        array | string $method = [],
        public ?string $uri = null,
        public ?string $fullUri = null,
        public ?string $name = null,
        array | string $middleware = [],
        public ?string $domain = null,
        public $action
    ) {
        $methods = Arr::wrap($method);

        $this->methods = collect($methods)
            ->map(fn (string $method) => strtoupper($method))
            ->filter(fn (string $method) => in_array($method, Router::$verbs))
            ->toArray();

        $this->middleware = Arr::wrap($middleware);
    }

    public function action(): mixed
    {

    }
}
