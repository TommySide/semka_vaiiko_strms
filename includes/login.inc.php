<?php

if (isset($_POST["login-submit"])) {
    $nick = $_POST["nickname"];
    $pwd = $_POST["password"];

    include "../classes/dbh.class.php";
    include "../classes/Login.class.php";
    include "../classes/LoginContr.class.php";
    $signup = new LoginContr($nick, $pwd);
    $signup->loginUser();

    header("Location: ../index.php?success=login");
}