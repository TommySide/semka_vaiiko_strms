<?php

class SignupContr
{
    private $nickname;
    private $email;
    private $password;
    private $passwordrep;

    /**
     * @param $nickname
     * @param $password
     * @param $passwordrep
     * @param $email
     */
    public function __construct($nickname, $email, $password, $passwordrep)
    {
        $this->nickname = $nickname;
        $this->email = $email;
        $this->password = $password;
        $this->passwordrep = $passwordrep;
    }

    private function emptyField() {
        if (empty($this->nickname) || empty($this->email) || empty($this->password) || empty($this->passwordrep)) {
            return false;
        }
        return true;
    }

    private function invalidNickname() {
        if (!preg_match("\^[a-zA-Z0-9]*$/", $this->nickname)) {
            return false;
        }
        return true;
    }

    private function invalidEmail() {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    private function pwdDontMatch() {
        if ($this->password !== $this->passwordrep) {
            return false;
        }
        return true;
    }
}