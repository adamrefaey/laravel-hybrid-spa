# Laravel hybrid-architecture response helpers.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mustafarefaey/laravel-hybrid-architecture-response-helpers.svg?style=flat-square)](https://packagist.org/packages/mustafarefaey/laravel-hybrid-architecture-response-helpers)
[![Tests](https://github.com/mustafarefaey/laravel-hybrid-architecture-response-helpers/workflows/Tests/badge.svg?branch=master)](https://github.com/mustafarefaey/laravel-hybrid-architecture-response-helpers/actions?query=branch%3Amaster+workflow%3ATests)
[![Total Downloads](https://img.shields.io/packagist/dt/mustafarefaey/laravel-hybrid-architecture-response-helpers.svg?style=flat-square)](https://packagist.org/packages/mustafarefaey/laravel-hybrid-architecture-response-helpers)

Laravel HTTP Response classes, to help you build a Hybrid SPA!

## Installation

You can install the package via composer:

```bash
composer require mustafarefaey/laravel-hybrid-architecture-response-helpers
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="MustafaRefaey\LaravelHybrid\LaravelHybridServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
    'js-app-url' => '',
    'js-app-id' => '',
    'shared-state-variable' => '__SHARED_STATE__',
    'page-state-variable' => '__PAGE_STATE__',
    'favicons' => [
        // this is an array of arrays, to describe favicons
        // must be in this format
        // ['href' => '', 'sizes' => '', 'type' => '']
    ],
];
```

## ApiResponse

Use this class in your controllers' actions to return a consistent JSON response.

```php
use MustafaRefaey\LaravelHybrid\ApiResponse;
```

### Success response

Use `success` method When returning a successful response.

```php
return ApiResponse::success();
```

### _You can -optionally- pass it:_

`data`: an array of any data, this will be json encoded.

`messages`: an array of any messages, this will be json encoded.

`HTTP status code`: by default this will be 200, unless you specify it.

```php
return ApiResponse::success(array $data = [], array $messages = [], int $code = 200);
```

### _The response format:_

```json
{
    "status": true,
    "data": [],
    "success_messages": []
}
```

### Fail response

Use `fail` method When returning a failure response.

```php
return ApiResponse::fail();
```

### _You can -optionally- pass it:_

`data`: an array of any data, this will be json encoded.

`messages`: an array of any messages, this will be json encoded.

`HTTP status code`: by default this will be 400, unless you specify it.

```php
return ApiResponse::fail(array $data = [], array $messages = [], int $code = 400);
```

### _The response format:_

```json
{
    "status": false,
    "data": [],
    "error_messages": []
}
```

## HybridResponse

Use this class in your controllers' actions to return an html page that loads the js app, passing it the initial page state.

If the request expects JSON response, it will return the page's state in an `ApiResponse`.

```php
use MustafaRefaey\LaravelHybrid\HybridResponse;
```

```php
return HybridResponse::make(array $page_state = []);
```

This package uses [artesaos/seotools](https://github.com/artesaos/seotools) to set meta tags in html response. Please review their [documentation](https://github.com/artesaos/seotools) to set meta tags.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
