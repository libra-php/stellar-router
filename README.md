# StellarRouter
[![PHP Composer](https://github.com/libra-php/stellar-router/actions/workflows/php.yml/badge.svg?branch=main)](https://github.com/libra-php/stellar-router/actions/workflows/php.yml)

🌜 StellarRouter is a PHP library that provides a powerful attribute-based router for mapping HTTP requests to request handlers.

🌟 Why settle for an ordinary router when you can have a celestial navigator? StellarRouter will guide your PHP applications through the vast universe of routes with utmost precision and cosmic speed.

👷 *Currently under development*


### Features
- [x] Basic HTTP routing (GET, POST, PUT, PATCH, DELETE)
- [x] Bind route middleware
- [x] Easy to use
- [x] Grouped routes
- [x] Named routes
- [x] Route parameters
- [x] Route prefixes
- [ ] Optional route parameters
- [ ] Sub-domains
 
 
### Installation

`composer require libra-php/stellar-router`


### Usage

Here is a basic example of how this works 🚀

```php
use StellarRouter\{Router,Get,Post,Group};

#[Group(prefix: "/basic", middleware: ["auth"])]
class BasicController
{
    #[Get('/photos/{photo}/edit', 'photos.edit')]
    public function edit($photo) 
    {
        return "edit: $photo";
    }

    #[Post('/photos', 'photos.create')]
    public function create() 
    {
        return ["success" => true];
    }
}

// Register route controller class
$router = new Router;
// Route attributes will be derived from controller 
// class (group) or methods (http methods)
$router->registerClass(BasicController::class);
// You can also add a route manually using the registerRoute 
// method if you don't want to use attributes
// eg) $router->registerRoute(new Route("/test", "GET"));

// Handle the request by method / request URI
// Note: we support grouping of routes via attributes
// Both BasicController routes are: 
//   prefixed with '/basic'
//   have 'auth' middleware attached
$route = $router->handleRequest('GET', '/basic/photos/42/edit');

// Expose the class & target endpoint
$handlerClass = $route->getHandlerClass();
$handlerMethod = $route->getHandlerMethod();
$routeParameters = $route->getParameters();

// The class is BasicController
$controller = new $handlerClass();

// Call the endpoint edit with argument '42', the photo id
$response = $controller->$handlerMethod(...$routeParameters);

print($response); // Prints: 'edit: 42'
```

🇨🇦 Made in Canada
