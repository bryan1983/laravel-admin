<?php

namespace Joselfonseca\LaravelAdmin\Traits;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

trait LaravelAdminUser
{

    use EntrustUserTrait,
        SoftDeletes;

    public function getFields()
    {
        return [
            'ID', trans('LaravelAdmin::laravel-admin.userName'), trans('LaravelAdmin::laravel-admin.userEmail')
        ];
    }

    public function getRows()
    {
        $data = [];
        $this->get()->each(function($row) use(&$data) {
            $data[] = [
                'id' => $row->id,
                'name' => $row->name,
                'email' => $row->email,
            ];
        });
        return $data;
    }

    public function getRolesForSelect()
    {
        $data = [];
        $this->roles->each(function($role) use (&$data) {
            $data[] = $role->id;
        });
        return $data;
    }
}