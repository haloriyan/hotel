<?php

$namaPertama = 'Riyan';
$namaKedua = 'Satria';
$kolom = [$namaPertama,$namaKedua];

$valPertama = 'Adi';
$valKedua = 'Tama';
$value = [$valPertama,$valKedua];

function edit($id, $kolom, $value) {
	$query = "UPDATE event SET ".$kolom." = '".$value."' WHERE idevent = '".$id."' <br />";
	return $query;
}

for ($i=0; $i < count($kolom); $i++) { 
	echo edit('123', $kolom[$i], $value[$i]);
}