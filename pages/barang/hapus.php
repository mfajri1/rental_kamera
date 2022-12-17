<?php 
	include("lib/koneksi.php");
	$kode = $_GET['id'];
	$queryGet 	= "SELECT * FROM ms_barang WHERE barang_kode='$kode'";
	$resultGet 	= $koneksi->query($queryGet)->fetch_assoc();
	$gambarBarang = $resultGet['barang_foto'];
	$gambarQr 	= $resultGet['barang_qr'];
	// var_dump($admin_url . 'assets2/img/img_qr/' . $kode);exit();

	$query = "DELETE FROM ms_barang WHERE barang_kode='$kode'";
	$result = $koneksi->query($query);
	if($result == true){
		if($gambarQr !== NULL){
			if($gambarBarang !== NULL){
				unlink('assets2/img/img_qr/' . $kode . '.png');
				unlink('assets2/img/barang/' . $gambarBarang);
				echo "<script>
					alert('Berhasil, Hapus Data');
					window.location = '$admin_url?hal=pages/barang/main.php';
				</script>";	
			}else{
				unlink('assets2/img/img_qr/' . $kode . '.png');
				echo "<script>
					alert('Berhasil, Hapus Data');
					window.location = '$admin_url?hal=pages/barang/main.php';
				</script>";
			}
				
		}else{
			if($gambarBarang !== NULL){
				unlink('assets2/img/barang/' . $gambarBarang);
				echo "<script>
					alert('Berhasil, Hapus Data');
					window.location = '$admin_url?hal=pages/barang/main.php';
				</script>";	
			}else{
				echo "<script>
					alert('Berhasil, Hapus Data');
					window.location = '$admin_url?hal=pages/barang/main.php';
				</script>";
			}
		}
				
	}else{
		echo "<script>
		alert('Gagal, Hapus Data');
			
		</script>";	
	}

	
?>