<?php
include '../ctrl/user.php';

$name = $_POST['name'];

if($name == "") {
	echo $_COOKIE['msgReg'];
}else {
	$id = rand(1, 999999999);
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	$added = time();

	$user->register($id, $email, $pwd, $name, $added);
}