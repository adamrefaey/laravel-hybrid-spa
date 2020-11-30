# Laravel hybrid-architecture response helpers.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mustafarefaey/laravel-hybrid-architecture-response-helpers.svg?style=flat-square)](https://packagist.org/packages/mustafarefaey/laravel-hybrid-architecture-response-helpers)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/mustafarefaey/laravel-hybrid-architecture-response-helpers/run-tests?label=tests)](https://github.com/mustafarefaey/laravel-hybrid-architecture-response-helpers/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/mustafarefaey/laravel-hybrid-architecture-response-helpers.svg?style=flat-square)](https://packagist.org/packages/mustafarefaey/laravel-hybrid-architecture-response-helpers)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

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
];
```

## Usage

```php
$laravel-hybrid-architecture-response-helpers = new MustafaRefaey\LaravelHybrid();
echo $laravel-hybrid-architecture-response-helpers->echoPhrase('Hello, MustafaRefaey!');
```

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
