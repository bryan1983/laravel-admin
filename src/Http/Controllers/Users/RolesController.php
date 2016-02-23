<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers\Users;

use Joselfonseca\LaravelAdmin\Http\Controllers\Controller;
use Joselfonseca\LaravelAdmin\Services\Users\Role;
use Joselfonseca\LaravelAdmin\Services\Users\Permission;
use Joselfonseca\LaravelAdmin\Services\TableBuilder\TableBuilder;
use Joselfonseca\LaravelAdmin\Http\Requests\RoleRequest;
use Joselfonseca\LaravelAdmin\Http\Requests\UpdateRoleRequest;
use Illuminate\Support\Facades\Redirect;
use SweetAlert;

class RolesController extends Controller
{

	private $model;

	public function __construct(Role $r)
	{
		$this->model = $r;
	}

    public function index(TableBuilder $table)
    {
    	$table->setActions([
            'edit' => [
                'link' => url('backend/roles/-id-/edit/'),
                'text' => '<i class="fa fa-pencil"></i> ' . trans('LaravelAdmin::laravel-admin.edit'),
                'class' => 'btn btn-primary btn-sm',
            ],
            'permissions' => [
                'link' => url('backend/roles/-id-/permissions'),
                'text' => '<i class="fa fa-lock"></i> ' . trans('LaravelAdmin::laravel-admin.permissions'),
                'class' => 'btn btn-default btn-sm',
            ],
            'delete' => [
                'link' => url('backend/roles/-id-/delete'),
                'text' => '<i class="fa fa-times"></i> ' . trans('LaravelAdmin::laravel-admin.delete'),
                'class' => 'btn btn-danger btn-sm confirm-delete',
                'confirm' => true,
            ],
        ]);
        return view('LaravelAdmin::roles.index')
        	->with('table', $table->setModel($this->model)->render())
            ->with('activeMenu', 'sidebar.Users.Roles');
    }

    public function create()
    {
    	return view('LaravelAdmin::roles.create')->with('activeMenu', 'sidebar.Users.Roles');
    }

    public function store(RoleRequest $request)
    {
    	$this->model->create($request->all());
		SweetAlert::success(trans('LaravelAdmin::laravel-admin.rolCreationSuccess'));
    	return Redirect::to('backend/roles');
    }

    public function edit($id)
    {
    	$role = $this->model->findOrFail($id);
    	return view('LaravelAdmin::roles.edit')
    			->with('role', $role)
    			->with('activeMenu', 'sidebar.Users.Roles');
    }

    public function update(UpdateRoleRequest $request, $id)
    {
    	$role = $this->model->findOrFail($id);
    	if($role->name !== $request->get('name'))
    	{
    		if($this->model->where('name', $request->get('name'))->count() > 0)
    		{
    			return Redirect::back()->withInput()->withErrors(['name' => trans('LaravelAdmin::laravel-admin.slugAlreadyExisits')]);
    		}
    	}
    	$role->fill($request->all());
    	$role->save();
        SweetAlert::success(trans('LaravelAdmin::laravel-admin.rolEditionSuccess'));
    	return Redirect::to('backend/roles');
    }

    public function destroy($id)
    {
    	$role = $this->model->findOrFail($id);
    	$role->delete();
        SweetAlert::success(trans('LaravelAdmin::laravel-admin.rolDeleteSuccess'));
    	return Redirect::to('backend/roles');
    }

    public function permissions($id)
    {
    	$role = $this->model->findOrFail($id);
    	return view('LaravelAdmin::permissions.assign')
    			->with('type', 'role')
    			->with('model', $role)
    			->with('permissions', $role->perms)
    			->with('activeMenu', 'sidebar.Users.Roles');
    }

    public function permissionsDelete($id, $permission)
    {
        $role = $this->model->findOrFail($id);
        $role->perms()->detach($permission);
        SweetAlert::success(trans('LaravelAdmin::laravel-admin.permissionsDetachedSuccess'));
        return Redirect::back();
    }
}
