<?php 
	include '../../lib/koneksi.php';
	
	$adminId			= $_POST['adminId'];
	$kodeTransaksi 		= $_POST['kodeTransaksi'];
	$tanggalTransaksi 	= $_POST['tanggalTransaksi'];
	$lamaPinjam 		= $_POST['lamaPinjam'];
    $kodeMember			= $_POST['kodeMember']; 
    $kodeBarang			= $_POST['kodeBarang']; 
    $nomor 				= $_POST['nomor']; 
    $namaBarang 		= $_POST['namaBarang']; 
    $kategoriNama 		= $_POST['kategoriNama']; 
    $jumlahPinjam 		= $_POST['jumlahPinjam']; 
    $satuanNama 		= $_POST['satuanNama']; 
    $kategoriId 		= $_POST['kategoriId']; 
    $satuanId 			= $_POST['satuanId']; 
    $hargaRental 		= $_POST['hargaRental']; 
    $stokBarang 		= $_POST['stokBarang']; 
    $totalPinjam 		= $_POST['totalPinjam'];

    $queryGet = "SELECT * FROM ta_transaksi WHERE transaksi_kode='$kodeTransaksi' AND transaksi_tanggal='$tanggalTransaksi' AND member_kode='$kodeMember'";
    $resultGet = $koneksi->query($queryGet)->fetch_array();

    if(!empty($resultGet)){
    	$idTransaksi = $resultGet['transaksi_id'];
	    $querySimpanDetail = "INSERT INTO ta_transaksi_detail(transaksi_id, barang_kode, kategori_id, transaksi_jumlah, satuan_id, transaksi_total) VALUES('$idTransaksi', '$kodeBarang', '$kategoriId', '$jumlahPinjam', '$satuanId', '$totalPinjam')";
	    $resultSimpanDetail = $koneksi->query($querySimpanDetail);

	    if($resultSimpanDetail == false){
	    	echo json_encode('gagalSimpanDetail');
	    }else{
		    $querySimpan = "UPDATE ta_transaksi SET transaksi_lama = '$lamaPinjam' WHERE transaksi_kode='$kodeTransaksi' AND transaksi_tanggal='$tanggalTransaksi' AND member_kode='$kodeMember'";
	    	$resultSimpan = $koneksi->query($querySimpan);

	    	if($resultSimpan == false){
	    		echo json_encode('gagalSimpanTransaksi');
	    	}else{
	    		$queryMode = "DELETE FROM tmp_qr_transaksi";

				$resultMode = $koneksi->query($queryMode);
	    		echo json_encode('berhasilSimpanTransaksi');

	    	}
	    }
    }else{
    	$querySimpan = "INSERT INTO ta_transaksi(admin_id, member_kode, transaksi_kode, transaksi_tanggal, transaksi_lama, transaksi_total) VALUES('$adminId', '$kodeMember', '$kodeTransaksi', '$tanggalTransaksi', '$lamaPinjam', '0')";
    	$resultSimpan = $koneksi->query($querySimpan);

    	if($resultSimpan == false){
    		echo json_encode('gagalInsertTransaksi');
    	}else{
    		$queryGetTrans = "SELECT * FROM ta_transaksi WHERE transaksi_kode='$kodeTransaksi' AND transaksi_tanggal='$tanggalTransaksi' AND member_kode='$kodeMember'";
    		$resultGetTrans = $koneksi->query($queryGetTrans)->fetch_array();
    		$idTrans = $resultGetTrans['transaksi_id'];
    		$querySimpanDetail = "INSERT INTO ta_transaksi_detail(transaksi_id, barang_kode, kategori_id, transaksi_jumlah, satuan_id, transaksi_total) VALUES('$idTrans', '$kodeBarang', '$kategoriId', '$jumlahPinjam', '$satuanId', '$totalPinjam')";
		    $resultSimpanDetail = $koneksi->query($querySimpanDetail);

		    if($resultSimpanDetail == false){
	    		echo json_encode('gagalInsertDetail');
	    	}else{
	    		$queryMode = "DELETE FROM tmp_qr_transaksi";

				$resultMode = $koneksi->query($queryMode);
	    		echo json_encode('berhasilInsertDetail');
	    	}
    	}
    }



?>