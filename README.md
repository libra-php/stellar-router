# StellarRouter

StellarRouter is a PHP package that provides a powerful attribute-based router for mapping HTTP requests to request handlers 🚀


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
