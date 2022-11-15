<?php
if (isset($_POST["login-submit"])) {
    // Zoberie data
    $nick = $_POST["nickname"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $pwdrep = $_POST["password-rep"];

    include "../classes/Signup.class.php";
    include "../classes/signup_contr.class.php";
    $signup = new SignupContr($nick, $email, $pwd, $pwdrep);

}