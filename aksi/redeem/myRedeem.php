<?php
include '../ctrl/redeem.php';

function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

$idhotel = $hotel->get($hotel->sesi(), "idhotel");

$myRedeem = $redeem->my($idhotel);
if($myRedeem == "null") {
    echo "You haven't asked for redeem";
    exit();
}

?>
<h3>My Redeem</h3>
<table>
    <thead>
        <tr>
            <th><i class='fa fa-calendar'></i></th>
            <th><i class='fa fa-money'></i></th>
            <th style='width: 20%;'>Status</th>
            <th style='width: 10%;'></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($myRedeem as $row) {
            $echoCalendar = explode(" ", $row['tgl'])[0];
            if($row['status'] == 0) {
                $status = "Pending";
            }
            echo "<tr>".
                    "<td>".$echoCalendar."</td>".
                    "<td>".toIdr($row['saldo'])."</td>".
                    "<td>".$status."</td>".
                    "<td>".
                        "<button class='tbl merah-2' id='abort' onclick='abort(this.value)' value='".$row['idredeem']."'><i class='fa fa-close'></i></button>".
                    "</td>".
                 "</tr>";
        }
        ?>
    </tbody>
</table>