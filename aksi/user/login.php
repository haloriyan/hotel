<?php
include '../ctrl/user.php';

$email = $_POST['email'];
$pwd = $_POST['pwd'];

$user->login($email, $pwd);