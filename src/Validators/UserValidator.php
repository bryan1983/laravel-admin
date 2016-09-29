<?php

namespace Joselfonseca\LaravelAdmin\Validators;

use Prettus\Validator\LaravelValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class UserValidator
 * @package Joselfonseca\LaravelAdmin\Validators
 */
class UserValidator extends LaravelValidator
{

    /**
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'email'  => 'required|unique:users',
            'password' => 'required|min:8'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
            'email'  => 'sometimes|required|unique:users',
        ]
    ];
}
