<?php
error_reporting(0);
include '../ctrl/galeri.php';

session_start();
$sesiHotel = $_COOKIE['idhotel'];
$sesiResto = $_COOKIE['idresto'];

$pakaiAkun = $_COOKIE['pakaiAkun'];

if($pakaiAkun == "hotel") {
    // nggawe hotel
    $tipe = "hotel";
    $id = $sesiHotel;
}else {
    // nggawe resto
    $tipe = "resto";
    $id = $sesiResto;
}

$myAlbum = $galeri->myAlbum($id, $tipe);
$totMyAlbum = count($myAlbum);

function loadImage($my) {
    foreach($my as $row) {
        $idAlbum = $row['idalbum'];
        $gambar = $row['gambar'];
        if($gambar == "") {
            return "No any image on this album";
        }else {
            return "<li onclick='loadAlbum(this.value)' value='".$idAlbum."' style='all: unset;list-style: none;'><img src='../aset/gbr/".$gambar."'></li>";
        }
    }
}

foreach($myAlbum as $row) {
    $myImage = $galeri->load($row['idalbum']);
    echo "<div class='listAlbum galeri'>".
            "<div class='wrap'>".
                "<h3>".$row['nama']."</h3>".
                loadImage($myImage);
                ?>
                <br /><br />
                <button class='tbl merah-2' onclick='loadAlbum(this.value)' value='<?php echo $row['idalbum']; ?>'> See all images</button>
                <?php
                echo
            "</div>".
         "</div>";
}