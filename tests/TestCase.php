<?php

namespace MustafaRefaey\LaravelHybridSpa\Tests;

use Artesaos\SEOTools\Providers\SEOToolsServiceProvider;
use MustafaRefaey\LaravelHybridSpa\LaravelHybridSpaServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelHybridSpaServiceProvider::class,
            SEOToolsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
    }
}
