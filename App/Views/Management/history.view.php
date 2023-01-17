<?php

$layout = 'auth';

use \App\Models\Boughtproducts;
use \App\Models\Streamer;
use \App\Models\Product;

/** @var \App\Core\IAuthenticator $auth */
/** @var array $data */
/** @var Streamer[] $streamers */
$streamers = $data["streamers"];
/** @var Product[] $products */
$products = $data["products"];
/** @var Boughtproducts $bproducts */
$bproducts = $data["bp"];
?>


<div class="container-fluid">
    <section class="telo text-white">
        <div class="row">
            <div class="col col-xl-12 text-center">
                <?php if ($data) { ?>
                    <h2 class="text-white text-start">Historia tvojích nákupov</h2>
                    <table class="table table-bordered table-dark">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Meno produktu</th>
                            <th scope="col">Meno streamera</th>
                            <th scope="col">Dátum</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php /** @var array $item */
                        for ($i = 0; $i < (count($data['bp'])); $i++) {
                           ?>
                            <tr>
                                <th scope="row"><?= @$i; ?></th>
                                <td><?= @$products[$i]->getTitul(); ?></td>
                                <td><?= @$streamers[$i]->getName(); ?></td>
                                <td><?= @$bproducts[$i]->getDatum(); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <h2 class="text-danger">Ked spravis nakup tu sa objavi</h2>
                <?php } ?>
            </div>
        </div>
    </section>
</div>