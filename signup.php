<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Strms</title>
    <link rel="stylesheet" href="style/stylegg.css">
    <link rel="stylesheet" href="style/signupforms.css">
    <script src="https://kit.fontawesome.com/85a6d0cbbe.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<?php include_once "header.php"; ?>


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
                    <input type="password" name="password" onchange="heslaZhoda()" class="text-white" placeholder="heslo"/>
                    <i class="fa-regular fa-eye fa-lg" id="aa" onclick="showHidePwdReg()"></i>
                </div>
                <div class="inputicon">
                    <input type="password" name="password-rep" onkeyup="heslaZhoda()"  class="text-white" placeholder="zopakuj heslo"/>
                    <i class="fa-regular fa-eye fa-lg" id="bb" onclick="showHidePwdReg()"></i>
                </div>
                <h5 id="hesla"></h5>
                <button name="login-submit">registruj</button>
                <p class="message">Už si zaregistrovaný? <a href="login.php">Prihlás sa</a></p>
            </form>
        </div>
    </div>
</div>
<?php include_once "footer.php"; ?>

</body>

</html>