<?php

namespace Joselfonseca\LaravelAdmin\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{

    protected function getPackageProviders($app)
    {
        return ['Joselfonseca\LaravelAdmin\Providers\LaravelAdminServiceProvider'];
    }

    public function test_to_init()
    {
        $this->assertTrue(true);
    }

}