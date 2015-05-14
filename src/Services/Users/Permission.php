<?php

namespace Joselfonseca\LaravelAdmin\Services\Users;

use Kodeine\Acl\Models\Eloquent\Permission as Model;

class Permission extends Model
{

	public function getFields(){
        return [
        	'ID', 'Name', 'Slug', 'Description'
        ];
    }
    
    public function getRows(){
    	$data = [];
    	$this->get()->each(function($rol) use (&$data){
    		$data[] = [
    			'id' => $rol->id,
    			'name' => $rol->name,
    			'slug' => $rol->slug,
    			'description' => $rol->description
    		];
    	});
        return $data;
    }

}