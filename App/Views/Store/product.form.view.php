<?php
use \App\Models\Product;

    /** @var array $data */
    /** @var Product $product */
    $product =  $data['product'];
    /** @var string $message  */
    $message = $data['message'];
    /** @var int $message  */
    $idStreamer = $data['streamer'];
?>

<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white"><?= @$message; ?></h2>
            <br>
            <form class="login-form" method="post" action="?c=store&a=submitproduct">
                <?php if ($product->getIdProduct()) { ?>
                    <input type="hidden" name="id" value="<?= @$product->getIdProduct(); ?>">
                <?php } ?>
                <input type="text" name="titul" class="text-white" value="<?= @$product->getTitul(); ?>" placeholder="Titulok produktu"/>
                <input type="text" name="popis" class="text-white" value="<?= @$product->getPopis(); ?>" placeholder="Popis produktu"/>
                <input type="number" name="cena" class="text-white" value="<?= @$product->getCena(); ?>" placeholder="Cena produktu"/>
                <input type="number" name="kusy" class="text-white" value="<?= @$product->getPocet(); ?>" placeholder="Pocet dostupnych kusov"/>
                <input type="hidden" value="<?= @$idStreamer; ?>" name="idStreamer">
                <div>Je schovatý?</div>
                <label class="switch">
                    <input type="checkbox" name="hidden" <?php if ($product->getHidden()) {echo "checked"; } ?>>
                    <span class="slider round"></span>
                </label>
                <br><br>
                <button name="submit">pridaj</button>
            </form>
        </div>
    </div>
</div>