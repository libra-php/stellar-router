<?php

namespace StellarRouter;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Route
{
    private string $path;
    private string $method;
    private ?string $name;
    private array $middleware;

    /**
     * @param string $path route path
     * @param string $method route method
     * @param ?string $name route name
     * @param array<int,mixed> $middleware route middleware
     */
    public function __construct(string $path, string $method, ?string $name, array $middleware)
    {
        $this->path = $path;
        $this->method = $method;
        $this->name = $name;
        $this->middleware = $middleware;
    }

    /**
     * Get the route name
     * @return ?string route name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get the route path
     * @return string route path
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Get the route method
     * @return string route method
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Get the route middleware
     * @return array route middleware
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }
}
