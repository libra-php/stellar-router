<?php

namespace StellarRouter;

use Attribute;

/**
 * Route attribute
 * @package StellarRouter
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Patch extends Route
{
    public function __construct(
        string $path,
        ?string $name,
        array $middleware = []
    ) {
        parent::__construct($path, "PATCH", $name, $middleware);
    }
}
