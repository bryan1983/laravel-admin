<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers\Users;

use Joselfonseca\LaravelAdmin\Http\Controllers\Controller;
use Joselfonseca\LaravelAdmin\Http\Requests;
use Joselfonseca\LaravelAdmin\Models\User;
use Joselfonseca\LaravelAdmin\Services\Acl\AclManager;
use Joselfonseca\LaravelAdmin\Services\TableBuilder\TableBuilder;
use Joselfonseca\LaravelAdmin\Services\Users\UserRepository;
use Illuminate\Support\Facades\Redirect;
use Exception;

/**
 * Description of UsersController
 *
 * @author jfonseca
 */
class UsersController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $r)
    {
        $this->userRepository = $r;
    }

    public function index(TableBuilder $table)
    {
        $table->setActions([
            'edit' => [
                'link' => url('backend/users/-id-/edit/'),
                'text' => '<i class="fa fa-pencil"></i> ' . trans('LaravelAdmin::laravel-admin.edit'),
                'class' => 'btn btn-primary btn-sm',
            ],
            'permissions' => [
                'link' => url('backend/users/-id-/permissions'),
                'text' => '<i class="fa fa-lock"></i> ' . trans('LaravelAdmin::laravel-admin.permissions'),
                'class' => 'btn btn-default btn-sm',
            ],
            'delete' => [
                'link' => url('backend/users/-id-/delete'),
                'text' => '<i class="fa fa-times"></i> ' . trans('LaravelAdmin::laravel-admin.delete'),
                'class' => 'btn btn-danger btn-sm confirm',
                'confirm' => true,
            ],
        ]);
        return view('LaravelAdmin::users.index')->with('table', $table->setModel(new User())->render())->with('activeMenu', 'sidebar.Users.List');
    }

    public function edit(AclManager $aclManager, $id)
    {
        $user = User::findOrFail($id);
        return view('LaravelAdmin::users.edit')
            ->with('user', $user)
            ->with('roles', $aclManager->getRolesForSelect())
            ->with('activeMenu', 'sidebar.Users');
    }

    public function create(AclManager $aclManager)
    {
        return view('LaravelAdmin::users.create')
            ->with('roles', $aclManager->getRolesForSelect())
            ->with('activeMenu', 'sidebar.Users');       
    }

    public function store(Requests\CreateUserRequest $request)
    {
        $this->userRepository->create($request->all());
        flash()->success(trans('LaravelAdmin::laravel-admin.userCreated'));
        return Redirect::to('backend/users');
    }

    public function update(Requests\UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->get('email') !== $user->email) {
            try {
                $this->userRepository->updateWithEmail($user->id, $request->all());
            } catch (Exception $e) {
                return Redirect::back()->withErrors(['email' => trans('LaravelAdmin::laravel-admin.emailTaken')]);
            }
        }
        $this->userRepository->update($user->id, $request->all());
        flash()->success(trans('LaravelAdmin::laravel-admin.userUpdated'));
        return Redirect::back();
    }

    public function updatePassword(Requests\UpdatePasswordRequest $request, $id)
    {
        $user = $user = User::findOrFail($id);
        $this->userRepository->updatePassword($user->id, $request->all());
        flash()->success(trans('LaravelAdmin::laravel-admin.passwordUpdated'));
        return Redirect::back();
    }

    public function destroy($id)
    {
        $user = $user = User::findOrFail($id);
        $this->userRepository->deleteUser($user);
        flash()->success(trans('LaravelAdmin::laravel-admin.userDeleted'));
        return Redirect::back();    
    }

    public function me(AclManager $aclManager)
    {
        $user = User::findOrFail(\Auth::user()->id);
        return view('LaravelAdmin::users.edit')
            ->with('user', $user)
            ->with('roles', $aclManager->getRolesForSelect())
            ->with('activeMenu', 'sidebar.Users');
    }

    public function meEdit(Requests\UpdateUserRequest $request)
    {
        return $this->update($request, \Auth::user()->id);
    }

}
