<?php
include '../ctrl/event.php';

$idhotel = $_COOKIE['idhotel'];

foreach ($event->ourEvent($idhotel) as $row) {
	$iconHotel = $hotel->get($idhotel, "icon");
	$namaHotel = $hotel->get($idhotel, "nama");
	echo "<a href='../event/".$row['idevent']."'>".
			"<div class='list'>".
				"<img src='../aset/gbr/".$row['cover']."'>".
				"<div class='ket'>".
					"<div class='wrap'>".
						"<div id='keterangan'>".
							"<h3>".$row['title']."</h3>".
							"<p><i class='fa fa-map-marker'></i> ".$row['address']."</p>".
						"</div>".
					"</div>".
					"<div id='hosted'>".
						"<div class='wrap'>".
							"<img src='../aset/gbr/".$iconHotel."' class='ke-kiri'>".
							"<div id='namaHotel'>Hosted by ".$namaHotel."</div>".
						"</div>".
					"</div>".
				"</div>".
			"</div>".
		 "</a>";
}

?>