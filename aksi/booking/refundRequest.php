<?php
include '../ctrl/booking.php';
function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

$status = $_COOKIE['statusRefund'];

$req = $booking->refundReq($status);
if($req == "null") {
    echo "No refund request";
}else {
    ?>
    <table id='myListing'>
        <thead>
            <tr>
                <th><i class='fa fa-user'></i></th>
                <th><i class='fa fa-money'></i></th>
                <th style='width: 20%;'></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($req as $row) {
                $namaUser = $user->info($row['iduser'], "nama");
                $price = $event->info($row['idevent'], "price");
                $fixPrice = $price * $row['qty'];
                if($row['status'] == 9) {
                    $btnCawang = "<button onclick='cawang(this.value)' value='".$row['idbooking']."' class='tbl hijau'><i class='fa fa-check'></i></button>";
                }else if($row['status'] == 8) {
                    $btnCawang = "<button onclick='hapus(this.value)' value='".$row['idbooking']."' class='tbl merah-2'><i class='fa fa-trash'></i></button>";
                }

                echo "<tr>".
                        "<td>".$namaUser."</td>".
                        "<td>".toIdr($fixPrice)."</td>".
                        "<td>".
                            $btnCawang.
                        "</td>".
                     "</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
}