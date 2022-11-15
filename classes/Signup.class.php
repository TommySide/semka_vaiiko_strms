<?php

class Signup extends Dbh
{
    protected function setUser($nickname, $pwd, $email) {
        $sql = "INSERT INTO users (nickname, password, email) VALUES (?,?,?);";
        $stmt = $this->connect()->prepare($sql);

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute([$nickname, $hashedPwd, $email])) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
    }

    protected function checkUser($nickname, $email) {
        $sql = "SELECT nickname FROM users WHERE nickname=? OR email=?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$nickname, $email])) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
        if ($stmt->rowCount() != 0) {
            return false;
        }
        return true;
    }
}