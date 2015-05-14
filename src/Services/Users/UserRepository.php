<?php

namespace Joselfonseca\LaravelAdmin\Services\Users;

use Joselfonseca\LaravelAdmin\Models\User;

class UserRepository {

	/**
     * @param $user
     * @return static
     */
    public function create($user){
        $data['password'] = bcrypt($data['password']);
        $u = User::create($data);
        $roles = (!isset($data['roles'])) ? [] : $data['roles'];
        $u->roles()->sync($roles);
        return $u;
    }

    /**
     * @param $user
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function updateWithEmail($user, $data){
        if(User::where('email', $data['email'])->exists()){
            throw new \Exception;
        }
        return $this->update($user, $data);
    }

    /**
     * @param $user
     * @param $data
     * @return bool
     */
    public function update($user, $data){
        $u = User::find($user);
        $u->name = $data['name'];
        $u->email = $data['email'];
        $u->save();
        $roles = (!isset($data['roles'])) ? [] : $data['roles'];
        $u->roles()->sync($roles);
        return $u;
    }

    /**
     * @param $user
     * @param $data
     * @return bool
     */
    public function updatePassword($user, $data){
        $u = User::find($user);
        $u->password = bcrypt($data['password']);
        $u->save();
        return $u;
    }

}