<?php
    /** @var \App\Core\IAuthenticator $auth */
    /** @var int $data */
?>

<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white font-weight-bold" style="letter-spacing: 3px">Profile | <?php echo $auth->getLoggedUserName()."#".$auth->getLoggedUserId(); ?></h2>
            <br>
            <a href="?c=user&a=changepwd"><button name="pwd">Zmena hesla</button></a>
                <?php if ($data == 0) { ?>
                    <a href="?c=store&a=create"><button name="pwd">vytvor obchod</button></a>
                <?php } else { ?>
                    <a href="?c=store&id=<?= @$data ?>"><button name="pwd">otvor obchod</button></a>
                <?php } ?>
                    <a href="?c=management"><button name="pwd">zoznam obchodov</button></a>
                    <a href="?c=management"><button name="pwd">zoznam obchodov</button></a>
        </div>
    </div>
</div>