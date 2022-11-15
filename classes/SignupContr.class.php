<?php

class SignupContr extends Signup
{
    private $nickname;
    private $email;
    private $password;
    private $passwordRep;

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
        $this->passwordRep = $passwordrep;
    }

    public function signupUser() {
        if (!$this->emptyField()) {
            header("Location: ../signup.php?error=emptyfields");
            exit();
        }
        if (!$this->invalidNickname()) {
            header("Location: ../signup.php?error=nickname");
            exit();
        }
        if (!$this->invalidEmail()) {
            header("Location: ../signup.php?error=email");
            exit();
        }
        if (!$this->pwdMatch()) {
            header("Location: ../signup.php?error=pwdmatch");
            exit();
        }
        if (!$this->nicknameTaken()) {
            header("Location: ../signup.php?error=useroremailtaken");
            exit();
        }

        $this->setUser($this->nickname, $this->password, $this->email);
    }

    private function emptyField() {
        if (empty($this->nickname) || empty($this->email) || empty($this->password) || empty($this->passwordRep)) {
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

    private function invalidEmail() {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    private function pwdMatch() {
        if ($this->password !== $this->passwordRep) {
            return false;
        }
        return true;
    }

    private function nicknameTaken() {
        if (!$this->checkUser($this->nickname, $this->email)) {
            return false;
        }
        return true;
    }

}