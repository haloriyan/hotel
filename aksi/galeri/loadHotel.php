<?php
error_reporting(0);
include '../ctrl/galeri.php';

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

/* TODO
    SEARCH HOW TO CONVERT ARRAY TO STRING
*/

if($sesiHotel == "") {
    // nggawe resto
    // query SELECT * FROM `album` INNER JOIN galeri WHERE galeri.idhotel = '357096'
    $tipe = "resto";
    $id = $resto->info($sesiResto, "idresto");
}else {
    // nggawe hotel
    $tipe = "hotel";
    $id = $hotel->get($sesiHotel, "idhotel");
}

$myAlbum = $galeri->myAlbum($id, $tipe);
$totMyAlbum = count($myAlbum);

function loadImage($my) {
    foreach($my as $row) {
        $gambar = $row['gambar'];
    }
    return $gambar;
}

/*
foreach($myAlbum as $row) {
    $myImage = $galeri->load($row['idalbum']);
    echo "<div class='listAlbum galeri'>".
            "<div class='wrap'>".
                "<h3>".$row['nama']."</h3>";
                echo "<img src='../aset/gbr/".loadImage($myImage)."'>";
    echo   "<br /><br /><button class='tbl merah-2'>See all</button>".
           "</div>".
         "</div>";
}
*/

foreach($myAlbum as $key => $row) {
    echo "<div class='listAlbum'>".
            "<div class='wrap'>".
                "<h3>".$row['nama']."
                    <li class='ke-kanan' id='tblDel' onclick='delAlbum(this.value)' value='".$row['idalbum']."'>Delete album</li>
                </h3>";
                $load = $galeri->load($row['idalbum']);
        echo    "<div class='bag-tombol'>".
                    "<button class='merah-2' onclick='addPhoto(this.value)' value='".$row['idalbum']."'>Add Photo</button>".
                "</div>".
            "</div>".
         "</div>";
}