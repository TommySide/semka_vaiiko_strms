<?php

class ChangePassword extends Dbh
{
    private $old, $new, $newRep;

    /**
     * @param $old
     * @param $new
     * @param $newRep
     */
    public function __construct($old, $new, $newRep)
    {
        $this->old = $old;
        $this->new = $new;
        $this->newRep = $newRep;
        session_start();
    }

    public function changePwd() {
        if ($this->emptyField()) {
            header("Location: ../profile.php?error=emptyfields");
            exit();
        }
        if (!$this->pwdMatch()) {
            header("Location: ../profile.php?error=newandrepdontmatch");
            exit();
        }

        if (!$this->correctPwd()) {
            header("Location: ../profile.php?error=passwordnotcorrect");
            exit();
        }

        $newHash = password_hash($this->new, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password=? WHERE id_users=?";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute([$newHash, $_SESSION["uId"]])) {
            header("Location: ../profile.php?error=stmtfail");
            exit();
        }

        header("Location: ../profile.php?success=pwdchange");
        exit();
    }

    private function emptyField() {
        if (empty($this->old) || empty($this->new) || empty($this->newRep)) {
            return true;
        }
        return false;
    }

    private function correctPwd() : bool{
        $sql = "SELECT password FROM users WHERE id_users=?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$_SESSION["uId"]])) {
            header("Location: ../profile.php?error=stmtfail");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            header("Location: ../profile.php?error=wtf");
            exit();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return password_verify($this->old, $result[0]["password"]);
    }

    private function pwdMatch() : bool {
        if ($this->new == $this->newRep) {
            return true;
        }
        return false;
    }
}