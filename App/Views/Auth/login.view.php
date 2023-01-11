<?php
$layout = 'auth';
/** @var Array $data */
?>
<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white">Login</h2>
            <br>
            <?= @$data['message'] ?>
            <form class="login-form" action="<?= \App\Config\Configuration::LOGIN_URL ?>" method="post">
                <input type="text" name="name" id="name" class="text-white" placeholder="prihlásovacie meno" required autofocus>
                <div class="inputicon">
                    <input type="password" name="password" id="pwd" class="text-white" placeholder="heslo"/>
                    <i class="fa-regular fa-eye fa-lg" id="icpwd" onclick="showHidePwd()"></i>
                </div>
                <button name="submit">prihlasit</button>
                <p class="message">Nie si registrovaný? <a href="<?= \App\Config\Configuration::REGISTER_URL ?>">Vytvor si účet</a></p>
                <p class="message">Zabudnuté heslo? <a href="#">Zmeň si ho tu</a></p>
            </form>
        </div>
    </div>
</div>
