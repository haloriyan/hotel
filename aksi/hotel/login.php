<?php
include '../ctrl/hotel.php';

$email = $_POST['email'];
$pwd = $_POST['pwd'];

$hotel->login($email, $pwd);