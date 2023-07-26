<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use StellarRouter\{Get,Post,Delete,Put,Patch,Router};

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

  public function testRouterResolvesCorrectRoute(): void
  {
    $route = $this->router->handleRequest('POST', '/photos');
    $this->assertSame('/photos', $route->getPath());
    $this->assertSame('BasicController', $route->getHandlerClass());
    $this->assertSame('create', $route->getHandlerMethod());
    $this->assertSame([], $route->getParameters());
  }

  public function testRouterResolvesRoutePathWithParameters(): void
  {
    $route = $this->router->handleRequest('GET', '/photos/42/edit');
    $this->assertSame('42', $route->getParameters()['photo']);
  }

  public function testDuplicateRequestMethodRequestPathThrowsException(): void
  {
    $this->expectException(Exception::class);
    $this->router->registerClass(DuplicateController::class);
  }
}
