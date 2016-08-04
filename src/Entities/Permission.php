<?php

namespace Joselfonseca\LaravelAdmin\Entities;

use Zizaco\Entrust\EntrustPermission as Model;

/**
 * Class Permission
 * @package Joselfonseca\LaravelAdmin\Services\Users
 */
class Permission extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['display_name', 'name', 'description'];
}
