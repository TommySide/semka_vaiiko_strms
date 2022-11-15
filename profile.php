<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/stylegg.css">
    <link rel="stylesheet" href="style/signupforms.css">
    <title>STRM | Profile</title>
</head>
<body>
<?php include "header.php";
    if (!isset($_SESSION["uId"])) {
        echo "<h1 class='text-danger'>Nie si prihlaseny!</h1>";
        exit();
    }
    if (isset($_GET["user"])) {
        if ($_GET["user"] != $_SESSION["uId"]) {
            echo "<h1 class='text-danger'>Tu nepatris!</h1>";
            exit();
        }
    }
?>

<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white font-weight-bold" style="letter-spacing: 3px">Profile | <?php echo $_SESSION["nickname"]."#".$_SESSION["uId"]; ?></h2>
            <br>
                <a href="pwd_change.php"><button name="pwd">Zmena hesla</button></a>
                <a href="create.php"><button>create streamer profile</button></a>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
<?php
