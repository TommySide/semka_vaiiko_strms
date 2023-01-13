<?php

use App\Models\Product;
use App\Models\Streamer;

/** @var \App\Core\IAuthenticator $auth */
/** @var Product[] $products */
/** @var Streamer $streamer */
?>


<div class="container-fluid">
    <section class="telo text-white">
        <div class="row">
            <div class="col-xl text-center">
                <img class="img-thumbnail picture" src="public/images/questionmark.jpg" alt="Profile picture">

                <h4><?php echo $streamer->getPopis(); ?></h4>
                <h5 class="text-secondary"><?php echo $streamer->getSmallpopis(); ?></h5>

                <section class="info text-start">
                    <?php if ($auth->isLogged()) { ?>
                        <div><i class="fa-solid fa-coins"></i> You currently have <?php echo $streamer->(); ?> points</div>
                        <div><i class="fa-solid fa-globe"></i> Your rank will be here.</div>
                        <div><i class="fa-solid fa-heart"></i> You can receive 1 point for each minute watched.</div>
                    <?php } else { ?>
                        <div><i class="fa-solid fa-coins"></i> Log in to see.</div>
                        <div><i class="fa-solid fa-globe"></i> Log in to see.</div>
                        <div><i class="fa-solid fa-heart"></i> Log in to see.</div>
                    <?php } ?>

                </section>
                <section class="icons">
                    <a href="<?php echo $streamer->www ?>"><i class="fa-solid fa-globe fa-2x"></i></a>
                    <a href="<?php echo $streamer->fb ?>"><i class="fa-brands fa-facebook fa-2x"></i></a>
                    <a href="<?php echo $streamer->discord ?>"><i class="fa-brands fa-discord fa-2x"></i></a>
                    <a href="<?php echo $streamer->youtube ?>"><i class="fa-brands fa-youtube fa-2x"></i></a>
                    <a href="<?php echo $streamer->instagram ?>"><i class="fa-brands fa-square-instagram fa-2x"></i></a>
                    <a href="<?php echo $streamer->telegram ?>"><i class="fa-brands fa-telegram fa-2x"></i></a>
                    <a href="<?php echo $streamer->twitter ?>"><i class="fa-brands fa-twitter fa-2x"></i></a>
                </section>

                <?php if (isset($_SESSION["uId"]) && $streamerContr->isManagement()) { ?>
                    <?php
                    if (isset($_GET["success"])) {
                        if ($_GET["success"] == "added") {
                            echo "<h4 class='text-success'>Produkt pridany.</h4>";
                        } else if ($_GET["success"] == "pointsadded") {
                            echo "<h4 class='text-success'>Body pridane.</h4>";
                        }
                    }
                    ?>
                    <h5 class="text-success"></h5>
                    <div class="form-group">
                        <form action="manage.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $streamer->id_streamer; ?>">
                            <button class="btn btn-primary" name="pridaj">Pridaj produkt</button>
                        </form>
                        <br>
                        <form method="post" style="padding: 5px;">
                            <input type="text" style="margin: 5px;" class="form-control" name="komu" placeholder="Komu pridat body">
                            <input type="number" style="margin: 5px;" class="form-control" name="kolko" placeholder="Kolko bodov pridat">
                            <button class="btn btn-primary" name="body">Pridaj body</button>
                        </form>
                    </div>
                <?php } ?>
            </div>

            <div class="col col-xl-5 text-center main-karty">
                <h1 class="text-start"> <?php echo $streamer->name; ?> store</h1>
                <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
                    <?php

                    /** @var Product $product */
                    if (!($products = $streamerContr->getProducts())) {
                        echo "<h1 class='text-danger'>No products!</h1>";
                        exit();
                    }

                    foreach ($products as $product) { ?>
                        <div class="col mb-4">
                            <div class="card">
                                <img src="images/questionmark.jpg" class="card-img-top img-karta" alt="">
                                <div class="card-body">
                                    <h5 class="card-title titulok"><?php echo $product->titul; ?></h5>
                                    <p class="card-text text-start"><?php echo $product->popis; ?></p>
                                    <p class="card-text text-start"><i class="fa-solid fa-coins"> <?php echo $product->cena; ?></i> </p>
                                    <p class="card-text text-start"><i class="fa-solid fa-cart-flatbed"> <?php echo $product->pocet; ?></i></p>


                                    <form method="post">
                                        <input type="hidden" name="id" value="<?php echo $product->id_produkt; ?>">
                                        <button class="btn btn-primary">Zakupit</button>
                                        <?php if (isset($_SESSION["uId"]) && $streamerContr->isManagement()) { ?>
                                            <button class="btn btn-danger" name="delete" onclick="return confirm('Are you sure you want to delete?')">Vymazat</button>
                                        <?php } ?>
                                    </form>


                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div>