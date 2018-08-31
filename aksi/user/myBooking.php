<?php
include '../ctrl/booking.php';

$iduser = $user->info($user->sesi(), "iduser");

function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

$myBook = $booking->myBooking($iduser);
if($myBook == "null") {
	echo "You dont have any booked event";
}else {
	?>
	<table id="myListing">
		<thead>
			<tr>
				<th style="width: 10%"><i class="fa fa-image"></i></th>
				<th style="width: 35%">Title</th>
				<th style="width: 20%"><i class="fa fa-calendar"></i></th>
				<th><i class="fa fa-money"></i></th>
				<th style="width: 15%">Status</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$bln = [
				"01" => "January",
				"02" => "February",
				"03" => "March",
				"04" => "April",
				"05" => "May",
				"06" => "June",
				"07" => "July",
				"08" => "August",
				"09" => "September",
				"10" => "October",
				"11" => "November",
				"12" => "Dec"
			];
			foreach ($myBook as $row) {
				$idevent	= $row['idevent'];
				$icon 		= $event->info($idevent, "logos");
				$title 		= $event->info($idevent, "title");
				$tgl		= $row['tgl'];
				$ds			= explode("-", $tgl);
				$tgls 	= $bln[$ds['1']] . ", ". $ds['2'];
				$price 		= $event->info($idevent, "price") * $row['qty'];
				if($row['bukti'] == "") {
					// belum dibayar
					$btn = "<a href='./invoice/".$row['idbooking']."' target='_blank'><button class='tbl merah-2' id='tblStatus'>UNPAID</button></a>";
					$reschedule = "";
				}else if($row['bukti'] != "" && $row['status'] == 0) {
					// belum dikonfirmasi
					$btn = "<a href='./invoice/".$row['idbooking']."' target='_blank'><button class='tbl kuning' id='tblStatus'>PAID</button></a>";
					$reschedule = "";
				}
				else {
					$btn = "<a href='./invoice/".$row['idbooking']."' target='_blank'><button class='tbl hijau' id='tblStatus'>CONFIRMED</button></a>";
					$reschedule = "<a href='#'>reschedule</a>";
				}
				echo "<tr>".
					 	"<td><img src='aset/gbr/".$icon."'></td>".
					 	"<td>".$title."</td>".
					 	"<td>".
					 		$tgls.
					 	"</td>".
					 	"<td>".toIdr($price)." (".$row['qty'].")</td>".
					 	"<td>".
							$btn.
							$reschedule.
					 	"</td>".
					 "</tr>";
			}
			?>
		</tbody>
	</table>
	<p style='margin-top: 50px;'>
		* click "UNPAID" button to pay it
	</p>
	<?php
}