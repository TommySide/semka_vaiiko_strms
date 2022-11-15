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
                <form class="login-form" action="includes/login.inc.php" method="post">
                    <input type="text" name="nickname" class="text-white" placeholder="prihlásovacie meno"/>
                    <input type="password" name="password" class="text-white" placeholder="heslo"/>
                    <button name="login-submit">prihlasit</button>
                    <p class="message">Nie si registrovaný? <a href="signup.php">Vytvor si účet</a></p>
                    <p class="message">Zabudnuté heslo? <a href="#">Zmeň si ho tu</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>