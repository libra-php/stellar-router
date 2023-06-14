<?php

namespace StellarRouter;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Post extends Route
{
    public function __construct(string $path, ?string $name = null, array $middleware = [])
    {
        parent::__construct($path, 'POST', $name, $middleware);
    }
}
