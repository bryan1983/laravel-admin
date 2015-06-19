<?php

namespace Joselfonseca\LaravelAdmin\Services\Users;

use Zizaco\Entrust\EntrustPermission as Model;

class Permission extends Model
{

    protected $fillable = ['display_name', 'name', 'description'];

	public function getFields(){
        return [
        	'ID', trans('LaravelAdmin::laravel-admin.permissionName'), 'Slug', trans('LaravelAdmin::laravel-admin.permissiondescription')
        ];
    }
    
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