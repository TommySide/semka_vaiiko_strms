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
<?php include "header.php"; ?>

<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white font-weight-bold" style="letter-spacing: 3px">Profile</h2>
            <br>
            <form class="login-form" action="includes/login.inc.php" method="post">
                <button>Zmena hesla</button>
                <a href=""><button>create streamer profile</button></a>
            </form>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
<?php
