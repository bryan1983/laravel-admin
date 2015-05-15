<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers\Users;

use Joselfonseca\LaravelAdmin\Http\Controllers\Controller;
use Joselfonseca\LaravelAdmin\Services\Users\Role;
use Joselfonseca\LaravelAdmin\Services\Users\Permission;
use Joselfonseca\LaravelAdmin\Services\TableBuilder\TableBuilder;
use Joselfonseca\LaravelAdmin\Http\Requests\RoleRequest;
use Joselfonseca\LaravelAdmin\Http\Requests\UpdateRoleRequest;
use Illuminate\Support\Facades\Redirect;
use Joselfonseca\LaravelAdmin\Services\Acl\AclManager;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
	private $model;

	public function __construct(Permission $p)
	{
		$this->model = $p;
	}

	public function getForSelect(Request $request, AclManager $acl)
	{
		if($request->get('type') === 'role'){
			$permissionsModel = $acl->getPermissionsIdsForRole($request->get('model'));
		}else{
			$permissionsModel = $acl->getPermissionsIdsForUser($request->get('model'));
		}
		$permissions = Permission::whereNotIn('id', $permissionsModel)->get();
		return response()->json($permissions);
	}

	public function permissionsAssign(Request $request, AclManager $acl)
	{
		if($request->get('type') === 'role'){
			$acl->assignPermitionsToRole($request->get('model'), $request->get('perms'));
		}else{
			$acl->assignPermitionsToUser($request->get('model'), $request->get('perms'));
		}
		flash()->success(trans('LaravelAdmin::laravel-admin.permissionsAttachSuccess'));
		return Redirect::back();	
	}

}