<?php
include '../database/config.php';

if($_POST['email'] == "") {
	echo "<div class='note'>".
			$_COOKIE['kukiForgot'].
			"<span class='ke-kanan' id='xNote' onclick='hide()'><i class='fa fa-close'></i></span>".
		 "</div>";
}else {
	$email = $_POST['email'];
	$tipes = $_POST['tipe'];
	// $token->createToken($email, $tipes);
	// $tokek->contoh();
	// $q = $ctrl->tabel('tokek')->tambah(['tokeks' => '123'])->eksekusi();
	$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
	$insert = msyqli_query($conn, "INSERT INTO tokek(tokeks) VALUES('123')");
}