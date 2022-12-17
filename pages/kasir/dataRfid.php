<?php 
	include("../../lib/koneksi.php");

	$query = "SELECT * FROM tmp_rfid_transaksi";
	$result = $koneksi->query($query)->fetch_array();

?>

<label for="member_kode" class="control-label font-weight-bolder">NIK Member <span class="text-danger">*</span></label>
<input type="text" class="form-control" name="member_kode" id="member_kode" placeholder="NIK Member" value="<?= $result['tmp_rfid'] ?>"  required>
<div class="invalid-feedback"></div>