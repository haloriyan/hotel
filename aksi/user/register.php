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

	$to = $email;
	$subjek = "Welcome to Dailyhotels";
	$header = "From: no-reply@dailyhotels.id";
	$header .= "Content-Type: text/html; charset=UTF-8";
	$message = "";

	@mail($to, $subjek, $message, $header);
}