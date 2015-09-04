<?php

namespace Joselfonseca\LaravelAdmin\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

/**
 * Class TestCase
 * @package Joselfonseca\LaravelAdmin\Tests
 */
class TestCase extends Orchestra
{

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['Joselfonseca\LaravelAdmin\Providers\LaravelAdminServiceProvider'];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Migrate a SQL lite Database to test the package
     */
    protected function migrateDatabase()
    {
        $this->artisan('migrate', [
            '--database' => 'testbench',
            '--realpath' => realpath(__DIR__.'/migrations'),
        ]);
    }

    /**
     * We will use this method in all tests
     */
    protected function install()
    {
        $installer = new \Joselfonseca\LaravelAdmin\Installer\Installer();
        $installer->install('admin@admin.com', 'secret');
    }

    /**
     * Bootstrap the installation for the running test
     */
    protected function bootstrapInstallation()
    {
        $this->migrateDatabase();
        $this->install();
    }

    /**
     * Just a true test
     */
    public function test_to_init()
    {
        $this->assertTrue(true);
    }

}