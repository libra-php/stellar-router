<?php

namespace StellarRouter;

use Exception;
use ReflectionClass;
use ReflectionMethod;

class Router
{
    /** @var array<int,Route> $routes */
    private array $routes = [];

    /**
     * Return true if there are routes registered
     * @return bool
     */
    public function hasRoutes(): bool
    {
        return !empty($this->routes);
    }

    /**
     * Return array of routes
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * Return route by name
     * @param string $name route name
     * @return ?Route
     */
    public function findRouteByName(string $name): ?Route
    {
        foreach ($this->routes as $route) {
            if ($route->getName() === $name) {
                return $route;
            }
        }
        return null;
    }

    /**
     * Register routes for your application.
     * @param string $handlerClass controller class with route attributes
     * @throws Exception
     */
    public function registerClass(string $handlerClass): void
    {
        $reflectionClass = new ReflectionClass($handlerClass);

        $classAttributes = $reflectionClass->getAttributes();

        // Filter the attributes to get the one with the Group attribute
        $groupParams = null;
        foreach ($classAttributes as $attribute) {
            if ($attribute->getName() === 'StellarRouter\Group') {
                $groupParams = $attribute->getArguments();
                break;
            }
        }

        // Only allow public methods
        $reflectionMethods = $reflectionClass->getMethods(
            ReflectionMethod::IS_PUBLIC
        );

        foreach ($reflectionMethods as $reflectionMethod) {
            $methodAttributes = $reflectionMethod->getAttributes();

            foreach ($methodAttributes as $attribute) {
                $attribute_route = $attribute->newInstance();

                $duplicate = array_filter(
                    $this->routes,
                    fn ($route) => $route->getPath() === $attribute_route->getPath() &&
                        $route->getMethod() === $attribute_route->getMethod()
                );
                if (!empty($duplicate)) {
                    throw new Exception(
                        "Duplicate route defined! path: '{$attribute_route->getPath()}' method: '{$attribute_route->getMethod()}'"
                    );
                }

                $attribute_route->setHandlerClass($handlerClass);
                $attribute_route->setHandlerMethod($reflectionMethod->getName());

                // This route is grouped
                if (!is_null($groupParams)) {
                    // Set grouped prefix
                    $attribute_route->setPath($groupParams['prefix'] . $attribute_route->getPath());
                    $merged_middleware = array_merge($groupParams['middleware'] ?? [], $attribute_route->getMiddleware() ?? []);
                    $attribute_route->setMiddleware($merged_middleware);
                }

                // Build array of routes
                $this->registerRoute($attribute_route);
            }
        }
    }

    /**
     * Register a single route for your application
     * @param array<int,mixed> $middleware
     */
    public function registerRoute(Route $route): void
    {
        $this->routes[] = $route;
    }

    /**
     * Handle the HTTP request and return class and endpoint for matched route
     * @param string $requestMethod request specified resource
     * @param string $requestUri request uniform resource identifier
     * @return ?array matched route
     */
    public function handleRequest(
        string $requestMethod,
        string $requestUri
    ): ?Route {
        foreach ($this->routes as $route) {
            if (
                $this->matchRoute($route->getPath(), $requestUri) &&
                $route->getMethod() === $requestMethod
            ) {
                $route->setParameters($this->extractParameters(
                    $route->getPath(),
                    $requestUri
                ));
                return $route;
            }
        }
        return null;
    }

    /**
     * Extract route parameters from the request URI.
     * @param string $routePath route path attribute
     * @param string $requestUri request URI
     * @return array parameters for endpoint
     */
    private function extractParameters(
        string $routePath,
        string $requestUri
    ): array {
        $routePathSegments = explode("/", trim($routePath, "/"));
        $requestUriSegments = explode("/", trim($requestUri, "/"));
        $parameters = [];

        $numSegments = count($routePathSegments);
        for ($i = 0; $i < $numSegments; $i++) {
            if (preg_match('/^{(.*)}$/', $routePathSegments[$i], $matches)) {
                $parameterName = $matches[1];
                $parameterValue = $requestUriSegments[$i];
                $parameters[$parameterName] = $parameterValue;
            }
        }

        return $parameters;
    }

    /**
     * Match route path attribute with request URI
     * @param string $routePath route path attribute
     * @param string $requestUri request URI
     * @return bool successful route path & request URI match
     */
    private function matchRoute(string $routePath, string $requestUri): bool
    {
        $requestUri = strtok($requestUri, '?');
        $routePath = trim($routePath, "/");
        $requestUri = trim($requestUri, "/");

        $routeSegments = explode("/", $routePath);
        $requestSegments = explode("/", $requestUri);

        if (count($routeSegments) !== count($requestSegments)) {
            return false;
        }

        $numSegments = count($routeSegments);
        for ($i = 0; $i < $numSegments; $i++) {
            if (
                $routeSegments[$i] !== $requestSegments[$i] &&
                !preg_match('/^{.*}$/', $routeSegments[$i])
            ) {
                return false;
            }
        }

        return true;
    }
}
