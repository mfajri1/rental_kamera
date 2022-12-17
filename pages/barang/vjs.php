<script>
	const swalAlert = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary mx-1',
            cancelButton: 'btn btn-danger mx-1',
        },
        buttonsStyling: false
    });
    function run_waitMe(el) {
        el.waitMe({
            effect: 'bounce',
            text: 'Tunggu...',
            bg: 'rgba(255,255,255,0.7)',
            color: '#000',
            maxSize: 100,
            waitTime: -1,
            textPos: 'vertical',
            source: '',
            fontSize: '',
            onClose: function(el) {}
        });
    }

	$(document).ready(function(){
		getDataBarang();
		$('#alert').hide();
		$('#alert#pesanAksi').html('');
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
                    "targets": [ 0, -1 ], //first column
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
        $('#member_nik').val('').trigger('change');
        $('#member_nama').val('').trigger('change');
        $('#member_kode').val('').trigger('change');
        $('#member_jk').val('').trigger('change');
        $('#member_alamat').val('').trigger('change');
        $('#member_umur').val('').trigger('change');
        $('#member_status').val('').trigger('change');
	}

	$(document).on("click", "#btnAdd", function(){
		formReset();
		$('#modalEntryForm').modal({
            backdrop: 'static'
        });
	});

	$(document).on("click", ".btnClose", function(){
		formReset();
		$('#modalEntryForm').modal('toggle');
	});


</script>