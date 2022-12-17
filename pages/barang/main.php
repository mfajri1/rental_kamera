<?php 
	include "pages/barang/vPhp.php";

	$queryUpdt = "UPDATE ta_mode SET status='Standby', jenis='Standby' WHERE id_status='1'";
	$resultUpdt = $koneksi->query($queryUpdt);	


	$page = 1;
	if (isset($_GET['page']) && !empty($_GET['page']))
		$page = (int)$_GET['page'];

	/* untuk mengetahui berapa banyak data yang akan ditampilkan
	juga untuk men-set nilai default menjadi 5 jika tidak ada
	data $_GET['perPage'] yang dikirimkan*/
	$dataPerPage = 5;
	if (isset($_GET['perPage']) && !empty($_GET['perPage']))
		$dataPerPage = (int)$_GET['perPage'];

	// tabel yang akan diambil datanya
	$table = 'satuan';

	// ambil data
	$dataTable = getTableData($koneksi, $page, $dataPerPage);

	$querySatuan = "SELECT * FROM reff_satuan ORDER BY satuan_nama";
	$dataSatuan = getDataDropdown($koneksi, $querySatuan);

	$queryKategori = "SELECT * FROM reff_kategori ORDER BY kategori_nama";
	$dataKategori = getDataDropdown($koneksi, $queryKategori);
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<div class="row">
    		<div class="col-md-9">
    			<h6 class="m-0 font-weight-bold text-primary">Barang</h6>		
    		</div>
    		<div class="col-md-3 d-flex justify-content-end">
    			<button class="btn btn-success mx-1" id="btnCetak">Cetak Data</button>
    			<button class="btn btn-primary" id="btnAdd">Tambah</button>	
    		</div>
    	</div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="3%">No</th>
							<th>Kode </th>
							<th>Nama </th>
							<th>Stok</th>
							<th>Kategori</th>
							<th>Harga </th>
							<th>Harga Rental</th>
							<th width="9%">Aksi</th>

						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($dataTable as $i => $dl){
								$no = ($i + 1) + (($page - 1) * $dataPerPage);?>
							<tr>
								<td><?= $no++ ?></th>
								<td><?= $dl['barang_kode'];?></td>
								<td><?= $dl['barang_nama'];?></td>
								<td><?= $dl['barang_stok'] . ' ' . $dl['satuan_nama'];?></td>
								<td><?= $dl['kategori_nama'];?></td>
								<td><?= format_ribuan($dl['barang_harga']);?></td>
								<td><?= format_ribuan($dl['barang_harga_rental']);?></td>
								
								<td>
									<a href="?hal=pages/barang/formEdit.php&id=<?= $dl['barang_kode'];?>" class="text-info pr-1"><i class="fa fa-edit"></i></a>
									<a href="?hal=pages/barang/hapus.php&id=<?= $dl['barang_kode'];?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="text-danger pr-1"><i class="fa fa-trash"></i></a>
									<a href="?hal=pages/barang/renderQrcode.php&id=<?= $dl['barang_kode'];?>" class="text-secondary pr-1"><i class="fas fa-qrcode"></i></a>
								</td>
							</tr>
						<?php }   
						?>
					</tbody>
				</table>	
			</div>
    </div>
</div>



