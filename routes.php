<?php

// error_reporting(1);
$role = $_GET['role'];
$bag = $_GET['bag'];

if($role == "" and $bag == "") {
	include 'index.php';
}else if($role == "") {
	$lokasi = 'pages/'.$bag.'.php';
	if(file_exists($lokasi)) {
		include $lokasi;
	}else {
		header("location: ./error/404");
	}
}else if($bag == "") {
	$lokasi = 'pages/'.$role.'/dasbor.php';
	if(file_exists($lokasi)) {
		include $lokasi;
	}else {
		$lokasi = 'pages/'.$role.'/index.php';
		if(file_exists($lokasi)) {
			include $lokasi;
		}else {
			header("location: ../error/404");
		}
	}
}else {
	$lokasi = 'pages/'.$role.'/'.$bag.'.php';
	if($role == "event" && is_numeric($bag)) {
		$idevent = $bag;
		include 'pages/event.php';
	}else if($role == "hotel" && is_numeric($bag)) {
		$idhotel = $bag;
		include 'pages/hotel.php';
	}else if ($role == "restoran" && is_numeric($bag)) {
		$idresto = $bag;
		include 'pages/restoran.php';
	}else if ($role == "invoice" && is_numeric($bag)) {
		$idinvoice = $bag;
		include 'pages/invoice.php';
	}
	else {
		if(file_exists($lokasi)) {
			include $lokasi;
		}else {
			header("location: ../error/404");
		}
	}
}
