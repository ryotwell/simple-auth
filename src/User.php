<?php

namespace Ryodevz;

class User
{
    public $username;

    public function __construct($user)
    {
        $this->username = $user['username'];
    }
}
