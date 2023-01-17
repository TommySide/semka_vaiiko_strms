<?php

$layout = 'auth';


/** @var \App\Core\IAuthenticator $auth */
/** @var array $data */
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
                            <th scope="col">Meno</th>
                            <th scope="col">Email</th>
                            <th scope="col">Body</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php /** @var array $item */
                        $i = 0;
                        foreach ($data as $item) {
                            ?>
                            <tr>
                                <th scope="row"><?= @$i; ?></th>
                                <td><?= @$item["user"]; ?></td>
                                <td><?= @$item["email"]; ?></td>
                                <td><?= @$item["points"]; ?></td>
                            </tr>
                        <?php
                        $i++;
                        } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <h2 class="text-danger">Ked spravis nakup tu sa objavi</h2>
                <?php } ?>
            </div>
        </div>
    </section>
    </div><?php
