<?php

namespace Joselfonseca\LaravelAdmin\Entities;

use Zizaco\Entrust\EntrustRole as Model;

/**
 * Class Role
 * @package Joselfonseca\LaravelAdmin\Services\Users
 */
class Role extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['display_name', 'name', 'description'];
}
