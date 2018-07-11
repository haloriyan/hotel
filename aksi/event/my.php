<?php
include '../ctrl/event.php';

$sesi 	= $hotel->sesi();
$myId 	= $hotel->get($sesi, "idhotel");

if($event->my($myId) == "kosong") {
	echo "You dont have any listing. <a href='./add-listing'>create one</a> now!";
}else {
?>
<table id="myListing">
	<thead>
		<tr>
			<th><i class="fa fa-image"></i></th>
			<th style="width: 45%;">Title</th>
			<th>Listing Type</th>
			<th>Date Posted</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($event->my($myId) as $row) {
			$tgl = explode(" ", $row['tgl_posted'])[0];
			echo "<tr>".
					"<td><img src='../aset/gbr/".$row['cover']."'></td>".
					"<td>".
						"<h4>".$row['title']."</h4>"."</h4>".
						"<!-- <a href='#'>Edit</a> &nbsp;".
						"<i class='fa fa-angle-right'></i> &nbsp; -->".
						"<li onclick='hapus(this.value)' value='".$row['idevent']."'>Delete</li>".
					"</td>".
					"<td>".$row['category']."</td>".
					"<td>".$tgl."</td>".
				 "</tr>";
		}
		?>
		<!--
		<tr>
			<td><img src="../aset/gbr/upin.jpeg"></td>
			<td>
				<h4>Ta'Jil di Swiss-Belhotel Petitenget</h4>
				<a href="#" id="tblEdit">Edit</a> &nbsp;
				<i class="fa fa-angle-right"></i> &nbsp;
				<a href="#" id="tblDel">Delete</a>
			</td>
			<td>Explore</td>
			<td>May 11, 2018</td>
			<td>-</td>
		</tr>
		-->
	</tbody>
</table>
<?php
}
?>