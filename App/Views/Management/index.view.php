<?php

use App\Models\User;

$layout = 'auth';

    /** @var array $data */
?>

<div class="container">
    <div class="row">
        <div class="col col-xl-12 text-center">
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'chars') {
                    echo "<h4 class='text-danger text-center'>Nepovolene znaky</h4>";
                } else if ($_GET['error'] == 'nouser') {
                    echo "<h4 class='text-danger text-center'>Pouzivatel neexistuje</h4>";
                }
            }
            if (isset($_GET['success'])) {
                if ($_GET['success'] == 'delete') {
                    echo "<h4 class='text-success text-center'>Admin zmazany</h4>";
                } else if ($_GET['success'] == 'added') {
                    echo "<h4 class='text-success text-center'>Admin pridany</h4>";
                }
            }

            ?>
            <?php if ($data['streamers']) { ?>
                <h2 class="text-white text-start">Mas pristup ku tymto obchodom</h2>
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Meno obchodu</th>
                            <th scope="col">Akcie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php /** @var \App\Models\Streamer $streamer */
                        foreach ($data['streamers'] as $streamer) { ?>
                            <tr>
                                <th scope="row"><?= @$streamer->getIdStreamer(); ?></th>
                                <td><?= @$streamer->getName(); ?></td>
                                <td>
                                    <a href="?c=store&id=<?= @$streamer->getIdStreamer(); ?>" class="btn btn-primary"><i class="far fa-eye"></i></a>
                                    <a href="?c=store&a=edit&id=<?= @$streamer->getIdStreamer(); ?>"class="btn btn-success"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <h2 class="text-white">Nemas pristup ku ziadnym obchodom.</h2>
            <?php }
            if ($data['hasStore']) { ?>
                <br>
                <button onclick="showForm()" class=" btn btn-primary" style="float: right;">Pridaj admina</button>
                <form action="?c=management&a=addadmin" method="post" class="form-group" style="display: none;" id="formPridaj">
                    <div class="form-group">

                        <br>
                        <input type="text" name="name" class="form-control" placeholder="Zadaj meno, email alebo id pouzivatela">
                        <button class="btn btn-primary">Pridaj</button>
                    </div>
                </form>
            <?php }
            if ($data['managers']) { ?>
                <h2 class="text-white text-start">Kto manazuje tvoj obchod</h2>

                <table class="table table-bordered table-dark">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Meno</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Akcie</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php /** @var User $manager */
                    foreach ($data['managers'] as $manager) { ?>
                        <tr>
                            <th scope="row"><?= @$manager->getIdUser(); ?></th>
                            <td><?= @$manager->getNickname(); ?></td>
                            <td><?= @$manager->getEmail(); ?></td>
                            <td>
                                <form action="?c=management&a=deleteadmin" method="post">
                                    <input type="hidden" name="id" value="<?= @$manager->getIdUser(); ?>">
                                    <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</div>