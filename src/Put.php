<?php

namespace StellarRouter;

use Attribute;

/**
 * Route attribute
 * @package StellarRouter
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Put extends Route
{
    public function __construct(
        string $path,
        ?string $name = null,
        array $middleware = []
    ) {
        parent::__construct($path, "PUT", $name, $middleware);
    }
}
