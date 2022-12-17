<?php 
	include("../../lib/koneksi.php");

	$query = "DELETE FROM tmp_rfid_transaksi";

	$result = $koneksi->query($query);

	if($result){
		$queryUpdtMode = "UPDATE ta_mode SET status='Transaksi', jenis='Scan RFID' WHERE id_status='1'";
		$resultUpdtMode = $koneksi->query($queryUpdtMode);
		echo json_encode($result);
	}else{
		echo json_encode($result);
	}

?>