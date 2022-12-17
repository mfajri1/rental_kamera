<?php 
    $queryUpdt = "UPDATE ta_mode SET status='Daftar', jenis='Daftar RFID' WHERE id_status='1'";
    $resultUpdt = $koneksi->query($queryUpdt);  

    include "pages/member/vPhp.php";
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
    $table = 'ms_member';
    // ambil data
    $dataTable = getTableData($koneksi, $page, $dataPerPage);

    // $querySatuan = "SELECT * FROM reff_satuan ORDER BY satuan_nama";
    // $dataSatuan = getDataDropdown($koneksi, $querySatuan);

    // $queryKategori = "SELECT * FROM reff_kategori ORDER BY kategori_nama";
    // $dataKategori = getDataDropdown($koneksi, $queryKategori);
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
    	<div class="row">
    		<div class="col-md-9">
    			<h6 class="m-0 font-weight-bold text-primary">Data Member</h6>		
    		</div>
    		<div class="col-md-3 d-flex justify-content-end">
    			<button class="btn btn-primary" id="btnAdd">Tambah</button>	
    		</div>
    	</div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="font-weight-bold text-center" width="3%">No</th>
                        <th class="font-weight-bold text-center">Kode </th>
                        <th class="font-weight-bold text-center">Nama</th>
                        <th class="font-weight-bold text-center">Jenis Kelamin</th>
                        <th class="font-weight-bold text-center">Umur</th>
                        <th class="font-weight-bold text-center">Foto</th>
                        <th class="font-weight-bold text-center">Status</th>
                        <th class="font-weight-bold text-center" width="9%">Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($dataTable as $i => $dl){
                            $no = ($i + 1) + (($page - 1) * $dataPerPage);?>
                        <tr>
                            <td><?= $no++ ?></th>
                            <td><?= $dl['member_kode'];?></td>
                            <td><?= $dl['member_nama'];?></td>
                            <?php 
                                if($dl['member_jk'] == 'P'){
                                    $jk = "Pria";
                                }else if($dl['member_jk'] == 'W'){
                                    $jk = "Wanita";
                                }else{
                                    $jk = "";
                                }
                            ?>

                            <td><?= $jk ;?></td>
                            <td><?= $dl['member_umur'];?> Tahun</td>
                            <td><img src="assets2/img/member/<?= $dl['member_foto'] ?>" width="60"></td>
                            <?php 
                                if($dl['member_status'] == 'A'){
                                    $status = "Aktif";
                                }else if($dl['member_status'] == 'N'){
                                    $status = "Nonaktif";
                                }else{
                                    $status = "";
                                }
                            ?>
                            <td><span class="badge badge-info badge-rounded badge-sm px-3 py-2"><?= $status ?></span></td>
                            <td>
                                <a href="?hal=pages/member/formEdit.php&id=<?= $dl['member_kode'];?>" class="text-info pr-1"><i class="fa fa-edit"></i></a>
                                <a href="?hal=pages/member/hapus.php&id=<?= $dl['member_kode'];?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')" class="text-danger pr-1"><i class="fa fa-trash"></i></a>
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
        <form action="pages/member/entryData.php" id="formEntry" class="needs-validated" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <div id="errEntry"></div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-4 required" id="load_rfid">
                        <!-- <label for="member_kode" class="control-label font-weight-bolder">Kode Member <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="member_kode" id="member_kode" placeholder="Kode Member"  required>
                        <div class="invalid-feedback"></div>-->
                    </div>
                    <div class="col-12 col-md-4 required">
                        <label for="member_nama" class="control-label font-weight-bolder">Nama Member <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="member_nama" id="member_nama" placeholder="Nama Member"  required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 col-12 required">
                        <label for="member_jk" class="control-label font-weight-bolder">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="member_jk" id="member_jk" class="form-control select-all" style="width:100%" >
                            <option value="">Pilih Data</option>
                            <option value="P">Pria</option>
                            <option value="W">Wanita</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-4 required">
                        <label for="member_umur" class="control-label font-weight-bolder">Umur <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="member_umur" id="member_umur" placeholder="Umur"  required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-12 col-md-4 required">
                        <label for="member_foto" class="control-label font-weight-bolder">Foto Member <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" name="member_foto" class="custom-file-input" id="member_foto">
                            <label class="custom-file-label" for="validatedCustomFile">Pilih file...</label>
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 col-12 required">
                        <label for="member_status" class="control-label font-weight-bolder">Status Member <span class="text-danger">*</span></label>
                        <select name="member_status" id="member_status" class="form-control select-all" style="width:100%" >
                            <option value="">Pilih Data</option>
                            <option value="A">Aktif</option>
                            <option value="N">Nonaktif</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-12 col-md-12 required">
                        <label for="member_alamat" class="control-label font-weight-bolder">Alamat Member <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="member_alamat" id="member_alamat" placeholder="Alamat Member" rows="4"  required></textarea>
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
