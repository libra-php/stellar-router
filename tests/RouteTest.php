<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use StellarRouter\Route;

final class RouteTest extends TestCase
{
  public function test_route_path_must_start_with_slash(): void
  {
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage("Route path must start with a /");
    $route = new Route('invalid', 'GET');
  }

  public function test_route_path_must_be_valid(): void
  {
    $path = "/&^(*Q(*Y#Q(*Y$(*HQ(*QH$)))))";
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage("Route path is not valid: " . $path);
    $route = new Route($path, 'GET');
  }
}
