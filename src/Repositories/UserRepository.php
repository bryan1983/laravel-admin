<?php

namespace Joselfonseca\LaravelAdmin\Repositories;

use Joselfonseca\LaravelAdmin\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Joselfonseca\LaravelAdmin\Events\UserWasCreated;
use Joselfonseca\LaravelAdmin\Events\UserWasUpdated;
use Joselfonseca\LaravelAdmin\Validators\UserValidator;
use Joselfonseca\LaravelAdmin\Contracts\UserRepositoryContract;

/**
 * Class UserRepository
 * @package Joselfonseca\LaravelAdmin\Repositories
 */
class UserRepository extends BaseRepository implements UserRepositoryContract
{

    /**
     * @return mixed
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @return mixed
     */
    public function validator()
    {
        return UserValidator::class;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $attributes['password'] = bcrypt($attributes['password']);
        $user = parent::create($attributes);
        $this->updateRoles($user, $attributes);
        event(new UserWasCreated($user, $attributes));
        return $this->parserResult($user);
    }

    /**
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        $user = $this->find($id);
        if ($user->email === $attributes['email']) {
            unset($attributes['email']);
        }
        $user = parent::update($attributes, $id);
        $this->updateRoles($user, $attributes);
        event(new UserWasUpdated($user, $attributes));
        return $this->parserResult($user);
    }

    /**
     * @param $user
     * @param $data
     */
    public function updateRoles($user, $data)
    {
        $roles = collect(isset($data['roles']) ?: []);
        $user->roles()->sync($roles->toArray());
    }

    public function updatePassword($user, $password)
    {
        $password = bcrypt($password);
        $user = $this->find($user);
        $user->password = $password;
        $user->save();
        return $this->parserResult($user);
    }
}
