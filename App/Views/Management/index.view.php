<?php
    $layout = 'auth';
    /** @var \App\Models\Streamer $data */

?>

<div class="container">
    <?php if ($data != NULL) { ?>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Streamer profile name</th>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php /** @var \App\Models\Streamer $streamer */
                        foreach ($data as $streamer) { ?>
                        <tr>
                            <th scope="row"><?= @$streamer->getIdStreamer(); ?></th>
                            <td><?= @$streamer->getSmallpopis(); ?></td>
                            <td><?= @$streamer->getName(); ?></td>
                            <td>
                                <a href="?c=store&id=<?= @$streamer->getIdStreamer(); ?>" class="btn btn-primary"><i class="far fa-eye"></i></a>
                                <a href="?c=store&a=edit&id=<?= @$streamer->getIdStreamer(); ?>"class="btn btn-success"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } else { ?>
        <h1 class="text-light">Nemas na starosti ziadne stream profily!</h1>
    <?php } ?>
</div>