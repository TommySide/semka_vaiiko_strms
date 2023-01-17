<?php
use App\Models\Streamer;

/** @var Streamer[] $data */
?>

<div class="row">
    <div class="container-fluid">
        <div class="text-white" style="margin: 5em 0em;">
            <h1 class="text-center">Odmeňte svojich divákov!</h1>
            <h2 class="text-center">Engage, earn and spend</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="bg-white text-black col col-xl-12 text-center main-karty">
        <br>
        <h1>Dôverované najlepšími</h1>
        <h3>Prezrite si obchody naších najnovších klientov</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4" style="margin: 3em 10em;">
            <?php foreach ($data as $streamer) { ?>
                <a href="?c=store&id=<?php echo $streamer->getIdStreamer(); ?>" class="noa">
                    <div class="col mb-4">
                        <div class="card">
                            <img src="public/images/questionmark.jpg" class="card-img-top img-karta" alt="">
                            <div class="card-body">
                                <h5 class="card-title titulok"><?php echo $streamer->getName(); ?></h5>
                                <p class="card-text text-start"><?php echo $streamer->getPopis(); ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</div>


