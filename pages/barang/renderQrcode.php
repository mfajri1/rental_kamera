<?php 
	include("lib/phpqrcode/qrlib.php");
	include("pages/barang/vPhp.php");
	$kode = $_GET['id'];
	if(!empty($kode)){ 
		// perintah untuk membuat qrcode dan menampilkannya secara langsung dengan format .PNG
		$qr = $kode . ".png";
		renderQrcode($kode, $qr); 
		// simpan barcode 
		$barcode = $kode . ".png";
		renderBarcode($kode, $barcode);

		$queryGet = "SELECT * FROM ms_barang WHERE barang_kode='$kode'";
		$resultGet = $koneksi->query($queryGet)->fetch_array();
		$gambarQr = $resultGet['barang_qr'];
		$gambarbarcode = $resultGet['barang_barcode'];

		$tampil = "";
		$tampil .= '<div class="row">';
			$tampil .= '<div class="offset-md-2 col-md-3 text-center">';
				$tampil .= '<h3> QRCode </h3>';
			$tampil .= '</div>';
			$tampil .= '<div class="offset-md-2 col-md-3 text-center">';
				$tampil .= '<h3> Barcode </h3>';
			$tampil .= '</div>';
		$tampil .= '</div>';
		$tampil .= '<div class="row">';
			$tampil .= '<div class="offset-md-2 col-md-3 text-center">';
				$tampil .= '<img src="./assets2/img/img_qr/' . $kode .'.png" style="width:300px;">';
			$tampil .= '</div>';
			$tampil .= '<div class="offset-md-2 col-md-3 text-center">';
				$tampil .= '<img src="lib/barcode-master/barcode.php?text=' . $kode . '&print=true&size=65" class="mt-5" style="width:300px" />';
			$tampil .= '</div>';
		$tampil .= '</div>';
		$tampil .= '<div class="row">';
			$tampil .= '<div class="offset-md-2 col-md-3 text-center">';
				$tampil .= '<a href="cetak.php?jenis=qr&kode='. $kode .'" class="btn btn-success btn-rounded px-5 py-2">Cetak QRCode</a>';
			$tampil .= '</div>';
			$tampil .= '<div class="offset-md-2 col-md-3 text-center">';
				$tampil .= '<a href="cetak.php?jenis=barcode&kode='. $kode .'" class="btn btn-primary btn-rounded px-5 py-2">Cetak Barcode</a>';
			$tampil .= '</div>';
		$tampil .= '</div>';



		if(empty($gambarQr) || $gambarQr == NULL){
			$query = "UPDATE ms_barang SET barang_qr='$qr', barang_barcode='$barcode' WHERE barang_kode='$kode'";
			$result = $koneksi->query($query);
			if($result){
				// echo '<img src="./assets2/img/img_qr/' . $kode .'.png">';	
				echo $tampil;
			}else{
				echo "Gagal Render QRcode";
			}	
		}else{
			$pecahGambar = explode('.', $gambarQr);
			if($pecahGambar[0] !== $kode){
				unlink('assets2/img/img_qr/' . $gambarQr);
				$query = "UPDATE ms_barang SET barang_qr='$qr' where barang_kode='$kode'";
				$result = $koneksi->query($query);

				if($result){
					echo $tampil;	
				}else{
					echo "Gagal Render QRcode";
				}	
			}else{
				echo $tampil;
			}

			if($gambarbarcode !== NULL){
				$pecahBarcode = explode('.', '$gambarbarcode');
				if($pecahBarcode[0] !== $kode){
					unlink('assets2/img/barcode/' . $gambarbarcode);
					$query = "UPDATE ms_barang SET barang_qr='$qr', barang_barcode='$barcode' where barang_kode='$kode'";
					$result = $koneksi->query($query);
					// simpan barcode 
					renderBarcode($kode, $barcode);

					if($result == false){
						echo "Gagal Render Barcode";
					}
				}	
			}else{
				$query = "UPDATE ms_barang SET barang_qr='$qr', barang_barcode='$barcode' where barang_kode='$kode'";
				// simpan barcode 
				renderBarcode($kode, $barcode);
			}	
		}
			
	}
	
?>