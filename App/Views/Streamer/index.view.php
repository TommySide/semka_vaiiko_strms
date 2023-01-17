<?php

use App\Models\Streamer;

$layout = 'root';

/** @var \App\Core\IAuthenticator $auth */
/** @var array $data */

?>


<div class="container-fluid">
    <section class="telo text-white">
        <div class="row">
            <div class="col-xl text-center">
                <form action="?c=streamer&a=find" method="post">
                    <div class="form-group mb-3">
                        <input type="search" placeholder="Meno streamera co hladas" name="search" class="form-control">
                    </div>
                </form>
                <?= @$data['message']; ?>
            </div>
            <div class="col col-xl-9 text-center">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                    <?php /** @var Streamer $streamer */
                    foreach ($data['streamer'] as $streamer) { ?>
                        <a href="?c=store&id=<?= @$streamer->getIdStreamer(); ?>" style="text-decoration: none;">
                            <div class="col mb-4">
                                <div class="card">
                                    <img src="public/images/questionmark.jpg" class="card-img-top img-karta" alt="">
                                    <div class="card-body row">
                                        <h5 class="card-title titulok"><?= @$streamer->getName(); ?></h5>
                                        <p class="card-text text-start card-text-custom"><?= @$streamer->getPopis(); ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div>