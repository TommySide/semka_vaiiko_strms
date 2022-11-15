<?php
include "header.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/signupforms.css">
    <link rel="stylesheet" href="style/stylegg.css">
    <title>Document</title>
</head>
<body>
<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white">Change password</h2>
            <br>
            <form class="login-form" action="includes/changepwd.inc.php" method="post">
                <input type="password" name="passwordCurrent" class="text-white" placeholder="aktuálne heslo"/>
                <input type="password" name="password" class="text-white" placeholder="nové heslo"/>
                <input type="password" name="password-rep" class="text-white" placeholder="nové heslo znova"/>
                <button name="change-submit">ZMEN HESLO</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>