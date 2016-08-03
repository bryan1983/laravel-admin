<?php

namespace Joselfonseca\LaravelAdmin\Console;

use Illuminate\Console\Command;
use Joselfonseca\LaravelAdmin\Providers\LaravelAdminServiceProvider;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Joselfonseca\LaravelAdmin\Installer\Installer as AdminInstaller;

class Installer extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'laravelAdmin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs the laravel-admin package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        \DB::beginTransaction();
        try {
            $this->info('Welcome to the Laravel-Admin Installer');
            $this->info('Creating basic user and Roles');
            $installer = new AdminInstaller;
            $installer->install('admin@admin.com', 'secret');
            \DB::commit();
            $this->info('Thanks! we are done!');
        } catch (\Exception $e) {
            \DB::rollback();
            $this->error('Something went wrong!. '.$e->getMessage());
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
        ];
    }
}
