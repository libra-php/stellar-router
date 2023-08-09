<?php

namespace StellarRouter;

use Attribute;

/**
 * Route attribute
 * @package StellarRouter
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Delete extends Route
{
    public function __construct(
        string $path,
        ?string $name = null,
        array $middleware = []
    ) {
        parent::__construct($path, "DELETE", $name, $middleware);
    }
}
