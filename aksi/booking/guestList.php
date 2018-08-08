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
    echo "No people with this filter";
    exit();
}
?>
<table id='myListing'>
    <thead>
        <tr>
            <th style='width: 35%;'>Name</th>
            <th>Date</th>
            <th>Qty</th>
            <th>Status</th>
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
            if($row['bukti'] == "") {
                $status = 'UNPAID';
                $style = "background-color: #cb0029;color: #fff;";
                $btnHadir = "";
            }else if($row['bukti'] != "" && $row['status'] == 0) {
                $status = "UNVERIFIED";
                $style = "background-color: #fcd840;color: #343434;";
                $btnHadir = "";
            }else if($row['bukti'] != "" && $row['status'] == 1) {
                $status = "OK";
                $style = "background-color: #2ecc71;color: #fff;";
            }
            echo "<tr>".
                    "<td>".$row['nama']."</td>".
                    "<td>".$row['tgl']."</td>".
                    "<td>".$row['qty']."</td>".
                    "<td><div class='tbl' style='display: inline-block;".$style."font-family: OBold;'>".$status."</div></td>".
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