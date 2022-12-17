<?php 
	include("../../lib/koneksi.php");

	$kodeMember = $_GET['kode'];

	$queryDel = "DELETE FROM tmp_rfid_daftar";
	$resultDelete = $koneksi->query($queryDel);

	$querySimpan = "INSERT INTO tmp_rfid_daftar (tmp_rfid) VALUES('$kodeMember')";
	$resultSimpan = $koneksi->query($querySimpan);

?>