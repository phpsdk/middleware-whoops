# Whoops middleware
  
This package contains a middleware that catches all exceptions
and redirects those to the [Whoops error handling library](http://filp.github.io/whoops/).


## Install

Via [Composer](https://getcomposer.org)

```bash
composer require phpsdk/middleware-whoops
```

## Usage

Just use the `ClientMiddleware` or `ServerMiddleware` class in your middleware stack:

~~~php
use PhpSDK\Http\Middleware\Whoops\ServerMiddleWare as WhoopsServerMiddleWare;
use Whoops;

$whoops = new Whoops\Run();
$whoops->pushHandler(new PrettyPageHandler());

$middleware = new WhoopsServerMiddleWare($whoops, new Response('Default error', 500));

$stack = $stack->withMiddleware($middleware);
~~~

If an exception is thrown, or an error is raised, Whoops will display a nice error message:

![Whoops!](http://i.imgur.com/0VQpe96.png)

## Testing

```bash
# install required files
composer self-update
composer install

# run the test (from project root)
phpunit
```

## Credits

- [Veaceslav Medvedev](https://github.com/slavcodev)
- [All Contributors](../../contributors)

## License

The BSD 2-Clause License. Please see [LICENSE][link-license] for more information.
