# StellarRouter
[![PHP Composer](https://github.com/libra-php/stellar-router/actions/workflows/php.yml/badge.svg?branch=main)](https://github.com/libra-php/stellar-router/actions/workflows/php.yml)

🌜 StellarRouter is a PHP library that provides a powerful attribute-based router for mapping HTTP requests to request handlers.

🌟 Why settle for an ordinary router when you can have a celestial navigator? StellarRouter will guide your PHP applications through the vast universe of routes with utmost precision and cosmic speed.

🚀 Join the StellarRouter Revolution today and witness your PHP applications reach for the stars! Let's navigate the routing galaxy together! 

👷 *Currently under development*


### Features
- [x] Easy to use
- [x] Basic HTTP routing (GET, POST, PUT, PATCH, DELETE)
- [x] Named routes
- [x] Bind route middleware
- [x] Route parameters
- [ ] Optional route parameters
- [ ] Grouped routes
- [ ] Route prefixes
- [ ] Sub-domains
- [ ] Geoblocking routes
 
 
### Installation

WIP


### Usage

WIP

```php
use StellarRouter\{Router,Get,Post};

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
$router->registerRoutes(BasicController::class);

// Handle the request by method / request URI
$test = $router->handleRequest('GET', '/photos/42/edit');

// Expose the class & target endpoint
$class = new $test['class'];
$endpoint = $test['endpoint'];

// Call the endpoint with arguments
$class->$endpoint(...array_values($test['parameters']));

// Prints:
// edit: 42
```

🇨🇦 Made in Canada
