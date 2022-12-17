<?php 
	include("../../lib/koneksi.php");
	$kodeBarang = $_POST['kodeBarang'];
	$queryGet = "SELECT mb.*, rk.*, rs.* FROM ms_barang mb 
				INNER JOIN reff_kategori rk ON rk.kategori_id = mb.kategori_id
				INNER JOIN reff_satuan rs ON rs.satuan_id = mb.satuan_id
				WHERE barang_kode='$kodeBarang'";
	$resultGet = $koneksi->query($queryGet)->fetch_array();

	echo json_encode($resultGet);

?>