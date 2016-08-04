<?php

namespace Joselfonseca\LaravelAdmin\Validators;

use Prettus\Validator\LaravelValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class RoleValidator extends LaravelValidator
{

    /**
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'display_name'  => 'required|unique:roles'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
            'display_name'  => 'sometimes|required|unique:roles'
        ]
    ];
}
