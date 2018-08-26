<?php
include '../ctrl/galeri.php';

$idalbum = $_COOKIE['idalbum'];
$nama = $galeri->infoAlbum($idalbum, "nama");


$load = $galeri->loadFromAlbum($idalbum);
echo "<div class='listAlbum'>".
        "<div class='wrap'>".
            "<input type='hidden' id='idalbums' value='".$idalbum."'>".
            "<h3>".$nama."
                <div class='ke-kanan'>
                    <button id='tblDel' onclick='delAlbum(this.value)' value='".$idalbum."'>delete</button> | <span id='tblDel' onclick='loadHotel()'>close</span>
                </div>
            </h3>";
foreach($load as $row) {
    echo "<div class='galeri' style='display: inline-block;float: none;'>".
            "<img src='../aset/gbr/".$row['gambar']."'>".
            "<li onclick='hapus(this.value)' value='".$row['idgambar']."'><i class='fa fa-trash'></i></li>".
         "</div>";
}
echo "<div class='bag-tombol'>";
                ?>
                <button class='merah-2' onclick='addPhoto(this.value, "<?php echo $nama; ?>")' value='<?php echo $idalbum; ?>'>Add Photo</button>
            <?php
            echo
        "</div>".
    "</div>".
"</div>";