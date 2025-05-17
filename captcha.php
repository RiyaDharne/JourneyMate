<?php
session_start();
$captcha = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 6);
$_SESSION["captcha"] = $captcha;
echo $captcha;
?>
