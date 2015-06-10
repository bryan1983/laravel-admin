<?php 

namespace Joselfonseca\LaravelAdmin\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Joselfonseca\LaravelAdmin\Installer\Installer as AdminInstaller;

class Installer extends Command{

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
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
    	\DB::beginTransaction();
    	try{
    		$this->info('Welcome to the Laravel-Admin Installer');
	        $email = $this->ask('Please enter the email for the administrator');
	        $password = $this->secret('Please enter the password for the administrator');
	        $this->info('Please give us a minute while we install everything');
	        $this->info('Working on ACL');
	        $this->call('entrust:migration');
	        $this->info('Migrating Database');
	        $this->call('migrate');
	        $this->info('Creating basic user and Roles');
	        $installer = new AdminInstaller;
	        $installer->install($email, $password);
            $this->info('Publishing Package stuff');
            $this->call('vendor:publish', ['--provider' => 'Joselfonseca\LaravelAdmin\LaravelAdminServiceProvider', '--tag' => 'LApublic']);
            $this->call('vendor:publish', ['--provider' => 'Joselfonseca\LaravelAdmin\LaravelAdminServiceProvider', '--tag' => 'LAconfig']);
            $this->call('vendor:publish', ['--provider' => 'Joselfonseca\LaravelAdmin\LaravelAdminServiceProvider', '--tag' => 'LALang']);
	        \DB::commit();
	        $this->info('Thanks! we are done!');
    	}catch(\Exception $e){
    		\DB::rollback();
    		$this->error('Something went wrong!. '.$e->getMessage());
    	}
        
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return [
            
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return [
            
        ];
    }

}