<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Strms</title>
    <link rel="stylesheet" href="style/stylegg.css">
    <script src="https://kit.fontawesome.com/85a6d0cbbe.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

<?php include_once "header.php"; ?>

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
    $db = new Dbh();
    $streamers = $db->getAllStreamers();

    /** @var Streamer $streamer */
    ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4" style="margin: 2em 10em;">
            <?php foreach ($streamers as $streamer) { ?>
                <a href="store.php?user=<?php echo $streamer->id_streamer; ?>" class="noa">
                    <div class="col mb-3">
                        <div class="card">
                            <img src="images/questionmark.jpg" class="card-img-top img-karta" alt="">
                            <div class="card-body">
                                <h5 class="card-title titulok"><?php echo $streamer->name; ?></h5>
                                <p class="card-text text-start"><?php echo $streamer->popis; ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
<?php include_once "footer.php"; ?>

</body>

</html>