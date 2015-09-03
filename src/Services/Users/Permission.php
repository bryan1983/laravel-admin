<?php

namespace Joselfonseca\LaravelAdmin\Services\Users;

use Zizaco\Entrust\EntrustPermission as Model;

/**
 * Class Permission
 * @package Joselfonseca\LaravelAdmin\Services\Users
 */
class Permission extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['display_name', 'name', 'description'];

    /**
     * Get the fields for the table generator
     * @return array
     */
    public function getFields(){
        return [
        	'ID', trans('LaravelAdmin::laravel-admin.permissionName'), 'Slug', trans('LaravelAdmin::laravel-admin.permissiondescription')
        ];
    }

    /**
     * Get the rows for the Table Generator
     * @return array
     */
    public function getRows(){
    	$data = [];
    	$this->get()->each(function($rol) use (&$data){
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