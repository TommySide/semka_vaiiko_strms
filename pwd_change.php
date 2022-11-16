<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Strms</title>
    <link rel="stylesheet" href="style/stylegg.css">
    <script src="https://kit.fontawesome.com/85a6d0cbbe.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
<?php
include "header.php";
?>
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
<?php
include "footer.php";
?>
</body>
</html>