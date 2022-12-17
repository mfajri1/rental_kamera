<?php 
	include("../../lib/koneksi.php");
	session_start();

	$kodeTransaksi 	= $_POST['kodeTransaksi'];
	$kodeMember 	= $_POST['kodeMember'];
	$tanggal 		= $_POST['tanggal'];
	$adminId 		= $_SESSION['admin_id'];
	$kodeBarang 	= $_POST['kodeBarang'];

	if($kodeBarang == '' || $kodeBarang == NULL || empty($kodeBarang)){
		echo json_encode('inpKode');	
	}else{
		echo json_encode('prosesSimpan');
		
	}

?>