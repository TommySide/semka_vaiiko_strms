<?php
if (!isset($_GET["pridaj"])) {
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
    <link rel="stylesheet" href="style/stylegg.css">

    <title>Document</title>
</head>
<?php include "header.php"; ?>
<body>

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
            <form class="login-form" action="" method="post">
                <input type="text" name="titul" class="text-white" placeholder="Titulok produktu"/>
                <input type="text" name="popis" class="text-white" placeholder="Popis produktu"/>
                <input type="number" name="cena" class="text-white" placeholder="Cena produktu"/>
                <input type="number" name="kusy" class="text-white" placeholder="Pocet dostupnych kusov"/>
                <button name="submit">pridaj</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>