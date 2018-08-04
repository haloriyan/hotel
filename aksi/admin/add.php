<?php
include '../ctrl/admin.php';

$idadmin = rand(1, 999);
$username = $_POST['username'];
$pwd = $_POST['pwd'];
$time = time();

$admin->add($idadmin, $username, $pwd, $time);
?>
