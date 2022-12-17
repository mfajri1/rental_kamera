<?php
	include "../../lib/koneksi.php";
	
	$kode 			= !empty($_POST['member_kode']) ? $_POST['member_kode'] : '';
	$nama 			= !empty($_POST['member_nama']) ? $_POST['member_nama'] : '';
	$jk 			= !empty($_POST['member_jk']) ? $_POST['member_jk'] : '';
	$umur 			= !empty($_POST['member_umur']) ? $_POST['member_umur'] : '';
	$alamat 		= !empty($_POST['member_alamat']) ? $_POST['member_alamat'] : '';
	$status 		= !empty($_POST['member_status']) ? $_POST['member_status'] : '';

	// var_dump($_POST);
	// exit();
	if(empty($kode) || empty($nama) || empty($jk) || empty($umur) || empty($status)){
		echo "<script>
			alert('Gagal, Data Tidak Boleh Kosong');
			window.location = '../../index.php?hal=pages/member/main.php';
		</script>";
	}else{
		if($_FILES['member_foto']['error'] == '4'){
			$query = "INSERT INTO ms_member (member_kode, member_nama, member_jk, member_umur, member_alamat, member_status) VALUES('$kode', '$nama', '$jk', '$umur', '$alamat', '$status')";
			$simpan = $koneksi->query($query);
			if($simpan){
				echo "<script>
					alert('Berhasil, Data Telah Ditambahakan');
					window.location = '../../index.php?hal=pages/member/main.php';
				</script>";
			}else{
				echo "<script>
					alert('Gagal, Periksa Data Yang diinputkan');
					window.location = '../../index.php?hal=pages/member/main.php';
				</script>";
			}
		}else{
			$ekstensi_diperbolehkan	= array('png', 'jpeg', 'jpg');
			$namaFile = $_FILES['member_foto']['name'];
			$x = explode('.', $namaFile);
			$ekstensi = strtolower(end($x));
			$error = $_FILES['member_foto']['error'];
			$ukuran	= $_FILES['member_foto']['size'];
			$file_tmp = $_FILES['member_foto']['tmp_name'];

			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 2048000){			
					move_uploaded_file($file_tmp, '../../assets2/img/member/'.$namaFile);
					$query = "INSERT INTO ms_member (member_kode, member_nama, member_jk, member_umur, member_alamat, member_foto, member_status) VALUES('$kode', '$nama', '$jk', '$umur', '$alamat', '$namaFile', '$status')";
					$simpan = $koneksi->query($query);
					if($simpan){
						echo "<script>
							alert('Berhasil, Data Telah Ditambahakan');
							window.location = '../../index.php?hal=pages/member/main.php';
						</script>";
					}else{
						echo "<script>
							alert('Gagal, Periksa Data Yang diinputkan');
							window.location = '../../index.php?hal=pages/member/main.php';
						</script>";
					}
				}else{
					echo "<script>
						alert('Gagal, Ukuran File Terlalu Besar');
						window.location = '../../index.php?hal=pages/member/main.php';
					</script>";
				}
			}else{
				echo "<script>
					alert('Gagal, File Yang Di Upload Tidak Sesuai');
					window.location = '../../index.php?hal=pages/member/main.php';
				</script>";
			}	
		}	
	}
?>