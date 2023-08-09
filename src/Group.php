<?php

namespace StellarRouter;

use Attribute;

/**
 * Route attribute
 * @package StellarRouter
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Group
{
    /**
     * @param array<int,mixed> $middleware
     */
    public function __construct(
    private string $prefix,
    private array $middleware = [],
  ) {
    Route::validatePath($prefix);
  } 

    /**
     * Get the route group prefix
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
}
