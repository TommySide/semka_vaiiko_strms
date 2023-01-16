<?php

namespace App\Auth;

use App\Core\IAuthenticator;

class MainAuthenticator extends DummyAuthenticator
{

    function login($userLogin, $pass): bool
    {
        if (!preg_match("/^[a-zA-Z0-9@]*$/", $userLogin)) {
            return false;
        }

    }

}