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
    private array $parameters;
    private ?string $handlerMethod;
    private ?string $handlerClass;

    /**
     * @param string $path route path
     * @param string $method route method
     * @param ?string $name route name
     * @param array<int,mixed> $middleware route middleware
     * @param array<int,mixed> $parameters
     */
    public function __construct(string $path, string $method, ?string $name, array $middleware, array $parameters = [], ?string $handlerMethod = null, ?string $handlerClass = null)
    {
        $this->path = $path;
        $this->method = $method;
        $this->name = $name;
        $this->middleware = $middleware;
        $this->parameters = $parameters;
        $this->handlerMethod = $handlerMethod;
        $this->handlerClass = $handlerClass;
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

    /**
     * Get the route parameters
     * @return array route parameters
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Get the route handlerMethod
     * @return ?string route handlerMethod
     */
    public function getHandlerMethod(): ?string
    {
        return $this->handlerMethod;
    }

    /**
     * Get the route handlerClass
     * @return ?string route handlerClass
     */
    public function getHandlerClass(): ?string
    {
        return $this->handlerClass;
    }
}
