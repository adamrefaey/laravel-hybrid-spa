<?php

namespace MustafaRefaey\LaravelHybrid\Tests;

use Artesaos\SEOTools\Providers\SEOToolsServiceProvider;
use MustafaRefaey\LaravelHybrid\LaravelHybridServiceProvider;
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
            LaravelHybridServiceProvider::class,
            SEOToolsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
    }
}
