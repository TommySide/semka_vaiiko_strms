<?php
use \App\Models\Streamer;

    /** @var array $data */
    /** @var Streamer $streamer */
    $streamer =  $data['streamer'];
    /** @var string $message  */
    $message = $data['message'];
?>

<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white"><?= @$message; ?></h2>
            <br>

            <form class="login-form" method="post" action="?c=store&a=submit">
                <input type="text" name="name" class="text-white" value="<?= @$streamer->getName(); ?>" placeholder="prezývka"/>
                <textarea class="text-white" name="popis" rows="3" placeholder="popis" style="resize: none;"><?= @$streamer->getPopis(); ?></textarea>
                <input type="text" name="smallpopis" class="text-white" value="<?= @$streamer->getSmallpopis(); ?>" placeholder="maly popis"/>
                <input type="text" name="www" class="text-white" value="<?= @$streamer->getWww(); ?>" placeholder="webstránka"/>
                <input type="text" name="fb" class="text-white" value="<?= @$streamer->getFb(); ?>" placeholder="facebook"/>
                <input type="text" name="discord" class="text-white" value="<?= @$streamer->getDiscord(); ?>" placeholder="discord"/>
                <input type="text" name="youtube" class="text-white" value="<?= @$streamer->getYoutube(); ?>" placeholder="youtube"/>
                <input type="text" name="instagram" class="text-white" value="<?= @$streamer->getInstagram(); ?>" placeholder="instagram"/>
                <input type="text" name="telegram" class="text-white" value="<?= @$streamer->getTelegram(); ?>" placeholder="telegram"/>
                <input type="text" name="twitter" class="text-white" value="<?= @$streamer->getTwitter(); ?>" placeholder="twitter"/>
                <?php if ($streamer->getIdStreamer()) { ?>
                    <input type="hidden" name="id" value="<?= @$streamer->getIdStreamer(); ?>">
                <?php } ?>
                <button name="submit">uloz</button>
            </form>
        </div>
    </div>
</div>