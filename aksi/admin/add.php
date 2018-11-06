<?php
include '../ctrl/admin.php';

$idadmin = null;
$username = $_POST['username'];
$pwd = $_POST['pwd'];
$time = time();

$admin->add($idadmin, $username, $pwd, $time);
?>
