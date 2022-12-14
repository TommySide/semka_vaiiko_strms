<?php
if (!isset($_GET["pridaj"])) {
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
<?php include "header.php"; ?>
<?php
    if (isset($_POST["submit"])) {
        if (empty($_POST["titul"]) || empty($_POST["popis"]) || empty($_POST["cena"]) || empty($_POST["kusy"])) {
            header("Location: manage.php?id=".$_GET["id"]."&pridaj&error=emptyfields");
            exit();
        }
        if (!preg_match('/^[a-zA-Z0-9 _#]+$/', $_POST["titul"]) || !preg_match('/^[a-zA-Z0-9 _#]+$/', $_POST["popis"])) {
            header("Location: manage.php?id=".$_GET["id"]."&pridaj&error=wronginput");
            exit();
        }
        include "classes/StreamerContr.class.php";
        $streamer = new StreamerContr($_GET["id"]);
        $produkt = new Product();
        $produkt->id_streamer = $_GET["id"];
        $produkt->titul = $_POST["titul"];
        $produkt->popis = $_POST["popis"];
        $produkt->cena = $_POST["cena"];
        $produkt->pocet = $_POST["kusy"];
        $streamer->pridajProdukt($produkt);
    }
?>

<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white">Add product</h2>
            <br>
            <form class="login-form" method="post">
                <input type="text" name="titul" class="text-white" placeholder="Titulok produktu"/>
                <input type="text" name="popis" class="text-white" placeholder="Popis produktu"/>
                <input type="number" name="cena" class="text-white" placeholder="Cena produktu"/>
                <input type="number" name="kusy" class="text-white" placeholder="Pocet dostupnych kusov"/>
                <button name="submit">pridaj</button>
            </form>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
</body>
</html>