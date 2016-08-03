<?php

namespace Joselfonseca\LaravelAdmin\Traits;

use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * Class LaravelAdminUser
 * @package Joselfonseca\LaravelAdmin\Traits
 */
trait LaravelAdminUser
{

    use EntrustUserTrait;

    /**
     * @return array
     */
    public function getRolesForSelect()
    {
        $data = [];
        $this->roles->each(function ($role) use (&$data) {
            $data[] = $role->id;
        });
        return $data;
    }
}
