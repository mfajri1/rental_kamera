<script type="text/javascript">
	$(document).ready(function(){
		getDataBarang();
	});

	function getDataBarang(){
		$('#dataTable').DataTable({
			"pagingType": "full_numbers",
            "destroy": true,
            "processing":true,
            "language": {
                "loadingRecords": '&nbsp;',
                "processing": 'Loading data...'
            },
            "ordering": false,
            "columnDefs": [
                {
                    "targets": [ 0, -1, -2, -3 ], //first column
                    "orderable": false, //set not orderable
                    "className": 'text-center'
                },
                {
                    "targets": [ -2, -3 ], //last column
                    "orderable": false, //set not orderable
                    "className": 'text-right'
                },
            ],
		});
	}

    function formReset(){
        $('#errEntry').html('');
        $('form#formEntry').trigger('reset');
        $('form#formEntry').removeClass('was-validated');
        $('#barang_kode').val('').trigger('change');
        $('#barang_nama').val('').trigger('change');
        $('#barang_stok').val('').trigger('change');
        $('#barang_kategori').val('').trigger('change');
        $('#barang_satuan').val('').trigger('change');
        $('#barang_ket').val('').trigger('change');
        $('#barang_foto').val('').trigger('change');
        $('#barang_harga').val('').trigger('change');
        $('#barang_harga_rental').val('').trigger('change');
    }

    let statInterval = null;

    $(document).on("click", "#btnAdd", function(){
        formReset();
        statInterval = setInterval(function(){
            $("#load_rfid").load('pages/member/dataRfid.php')
        }, 1000);
        $('#modalEntryForm').modal({
            backdrop: 'static'
        });
    });

    $(document).on("click", ".btnClose", function(){
        formReset();
        clearInterval(statInterval);
        $('#modalEntryForm').modal('toggle');
    });
</script>