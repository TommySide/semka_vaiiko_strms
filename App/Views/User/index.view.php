<?php
    /** @var \App\Core\IAuthenticator $auth */
    /** @var int $data */
?>

<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white font-weight-bold" style="letter-spacing: 3px">Profile | <?php echo $auth->getLoggedUserName()."#".$auth->getLoggedUserId(); ?></h2>
            <br>
            <a href="?c=user&a=changepwd"><button>Zmena hesla</button></a>
                <?php if ($data == 0) { ?>
                    <a href="?c=store&a=create"><button>vytvor obchod</button></a>
                <?php } else { ?>
                    <a href="?c=store&id=<?= @$data ?>"><button>otvor obchod</button></a>
                <?php } ?>
                    <a href="?c=management"><button>zoznam obchodov</button></a>

                    <a href="?c=user&a=delete" onclick="return confirm('Isto chceš zmazať svoj účet a spolu s tým (ak existuje) stream profil?')"><button class="bg-danger">zmazat ucet</button></a>
        </div>
    </div>
</div>