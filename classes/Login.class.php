<?php

class Login extends dbh
{
    protected function getUser($nickname, $password) {
        $sql = "SELECT password FROM users WHERE nickname=? OR email=?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$nickname, $nickname])) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../login.php?error=usernotfound");
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($password, $pwdHashed[0]["password"]);

        $stmt = null;
    }
}