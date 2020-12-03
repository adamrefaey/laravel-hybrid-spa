<?php

return [
    'js-app-url' => '',
    'js-app-id' => '',

    /**
     * This must be a full qualified class path, that implements
     * `MustafaRefaey\LaravelHybrid\RetrievesSharedState` interface
     */
    'shared-state-handler' => '\\MustafaRefaey\\LaravelHybrid\\SharedState',

    'shared-state-variable' => '__SHARED_STATE__',
    'page-state-variable' => '__PAGE_STATE__',

    'favicons' => [
        // this is an array of arrays, to describe favicons
        // must be in this format
        // ['href' => '', 'sizes' => '', 'type' => '']
    ],
];
