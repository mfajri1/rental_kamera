<script type="text/javascript">

	let statIntervalRfid = null;
    let statIntervalQr = null;

    $(document).on('click', '#btnResetRfid', function(){
        var tanggalTransaksi = $('#transaksi_tanggal').val();
        $.ajax({
            type : 'POST',
            dataType : 'json',
            url : 'pages/kasir/resetRfid.php',
            data : {
                jenis : 'resetRfid',
                tanggal : tanggalTransaksi 
            }, 
            success : function(result){
                if(result == true){
                    clearInterval(statIntervalQr);
                    alert('Berhasil Hapus Data');
                }else{
                    alert('Gagal Hapus Data');
                }
                
                statIntervalRfid = setInterval(function(){
                    $("#load_rfid").load('pages/kasir/dataRfid.php')
                }, 1000);
            }
        });
    });

    $(document).on('click', '#btnSimpanRfid', function(){
        var kodeTransaksi   = $('#transaksi_kode').val();
        var kodeMember      = $('#member_kode').val();
        var tanggalTransaksi= $('#transaksi_tanggal').val();
        var lamaPinjam      = $('#transaksi_lama').val();

        if(tanggalTransaksi == '00-00-0000' || tanggalTransaksi == "" || kodeTransaksi == "" || lamaPinjam == ""){
            alert("Input Data Terlebih Dahulu")
        }else{
            $.ajax({
                type : 'POST',
                dataType : 'json',
                url : 'pages/kasir/simpanRfid.php',
                data : {
                    kodeTransaksi : kodeTransaksi,
                    kodeMember : kodeMember,
                    tanggal : tanggalTransaksi,
                    lamaPinjam : lamaPinjam,
                }, 
                success : function(result){
                    if(result == 'inpKode'){
                        alert("Isikan Kode Terlebih Dahulu");
                    }else if(result == 'noMember'){
                        alert('Belum Terdaftar Sebagai Member');
                    }else if(result == 'gagalSimpan'){
                        alert('Gagal Simpan Data');
                    }else if(result == 'suksesSimpan'){
                        alert('Berhasil Simpan Data');
                        clearInterval(statIntervalRfid);
                        statIntervalQr = setInterval(function(){
                            $("#load_qr").load('pages/kasir/dataQr.php');
                        }, 1000);
                    }else if(result == 'suksesUpdate'){
                        alert('Berhasil Update Data');
                        clearInterval(statIntervalRfid);
                        statIntervalQr = setInterval(function(){
                            $("#load_qr").load('pages/kasir/dataQr.php');
                        }, 1000);
                    }else if(result == 'gagalUpdate'){
                        alert('Gagal Update Data');
                    }
                }
            });
        }
    });


    $(document).on('click', '#btnResetQr', function(){
        var tanggalTransaksi = $('#transaksi_tanggal').val();
        $.ajax({
            type : 'POST',
            dataType : 'json',
            url : 'pages/kasir/resetQr.php',
            data : {
                jenis : 'resetQr',
                tanggal : tanggalTransaksi 
            }, 
            success : function(result){
                if(result == true){
                    alert('Berhasil Hapus Data');
                }else{
                    alert('Gagal Hapus Data');
                }

                statInterval = setInterval(function(){
                    $("#load_qr").load('pages/kasir/dataQr.php');
                }, 1000);


            }
        });
    });

    $(document).on('click', '#btnSimpanQr', function(){
        var nomor = $('#no').val();
        var kodeTransaksi = $('#transaksi_kode').val();
        var kodeBarang = $('#barang_kode').val();
        var kodeMember = $('#member_kode').val();
        var tanggalTransaksi = $('#transaksi_tanggal').val();

        if(tanggalTransaksi == '00-00-0000' || tanggalTransaksi == "" || kodeBarang == "") {
            alert("Input Data Terlebih Dahulu")
        }else{
            $.ajax({
                type : 'POST',
                dataType : 'json',
                url : 'pages/kasir/simpanQr.php',
                data : {
                    jenis : 'simpanQr',
                    kodeTransaksi : kodeTransaksi,
                    kodeMember : kodeMember,
                    kodeBarang : kodeBarang,
                    tanggal : tanggalTransaksi,
                }, 
                success : function(result){
                    if(result == 'inpKode'){
                        alert("Isikan Data Terlebih Dahulu");
                    }else if(result == 'prosesSimpan'){
                        alert('Berhasil Simpan Data');
                        prosesSimpanData();
                    }
                }
            });
        }
    });

    function prosesSimpanData(){
        var nomor           = $('#nomor').val();
        var kodeBarang      = $('#barang_kode').val();
        var jumlahPinjam    = $('#barang_jumlah').val();
        var adminId         = $('#adminId').val();
        var kodeTransaksi   = $('#transaksi_kode').val();
        var tanggalTransaksi= $('#transaksi_tanggal').val();
        var lamaPinjam      = $('#transaksi_lama').val();
        var kodeMember      = $('#member_kode').val();
        var kategoriNama    = "";
        var satuanNama      = "";
        var kategoriId      = "";
        var satuanId        = "";
        var hargaRental     = "";
        var stokBarang      = "";
        var namaBarang      = "";


        $.ajax({
            type : 'POST',
            dataType : 'json',
            url : 'pages/kasir/getKodeBarang.php',
            data : {
                kodeBarang : kodeBarang
            }, 
            success : function(result){
                namaBarang = result.barang_nama;
                kategoriNama = result.kategori_nama;
                satuanNama = result.satuan_nama;
                kategoriId = result.kategori_id;
                satuanId = result.satuan_id;
                hargaRental = result.barang_harga_rental;
                stokBarang = result.barang_stok;

                totalPinjam = parseInt(jumlahPinjam) * hargaRental;

                transaksi(adminId, kodeTransaksi, tanggalTransaksi, lamaPinjam, kodeMember, kodeBarang, nomor, namaBarang, kategoriNama, jumlahPinjam, satuanNama, kategoriId, satuanId, hargaRental, stokBarang, totalPinjam);

            }
        });
    }

    function transaksi(adminId, kodeTransaksi, tanggalTransaksi, lamaPinjam, kodeMember, kodeBarang, nomor, namaBarang, kategoriNama, jumlahPinjam, satuanNama, kategoriId, satuanId, hargaRental, stokBarang, totalPinjam){
        var jml = 0;
        var jmlData = $('#jmlData').val();
        var html = "";

        html += '<tr id="row'+ nomor +'">';
            html += '<td width="20%">';
                html += '<input type="text" class="form-control" name="kodeBarangTrans[]" id="kodeBarangTrans'+ nomor +'" value="'+ kodeBarang +'" readonly>';
                html += '<input type="text" class="form-control" name="nomorTrans[]" id="nomorTrans'+ nomor +'" value="'+ nomor +'">';
            html += '</td>';
            html += '<td width="20%">';
                html += '<input type="text" class="form-control" name="namaBarangTrans[]" id="namaBarangTrans'+ nomor +'" value="'+ namaBarang +'" readonly>';
            html += '</td>';
            html += '<td width="18%">';
                html += '<input type="text" class="form-control" name="kategoriBarangTrans[]" id="kategoriBarangTrans'+ nomor +'" value="'+ kategoriNama +'" readonly>';
                html += '<input type="hidden" class="form-control" name="kategoriIdTrans[]" id="kategoriIdTrans'+ nomor +'" value="'+ kategoriId +'" readonly>';
            html += '</td>';
            html += '<td width="18%">';
                html += '<input type="text" class="form-control" name="hargaBarangTrans[]" id="hargaBarangTrans'+ nomor +'" value="'+ hargaRental +'" readonly>';
            html += '</td>';
            html += '<td width="4%">';
                html += '<input type="text" class="form-control" name="jumlahBarangTrans[]" id="jumlahBarangTrans'+ nomor +'" value="'+ jumlahPinjam +'" readonly>';
            html += '</td>';
            html += '<td width="6%">';
                html += '<input type="text" class="form-control" name="satuanBarangTrans[]" id="satuanBarangTrans'+ nomor +'" value="'+ satuanNama +'" readonly>';
                html += '<input type="hidden" class="form-control" name="satuanIdTrans[]" id="satuanIdTrans'+ nomor +'" value="'+ satuanId +'" readonly>';
            html += '</td>';

            html += '<td width="16%">';
                html += '<input type="text" class="form-control" id="totalTrans'+ nomor +'" name="totalTrans[]" value="'+ totalPinjam +'">';
            html += '</td>';
            html += '<td width="4%">';
                html += '<a onClick="del('+ nomor +')" class="btn btn-danger px-1 py-0 mt-1"><i class="fas fa-1x fa-times-circle"></i></a>';
            html += '</td>';
        html += '</tr>';

        $(html).appendTo('#isiTransaksi');


        $.ajax({
            url : 'pages/kasir/simpanDetailTransaksi.php',
            type : 'POST',
            dataType : 'json',
            data : {
                adminId : adminId,
                kodeTransaksi : kodeTransaksi,
                tanggalTransaksi : tanggalTransaksi,
                lamaPinjam : lamaPinjam,
                kodeMember : kodeMember, 
                kodeBarang: kodeBarang, 
                nomor : nomor, 
                namaBarang : namaBarang, 
                kategoriNama : kategoriNama, 
                jumlahPinjam : jumlahPinjam, 
                satuanNama : satuanNama, 
                kategoriId : kategoriId, 
                satuanId : satuanId, 
                hargaRental : hargaRental, 
                stokBarang : stokBarang, 
                totalPinjam : totalPinjam
            },
            success : function(result){

            }
        });


        jml = parseInt(jmlData) + 1;
        $('#jmlData').val(jml);

        var nomor = (nomor-1) + 2;
        $('#nomor').val(nomor);
    }

    function del(nomor){
        // var stotal = parseInt($('#jumlah'+no).val());
        // var alltotal = parseInt($('#stotal').val());
        // var newtotal = alltotal - stotal;

        // $('#stotal').val(newtotal);
        var jumlahData = $('#jmlData').val();
        $('#jmlData').val(jumlahData - 1);
        $('#row'+nomor).remove();
    }
</script>