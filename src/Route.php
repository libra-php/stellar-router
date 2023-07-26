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
    private ?string $handlerMethod;
    private ?string $handlerClass;
    private mixed $payload;
    private array $parameters;

    /**
     * @param string $path route path
     * @param string $method route method
     * @param ?string $name route name
     * @param array<int,mixed> $middleware route middleware
     * @param array<int,mixed> $parameters
     */
    public function __construct(
        string $path,
        string $method,
        ?string $name = null,
        array $middleware = [],
        ?string $handlerClass = null,
        ?string $handlerMethod = null,
        mixed $payload = null,
        array $parameters = [],
    ) {
        $this->path = $path;
        $this->method = $method;
        $this->name = $name;
        $this->middleware = $middleware;
        $this->handlerClass = $handlerClass;
        $this->handlerMethod = $handlerMethod;
        $this->payload = $payload;
        $this->parameters = $parameters;
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

    /**
     * Get the route payload
     */
    public function getPayload(): mixed
    {
        return $this->payload;
    }

    /**
     * Set the route parameters
     */
    public function setParameters(array $parameters): void
    {
        $this->parameters = $parameters;
    }

    /**
     * Set the route parameters
     */
    public function setHandlerClass(string $class_name): void
    {
        $this->handlerClass = $class_name;
    }

    /**
     * Set the route parameters
     */
    public function setHandlerMethod(string $method_name): void
    {
        $this->handlerMethod = $method_name;
    }
}
