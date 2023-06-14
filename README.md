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
    public function edit($photo) {
        print("edit: $photo");
    }
    #[Post('/photos', 'photos.create')]
    public function create() {
        print("create");
    }
}
```
