<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style/signupforms.css">
    <link rel="stylesheet" href="style/stylegg.css">
    <script src="https://kit.fontawesome.com/85a6d0cbbe.js" crossorigin="anonymous"></script>
</head>
<?php include_once "header.php"; ?>
<body>
<script type="application/javascript" src="scripts/script.js"></script>
<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white">Login</h2>
            <br>
            <form class="login-form" action="includes/signup.inc.php" method="post">
                <input type="text" name="nickname" class="text-white" placeholder="prihlásovacie meno"/>
                <input type="email" name="email" class="text-white" placeholder="email"/>
                <div class="inputicon">
                    <input type="password" name="password" id="pwd" onchange="heslaZhoda()" class="text-white" placeholder="heslo"/>
                    <i class="fa-regular fa-eye fa-lg" id="aa" onclick="showHidePwdReg()"></i>
                </div>
                <div class="inputicon">
                    <input type="password" name="password-rep" onkeyup="heslaZhoda()" id="pwd" class="text-white" placeholder="heslo"/>
                    <i class="fa-regular fa-eye fa-lg" id="bb" onclick="showHidePwdReg()"></i>
                </div>
                <h5 id="hesla"></h5>
                <button name="login-submit">registruj</button>
                <p class="message">Už si zaregistrovaný? <a href="login.php">Prihlás sa</a></p>
            </form>
        </div>
    </div>
</div>
</body>

</html>