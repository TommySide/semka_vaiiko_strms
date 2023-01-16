<?php
/** @var string $data */
?>
<div class="container-fluid">
        <div class="login-page">
            <div class="form text-white">
                <h2 class="text-center text-white">Change password</h2>
                <br>
                <?= @$data ?>
                <form class="login-form" action="?c=user&a=changepwd" method="post">
                    <input type="password" name="passwordCurrent" class="text-white" placeholder="aktuálne heslo"/>
                    <input type="password" name="password" class="text-white" placeholder="nové heslo"/>
                    <input type="password" name="passwordRepeat" class="text-white" placeholder="nové heslo znova"/>
                    <button name="submit">ZMEN HESLO</button>
                </form>
            </div>
        </div>
    </div>