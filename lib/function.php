<?php
	// function getTableData($koneksi, $tableName, $page = 1, $limit = 20) {
	// 	$dataTable = array();
	// 	$startRow = ($page - 1) * $limit;
	// 	$query = mysqli_query($koneksi, "SELECT * FROM " . $tableName . " LIMIT " . $startRow . ", " . $limit);

	// 	while ($data = mysqli_fetch_assoc($query)){
	// 		array_push($dataTable, $data);
	// 	}

	// 	return $dataTable;
	// }

	// function showPagination($koneksi, $tableName, $limit = 20) {
	// 	$countTotalRow = mysqli_query($koneksi, 'SELECT COUNT(*) AS total FROM `' . $tableName . '`');
	// 	$queryResult = mysqli_fetch_assoc($countTotalRow);
	// 	$totalRow = $queryResult['total'];

	// 	$totalPage = ceil($totalRow / $limit);

	// 	$page = 1;
	// 	while ($page <= $totalPage) {
	// 		echo '<li><a href="?page=' . $page . '&perPage=' . $limit . '">' . $page . '</a></li>';
	// 		if ($page < $totalPage)
	// 			echo "&nbsp";
	// 		$page++;
	// 	}
	// }

	function date_indo($date) {
        $newdate = str_replace('/','-', $date);
        $newdate = date('d-m-Y', strtotime($newdate));
        return $newdate;
    }
    function bulan($bln) {
        switch ($bln) {
			case '01':
				return "Januari";
				break;
			case '02':
				return "Februari";
				break;
			case '03':
				return "Maret";
				break;
			case '04':
				return "April";
				break;
			case '05':
				return "Mei";
				break;
			case '06':
				return "Juni";
				break;
			case '07':
				return "Juli";
				break;
			case '08':
				return "Agustus";
				break;
			case '09':
				return "September";
				break;
			case '10':
				return "Oktober";
				break;
			case '11':
				return "November";
				break;
			case '12':
				return "Desember";
				break;
		}
    }

    function nama_bulan($bln) {
        switch ($bln) {
			case 'januari':
				return 1;
				break;
			case 'februari':
				return 2;
				break;
			case 'maret':
				return 3;
				break;
			case 'april':
				return 4;
				break;
			case 'mei':
				return 5;
				break;
			case 'juni':
				return 6;
				break;
			case 'juli':
				return 7;
				break;
			case 'agustus':
				return 8;
				break;
			case 'september':
				return 9;
				break;
			case '10':
				return "oktober";
				break;
			case 'november':
				return 11;
				break;
			case 'desember':
				return 12;
				break;
            default:
                return 0;
                break;
		}
    }

    function hari($tanggal) {
        $hari = date('D', strtotime($tanggal));
        switch($hari) {
			case 'Sun':
				return "Minggu";
				break;
			case 'Mon':
				return "Senin";
				break;
			case 'Tue':
				return "Selasa";
				break;
			case 'Wed':
				return "Rabu";
				break;
			case 'Thu':
				return "Kamis";
				break;
			case 'Fri':
				return "Jumat";
				break;
			case 'Sat':
				return "Sabtu";
				break;
			case 'Sunday':
				return "Minggu";
				break;
			case 'Monday':
				return "Senin";
				break;
			case 'Tuesday':
				return "Selasa";
				break;
			case 'Wednesday':
				return "Rabu";
				break;
			case 'Thursday':
				return "Kamis";
				break;
			case 'Friday':
				return "Jumat";
				break;
			case 'Saturday':
				return "Sabtu";
				break;
        }
    }

    if (!function_exists('space')) {
	    function space($str) {
	        if (empty($str)) {
	            return;
	        }
	        return str_replace('-', ' ', $str);
	    }
	}

	if (!function_exists('no_space')) {
	    function no_space($str) {
	        if (empty($str)) {
	            return;
	        }
	        return str_replace(' ', '', $str);
	    }
	}

	if (!function_exists('upper')) {
	    function upper($str) {
	        return strtoupper(strtolower($str));
	    }
	}

	if (!function_exists('capital_each_word')) {
	    function capital_each_word($str) {
	        $asal = array('DI', 'DAN');
	        $jadi = array('di', 'dan');
	        if (in_array($asal, $jadi))
	            return ucwords(strtolower($str));
	    }
	}

	if (!function_exists('separator_to_list')) {
	    function separator_to_list($str) {
	        $arr = explode('|', $str);
	        $li = '<ul>';
	        foreach ($arr as $value) {
	            $li.='<li>' . $value . '</li>';
	        }
	        $li.='</ul>';
	        return $li;
	    }
	}

	if (!function_exists('kosongkan')) {
	    function kosongkan($jml) {
	        return ($jml == 0) ? '' : $jml;
	    }
	}

	if (!function_exists('format_ribuan')) {
	    function format_ribuan($jml) {
	        if ($jml == 0) {
	            return $jml;
	        }
	        return number_format($jml, 0, ',', '.');
	    }
	}

	if (!function_exists('tambah_nol')) {
	    function tambah_nol($number, $total) {
	        $jumlah_nol = strlen($number);
	        $angka_nol  = $total - $jumlah_nol;
	        $nol = "";
	        for($i=1;$i<=$angka_nol;$i++) {
	            $nol .= '0';
	        }
	        return $nol.$number;
	    }
	}

?>