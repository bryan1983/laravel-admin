<?php

namespace Joselfonseca\LaravelAdmin\Services\Acl;

use Joselfonseca\LaravelAdmin\Services\Users\Role;
use Joselfonseca\LaravelAdmin\Services\Users\User;

/**
 * Class AclManager
 * Some function to interact with the ACL
 * @package Joselfonseca\LaravelAdmin\Services\Acl
 */
class AclManager
{

    /**
     * Get the user model from config
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Can the user see based on permissions
     * @param $permissions
     * @param null $user
     * @return bool
     */
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

    /**
     * Get the roles for a select html input
     * @return array
     */
    public function getRolesForSelect()
    {
        $roles = new Role;
        $rolesSelect = [];
        foreach ($roles->all() as $role) {
            $rolesSelect[$role->id] = $role->display_name;
        }
        return $rolesSelect;
    }

    /**
     * get the permissions ids for a role
     * @param $roleId
     * @return array
     */
    public function getPermissionsIdsForRole($roleId)
    {
        $roles = Role::findOrFail($roleId);
        $perms = [];
        $roles->perms->each(function ($permission) use (&$perms) {
            $perms[] = $permission->id;
        });
        return $perms;
    }

    /**
     * Get the permissions ids for a user
     * @param $userId
     * @return array
     */
    public function getPermissionsIdsForUser($userId)
    {
        $user = $this->user->findOrFail($userId);
        $perms = [];
        $user->perms->each(function ($permission) use (&$perms) {
            $perms[] = $permission->id;
        });
        return $perms;
    }

    /**
     * Assing permissions to a Role
     * @param $roleId
     * @param $permissions
     * @return bool
     */
    public function assignPermissionsToRole($roleId, $permissions)
    {
        $roles = Role::findOrFail($roleId);
        $roles->perms()->attach($permissions);
        return true;
    }

    /**
     * Assign permissions to a User
     * @param $userId
     * @param $permissions
     * @return bool
     */
    public function assignPermissionsToUser($userId, $permissions)
    {
        $user = $this->user->findOrFail($userId);
        $user->perms()->attach($permissions);
        return true;
    }
}
