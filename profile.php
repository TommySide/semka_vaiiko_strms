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
            <?php if ($_SESSION["hasStore"] == 0) { ?>
                <form action="create.php" method="post">
                    <button name="create">create streamer profile</button>
                </form>
                <?php } ?>

        </div>
    </div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
<?php
