# ![image](https://avatars.githubusercontent.com/u/99982570?s=28&v=4) StellarRouter - Attribute-Based Routing Library for PHP

[![Discord Community](https://discordapp.com/api/guilds/1139362100821626890/widget.png?style=shield)](https://discord.gg/RMhUmHmNak)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D7.4-8892BF.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![PHP Composer](https://github.com/libra-php/stellar-router/actions/workflows/php.yml/badge.svg?branch=main)](https://github.com/libra-php/stellar-router/actions/workflows/php.yml)

🌌 StellarRouter is an advanced PHP library designed to elevate your web application's routing capabilities through a sophisticated attribute-based router. By seamlessly mapping HTTP requests to designated request handlers, StellarRouter empowers developers to navigate the intricate realm of routes with unparalleled precision and efficiency. 🌟

## Key Features

- **Comprehensive HTTP Routing**: Supports standard HTTP methods such as GET, POST, PUT, PATCH, and DELETE, enabling versatile request handling.
- **Route Middleware Binding**: Effortlessly attach middleware to routes, enhancing modularity and facilitating robust request processing.
- **Intuitive and Developer-Friendly**: Boasts an intuitive and elegant API, ensuring ease of use for developers regardless of their experience level.
- **Route Grouping**: Organize related routes into logical groups, streamlining code management and enhancing codebase clarity.
- **Named Routes**: Assign meaningful names to routes, fostering a more semantic and maintainable routing structure.
- **Dynamic Route Parameters**: Easily extract dynamic route parameters, promoting dynamic content handling and data manipulation.
- **Route Prefixes**: Implement route prefixes to accommodate versioning or categorization, optimizing API design.
- <s>**Optional Route Parameters**: Define optional route parameters for enhanced flexibility in request handling.</s>
- <s>**Sub-Domain Routing**: Seamlessly handle sub-domain routing scenarios, catering to diverse application architectures.</s>

## Installation

Install StellarRouter effortlessly using Composer:

```bash
composer require libra-php/stellar-router
```

## Usage

Explore a basic example to grasp StellarRouter's prowess:

```php
use StellarRouter\{Router, Get, Post, Group};

#[Group(prefix: "/v1", middleware: ["auth"])]
class PhotoController
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

// Instantiate the router
$router = new Router;

// Automatically register route attributes from the controller class and methods
$router->registerClass(PhotoController::class);

// Alternatively, manually add routes using the registerRoute method
// Example: $router->registerRoute(new Route("/test", "GET"));

// Process the request based on the HTTP method and request URI
$route = $router->handleRequest('GET', '/v1/photos/42/edit');

// Extract route details
$handlerClass = $route->getHandlerClass();
$handlerMethod = $route->getHandlerMethod();
$routeParameters = $route->getParameters();

// Instantiate the appropriate controller class
$controller = new $handlerClass();

// Invoke the designated endpoint, passing necessary arguments
$response = $controller->$handlerMethod(...$routeParameters);

// Output the response
print($response); // Output: 'edit: 42'
```

## License

StellarRouter is open-source software licensed under the [MIT License](https://opensource.org/licenses/MIT).


🇨🇦Proudly made in Canada
