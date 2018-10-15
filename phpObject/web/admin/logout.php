<?php
session_start();
unset($_SESSION["login"]);
$msg="退出成功";
$href="login.php";
include("message.php");
?>