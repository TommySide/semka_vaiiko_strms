<?php

class Login extends dbh
{
    protected function getUser($nickname, $password) {
        $sql = "SELECT id, nickname, password FROM users WHERE nickname=? OR email=?";
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

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r($result);
        if (!password_verify($password, $result[0]["password"])) {
            header("Location: ../login.php?error=wrongpwd");
            exit();
        }
        session_start();
        $_SESSION["uId"] = $result[0]["id"];
        $_SESSION["nickname"] = $result[0]["nickname"];

        $stmt = null;
    }
}