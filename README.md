# StellarRouter
[![PHP Composer](https://github.com/libra-php/stellar-router/actions/workflows/php.yml/badge.svg?branch=main)](https://github.com/libra-php/stellar-router/actions/workflows/php.yml)

🌜 StellarRouter is a PHP library that provides a powerful attribute-based router for mapping HTTP requests to request handlers.

🌟 Why settle for an ordinary router when you can have a celestial navigator? StellarRouter will guide your PHP applications through the vast universe of routes with utmost precision and cosmic speed.

🚀 Join the StellarRouter Revolution today and witness your PHP applications reach for the stars! Let's navigate the routing galaxy together! 

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

Here is a basic example of how this works:
```php
use StellarRouter\{Router,Get,Post};

#[Group(prefix: "/basic", ["auth"])]
class BasicController
{
    #[Get('/photos/{photo}/edit', 'photos.edit')]
    public function edit($photo) 
    {
        print("edit: $photo");
    }

    #[Post('/photos', 'photos.create')]
    public function create() 
    {
        print("create");
    }
}

// Register route controller class or classes
$router = new Router;
$router->registerClass(BasicController::class);

// Handle the request by method / request URI
// Note: we support grouping of routes
// Both BasicController routes are prefixed with '/basic'
// Both BasicController routes have 'auth' middleware attached
$route = $router->handleRequest('GET', '/basic/photos/42/edit');

// Expose the class & target endpoint
$handlerClass = $route->getHandlerClass();
$handlerMethod = $route->getHandlerMethod();
$routeParameters = $route->getParameters();

// Call the endpoint with arguments
$handlerResponse = $handlerClass->$handlerMethod(...$routeParameters);

print($handlerResponse); // Prints: 'edit: 42'
```

🇨🇦 Made in Canada
