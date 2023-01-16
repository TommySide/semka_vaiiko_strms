<?php
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/js/script.js"></script>
    <script src="https://kit.fontawesome.com/85a6d0cbbe.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a href="?c=home" class="navbar-brand logo">STRMS</a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navig">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navig">
            <ul class="navbar-nav">
                <li class="">
                    <a class="" href="?c=home">Home</a>
                </li>
                <li class="">
                    <a class="" href="?c=contact">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if (!$auth->isLogged()) { ?>
                    <li><a href="<?= \App\Config\Configuration::LOGIN_URL ?>">Login</a></li>
                    <li><a href="<?= \App\Config\Configuration::REGISTER_URL ?>">Register</a></li>
                <?php } else { ?>
                    <li><a href="?c=user"><?php echo $auth->getLoggedUserName(); ?></a></li>
                    <li><a href="?c=auth&a=logout">Logout</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>
</body>
</html>
