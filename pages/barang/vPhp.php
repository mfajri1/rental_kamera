<?php 
	include("lib/koneksi.php");
		
	function getTableData($koneksi, $page = 1, $limit = 20) {
		$dataTable = array();
		$startRow = ($page - 1) * $limit;
		$query1 = "SELECT mb.*, rk.*, rs.*   FROM ms_barang mb 
				  INNER JOIN reff_kategori rk ON rk.kategori_id = mb.kategori_id 
				  INNER JOIN reff_satuan rs ON rs.satuan_id = mb.satuan_id
				  LIMIT " . $startRow . ", " . $limit;
		$queryResult = $koneksi->query($query1);

		while ($data = $queryResult->fetch_assoc()){
			array_push($dataTable, $data);
		}

		return $dataTable;
	}

	function showPagination($koneksi, $tableName, $limit = 20) {
		$countTotalRow = mysqli_query($koneksi, 'SELECT COUNT(*) AS total FROM `' . $tableName . '`');
		$queryResult = mysqli_fetch_assoc($countTotalRow);
		$totalRow = $queryResult['total'];

		$totalPage = ceil($totalRow / $limit);

		$page = 1;
		while ($page <= $totalPage) {
			echo '<li><a href="?page=' . $page . '&perPage=' . $limit . '">' . $page . '</a></li>';
			if ($page < $totalPage)
				echo "&nbsp";
			$page++;
		}
	}

	function getDataDropdown($koneksi, $query){
		$data = $koneksi->query($query);
		return $data;
	}

	function renderBarcode($text, $file_name_image){
		$target_path = "assets2/img/barcode/" . $file_name_image;
		// /cek apakah server menggunakan http atau https
		$protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';

		//url file image barcode 
		$fileImage = $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/lib/barcode-master/barcode.php?text=" . $text . "&print=true&size=65";

		//ambil gambar barcode dari url diatas
		$content = file_get_contents($fileImage);

		//simpan gambar
		file_put_contents($target_path, $content);
	}

	function renderQrcode($text, $file_name_image){
		QRcode::png($text ,"assets2/img/img_qr/" . $file_name_image,"L",6,3);
	}

?>