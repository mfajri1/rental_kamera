<?php 
	include("../../lib/koneksi.php");

	$query = "DELETE FROM tmp_qr_transaksi";

	$result = $koneksi->query($query);

	if($result){
		echo json_encode($result);
	}else{
		echo json_encode($result);
	}

?>