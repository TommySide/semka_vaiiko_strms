<?php

class LoginContr extends Login
{
    private $nickname;
    private $password;

    /**
     * @param $nickname
     * @param $password
     */
    public function __construct($nickname, $password)
    {
        $this->nickname = $nickname;
        $this->password = $password;
    }

    public function loginUser() {
        if (!$this->emptyField()) {
            header("Location: ../signup.php?error=emptyfields");
            exit();
        }
        if (!$this->invalidNickname()) {
            header("Location: ../signup.php?error=invalidnickname");
            exit();
        }

        $this->getUser($this->nickname, $this->password);
    }

    private function emptyField() {
        if (empty($this->nickname) || empty($this->password)) {
            return false;
        }
        return true;
    }

    private function invalidNickname() {
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->nickname)) {
            return false;
        }
        return true;
    }


}