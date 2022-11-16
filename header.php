<?php session_start(); ?>
<header id="header">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand logo">STRMS</a>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navig">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navig">
                <ul class="navbar-nav">
                    <li class="">
                        <a class="" href="index.php">Home</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if (!isset($_SESSION["nickname"])) {?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="signup.php">Register</a></li>
                    <?php } else { ?>
                        <li><a href="profile.php?user=<?php echo $_SESSION['uId']; ?>"><?php echo $_SESSION["nickname"]; ?></a></li>
                        <li><a href="includes/logout.inc.php">Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>