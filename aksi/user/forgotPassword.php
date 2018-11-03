<?php
include '../ctrl/token.php';

if($_POST['email'] == "") {
	echo "<div class='note'>".
			$_COOKIE['kukiForgot'].
			"<span class='ke-kanan' id='xNote' onclick='hide()'><i class='fa fa-close'></i></span>".
		 "</div>";
}else {
	$email = $_POST['email'];
	$tipes = $_POST['tipe'];
	$token->createToken($email, $tipes);
}