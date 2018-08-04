<?php
include '../ctrl/admin.php';

$username = $_POST['username'];
$pwd = $_POST['pwd'];

$admin->login($username, $pwd);
