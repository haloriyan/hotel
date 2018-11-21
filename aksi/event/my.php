<?php
include '../ctrl/event.php';

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

$category = $_COOKIE['category'];
$month = $_COOKIE['month'];
$pakaiAkun = $_COOKIE['pakaiAkun'];

if($pakaiAkun == "resto") {
	// nggawe resto
	$myId = $resto->info($sesiResto, "idresto");
	$load = $event->myForResto($myId, '', $category, $month);
}else {
    // nggawe hotel
	$myId = $hotel->get($sesiHotel, "idhotel");
	$load = $event->my($myId, '', $category, $month);
}

if($load == "kosong") {
	if($category != '' or $month != '') {
		echo 'You dont have listing with this filter';
	}else {
		echo "You dont have any listing. <a href='./add-listing'>create one</a> now!";
	}
}else {
?>
<div style="overflow: auto;width: 100%;">
<table id="myListing">
	<thead>
		<tr>
			<th id="thImg"><i class="fa fa-image"></i></th>
			<th id="thTitle">Title</th>
			<th id="thListing">Listing Type</th>
			<th id="thDate">Date Posted</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($load as $row) {
			$tgl = explode(" ", $row['tgl_posted'])[0];
			echo "<tr>".
					"<td><img src='../aset/gbr/".$row['covers']."'></td>".
					"<td>".
						"<a href='../event/".$row['idevent']."' target='_blank' id='seeEvent'><h4>".$row['title']." &nbsp; <i class='fa fa-eye' id='seeEventIcon'></i></h4>"."</h4></a>".
						"<a href='../hotel/edit-listing&idevent=".$row['idevent']."' style='text-decoration: none;'>Edit</a> &nbsp;".
						"| &nbsp;".
						"<a href='../event/detail&idevent=".$row['idevent']."' target='_blank'><li>Detail</li></a> | ".
						"<a><li onclick='hapus(this.value)' value='".$row['idevent']."'>Delete</li></a>".
					"</td>".
					"<td>".$row['category']."</td>".
					"<td>".$tgl."</td>".
				 "</tr>";
		}
		?>
	</tbody>
</table>
</div>
<div class="bag-tombol" style='margin-top: 25px;'>
	<a href='../event/dashboard'><button class='merah-2'>see all my events</button></a>
</div>
<?php
}
?>
