<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers\Users;

use Joselfonseca\LaravelAdmin\Http\Controllers\Controller;
use Joselfonseca\LaravelAdmin\Services\Users\Role;
use Joselfonseca\LaravelAdmin\Services\Users\Permission;
use Joselfonseca\LaravelAdmin\Services\TableBuilder\TableBuilder;
use Joselfonseca\LaravelAdmin\Http\Requests\PermissionsRequest;
use Joselfonseca\LaravelAdmin\Http\Requests\UpdatePermissionRequest;
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

    public function index(TableBuilder $table)
    {
        $table->setActions([
            'edit' => [
                'link' => url('backend/permissions/-id-/edit/'),
                'text' => '<i class="fa fa-pencil"></i> '.trans('LaravelAdmin::laravel-admin.edit'),
                'class' => 'btn btn-primary btn-sm',
            ],
            'delete' => [
                'link' => url('backend/permissions/-id-/delete'),
                'text' => '<i class="fa fa-times"></i> '.trans('LaravelAdmin::laravel-admin.delete'),
                'class' => 'btn btn-danger btn-sm confirm',
                'confirm' => true,
            ],
        ]);
        return view('LaravelAdmin::permissions.index')
                ->with('table', $table->setModel($this->model)->render())
                ->with('activeMenu', 'sidebar.Users.Permissions');
    }

    public function create()
    {
        return view('LaravelAdmin::permissions.create')->with('activeMenu',
                'sidebar.Users.Permissions');
    }

    public function store(PermissionsRequest $request)
    {
        $this->model->create($request->all());
        flash()->success(trans('LaravelAdmin::laravel-admin.permissionCreationSuccess'));
        return Redirect::to('backend/permissions');
    }

    public function edit($id)
    {
        $permission = $this->model->findOrFail($id);
        return view('LaravelAdmin::permissions.edit')
                ->with('permission', $permission)
                ->with('activeMenu', 'sidebar.Users.Permissions');
    }

    public function update(UpdatePermissionRequest $request, $id)
    {
        $role = $this->model->findOrFail($id);
        if ($role->name !== $request->get('name')) {
            if ($this->model->where('name', $request->get('name'))->count() > 0) {
                return Redirect::back()->withInput()->withErrors(['name' => trans('LaravelAdmin::laravel-admin.slugAlreadyExisits')]);
            }
        }
        $role->fill($request->all());
        $role->save();
        flash()->success(trans('LaravelAdmin::laravel-admin.permissionEditionSuccess'));
        return Redirect::to('backend/permissions');
    }

    public function destroy($id)
    {
        $role = $this->model->findOrFail($id);
        $role->delete();
        flash()->success(trans('LaravelAdmin::laravel-admin.permissionDeleteSuccess'));
        return Redirect::to('backend/permissions');
    }

    public function getForSelect(Request $request, AclManager $acl)
    {
        if ($request->get('type') === 'role') {
            $permissionsModel = $acl->getPermissionsIdsForRole($request->get('model'));
        } else {
            $permissionsModel = $acl->getPermissionsIdsForUser($request->get('model'));
        }
        $permissions = Permission::whereNotIn('id', $permissionsModel)->get();
        return response()->json($permissions);
    }

    public function permissionsAssign(Request $request, AclManager $acl)
    {
        if ($request->get('type') === 'role') {
            $acl->assignPermissionsToRole($request->get('model'),
                $request->get('perms'));
        } else {
            $acl->assignPermissionsToUser($request->get('model'),
                $request->get('perms'));
        }
        flash()->success(trans('LaravelAdmin::laravel-admin.permissionsAttachSuccess'));
        return Redirect::back();
    }
}