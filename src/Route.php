<?php

namespace Mguinea\RouteLoader;

class Route
{
    /**
     * All of the verbs supported by the router.
     *
     * @var string[]
     */
    public static $verbs = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];

    public function __construct(
        private string $uri,
        private mixed $action,
        private ?array $wheres = null,
        private ?array $methods = null,
        private ?array $middlewares = null,
        private ?string $domain = null,
        private ?string $name = null
    ) {
        $this->methods = collect($methods)
            ->map(fn (string $method) => strtoupper($method))
            ->filter(fn (string $method) => in_array($method, self::$verbs))
            ->toArray();
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function action(): mixed
    {
        return $this->action;
    }

    public function wheres(): ?array
    {
        return $this->wheres;
    }

    public function methods(): array
    {
        return $this->methods ?? ['GET'];
    }

    public function middlewares(): ?array
    {
        return $this->middlewares;
    }

    public function domain(): ?string
    {
        return $this->domain;
    }

    public function name(): ?string
    {
        return $this->name;
    }
}
