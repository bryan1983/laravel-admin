<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers\Users;

use DB;
use Datatables;
use SweetAlert;
use Illuminate\Http\Request;
use Joselfonseca\LaravelAdmin\Entities\Permission;
use Prettus\Validator\Exceptions\ValidatorException;
use Joselfonseca\LaravelAdmin\Http\Requests\RoleRequest;
use Joselfonseca\LaravelAdmin\Http\Controllers\Controller;
use Joselfonseca\LaravelAdmin\Http\Requests\UpdateRoleRequest;
use Joselfonseca\LaravelAdmin\Contracts\RoleRepositoryContract;

/**
 * Class RolesController
 * @package Joselfonseca\LaravelAdmin\Http\Controllers\Users
 */
class RolesController extends Controller
{

    /**
     * @var RoleRepositoryContract
     */
    private $repository;

    /**
     * RolesController constructor.
     * @param RoleRepositoryContract $repository
     */
    public function __construct(RoleRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of($this->repository->all(['id', 'display_name']))
                ->addColumn('action', function ($role) {
                    $buttons = '<a href="'.route('LaravelAdminRolesEdit', [$role->id]).'" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> '.trans('laravel-admin.edit').'</a> &nbsp;&nbsp;';
                    $buttons .= '<a href="'.route('LaravelAdminRolesPermissions', [$role->id]).'" class="btn btn-sm btn-default"><i class="fa fa-lock"></i> '.trans('laravel-admin.permissions').'</a> &nbsp;&nbsp;';
                    $buttons .= '<a href="'.route('LaravelAdminRolesDelete', [$role->id]).'" class="btn btn-sm btn-danger confirm-delete"><i class="fa fa-times"></i> '.trans('laravel-admin.delete').'</a>';
                    return $buttons;
                })
                ->make();
        }
        return view('LaravelAdmin::roles.index')->with('activeMenu', 'sidebar.Users.Roles');
    }

    /**
     * @return $this
     */
    public function create()
    {
        return view('LaravelAdmin::roles.create')->with('activeMenu', 'sidebar.Users.Roles');
    }

    /**
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $this->repository->create($request->all());
            });
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag());
        }
        SweetAlert::success(trans('LaravelAdmin::laravel-admin.rolCreationSuccess'));
        return redirect()->to(config('laravel-admin.routePrefix', 'backend') . '/roles');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        return view('LaravelAdmin::roles.edit')
            ->with('role', $this->repository->find($id))
            ->with('activeMenu', 'sidebar.Users.Roles');
    }

    /**
     * @param UpdateRoleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $this->repository->update($request->all(), $id);
            });
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag());
        }
        SweetAlert::success(trans('LaravelAdmin::laravel-admin.rolEditionSuccess'));
        return redirect()->to(config('laravel-admin.routePrefix', 'backend') . '/roles');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $this->repository->delete($id);
            });
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag());
        }
        SweetAlert::success(trans('LaravelAdmin::laravel-admin.rolDeleteSuccess'));
        return redirect()->to(config('laravel-admin.routePrefix', 'backend') . '/roles');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function permissions($id)
    {
        $role = $this->repository->find($id);
        $permissions = Permission::all()->pluck('display_name', 'id')->toArray();
        return view('LaravelAdmin::permissions.assign')
            ->with('type', 'role')
            ->with('model', $role)
            ->with('permissions', $role->perms->pluck('id')->toArray())
            ->with('permissionsList', $permissions)
            ->with('activeMenu', 'sidebar.Users.Roles');
    }

    /**
     * @param $id
     * @param $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function permissionsDelete($id, $permission)
    {
        $role = $this->repository->find($id);
        $role->perms()->detach($permission);
        SweetAlert::success(trans('LaravelAdmin::laravel-admin.permissionsDetachedSuccess'));
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function permissionsUpdate(Request $request, $id)
    {
        $role = $this->repository->find($id);
        $role->perms()->sync($request->get('permissions'));
        SweetAlert::success(trans('LaravelAdmin::laravel-admin.permissionsAttachSuccess'));
        return redirect()->to(config('laravel-admin.routePrefix', 'backend') . '/roles');
    }
}
