<?php
include '../ctrl/booking.php';

$idevent = $_COOKIE['idevent'];
$hadir = $_COOKIE['hadir'];
$nama = $_COOKIE['namaCari'];

$all = $booking->guest($idevent, $hadir, $nama);

if($idevent == "null") {
    echo "Select the event first";
    exit();
}
if($all == "null") {
    echo "No people attended on this event";
    exit();
}
?>
<table id='myListing'>
    <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Qty</th>
            <th style='width: 20%;'></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($all as $row) {
            if($row['hadir'] == 0) {
                // ada tombol
                $btnHadir = "<button class='tbl hijau' onclick='hadir(this.value)' value='".$row['idbooking']."'><i class='fa fa-check'></i></button>";
            }else {
                $btnHadir = "";
            }
            echo "<tr>".
                    "<td>".$row['nama']."</td>".
                    "<td>".$row['tgl']."</td>".
                    "<td>".$row['qty']."</td>".
                    "<td>".
                        $btnHadir.
                    "</td>".
                 "</tr>";
        }
        ?>
    </tbody>
</table>
<!--
<table id='myListing'>
				<thead>
					<tr>
						<th>Name</th>
						<th style='width: 20%;'></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Riyan Satria</td>
						<td>
							<button class='tbl hijau'><i class='fa fa-check'></i></button>
						</td>
					</tr>
				</tbody>
			</table>
            -->