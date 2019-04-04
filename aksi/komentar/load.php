<?php
include '../ctrl/komentar.php';

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

if($sesiResto != "") {
    // nggawe resto
    $idhotel = $resto->info($sesiResto, "idhotel");
    $idresto = $resto->info($sesiResto, "idresto");
    $pakai	 = "resto";
}else {
    // nggawe hotel
    $idhotel = $hotel->get($sesiHotel, "idhotel");
    $idresto = 0;
    $pakai	 = "hotel";
}

$id = $_POST['id'];
$all = $komen->all($id);

if($all == "tiada") {
	echo "<h3>No comments here</h3>";
}else {
	$i = 0;
	foreach ($all as $r) {
		$urut = $i++;
		$namaUser = $user->info($r['iduser'], 'nama');

		if($pakai == "hotel") {
			$cek = $ctrl->query("SELECT * FROM event WHERE idevent = '$id' AND idhotel = '$idhotel'");
			$cek = $ctrl->hitung($cek);
		}else {
			$cek = $ctrl->query("SELECT * FROM event WHERE idevent = '$id' AND id_resto = '$idresto'");
			$cek = $ctrl->hitung($cek);
		}
		$control = "";
		if($cek != 0) {
			$control = "<button class='merah-2' style='border: none;padding: 10px 20px;' onclick='deleteComment(`".$r['idkomentar']."`)'>Delete</button>";
			if($r['reply'] == '') {
				$control .= '
				<div class="reply">
					<form id="formReply" style="margin-top: 20px;" onsubmit="hehe(`'.$urut.'`);return false">
						<div class="box" contenteditable="true" id="balasan'.$urut.'"></div>
						<input type="hidden" id="idkomen'.$urut.'" value="'.$r['idkomentar'].'">
						<button class="tbl merah-2" style="position: relative;top: -72px;"><i class="fa fa-paper-plane"></i></button>
					</form>
				</div>';
			}else {
				$control .= "<div class='reply'>
								<h3>Reply :</h3>
								<p>".$r['reply']."</p>".
								"<button style='border: none;padding: 10px 20px;' class='merah-2' onclick='deleteReply(`".$r['idkomentar']."`)'>Delete</button>".
							 "</div>";
			}
		}else {
			if($r['reply'] != '') {
				$control .= "<div class='reply'>
								<h3>Reply :</h3>
								<p>".$r['reply']."</p>".
							 "</div>";
			}
		}
		echo "<div class='komen'>".
				"<h3>".$namaUser."</h3>".
				"<p>".$r['komentar']."</p>".
				$control.
			 "</div>";
	}
}