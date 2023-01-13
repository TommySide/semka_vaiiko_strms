<?php
use App\Models\Streamer;

/** @var Streamer[] $data */
?>

<div class="container-fluid">
    <div class="text-white" style="margin: 5em 0em;">
        <h1 class="text-center">Reward your viewers!</h1>
        <h2 class="text-center">Engage, earn and spend!</h2>
    </div>
</div>
<div class="bg-white text-black text-center" style="padding: 2em 0em;">
    <h1>Trusted by the best</h1>
    <h3>Some of the newest content creators!</h3>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4" style="margin: 2em 10em;">
        <?php foreach ($data as $streamer) { ?>
            <a href="?c=store&a=index&id=2" class="noa">
                <div class="col mb-4">
                    <div class="card">
                        <img src="public/images/questionmark.jpg" class="card-img-top img-karta" alt="">
                        <div class="card-body">
                            <h5 class="card-title titulok"><?php echo $streamer->getName(); ?></h5>
                            <p class="card-text text-start"><?php echo $streamer->getSmallpopis(); ?></p>
                        </div>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>
</div>
