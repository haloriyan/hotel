<?php
include '../ctrl/resto.php';

$idhotel = $hotel->get($hotel->sesi(), "idhotel");
$myResto = $resto->myResto($idhotel);
if($myResto == "null") {
	echo "You dont have any restaurant";
}else {
	?>
	<table>
		<thead>
			<tr>
				<th>Resto name</th>
				<th style="width: 15%">Action</th>
			</tr>
		</thead>
		<tbody>
	<?php
	foreach ($myResto as $row) {
		echo "<tr>".
				"<td>".$row['nama']."</td>".
				"<td>".
					"<button class='merah-2' onclick='hapus(this.value)' value='".$row['idresto']."'><i class='fa fa-trash'></i></button>".
				"</td>".
			 "</tr>";
	}
	?>
		</tbody>
	</table>
	<?php
}