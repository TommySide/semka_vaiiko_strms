<?php

class Login extends Dbh
{
    protected function getUser($nickname, $password) {
        $sql = "SELECT id_users, nickname, password, hasStore FROM users WHERE nickname=? OR email=?";
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

        if (!password_verify($password, $result[0]["password"])) {
            header("Location: ../login.php?error=wrongpwd");
            exit();
        }
        session_start();
        $_SESSION["uId"] = $result[0]["id_users"];
        $_SESSION["nickname"] = $result[0]["nickname"];
        $_SESSION["hasStore"] = $result[0]["hasStore"];

        $stmt = null;
    }
}