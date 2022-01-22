//-------------------Datatables----------------------------

$(document).ready(function() {
    $('#TablePermissions').DataTable({
    	 "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true,
    });

} );

$(document).ready(function() {
    $('#TableRoles').DataTable({
    	"paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true,
<<<<<<< HEAD
=======
        "buttons": [
            "copy",
            "csv",
            "xls",
            "pdf",
            { "type": "print", "buttonText": "Print me!" }
        ]
>>>>>>> 946a5ec3f8ba2e8de7f6efbb3b7bbe5635983500
    });
} );


<<<<<<< HEAD
//------------------Fin de datadables------------------------
=======
//------------------Fin de datadables------------------------
>>>>>>> 946a5ec3f8ba2e8de7f6efbb3b7bbe5635983500
