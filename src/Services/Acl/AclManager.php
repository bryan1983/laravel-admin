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

}
