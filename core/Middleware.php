<?php
session_start();

function isAuth()
{
    return isset($_SESSION["users"]);
}

function Auth()
{
    if (!isAuth()) {
        header("Location: /error/403.php");
        exit;
    }
}


