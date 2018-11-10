<?php
include '../ctrl/galeri.php';

$idalbum = $_COOKIE['idalbum'];
$public = $_COOKIE['public'];
$nama = $galeri->infoAlbum($idalbum, "nama");


$load = $galeri->loadFromAlbum($idalbum);
echo "<div class='listAlbum'>".
        "<div class='wrap'>".
            "<input type='hidden' id='idalbums' value='".$idalbum."'>".
            "<h3>".$nama;
                if($public == 0 or $public == "") {
                    echo "
                <div class='ke-kanan'>
                    <button id='tblDel' onclick='delAlbum(this.value)' value='".$idalbum."'><i class='fa fa-trash'></i></button> | <span id='tblDel' onclick='loadHotel()'>close</span>
                </div>";
                }else if($public == 1) {
                    echo "";
                }
                echo "
            </h3>";
foreach($load as $row) {
    ?>
    <div class='galeri' style='display: inline-block;float: none;cursor: pointer;'>
        <div id="gambarnya" onclick="seeImage(this.getAttribute('isi'))" isi='<?php echo $row['gambar']; ?>'>
    <?php
    echo "<img src='../aset/gbr/".$row['gambar']."'>";
            if($public != 1) {
            ?>
        </div>
            <li onclick='hapus(this.value, "<?php echo $idalbum; ?>")' value='<?php echo $row['idgambar']; ?>'><i class='fa fa-trash'></i></li>
            <?php
            }else {
                echo "";
            }
            echo
         "</div></div>";
}
echo "<div class='bag-tombol'>";
                if($public != 1) {
                ?>
                <button class='merah-2' onclick='addPhoto(this.value, "<?php echo $nama; ?>")' value='<?php echo $idalbum; ?>'>Add Photo</button>
            <?php
                }else {
                    echo "<button class='merah-2' onclick='loadGaleri()'>See other albums</button>";
                }
            echo
        "</div>".
    "</div>".
"</div>";