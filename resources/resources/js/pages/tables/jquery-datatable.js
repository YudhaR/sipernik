$(function () {
    $('.js-basic-example').DataTable({          
          "language": {
            "sProcessing":   "Sedang memproses...",
			"sLengthMenu":   "Tampilkan _MENU_ entri",
			"sZeroRecords":  "<a class='col-red'>Tidak ada data untuk ditampilkan</a>",
			"sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
			"sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
			"sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
			"sInfoPostFix":  "",
			"sSearch":       "<i class='fa fa-search'> </i> Cari : ",
			"sUrl":          "",
			"oPaginate": {
				"sFirst":    "Pertama",
				"sPrevious": "Sebelumnya",
				"sNext":     "Selanjutnya",
				"sLast":     "Terakhir"
			}
        }
        });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});