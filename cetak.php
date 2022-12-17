<?php 
	require_once "lib/TCPDF/tcpdf.php";
    include("lib/koneksi.php");
    include("lib/function.php");
    include("lib/config_web.php");

	$jenis = $_GET['jenis'];
    $kode = $_GET['kode'];
	
    if($jenis == 'qr'){
        $query = "SELECT * FROM ms_barang WHERE barang_kode='$kode'";
        $result = $koneksi->query($query)->fetch_array();
        $foto = $result['barang_qr'];

		$pdf = new TCPDF();
        //set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Cetak Data QR');
        $pdf->SetTitle('Cetak Data QR');
        $pdf->SetSubject('Data QR');
        $pdf->SetKeywords('Data, QR');
        // set default header data
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        //set default font subsetting mode
        $pdf->setFontSubsetting(true);
        //Set font
        $pdf->SetAutoPageBreak(TRUE, 10);
        //Add a page
        $pdf->addPage('L', array(50, 60));
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('times', 'B', 16, '', true);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->MultiCell(25, 10, $kode ."\n", 0, 'C', 1, 2, 18, 2, TRUE ,0, false, false, 0, 'M', true);
        


        $pdf->SetFont('times', '', 12, '', true);
        $pdf->Image('assets2/img/img_qr/' . $foto, 18, 12, 25, 25, 'PNG', $kode, 'C', true, 300, '', false, false, 1, false, false, false);



        $pdf->lastPage();
        ob_end_clean();
        $pdf->Output('Cetak Data Gaji.pdf', 'D');
	}else if($jenis == 'barcode'){
        $query = "SELECT * FROM ms_barang WHERE barang_kode='$kode'";
        $result = $koneksi->query($query)->fetch_array();
        $foto = $result['barang_qr'];

        $pdf = new TCPDF();
        //set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Cetak Data QR');
        $pdf->SetTitle('Cetak Data QR');
        $pdf->SetSubject('Data QR');
        $pdf->SetKeywords('Data, QR');
        // set default header data
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        //set default font subsetting mode
        $pdf->setFontSubsetting(true);
        //Set font
        $pdf->SetAutoPageBreak(TRUE, 10);
        //Add a page
        $pdf->addPage('L', array(50, 60));
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('times', 'B', 16, '', true);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->MultiCell(25, 10, $kode ."\n", 0, 'C', 1, 2, 18, 2, TRUE ,0, false, false, 0, 'M', true);
        


        $pdf->SetFont('times', '', 12, '', true);
        $pdf->Image('assets2/img/barcode/' . $foto, 10, 12, 40, 25, 'PNG', $kode, 'C', true, 300, '', false, false, 1, false, false, false);



        $pdf->lastPage();
        ob_end_clean();
        $pdf->Output('Cetak Data Gaji.pdf', 'D');
    }
?>