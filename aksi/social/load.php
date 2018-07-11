<?php
include '../ctrl/social.php';
$sesi = $hotel->sesi();
$idhotel = $hotel->get($sesi, "idhotel");
$soc = $social->all($idhotel);

if($soc == "null") {
	echo "<h4>You dont have any social network</h4>";
}else {
?>
<table>
	<thead>
		<tr>
			<th style="width: 30%">Social</th>
			<th>URL</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($social->all($idhotel) as $row) {
			echo "<tr>".
					"<td>".$row['type']."</td>".
					"<td><a href='".$row['url']."' target='_blank'>".$row['url']."</a></td>".
					"<td class='rata-kanan'>".
						"<button class='merah-2'><i class='fa fa-close'></i></button>".
					"</td>".
				 "</tr>";
		}
		?>
		<!--
		<tr>
			<td>Facebook</td>
			<td>https://www.facebook.com/zuck</td>
			<td>
				<button class="hijau"><i class="fa fa-pencil"></i></button>
				<button class="merah-2"><i class="fa fa-close"></i></button>
			</td>
		</tr>
		-->
	</tbody>
</table>
<?php
}