<?php

include_once("../config/connectDB.php");
include_once("../class/UserLogin.php");

$connectDB = new Database();
    $db = $connectDB->getConnection();
    $user = new UserLogin($db);
    $user->logOut();
?>