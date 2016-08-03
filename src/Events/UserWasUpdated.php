<?php

namespace Joselfonseca\LaravelAdmin\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class UserWasUpdated
 * @package Joselfonseca\LaravelAdmin\Events
 */
class UserWasUpdated extends Event
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
