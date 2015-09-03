<?php

namespace Joselfonseca\LaravelAdmin\Services\Users;

use Zizaco\Entrust\EntrustRole as Model;

/**
 * Class Role
 * @package Joselfonseca\LaravelAdmin\Services\Users
 */
class Role extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['display_name', 'name', 'description'];

    /**
     * @return array
     */
    public function getFields()
    {
        return [
            'ID', trans('LaravelAdmin::laravel-admin.roleName'), 'Slug', trans('LaravelAdmin::laravel-admin.roleDescription')
        ];
    }

    /**
     * @return array
     */
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