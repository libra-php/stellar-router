<?php

namespace StellarRouter;

use Attribute;
use Exception;

/**
 * Route attribute
 * @package StellarRouter
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Route
{
    private string $prefix = '';
    /**
     * @param string $path route path
     * @param string $method route method
     * @param ?string $name route name
     * @param array<int,mixed> $middleware route middleware
     * @param array<int,mixed> $parameters
     */
    public function __construct(
        private string $path,
        private string $method,
        private ?string $name = null,
        private array $middleware = [],
        private ?string $handlerClass = null,
        private ?string $handlerMethod = null,
        private mixed $payload = null,
        private array $parameters = [],
    ) {
        $path = $this->getPath();
        $method = $this->getMethod();
        self::validatePath($path);
        self::validateMethod($method);
    }

    /**
     * Validate a route path.
     * @param string $path route path
     */
    public static function validatePath(string $path): void
    {
        $pattern = '/^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([{}\/\w.-]*)*\/?$/';
        $url = "http://www.example.com".$path; // uri mocked with example.com for filter_var
        if (substr($path, 0, 1) !== "/") {
            throw new Exception("Path must start with a /");
        } else if (strpos($path, '(') === false && (!preg_match($pattern, $url) || !filter_var($url, FILTER_VALIDATE_URL))) {
            throw new Exception("Path is not valid: " . $path);
        }
    }

    /**
     * Validate a route method.
     * @param string $method route method
     */
    public static function validateMethod(string $method): void
    {
        $valid_methods = [
            // "CONNECT",
            // "HEAD",
            // "OPTIONS",
            // "TRACE",
            "GET",
            "POST",
            "PUT",
            "PATCH",
            "DELETE",
        ];
        if (!in_array($method, $valid_methods)) {
            throw new Exception("Method is not valid: " . $method);
        }
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
     * Get the route prefix
     * @return string route prefix
     */
    public function getPrefix(): string
    {
        return $this->prefix;
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
     * Set the route path
     */
    public function setPath(string $path): void
    {
        self::validatePath($path);
        $this->path = $path;
    }

    /**
     * Set the route prefix
     */
    public function setPrefix(string $prefix): void
    {
        self::validatePath($prefix);
        $this->prefix = $prefix;
    }
    /**
     * Set the route method
     */
    public function setMethod(string $method): void
    {
        self::validateMethod($method);
        $this->method = $method;
    }

    /**
     * Set the route name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Set the route middleware array
     * @param array<int,mixed> $middleware
     */
    public function setMiddleware(array $middleware): void
    {
        $this->middleware = $middleware;
    }

    /**
     * Set the route parameters
     * @param array<int,mixed> $parameters
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
