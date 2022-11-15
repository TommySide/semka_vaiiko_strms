<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style/signupforms.css">
    <link rel="stylesheet" href="style/stylegg.css">
</head>
<?php include_once "header.php"; ?>
<body>
<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white">Login</h2>
            <br>
            <form class="login-form" action="includes/signup.inc.php" method="post">
                <input type="text" name="nickname" class="text-white" placeholder="prihlásovacie meno"/>
                <input type="email" name="email" class="text-white" placeholder="email"/>
                <input type="password" name="password" class="text-white" placeholder="heslo"/>
                <input type="password" name="password-rep" class="text-white" placeholder="heslo znova"/>
                <button name="login-submit">registruj</button>
                <p class="message">Už si zaregistrovaný? <a href="login.php">Prihlás sa</a></p>
            </form>
        </div>
    </div>
</div>
</body>

</html>