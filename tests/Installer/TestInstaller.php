<?php

namespace Joselfonseca\LaravelAdmin\Tests\Installer;

use Joselfonseca\LaravelAdmin\Entities\User;
use Joselfonseca\LaravelAdmin\Entities\Role;
use Joselfonseca\LaravelAdmin\Tests\TestCase;
use Joselfonseca\LaravelAdmin\Entities\Permission;

/**
 * Class TestInstaller
 * @package Joselfonseca\LaravelAdmin\Tests\Installer
 */
class TestInstaller extends TestCase{

    /**
     * can it be installed?
     */
    public function test_it_install_the_package()
    {
        $this->bootstrapInstallation();
        $user = User::first();
        $this->assertEquals('admin@admin.com', $user->email);
    }

    /**
     * creates the admin role
     */
    public function test_it_creates_the_admin_role()
    {
        $this->bootstrapInstallation();
        $role = Role::where('name', 'system-administrator')->first();
        $this->assertEquals('system-administrator', $role->name);
    }

    /**
     * it attached the role to the user
     */
    public function test_it_attach_the_admin_role_to_user()
    {
        $this->bootstrapInstallation();
        $user = User::first();
        $this->assertTrue($user->hasRole('system-administrator'));
    }

    /**
     * it creates the basic permissions
     */
    public function test_it_creates_users_permissions()
    {
        $this->bootstrapInstallation();
        $permission = Permission::where('name', 'edit-user')->first();
        $this->assertEquals('edit-user', $permission->name);
        $permission = Permission::where('name', 'create-user')->first();
        $this->assertEquals('create-user', $permission->name);
        $permission = Permission::where('name', 'delete-user')->first();
        $this->assertEquals('delete-user', $permission->name);
        $permission = Permission::where('name', 'list-users')->first();
        $this->assertEquals('list-users', $permission->name);
        $permission = Permission::where('name', 'see-profile')->first();
        $this->assertEquals('see-profile', $permission->name);
    }

    /**
     * it creates the acl permissions
     */
    public function test_it_creates_acl_permissions()
    {
        $this->bootstrapInstallation();
        $permission = Permission::where('name', 'roles-crud')->first();
        $this->assertEquals('roles-crud', $permission->name);
    }

    /**
     * check a user permission
     */
    public function test_it_checks_user_permissions()
    {
        $this->bootstrapInstallation();
        $user = User::first();
        $this->assertTrue($user->can('roles-crud'));
    }

}