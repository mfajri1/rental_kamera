<?php 
	include("../../lib/koneksi.php");

	$query = "SELECT * FROM tmp_qr_transaksi";
	$result = $koneksi->query($query)->fetch_array();

?>

<label for="barang_kode" class="control-label font-weight-bolder">Kode Barang <span class="text-danger">*</span></label>
<input type="text" class="form-control" name="barang_kode" id="barang_kode" placeholder="Kode Barang" value="<?= $result['tmp_qr'] ?>"  required>
<div class="invalid-feedback"></div>