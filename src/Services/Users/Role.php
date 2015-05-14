<?php

namespace Joselfonseca\LaravelAdmin\Services\Users;

use Kodeine\Acl\Models\Eloquent\Role as Model;

class Role extends Model
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

    public function getPermissionsForAssign()
    {
        $p = [];
        foreach($this->getPermissions() as $key => $value){
            $p[] = [
                'model' => Permission::where('name', $key)->first(),
                'list' => $value
            ];
        }
        return $p;
    }

}