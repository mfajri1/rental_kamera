<?php 
	include("lib/koneksi.php");
	$kode = $_GET['id'];
	$queryGet 	= "SELECT * FROM ms_member WHERE member_kode='$kode'";
	$resultGet 	= $koneksi->query($queryGet)->fetch_assoc();
	$gambarMember = $resultGet['member_foto'];

	$query = "DELETE FROM ms_member WHERE member_kode='$kode'";
	$result = $koneksi->query($query);
	if($result == true){
		if($gambarMember !== NULL){
			unlink('assets2/img/member/' . $gambarMember);
			echo "<script>
				alert('Berhasil, Hapus Data');
				window.location = '$admin_url?hal=pages/member/main.php';
			</script>";	
		}else{
			echo "<script>
				alert('Berhasil, Hapus Data');
				window.location = '$admin_url?hal=pages/member/main.php';
			</script>";
		}
				
	}else{
		echo "<script>
		alert('Gagal, Hapus Data');
			
		</script>";	
	}

	
?>