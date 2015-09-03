<?php

namespace Joselfonseca\LaravelAdmin\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class UserWasCreated
 * @package Joselfonseca\LaravelAdmin\Events
 */
class UserWasCreated extends Event
{

    use SerializesModels;

    /**
     * @var
     */
    public $user;
    /**
     * @var
     */
    public $input;

    /**
     * @param $user
     * @param $data
     */
    public function __construct($user, $data)
    {
        $this->user = $user;
        $this->input = $data;
    }

}