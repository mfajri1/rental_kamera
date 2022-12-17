<?php
	include "../../lib/koneksi.php";
	
	$kode 			= !empty($_POST['barang_kode']) ? $_POST['barang_kode'] : '';
	$nama 			= !empty($_POST['barang_nama']) ? $_POST['barang_nama'] : '';
	$satuan 		= !empty($_POST['barang_satuan']) ? $_POST['barang_satuan'] : '';
	$stok 			= !empty($_POST['barang_stok']) ? $_POST['barang_stok'] : '';
	$kategori 		= !empty($_POST['barang_kategori']) ? $_POST['barang_kategori'] : '';
	$harga 			= !empty($_POST['barang_harga']) ? $_POST['barang_harga'] : '';
	$harga_rental 	= !empty($_POST['barang_harga_rental']) ? $_POST['barang_harga_rental'] : '';
	$ket 			= !empty($_POST['barang_ket']) ? $_POST['barang_ket'] : '';

	// var_dump($_POST);
	// exit();
	if(empty($kode) || empty($nama) || empty($satuan) || empty($stok) || empty($kategori) || empty($harga) || empty($harga_rental)){
		echo "<script>
			alert('Gagal, Data Tidak Boleh Kosong');
			window.location = '../../index.php?hal=pages/barang/main.php';
		</script>";
	}else{
		if($_FILES['barang_foto']['error'] == '4'){
			$query = "INSERT INTO ms_barang (barang_kode, barang_nama, kategori_id, barang_stok, satuan_id, barang_ket, barang_harga, barang_harga_rental) VALUES('$kode', '$nama', '$kategori', '$stok', '$satuan', '$ket', '$harga', '$harga_rental')";
			$simpan = $koneksi->query($query);
			if($simpan){
				echo "<script>
					alert('Berhasil, Data Telah Ditambahakan');
					window.location = '../../index.php?hal=pages/barang/main.php';
				</script>";
			}else{
				echo "<script>
					alert('Gagal, Periksa Data Yang diinputkan');
					window.location = '../../index.php?hal=pages/barang/main.php';
				</script>";
			}
		}else{
			$ekstensi_diperbolehkan	= array('png', 'jpeg', 'jpg');
			$namaFile = $_FILES['barang_foto']['name'];
			$x = explode('.', $namaFile);
			$ekstensi = strtolower(end($x));
			$error = $_FILES['barang_foto']['error'];
			$ukuran	= $_FILES['barang_foto']['size'];
			$file_tmp = $_FILES['barang_foto']['tmp_name'];

			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 2048000){			
					move_uploaded_file($file_tmp, '../../assets2/img/barang/'.$namaFile);
					$query = "INSERT INTO ms_barang (barang_kode, barang_nama, kategori_id, barang_stok, satuan_id, barang_ket, barang_harga, barang_harga_rental, barang_foto) VALUES('$kode', '$nama', '$kategori', '$stok', '$satuan', '$ket', '$harga', '$harga_rental', '$namaFile')";
					$simpan = $koneksi->query($query);
					if($simpan){
						echo "<script>
							alert('Berhasil, Data Telah Ditambahakan');
							window.location = '../../index.php?hal=pages/barang/main.php';
						</script>";
					}else{
						echo "<script>
							alert('Gagal, Periksa Data Yang diinputkan');
							window.location = '../../index.php?hal=pages/barang/main.php';
						</script>";
					}
				}else{
					echo "<script>
						alert('Gagal, Ukuran File Terlalu Besar');
						window.location = '../../index.php?hal=pages/barang/main.php';
					</script>";
				}
			}else{
				echo "<script>
					alert('Gagal, File Yang Di Upload Tidak Sesuai');
					window.location = '../../index.php?hal=pages/barang/main.php';
				</script>";
			}	
		}	
	}
?>