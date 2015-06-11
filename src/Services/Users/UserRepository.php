<?php

namespace Joselfonseca\LaravelAdmin\Services\Users;

class UserRepository
{

    public function __construct()
    {
        $model       = \Config::get('auth.model');
        $this->model = new $model;
    }

    /**
     * @param $user
     * @return static
     */
    public function create($data)
    {
        $data['password'] = bcrypt($data['password']);
        $u                = $this->model->create($data);
        $roles            = (!isset($data['roles'])) ? [] : $data['roles'];
        $u->roles()->sync($roles);
        return $u;
    }

    /**
     * @param $user
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function updateWithEmail($user, $data)
    {
        if ($this->model->where('email', $data['email'])->exists()) {
            throw new \Exception;
        }
        return $this->update($user, $data);
    }

    /**
     * @param $user
     * @param $data
     * @return bool
     */
    public function update($user, $data)
    {
        $u        = $this->model->find($user);
        $u->name  = $data['name'];
        $u->email = $data['email'];
        $u->save();
        $this->updateRoles($u, $data);
        return $u;
    }

    /**
     * @param $user
     * @param $data
     * @return bool
     */
    public function updatePassword($user, $data)
    {
        $u           = $this->model->find($user);
        $u->password = bcrypt($data['password']);
        $u->save();
        return $u;
    }

    /**
     *
     * @param type $user
     * @return type
     */
    public function deleteUser($user)
    {
        return $user->delete();
    }

    public function updateRoles($u, $data)
    {
        if(isset($data['roles'])){
            $roles = $data['roles'];
            if(count($data['roles']) == 0){
                $roles = [];
            }
            $u->roles()->sync($roles);
        }
    }
}