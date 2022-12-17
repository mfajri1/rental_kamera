<?php 
	include("lib/koneksi.php");
		
	function getTableData($koneksi, $page = 1, $limit = 20) {
		$dataTable = array();
		$startRow = ($page - 1) * $limit;
		$query1 = "SELECT * FROM ms_member LIMIT " . $startRow . ", " . $limit;
		$queryResult = $koneksi->query($query1);

		while ($data = $queryResult->fetch_assoc()){
			array_push($dataTable, $data);
		}

		return $dataTable;
	}

	function showPagination($koneksi, $limit = 20) {
		$countTotalRow = mysqli_query($koneksi, 'SELECT COUNT(*) AS total FROM ms_member');
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

?>