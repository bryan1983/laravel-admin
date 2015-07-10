<?php

namespace Joselfonseca\LaravelAdmin\Events;

use Illuminate\Queue\SerializesModels;


class UserWasUpdated extends Event{

    use SerializesModels;

    public $user;
    public $input;

    public function __construct($user, $data)
    {
        $this->user = $user;
        $this->input = $data;
    }

}