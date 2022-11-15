<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Strms | Home</title>
    <link rel="stylesheet" href="style/stylegg.css">
    <script src="https://kit.fontawesome.com/85a6d0cbbe.js" crossorigin="anonymous"></script>
</head>
<?php include_once "header.php"; ?>
<body>
<div class="container-fluid">
    <div class="text-white" style="margin: 5em 0em;">
        <h1 class="text-center">Reward your viewers!</h1>
        <h2 class="text-center">Engage, earn and spend!</h2>
    </div>
</div>
<div class="bg-white text-black text-center" style="padding: 2em 0em;">
    <h1>Trusted by the best</h1>
    <h3>Some of the newest content creators!</h3>
<?php
include "classes/Dbh.class.php";
$d = new Dbh();
$streamers = $d->getAllStreamers();

/** @var Streamer $streamer */
foreach ($streamers as $streamer) { ?>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4" style="margin: 2em 10em;">
        <div class="col mb-3">
            <div class="card">
                <img src="images/questionmark.jpg" class="card-img-top img-karta" alt="">
                <div class="card-body">
                    <h5 class="card-title titulok"><?php echo $streamer->getName(); ?></h5>
                    <p class="card-text text-start">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, dicta dolores eos expedita fugiat odit!</p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

</div>



</body>
<?php include_once "footer.php"; ?>
</html>