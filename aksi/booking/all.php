<?php
include '../ctrl/booking.php';

$all = $booking->all();

if($all == "null") {
    echo "No payment confirmation";
    exit();
}
?>
<table id='myListing'>
    <thead>
        <tr>
            <th><i class='fa fa-user'></i></th>
            <th><i class='fa fa-calendar'></i></th>
            <th><i class='fa fa-image'></i></th>
            <th style='width: 15%'></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($all as $row) {
            $namaUser = $user->info($row['iduser'], "nama");
            $namaEvent = $event->info($row['idevent'], "title");
            $bukti = $row['bukti'];
            echo "<tr>".
                    "<td>".$namaUser."</td>".
                    "<td>".$namaEvent."</td>".
                    "<td><a href='../aset/gbr/".$row['bukti']."' target='_blank'>See image</a></td>".
                    "<td>".
                        "<button class='tbl hijau' onclick='cawang(this.value)' value='".$row['idbooking']."'><i class='fa fa-check'></i></button>".
                    "</td>".
                 "</tr>";
        }
        ?>
    </tbody>
</table>