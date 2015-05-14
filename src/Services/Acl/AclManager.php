<?php

namespace Joselfonseca\LaravelAdmin\Services\Acl;

class AclManager {

    public function canSee($permission)
    {
        $user = \Auth::user();
        if(!empty($permission)){
            return $user->can($permission);
        }
        return false;
    }

    public function getRolesForSelect()
    {
    	$modelRoles = config('acl.role', 'Kodeine\Acl\Models\Eloquent\Role');
        $roles = new $modelRoles;
        $rolesSelect = [];
        foreach($roles->all() as $role)
        {
            $rolesSelect[$role->id] = $role->name;
        }
        return $rolesSelect;
    }

}
