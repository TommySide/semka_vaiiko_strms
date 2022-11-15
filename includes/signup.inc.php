<?php
if (isset($_POST["login-submit"])) {
    // Zoberie data
    $nick = $_POST["nickname"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $pwdRep = $_POST["password-rep"];

    include "../classes/dbh.class.php";
    include "../classes/Signup.class.php";
    include "../classes/SignupContr.class.php";
    $signup = new SignupContr($nick, $email, $pwd, $pwdRep);
    $signup->signupUser();

    header("Location: ../index.php?error=none");
}