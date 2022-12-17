<?php 
	$queryUpdt = "UPDATE ta_mode SET status='Transaksi', jenis='Scan RFID' WHERE id_status='1'";
	$resultUpdt = $koneksi->query($queryUpdt);	

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<div class="row">
    		<div class="col-md-9">
    			<h6 class="m-0 font-weight-bold text-primary">Kasir</h6>		
    		</div>
    		<!-- <div class="col-md-3 d-flex justify-content-end">
    			<button class="btn btn-primary btn-sm" id="btnAdd">Tambah</button>	
    		</div> -->
    	</div>
    </div>
	<div class="card-body">
		<input type="hidden" name="adminId" id="adminId" value="<?= $_SESSION['admin_id'] ?>">
		<input type="hidden" name="jmlData" id="jmlData" value="0">
    	<div class="row mb-2">
    		<div class="col-md-3">
    			<label for="transaksi_kode" class="control-label font-weight-bolder">Kode Transaksi <span class="text-danger">*</span></label>
				<input type="text" class="form-control form-control-sm" name="transaksi_kode" id="transaksi_kode" placeholder="Kode Transaksi"  required>
				<div class="invalid-feedback"></div>
    		</div>
    		<div class="col-md-2">
    			<label for="transaksi_tanggal" class="control-label font-weight-bolder">Tanggal Transaksi <span class="text-danger">*</span></label>
				<input type="date" class="form-control form-control-sm" name="transaksi_tanggal" id="transaksi_tanggal" placeholder="Tanggal Transaksi"  required>
				<div class="invalid-feedback"></div>
    		</div>
    		<div class="col-md-2">
    			<label for="transaksi_lama" class="control-label font-weight-bolder">Lama Peminjaman <span class="text-danger">*</span></label>
				<input type="text" class="form-control form-control-sm" name="transaksi_lama" id="transaksi_lama" placeholder="Lama Peminjaman"  required>
				<div class="invalid-feedback"></div>
				<input type="hidden" name="nomor" id="nomor" value="1">
    		</div>
    		<div class="col-md-3" id="load_rfid">
    			<label for="member_kode" class="control-label font-weight-bolder">NIK Member <span class="text-danger">*</span></label>
	            <input type="text" class="form-control form-control-sm" name="member_kode" id="member_kode" placeholder="NIK Member"  required>
	            <div class="invalid-feedback"></div>
    		</div>
    		<div class="col-md-1">
    			<label for="" class="control-label font-weight-bolder"></label>
    			<button class="form-control form-control-sm btn btn-primary btn-rounded btn-sm mt-2 mx-1" id="btnSimpanRfid">Save</button>
    		</div>
    		<div class="col-md-1">
    			<label for="" class="control-label font-weight-bolder"></label>
    			<button class="form-control form-control-sm btn btn-warning btn-rounded btn-sm mt-2" id="btnResetRfid">Reset</button>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-md-3" id="load_qr">
    			<label for="barang_kode" class="control-label font-weight-bolder">Kode Barang <span class="text-danger">*</span></label>
				<input type="text" class="form-control form-control-sm" name="barang_kode" id="barang_kode" placeholder="Kode Barang"  required>
				<div class="invalid-feedback"></div>
				<input type="hidden" name="nomor" id="nomor" value="1">
    		</div>
    		<div class="col-md-3" id="load_qr">
    			<label for="barang_jumlah" class="control-label font-weight-bolder">Jumlah <span class="text-danger">*</span></label>
				<input type="text" class="form-control form-control-sm" name="barang_jumlah" id="barang_jumlah" placeholder="Jumlah"  required>
				<div class="invalid-feedback"></div>
    		</div>
    		<div class="col-md-1">
    			<label for="member_nik" class="control-label font-weight-bolder"></label>
    			<button class="form-control form-control-sm btn btn-primary btn-rounded btn-sm mt-2 mx-1" id="btnSimpanQr">Save</button>
    		</div>
    		<div class="col-md-1">
    			<label for="member_nik" class="control-label font-weight-bolder"></label>
    			<button class="form-control form-control-sm btn btn-warning btn-rounded btn-sm mt-2" id="btnResetQr">Reset</button>
    		</div>
    	</div>
    	<hr>
    	<div class="row mx-2">
	    	<div class="col-md-12">
	    		<div class="table-responsive">
		    		<table class="table">
		    			<thead>
			    			<tr>
			    				<th width="20%">Kode Barang</th>
			    				<th width="20%">Nama Barang</th>
			    				<th width="18%">Kategori</th>
			    				<th width="18%">Harga</th>
			    				<th width="4%">Jumlah</th>
			    				<th width="6%">Satuan</th>
			    				<th width="16%">Total</th>
			    				<th width="4%">Aksi</th>
			    			</tr>
		    			</thead>
		    			<tbody id="isiTransaksi">
		    				<!-- <tr>
		    					<td width="20%"><input type="text" class="form-control" name="kode"></td>
		    					<td width="20%"><input type="text" class="form-control" name="nama"></td>
		    					<td width="18%"><input type="text" class="form-control" name="kategori"></td>
		    					<td width="4%"><input type="text" class="form-control" name="jumlah"></td>
		    					<td width="8%"><input type="text" class="form-control" name="satuan"></td>
		    					<td width="16%"><input type="text" class="form-control" name="total"></td>
		    					<td width="4%"><button class="btn btn-danger px-1 py-0 mt-1"><i class="fas fa-1x fa-times-circle"></i></button></td>
		    				</tr> -->
		    			</tbody>
		    		</table>
	    		
	    		</div>
	    		
	    	</div>
	    </div>
    </div>
    

    

</div>