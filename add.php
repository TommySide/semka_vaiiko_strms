<?php
include "header.php";
if (isset($_POST["body"])) {


    header("Location: streamer.php?user=".$_POST["streamer"]);
    exit();
} else {
    header("Location: index.php");
    exit();
}
if (isset($_POST["produkt"])) {

    header("Location: streamer.php?user=".$_POST["streamer"]);
    exit();
} else {
    header("Location: index.php");
    exit();
}
