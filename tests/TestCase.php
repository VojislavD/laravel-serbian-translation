<?php

namespace VojislavD\LaravelSerbianTranslation\Tests;

use VojislavD\LaravelSerbianTranslation\LaravelSerbianTranslationServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp() :void
    {
        parent::setUp();
    }

    public function getEnvironmentSetUp($app)
    {
        
    }

    public function getPackageProviders($app)
    {
        return [
            LaravelSerbianTranslationServiceProvider::class
        ];
    }
}