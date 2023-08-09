<?php

namespace StellarRouter;

use Attribute;

/**
 * Route attribute
 * @package StellarRouter
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Get extends Route
{
    public function __construct(
        string $path,
        ?string $name = null,
        array $middleware = []
    ) {
        parent::__construct($path, "GET", $name, $middleware);
    }
}
