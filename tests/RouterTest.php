<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use StellarRouter\{Get,Post,Router};
use StellarRouter\Group;

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

  public function test_router_group_prefix(): void
  {
    // Since this has a group prefix, the route should be /basic/photos
    $route = $this->router->handleRequest('GET', '/basic/photos');
    $this->assertSame('/basic/photos', $route->getPath());
  }

  public function test_router_group_middleware(): void
  {
    $route = $this->router->handleRequest('GET', '/basic/photos');
    $this->assertSame(['new', 'test'], $route->getMiddleware());
  }

  public function test_router_resolves_correct_route(): void
  {
    $route = $this->router->handleRequest('POST', '/basic/photos');
    $this->assertSame('/basic/photos', $route->getPath());
    $this->assertSame('BasicController', $route->getHandlerClass());
    $this->assertSame('create', $route->getHandlerMethod());
    $this->assertSame([], $route->getParameters());
  }

  public function test_route_with_parameters(): void
  {
    $route = $this->router->handleRequest('GET', '/basic/photos/42/edit');
    $this->assertSame('42', $route->getParameters()['photo']);
  }

  public function test_duplicate_path_and_method_throws_exception(): void
  {
    $this->expectException(Exception::class);
    $this->router->registerClass(DuplicateController::class);
  }
}

#[Group(prefix: "/basic", middleware: ['new'])]
final class BasicController
{
    #[Get('/photos', 'photos.index', ['test'])]
    public function index(): void
    {

    }

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
  #[Get('/basic/photos/{photo}/edit', 'photos.edit')]
  public function edit($photo): void 
  {
    print("edit: $photo");
  }
}

