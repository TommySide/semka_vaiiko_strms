<?php
if(isset($_POST["change-submit"])) {
    $curPwd = $_POST["passwordCurrent"];
    $newPwd = $_POST["password"];
    $newPwdRep = $_POST["password-rep"];

    include "../classes/Dbh.class.php";
    include "../classes/ChangePassword.php";
    $change = new ChangePassword($curPwd, $newPwd, $newPwdRep);
    $change->changePwd();
}