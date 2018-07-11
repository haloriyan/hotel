<?php
include '../ctrl/user.php';

$id = rand(1, 999999999);
$name = $_POST['name'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$added = time();

$user->register($id, $email, $pwd, $name, $added);