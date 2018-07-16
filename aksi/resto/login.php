<?php
include '../ctrl/resto.php';

$email = $_POST['email'];
$password = $_POST['pwd'];

$resto->login($email, $password);