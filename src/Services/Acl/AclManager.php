<?php

namespace Joselfonseca\LaravelAdmin\Services\Acl;

use Joselfonseca\LaravelAdmin\Services\Users\Role;

class AclManager
{
    private $model;

    public function __construct()
    {
        $model      = \Config::get('auth.model');
        $this->user = new $model;
    }

    public function canSee($permissions, $user = null)
    {
        if (is_null($user)) {
            $user = \Auth::user();
        }
        if (!empty($permissions)) {
            return $user->can($permissions);
        }
        return false;
    }

    public function getRolesForSelect()
    {
        $roles       = new Role;
        $rolesSelect = [];
        foreach ($roles->all() as $role) {
            $rolesSelect[$role->id] = $role->display_name;
        }
        return $rolesSelect;
    }

    public function getPermissionsIdsForRole($roleId)
    {
        $roles = Role::findOrFail($roleId);
        $perms = [];
        $roles->perms->each(function($permission) use(&$perms) {
            $perms[] = $permission->id;
        });
        return $perms;
    }

    public function getPermissionsIdsForUser($userId)
    {
        $user  = $this->user->findOrFail($userId);
        $perms = [];
        $user->perms->each(function($permission) use(&$perms) {
            $perms[] = $permission->id;
        });
        return $perms;
    }

    public function assignPermitionsToRole($roleId, $permissions)
    {
        $roles = Role::findOrFail($roleId);
        $roles->perms()->attach($permissions);
        return true;
    }

    public function assignPermitionsToUser($userId, $permissions)
    {
        $user = $this->user->findOrFail($userId);
        $user->perms()->attach($permissions);
        return true;
    }
}