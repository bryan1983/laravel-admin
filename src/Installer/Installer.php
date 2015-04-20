<?php

namespace Joselfonseca\LaravelAdmin\Installer;

use Kodeine\Acl\Models\Eloquent\Role;
use Kodeine\Acl\Models\Eloquent\Permission;
use Joselfonseca\LaravelAdmin\Models\User;

class Installer
{

    public function install($email, $password){
    	/** Create Admin Role **/
    	$role = $this->createAdminRole();
    	$user = $this->createAdminUser($email, $password);
    	/** Assign Role to the user **/
    	$user->assignRole($role);
    	/** Create User's Management permissions **/
    	$permission = $this->createUserPermission();
    	/** Asign user management permission to the admin role **/
    	$role->assignPermission($permission);
    }

    private function createAdminRole(){
    	$role = new Role();
		$roleAdmin = $role->create([
		    'name' => 'Administrator',
		    'slug' => 'administrator',
		    'description' => 'manage administration privileges'
		]);
		return $roleAdmin;
    }

    private function createAdminUser($email, $password){
    	return User::create([
    		'name' => 'Administrator',
    		'email' => $email,
    		'password' => bcrypt($password)
    	]);
    }

    private function createUserPermission(){
    	$permission = new Permission();
		$permUser = $permission->create([ 
		    'name'        => 'user',
		    'slug'        => [          // pass an array of permissions.
		        'create'     => true,
		        'view'       => true,
		        'update'     => true,
		        'delete'     => true,
		        'view.phone' => true
		    ],
		    'description' => 'Manage user permissions'
		]);
		return $permUser;
    }

}
