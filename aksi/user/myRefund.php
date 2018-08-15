<?php
include '../ctrl/booking.php';
function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

$iduser = $user->info($user->sesi(), "iduser");
$myRefund = $booking->myRefund($iduser);

if($myRefund == "null") {
    echo "You dont have any refund request.";
}else {
    ?>
    <table id='myListing'>
        <thead>
            <tr>
                <th style="width: 10%"><i class="fa fa-image"></i></th>
				<th style="width: 40%">Title</th>
				<th><i class="fa fa-money"></i></th>
				<th style="width: 15%">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($myRefund as $row) {
                $idevent = $row['idevent'];
                $eventName = $event->info($idevent, "title");
                $icon = $event->info($idevent, "logos");
                
                $price = $event->info($idevent, "price");
                $fixPrice = $price * $row['qty'];

                if($row['status'] == 9) {
                    $btnStatus = "<div class='tbl kuning' id='tblStatus'>PENDING</div>";
                }else if($row['status'] == 8) {
                    $btnStatus = "<div class='tbl hijau' id='tblStatus'>CONFIRMED</div>";
                }

                echo "<tr>".
                        "<td><img src='aset/gbr/".$icon."'></td>".
                        "<td>".$eventName."</td>".
                        "<td>".toIdr($fixPrice)."</td>".
                        "<td>".$btnStatus."</td>".
                     "</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
}
