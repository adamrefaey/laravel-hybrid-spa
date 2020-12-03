# Laravel hybrid SPA response helpers.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mustafarefaey/laravel-hybrid-spa.svg?style=flat-square)](https://packagist.org/packages/mustafarefaey/laravel-hybrid-spa)
[![Tests](https://github.com/mustafarefaey/laravel-hybrid-spa/workflows/Tests/badge.svg?branch=master)](https://github.com/mustafarefaey/laravel-hybrid-spa/actions?query=branch%3Amaster+workflow%3ATests)
[![Total Downloads](https://img.shields.io/packagist/dt/mustafarefaey/laravel-hybrid-spa.svg?style=flat-square)](https://packagist.org/packages/mustafarefaey/laravel-hybrid-spa)

Laravel HTTP Response classes, to help you build a hybrid SPA!

## Contents table

-   [Installation](#installation)

-   [ApiResponse](#apiresponse)

    -   [Success response](#success-response)
        -   [Success response optional parameters](#success-response-optional-parameters)
        -   [Success response format](#success-response-format)
    -   [Fail response](#fail-response)
        -   [Fail response optional parameters](#fail-response-optional-parameters)
        -   [Fail response format](#fail-response-format)

-   [HybridResponse](#hybridresponse)
    -   [HTML response content](#html-response-content)

## Installation

You can install the package via composer:

```bash
composer require mustafarefaey/laravel-hybrid-spa
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="MustafaRefaey\LaravelHybridSpa\LaravelHybridSpaServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
    /**
     * This should be a full HTTP/HTTPS URL to your JS app.
     * Example: 'https://example.com/app.js'
     */
    'js-app-url' => '',

    /**
     * This should be the ID of the element that mounts the JS app.
     * Example: 'app'
     */
    'js-app-id' => '',

    /**
     * This must be a full qualified class path, that implements
     * `MustafaRefaey\LaravelHybridSpa\RetrievesSharedState` interface
     */
    'shared-state-handler' => '\\MustafaRefaey\\LaravelHybridSpa\\SharedState',

    /**
     * This is the name of the global JS variable, that will be injected with the shared state
     * Example: '__SHARED_STATE__', will be exposed as `window.__SHARED_STATE__`
     */
    'shared-state-variable' => '__SHARED_STATE__',

    /**
     * This is the name of the global JS variable, that will be injected with the page state
     * Example: '__PAGE_STATE__', will be exposed as `window.__PAGE_STATE__`
     */
    'page-state-variable' => '__PAGE_STATE__',

    /**
     * This is an array of arrays, to describe favicons
     * Must be in this format:
     *  [
     *      ['href' => '', 'sizes' => '', 'type' => ''],
     *      ['href' => '', 'sizes' => '', 'type' => ''],
     *  ]
     *
     */
    'favicons' => [],
];
```

`artesaos/seotools` package is used to set meta tags. Please check their [configuration documentation](https://github.com/artesaos/seotools#4-configuration).

## ApiResponse

Use this class in your controllers' actions to return a consistent JSON response.

```php
use MustafaRefaey\LaravelHybridSpa\ApiResponse;
```

### **Success response**

Use `success` method When returning a successful response.

```php
return ApiResponse::success();
```

#### **Success response optional parameters**

`data`: an array of any data, this will be json encoded.

`messages`: an array of any messages, this will be json encoded.

`HTTP status code`: by default this will be 200, unless you specify it.

```php
return ApiResponse::success(array $data = [], array $messages = [], int $code = 200);
```

#### **Success response format**

```json
{
    "status": true,
    "data": [],
    "success_messages": []
}
```

### **Fail response**

Use `fail` method When returning a failure response.

```php
return ApiResponse::fail();
```

#### **Fail response optional parameters**

`data`: an array of any data, this will be json encoded.

`messages`: an array of any messages, this will be json encoded.

`HTTP status code`: by default this will be 400, unless you specify it.

```php
return ApiResponse::fail(array $data = [], array $messages = [], int $code = 400);
```

#### **Fail response format**

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
use MustafaRefaey\LaravelHybridSpa\HybridResponse;
```

```php
return HybridResponse::make(array $pageState = []);
```

### HTML response content

-   Inside **head** tag:
    1. **Usually needed meta tags**:
        ```html
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        ```
    2. **Favicons**: you can set them in the config file.
    3. **SEO meta tags**: This package uses `artesaos/seotools` package to set meta tags. Please review their [documentation](https://github.com/artesaos/seotools#usage).
-   Inside **body** tag:
    1. **Div element that will mount the JS app**: you can set its ID in the config file.
    2. **Four global JS variables**:
        1. `window.__SHARED_STATE__`: This is where the shared state is injected.
            - You can rename this variable in the config file.
            - To control its value, You can create a class that extends the `MustafaRefaey\LaravelHybridSpa\RetrievesSharedState` interface,
              then update `shared-state-handler` in the config file, accordingly.
        2. `window.__PAGE_STATE__`: This is where the page state is injected.
            - You can rename this variable in the config file.
        3. `window.__SESSION_SUCCESS_MESSAGES__`: This is where the session success messages are injected.
        4. `window.__SESSION_ERROR_MESSAGES__`: This is where the session error messages are injected.
    3. **The JS app script**: you can set its URL in the config file.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Credits

This package uses the package [artesaos/seotools](https://github.com/artesaos/seotools) to set meta tags.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
