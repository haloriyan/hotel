<?php
include '../ctrl/redeem.php';
function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

$all = $redeem->all(0);
if($all == "null") {
    echo "No redeem request";
    exit();
}
?>
<table id='myListing'>
    <thead>
        <tr>
            <th><i class='fa fa-calendar'></i></th>
            <th><i class='fa fa-user'></i></th>
            <th><i class='fa fa-money'></i></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($all as $row) {
            $namaHotel = $hotel->get($row['idhotel'], "nama");
            echo "<tr>".
                    "<td>".explode(" ", $row['tgl'])[0]."</td>".
                    "<td>".$namaHotel."</td>".
                    "<td>".toIdr($row['saldo'])."</td>".
                    "<td>".
                        "<button class='tbl hijau' onclick='cawang(this.value)' value='".$row['idredeem']."'><i class='fa fa-check'></i></button>".
                    "</td>".
                 "</tr>";
        }
        ?>
    </tbody>
</table>