<div class="modal fade" id="modalEntryForm" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" id="frmEntry">
      <div class="modal-header">
        <h5 class="modal-title">Entry Data</h5>
        <button type="button" class="close btnClose" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      	<form action="pages/barang/entryData.php" id="formEntry" class="needs-validated" method="POST" enctype="multipart/form-data">
			<div class="modal-body">
			    <div id="errEntry"></div>
			    <div class="form-row mb-3">
			        <div class="col-12 col-md-4 required">
			            <label for="barang_kode" class="control-label font-weight-bolder">Kode Barang <span class="text-danger">*</span></label>
			            <input type="text" class="form-control" name="barang_kode" id="barang_kode" placeholder="Kode Barang"  required>
			            <div class="invalid-feedback"></div>
			        </div>
			        <div class="col-12 col-md-4 required">
			            <label for="barang_nama" class="control-label font-weight-bolder">Nama Barang <span class="text-danger">*</span></label>
			            <input type="text" class="form-control" name="barang_nama" id="barang_nama" placeholder="Nama Barang"  required>
			            <div class="invalid-feedback"></div>
			        </div>
			        <div class="col-md-4 col-12 required">
                        <label for="barang_kategori" class="control-label font-weight-bolder">Kategori Barang <span class="text-danger">*</span></label>
                        <select name="barang_kategori" id="barang_kategori" class="form-control select-all" style="width:100%" >
                        	<option val="">Pilih Data</option>
                        	<?php foreach ($dataKategori as $key => $dd): ?>
                        		<option value="<?= $dd['kategori_id'] ?>"><?= $dd['kategori_nama'] ?></option>
                        	<?php endforeach ?>
						</select>
                        <div class="invalid-feedback"></div>
                    </div>
			    </div>
			    <div class="form-row mb-3">
			    	<div class="col-12 col-md-4 required">
			            <label for="barang_stok" class="control-label font-weight-bolder">Stok Barang <span class="text-danger">*</span></label>
			            <input type="text" class="form-control" name="barang_stok" id="barang_stok" placeholder="Stok Barang"  required>
			            <div class="invalid-feedback"></div>
			        </div>
			        <div class="col-md-4 col-12 required">
                        <label for="barang_satuan" class="control-label font-weight-bolder">Satuan Barang <span class="text-danger">*</span></label>
                        <select name="barang_satuan" id="barang_satuan" class="form-control select-all" style="width:100%" >
                        	<option val="">Pilih Data</option>
                        	<?php foreach ($dataSatuan as $key => $dd): ?>
                        		<option value="<?= $dd['satuan_id'] ?>"><?= $dd['satuan_nama'] ?></option>
                        	<?php endforeach ?>
						</select>
                        <div class="invalid-feedback"></div>
                    </div>
			        <div class="col-12 col-md-4 required">
			            <label for="barang_harga" class="control-label font-weight-bolder">Harga Barang <span class="text-danger">*</span></label>
			            <input type="text" class="form-control" name="barang_harga" id="barang_harga" placeholder="Harga Barang"  required>
			            <div class="invalid-feedback"></div>
			        </div>
			    </div>
			    <div class="form-row mb-3">
			        <div class="col-12 col-md-4 required">
			            <label for="barang_harga_rental" class="control-label font-weight-bolder">Harga Rental Barang <span class="text-danger">*</span></label>
			            <input type="text" class="form-control" name="barang_harga_rental" id="barang_harga_rental" placeholder="Harga Rental Barang"  required>
			            <div class="invalid-feedback"></div>
			        </div>
			        <div class="col-12 col-md-4 required">
			            <label for="barang_foto" class="control-label font-weight-bolder">Foto Barang <span class="text-danger">*</span></label>
			            <div class="custom-file">
							<input type="file" name="barang_foto" class="custom-file-input" id="barang_foto">
							<label class="custom-file-label" for="validatedCustomFile">Pilih file...</label>
						</div>
						<div class="invalid-feedback"></div>
			        </div>
			    </div>
			    <div class="form-row mb-3">
			    	<div class="col-12 col-md-12 required">
			            <label for="barang_ket" class="control-label font-weight-bolder">Keterangan Barang <span class="text-danger">*</span></label>
			            <textarea class="form-control" name="barang_ket" id="barang_ket" placeholder="Keterangan Barang" rows="4"  required></textarea>
			            <div class="invalid-feedback"></div>
			        </div>
			    </div>
			</div>
			<div class="modal-footer">
			    <button type="button" class="btn btn-secondary waves-effect waves-light px-3 py-2 font-weight-bold btnClose"><i class="fas fa-times"></i> Close</button>
			    <button type="submit" class="btn btn-primary waves-effect waves-light px-3 py-2 font-weight-bold" name="save" id="save"><i class="fas fa-check"></i> Submit</button>
			</div>
		</form>
    </div>
  </div>
</div>