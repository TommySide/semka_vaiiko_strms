<?php
$layout = 'auth';
/** @var Array $data */
?>
<div class="container-fluid">
    <div class="login-page">
        <div class="form text-white">
            <h2 class="text-center text-white">Login</h2>
            <br>
            <form class="login-form" action="<?= \App\Config\Configuration::REGISTER_URL ?>" method="post">
                <input type="text" name="nickname" class="text-white" placeholder="prihlásovacie meno"/>
                <input type="email" name="email" class="text-white" placeholder="email"/>
                <div class="inputicon">
                    <input type="password" name="password" onchange="heslaZhoda()" class="text-white" placeholder="heslo"/>
                    <i class="fa-regular fa-eye fa-lg" id="aa" onclick="showHidePwdReg()"></i>
                </div>
                <div class="inputicon">
                    <input type="password" name="password-rep" onkeyup="heslaZhoda()"  class="text-white" placeholder="zopakuj heslo"/>
                    <i class="fa-regular fa-eye fa-lg" id="bb" onclick="showHidePwdReg()"></i>
                </div>
                <h5 id="hesla"></h5>
                <button name="submit">registruj</button>
                <p class="message">Už si zaregistrovaný? <a href="<?= \App\Config\Configuration::LOGIN_URL ?>">Prihlás sa</a></p>
            </form>
        </div>
    </div>
</div>
