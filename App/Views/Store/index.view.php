<?php

use App\Models\Product;
use App\Models\Streamer;
use App\Models\Points;

$layout = 'root';

/** @var \App\Core\IAuthenticator $auth */
/** @var Array $data */
/** @var Streamer $streamer */
$streamer = $data['streamer'];
/** @var Points $points */
$points = $data['points'];
/** @var Product[] $products */
$products = $data['products'];
$manage = $data['manage'];
$owner = $data['owner'];
$message = (isset($data['message'])) ? $data['message'] : "";
?>


<div class="container-fluid">
    <section class="telo text-white">
        <div class="row">
            <div class="col-xl text-center">
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'nomngt') {
                        echo "<h4 class='text-danger text-center'>Nie si oprávnený</h4>";
                    } else if ($_GET['error'] == '') {
                        echo "<h4 class='text-danger text-center'>Pouzivatel neexistuje</h4>";
                    }
                }
                if (isset($_GET['success'])) {
                    if ($_GET['success'] == 'profilecreated') {
                        echo "<h4 class='text-success text-center'>Profil vytvorený</h4>";
                    } else if ($_GET['success'] == 'productdeleted') {
                        echo "<h4 class='text-success text-center'>Produkt vymazaný</h4>";
                    } else if ($_GET['success'] == 'productadded') {
                        echo "<h4 class='text-success text-center'>Produkt pridaný</h4>";
                    }
                }

                ?>
                <img class="img-thumbnail picture" src="public/images/questionmark.jpg" alt="Profile picture">

                <h2 class="text-info"><?php echo $streamer->getName(); ?></h2>
                <h4 class="text-white"><?php echo $streamer->getPopis(); ?></h4>
                <h5 class="text-secondary"><?php echo $streamer->getSmallpopis(); ?></h5>

                <section class="info text-start">
                    <?php if ($auth->isLogged()) { ?>
                        <div><i class="fa-solid fa-coins"></i> You currently have <?php if ($points != NULL) {
                            echo number_format($points->getPoints(),0, ",", "."); } else { echo "0"; } ?> points</div>
                        <div><i class="fa-solid fa-globe"></i> Your rank will be here.</div>
                        <div><i class="fa-solid fa-heart"></i> You can receive 1 point for each minute watched.</div>
                    <?php } else { ?>
                        <div><i class="fa-solid fa-coins"></i> Log in to see.</div>
                        <div><i class="fa-solid fa-globe"></i> Log in to see.</div>
                        <div><i class="fa-solid fa-heart"></i> Log in to see.</div>
                    <?php } ?>

                </section>
                <section class="icons">
                    <?php if ($streamer->getWww()) { ?><a href="<?php echo $streamer->getWww(); ?>"><i class="fa-solid fa-globe fa-2x"></i></a><?php } ?>
                    <?php if ($streamer->getFb()) { ?><a href="<?php echo $streamer->getFb(); ?>"><i class="fa-brands fa-facebook fa-2x"></i></a><?php } ?>
                    <?php if ($streamer->getDiscord()) { ?><a href="<?php echo $streamer->getDiscord(); ?>"><i class="fa-brands fa-discord fa-2x"></i></a><?php } ?>
                    <?php if ($streamer->getYoutube()) { ?><a href="<?php echo $streamer->getYoutube(); ?>"><i class="fa-brands fa-youtube fa-2x"></i></a><?php } ?>
                    <?php if ($streamer->getInstagram()) { ?><a href="<?php echo $streamer->getInstagram(); ?>"><i class="fa-brands fa-square-instagram fa-2x"></i></a><?php } ?>
                    <?php if ($streamer->getTelegram()) { ?><a href="<?php echo $streamer->getTelegram(); ?>"><i class="fa-brands fa-telegram fa-2x"></i></a><?php } ?>
                    <?php if ($streamer->getTwitter()) { ?><a href="<?php echo $streamer->getTwitter(); ?>"><i class="fa-brands fa-twitter fa-2x"></i></a><?php } ?>
                    <?php if ($streamer->getTwitch()) { ?><a href="<?php echo $streamer->getTwitch(); ?>"><i class="fa-brands fa-twitch fa-2x"></i></a><?php } ?>
                </section>

                <?php if ($manage || $owner) { ?>
                    <div class="form-group">
                        <form action="?c=store&a=edit" method="post">
                            <input type="hidden" name="id" value="<?php echo $streamer->getIdStreamer(); ?>">
                            <button class="btn btn-primary" name="pridaj">Upravit profil</button>
                        </form>
                        <form action="?c=store&a=add" method="post">
                            <input type="hidden" name="id" value="<?php echo $streamer->getIdStreamer(); ?>">
                            <button class="btn btn-primary" name="pridaj">Pridaj produkt</button>
                        </form>
                        <form action="?c=management" method="post">
                            <input type="hidden" name="id" value="<?php echo $streamer->getIdStreamer(); ?>">
                            <button class="btn btn-primary" name="pridaj">Manazment</button>
                        </form>
                        <form method="post" action="?c=store&a=addpoints&id=<?php echo $streamer->getIdStreamer(); ?>" style="padding: 5px;">
                            <input type="text" style="margin: 5px;" class="form-control" name="komu" placeholder="Komu pridat body">
                            <input type="number" style="margin: 5px;" class="form-control" name="kolko" placeholder="Kolko bodov pridat">
                            <button class="btn btn-primary" name="body">Pridaj body</button>
                        </form>
                    </div>
                <?php } ?>
            </div>

            <div class="col col-xl-9 text-center main-karty">
                <h1 class="text-start"> <?php echo $streamer->getName(); ?> store</h1>
                <?php if ($products != null) { ?>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
                    <?php
                        /** @var Product $product */
                        foreach ($products as $product) {
                            if (!$product->getHidden() || $owner || $manage) { ?>
                                <div class="col mb-4">
                                    <div class="card">
                                        <img src="public/images/questionmark.jpg" class="card-img-top img-karta" alt="">
                                        <div class="card-body row">
                                            <h5 class="card-title titulok"><?php echo $product->getTitul(); if ($product->getHidden()) { ?><h6>(hidden)</h6> <?php } ?></h5>
                                            <p class="card-text text-start card-text-custom"><?php echo $product->getPopis(); ?></p>
                                            <p class="card-text text-start"><i class="fa-solid fa-coins"> <?php echo $product->getCena(); ?> </i></p>
                                            <p class="card-text text-start"><i class="fa-solid fa-cart-flatbed"> <?php echo $product->getPocet(); ?></i></p>
                                            <br>
                                            <?php if ($auth->isLogged()) { ?>
                                                <form>
                                                    <a class="btn btn-primary">Zakupit</a>
                                                    <?php if ($manage || $owner) { ?>
                                                        <a href="?c=store&a=editproduct&id=<?php echo $product->getIdProduct()."&idS=".$streamer->getIdStreamer(); ?>" class="btn btn-warning">Upravit</a>
                                                        <a href="?c=store&a=delete&id=<?php echo $product->getIdProduct()."&idS=".$streamer->getIdStreamer(); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Vymazat</a>
                                                    <?php } ?>
                                                </form>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        }
                    } else {
                        echo "<h1 class='text-warning text-start'>Store doesnt have items!</h1>";
                    } ?>
                </div>
            </div>
        </div>
    </section>
</div>