<?php
    if (!isset($_POST["create"])) {
        header("Location: index.php?error=naah");
        exit();
    }
?>
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
<?php include "header.php";?>

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
            <form class="login-form" method="post">
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
<?php include "footer.php";?>

</body>
</html>