<?php /** @var \App\Core\IAuthenticator $auth */ ?>

<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white font-weight-bold" style="letter-spacing: 3px">Profile | <?php echo $auth->getLoggedUserName()."#".$auth->getLoggedUserId(); ?></h2>
            <br>
            <a href="?c=user&a=changepwd"><button name="pwd">Zmena hesla</button></a>
                <form action="#" method="post">
                    <button name="create">create streamer profile</button>
                </form>
        </div>
    </div>
</div>