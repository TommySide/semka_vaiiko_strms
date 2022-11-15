<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Strms</title>
    <link rel="stylesheet" href="style/stylegg.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<?php session_start(); ?>
    <header id="header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand logo">STRMS > streamer#1</a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navig">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navig">
                    <ul class="navbar-nav">
                        <li class="">
                            <a class="" href="index.php">Home</a>
                        </li>
                        <li class="">
                            <a class="" href="#">About</a>
                        </li>
                        <li class="">
                            <a class="" href="#">Contant us</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <?php if (!isset($_SESSION["nickname"])) {?>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="signup.php">Register</a></li>
                        <?php } else { ?>
                            <li><a href="profile.php"><?php echo $_SESSION["nickname"]; ?></a></li>
                            <li><a href="includes/logout.inc.php">Logout</a></li>
                        <?php } ?>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>