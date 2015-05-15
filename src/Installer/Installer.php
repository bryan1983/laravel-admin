<?php

namespace Joselfonseca\LaravelAdmin\Installer;

use Joselfonseca\LaravelAdmin\Services\Users\Role;
use Joselfonseca\LaravelAdmin\Services\Users\Permission;

class Installer
{

    public function install($email, $password){
    	/** Create Admin Role **/
    	$role = $this->createAdminRole();
    	$user = $this->createAdminUser($email, $password);
    	/** Assign Role to the user **/
    	$user->attachRole($role);
    	/** Create User's Management permissions **/
    	$userPerms = $this->createUserPermission();
    	/** Asign user management permission to the admin role **/
    	$role->attachPermissions($userPerms);
        $adminperms = $this->createAclPermissions();
        $role->attachPermissions($adminperms);
    }

    private function createAdminRole(){
    	$owner = new Role();
        $owner->name = 'system-administrator';
        $owner->display_name = 'System Administrator';
        $owner->description  = 'The General admin user';
        $owner->save();
        return $owner;
    }

    private function createAdminUser($email, $password){
        $model = \Config::get('auth.model');
        $user = new $model;
    	return $user->create([
    		'name' => 'Administrator',
    		'email' => $email,
    		'password' => bcrypt($password)
    	]);
    }

    private function createUserPermission(){
        /** Edit User **/
    	$editUser = new Permission();
        $editUser->name = 'edit-user';
        $editUser->display_name = 'Edit User';
        $editUser->description  = 'Edit existing users';
        $editUser->save();
        /** Create User **/
        $createUser = new Permission();
        $createUser->name = 'create-user';
        $createUser->display_name = 'Create Users';
        $createUser->description  = 'Create new Users';
        $createUser->save();
        /** Delete User **/
        $deleteUser = new Permission();
        $deleteUser->name = 'delete-user';
        $deleteUser->display_name = 'Delete Users';
        $deleteUser->description  = 'Delete Users';
        $deleteUser->save();
        /** list Users **/
        $listUser = new Permission();
        $listUser->name = 'list-users';
        $listUser->display_name = 'List Users';
        $listUser->description  = 'List Users and Manage them';
        $listUser->save();
		return [
            $editUser, $createUser, $deleteUser
        ];
    }

    private function createAclPermissions()
    {
        /** Permissions crud **/
        $permissionsCrud = new Permission();
        $permissionsCrud->name = 'permissions-crud';
        $permissionsCrud->display_name = 'Permissions Crud';
        $permissionsCrud->description  = 'Create, update and delete Permissions';
        $permissionsCrud->save();
        /** roles crud **/
        $rolesCrud = new Permission();
        $rolesCrud->name = 'roles-crud';
        $rolesCrud->display_name = 'Roles Crud';
        $rolesCrud->description  = 'Create, update and delete roles';
        $rolesCrud->save();
        return [
            $permissionsCrud, $rolesCrud
        ];
    }

}
