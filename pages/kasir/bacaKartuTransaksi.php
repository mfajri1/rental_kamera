<?php 
	include("../../lib/koneksi.php");

	$kodeMember = !empty($_GET['kode']) ? $_GET['kode'] : '';

	$queryDel = "DELETE FROM tmp_rfid_transaksi";
	$resultDelete = $koneksi->query($queryDel);

	if($kodeMember !== ''){
		$querySimpan = "INSERT INTO tmp_rfid_transaksi (tmp_rfid) VALUES('$kodeMember')";
		$resultSimpan = $koneksi->query($querySimpan);	
	}
	

?>