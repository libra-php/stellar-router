<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use StellarRouter\{Get,Post,Delete,Put,Patch,Router};

final class RouterTest extends TestCase
{
  private $router;

  protected function setUp(): void
  {
    $this->router = new Router;
    $this->router->registerClass(BasicController::class);
  }

  protected function tearDown(): void
  {
    $this->router = null;
  }

  public function test_router_resolves_correct_route(): void
  {
    $route = $this->router->handleRequest('POST', '/photos');
    $this->assertSame('/photos', $route->getPath());
    $this->assertSame('BasicController', $route->getHandlerClass());
    $this->assertSame('create', $route->getHandlerMethod());
    $this->assertSame([], $route->getParameters());
  }

  public function test_route_with_parameters(): void
  {
    $route = $this->router->handleRequest('GET', '/photos/42/edit');
    $this->assertSame('42', $route->getParameters()['photo']);
  }

  public function test_duplicate_path_and_method_throws_exception(): void
  {
    $this->expectException(Exception::class);
    $this->router->registerClass(DuplicateController::class);
  }
}

final class BasicController
{
    #[Get('/photos/{photo}/edit', 'photos.edit')]
    public function edit($photo): void 
    {
        print("edit: $photo");
    }

    #[Post('/photos', 'photos.create')]
    public function create(): void 
    {
        print("create");
    }
}

final class DuplicateController 
{
  #[Get('/photos/{photo}/edit', 'photos.edit')]
  public function edit($photo): void 
  {
    print("edit: $photo");
  }
}

