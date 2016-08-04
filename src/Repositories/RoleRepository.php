<?php

namespace Joselfonseca\LaravelAdmin\Repositories;

use Joselfonseca\LaravelAdmin\Entities\Role;
use Prettus\Repository\Eloquent\BaseRepository;
use Joselfonseca\LaravelAdmin\Validators\RoleValidator;
use Joselfonseca\LaravelAdmin\Contracts\RoleRepositoryContract;

/**
 * Class RoleRepository
 * @package Joselfonseca\LaravelAdmin\Repositories
 */
class RoleRepository extends BaseRepository implements RoleRepositoryContract
{

    /**
     * @return mixed
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * @return mixed
     */
    public function validator()
    {
        return RoleValidator::class;
    }

    /**
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        $role = $this->find($id);
        if ($attributes['display_name'] === $role->display_name) {
            unset($attributes['display_name']);
        }
        return parent::update($attributes, $id);
    }
}
