<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use StellarRouter\Route;

final class RouteTest extends TestCase
{
  public function test_route_path_must_start_with_slash(): void
  {
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage("Path must start with a /");
    $route = new Route('invalid', 'GET');
  }

  public function test_route_new_path_must_be_valid(): void
  {
    $path = "/&^(*Q(*Y#Q(*Y$(*HQ(*QH$)))))";
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage("Path is not valid: " . $path);
    $route = new Route($path, 'GET');
  }

  public function test_route_set_path_must_be_valid(): void
  {
    $path = "/&^(*Q(*Y#Q(*Y$(*HQ(*QH$)))))";
    $route = new Route("/test", 'GET');
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage("Path is not valid: " . $path);
    $route->setPath($path);
  }
}
