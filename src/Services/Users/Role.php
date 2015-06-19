<?php

namespace Joselfonseca\LaravelAdmin\Services\Users;

use Zizaco\Entrust\EntrustRole as Model;

class Role extends Model
{
    protected $fillable = ['display_name', 'name', 'description'];

    public function getFields()
    {
        return [
            'ID', trans('LaravelAdmin::laravel-admin.roleName'), 'Slug', trans('LaravelAdmin::laravel-admin.roleDescription')
        ];
    }

    public function getRows()
    {
        $data = [];
        $this->get()->each(function($rol) use (&$data) {
            $data[] = [
                'id' => $rol->id,
                'name' => $rol->display_name,
                'slug' => $rol->name,
                'description' => $rol->description
            ];
        });
        return $data;
    }
}