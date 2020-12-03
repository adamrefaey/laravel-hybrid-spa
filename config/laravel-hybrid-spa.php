<?php

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
    'js-app-id' => 'app',

    /**
     * This must be a full qualified class path, that implements
     * `MustafaRefaey\LaravelHybridSpa\RetrievesSharedState` interface
     */
    'shared-state-handler' => '\\MustafaRefaey\\LaravelHybridSpa\\SharedStateHandler',

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
