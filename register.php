<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style/signupforms.css">
    <link rel="stylesheet" href="style/stylef.css">
</head>
<?php include_once "header.html"; ?>
<body>
<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white">Login</h2>
            <br>
            <form class="login-form" action="#">
                <input type="text" class="text-white" placeholder="prihlásovacie meno"/>
                <input type="email" class="text-white" placeholder="email"/>
                <input type="password" class="text-white" placeholder="heslo"/>
                <input type="password" class="text-white" placeholder="heslo znova"/>
                <button name="login-submit">registruj</button>
                <p class="message">Už si zaregistrovaný? <a href="login.php">Prihlás sa</a></p>
            </form>
        </div>
    </div>
</div>
</body>

</html>