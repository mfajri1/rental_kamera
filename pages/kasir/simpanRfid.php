<?php 
	include("../../lib/koneksi.php");
	session_start();

	$kodeTransaksi 	= $_POST['kodeTransaksi'];
	$kodeMember 	= $_POST['kodeMember'];
	$tanggal 		= $_POST['tanggal'];
	$lamaPinjam 	= $_POST['lamaPinjam'];
	$adminId 		= $_SESSION['admin_id'];

	if($kodeMember == '' || $kodeMember == NULL || empty($kodeMember)){
		echo json_encode('inpKode');	
	}else{
		$queryGet = "SELECT * FROM ms_member WHERE member_kode = '$kodeMember'";
		$resultGet = $koneksi->query($queryGet)->fetch_array();

		if($resultGet == "" || empty($resultGet)){
			echo json_encode('noMember');
		}else{
			$queryGetTrans  = "SELECT * FROM ta_transaksi WHERE transaksi_kode = '$kodeTransaksi' AND member_kode = '$kodeMember' AND transaksi_tanggal='$tanggal'";
			$resultGetTrans = $koneksi->query($queryGetTrans)->fetch_array();

			if($resultGetTrans == "" || empty($resultGetTrans)){
				$querySimpan = "INSERT INTO ta_transaksi (admin_id, transaksi_kode, member_kode, transaksi_tanggal) VALUES('$adminId', '$kodeTransaksi', '$kodeMember', '$tanggal')";
				$resultSimpan = $koneksi->query($querySimpan);

				if($resultSimpan){
					echo json_encode('suksesSimpan');
					$queryUpdtMode = "UPDATE ta_mode SET status='Transaksi', jenis='Scan Barcode' WHERE id_status='1'";
					$resultUpdtMode = $koneksi->query($queryUpdtMode);

					$queryMode = "DELETE FROM tmp_qr_transaksi";

					$resultMode = $koneksi->query($queryMode);

				}else{
					echo json_encode('gagalSimpan');
				}
			}else{
				$queryUpdt = "UPDATE ta_transaksi SET member_kode='$kodeMember', transaksi_lama='$lamaPinjam' WHERE member_kode='$kodeMember' AND transaksi_tanggal='$tanggal' AND transaksi_kode='$kodeTransaksi'";	
				$resultUpdt = $koneksi->query($queryUpdt);
				if($resultUpdt){
					$queryUpdtMode = "UPDATE ta_mode SET status='Transaksi', jenis='Scan Barcode' WHERE id_status='1'";
					$resultUpdtMode = $koneksi->query($queryUpdtMode);
					echo json_encode('suksesUpdate');
					$queryMode = "DELETE FROM tmp_qr_transaksi";

					$resultMode = $koneksi->query($queryMode);
				}else{
					echo json_encode('gagalUpdate');
				}
			}			
		}
	}

?>