<?php
    if (!isset($_POST["create"])) {
        header("Location: index.php?error=naah");
        exit();
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/signupforms.css">
    <title>Document</title>
</head>
<?php include "header.php";?>
<body>

<?php
    if (isset($_POST["strm-submit"])) {
        include "classes/StreamerContr.class.php";
        $array = [];
        foreach ($_POST as $key => $value) {
            array_push($array, $value);
        }
        unset($array[10]);
        $streamer = new StreamerContr($_SESSION["uId"]);
        $streamer->vytvorStreamProfil($array);
    }
?>
<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white">Login</h2>
            <br>
            <form class="login-form" action="" method="post">
                <input type="text" name="nickname" class="text-white" placeholder="prezývka"/>
                <textarea class="text-white" name="popis" rows="2" placeholder="popis" style="resize: none;"></textarea>
                <input type="text" name="smallpopis" class="text-white" placeholder="maly popis"/>
                <input type="text" name="www" class="text-white" placeholder="webstránka"/>
                <input type="text" name="fb" class="text-white" placeholder="facebook"/>
                <input type="text" name="discord" class="text-white" placeholder="discord"/>
                <input type="text" name="youtube" class="text-white" placeholder="youtube"/>
                <input type="text" name="instagram" class="text-white" placeholder="instagram"/>
                <input type="text" name="telegram" class="text-white" placeholder="telegram"/>
                <input type="text" name="twitter" class="text-white" placeholder="twitter"/>
                <button name="strm-submit">vytvor</button>
            </form>
        </div>
    </div>
</div>
</body>
<?php include "footer.php";?>
</html>