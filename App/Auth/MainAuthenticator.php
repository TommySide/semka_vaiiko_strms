<?php

namespace App\Auth;

use App\Core\IAuthenticator;
use App\Models\User;

class MainAuthenticator extends DummyAuthenticator
{

    function login($userLogin, $pass): bool
    {
        if ($this->emptyField($userLogin, $pass))
            return false;
        if ($this->invalidNickname($userLogin))
            return false;

        $user = User::getAll("nickname = ? OR email = ?", [$userLogin, $userLogin]);
        if ($user == NULL)
            return false;
        if (password_verify($pass, $user[0]->getPassword())) {
            $_SESSION['user'] = $user[0]->getNickname();
            $_SESSION['userId'] = $user[0]->getIdUser();
            return true;
        }
        return false;
    }

    function getLoggedUserId(): mixed
    {
        return $_SESSION['userId'];
    }

    private function emptyField($nickname, $password) {
        if (empty($nickname) || empty($password)) {
            return true;
        }
        return false;
    }

    private function invalidNickname($nickname) {
        if (!preg_match("/^[a-zA-Z0-9 .@]*$/", $nickname)) {
            return true;
        }
        return false;
    }
}