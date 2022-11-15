<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STRMS | Store</title>
</head>
<?php include "header.php";?>
<body>

<?php

    if (isset($_GET["user"])) {
        if (!is_numeric($_GET["user"])) {
            echo "<h1 class='text-center text-danger' style='margin-top: 1em;'>This streamer doesn't exist!</h1>";
            exit();
        }

        include "classes/Streamer.php";
        $streamer = new Streamer($_GET["user"]);
        $streamer->loadStreamer();
    } else {
        header("Location: index.php?error=enterstreamer");
        exit();
    }
?>
<div class="container-fluid">
    <section class="telo text-white">
        <div class="row">
            <div class="col-xl text-center">
                <img class="img-thumbnail picture" src="images/questionmark.jpg" alt="Profile picture">

                <h4><?php echo $streamer->getPopis(); ?></h4>
                <h5 class="text-secondary"><?php echo $streamer->getSmallpopis(); ?></h5>

                <section class="info text-start">
                    <?php if (isset($_SESSION["nickname"])) { ?>
                        <div><i class="fa-solid fa-coins"></i> You currently have <?php echo $streamer->getPoints(); ?> points</div>
                        <div><i class="fa-solid fa-globe"></i> Your rank will be here.</div>
                        <div><i class="fa-solid fa-heart"></i> You can receive 1 point for each minute watched.</div>
                    <?php } else { ?>
                        <div><i class="fa-solid fa-coins"></i> Login to see.</div>
                        <div><i class="fa-solid fa-globe"></i> Login to see.</div>
                        <div><i class="fa-solid fa-heart"></i> Login to see.</div>
                    <?php } ?>

                </section>
                <section class="icons">
                    <a href="#"><i class="fa-solid fa-globe fa-2x"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook fa-2x"></i></a>
                    <a href="#"><i class="fa-brands fa-discord fa-2x"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube fa-2x"></i></a>
                    <a href="#"><i class="fa-brands fa-square-instagram fa-2x"></i></a>
                    <a href="#"><i class="fa-brands fa-telegram fa-2x"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter fa-2x"></i></a>
                </section>

                <?php if (isset($_SESSION["uId"]) && $streamer->isManagement()) { ?>
                    <div class="form-group">
                        <form action="add.php" method="post">
                            <input type="text" class="form-control" placeholder="Komu pridat body">
                            <input type="number" class="form-control" placeholder="Kolko bodov pridat">
                            <button class="btn btn-primary" name="body">Pridaj body</button>
                        </form>
                    </div>
                <?php } ?>
            </div>

            <div class="col col-xl-9 text-center main-karty">
                <h1 class="text-start"> <?php echo $streamer->getName(); ?> store</h1>
                <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
                    <?php
                    if (isset($_GET["error"])) {
                        if ($_GET["noproducts"]) {
                            echo "<h1 class='text-danger'>No products!</h1>";
                            exit();
                        }
                    }
                    $products = $streamer->getProducts();

                    foreach ($products as $product) { ?>
                        <div class="col mb-4">
                            <div class="card">
                                <img src="images/questionmark.jpg" class="card-img-top img-karta" alt="">
                                <div class="card-body">
                                    <h5 class="card-title titulok"><?php echo $product->titul; ?></h5>
                                    <p class="card-text text-start"><?php echo $product->popis; ?></p>
                                    <p class="card-text text-start"><i class="fa-solid fa-coins"> <?php echo $product->cena; ?></i> </p>
                                    <p class="card-text text-start"><i class="fa-solid fa-cart-flatbed"> <?php echo $product->pocet; ?></i></p>
                                    <button class="btn btn-primary">Zakupit</button>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
<?php include "footer.php";?>
</html>

<?php
