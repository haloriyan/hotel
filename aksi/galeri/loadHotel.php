<?php
error_reporting(0);
include '../ctrl/galeri.php';

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

if($sesiHotel == "") {
    // nggawe resto
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
        if($gambar == "") {
            return "No any image on this album";
        }else {
            return "<img src='../aset/gbr/".$gambar."'>";
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