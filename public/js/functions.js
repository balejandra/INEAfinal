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
    });
} );


//------------------Fin de datadables------------------------