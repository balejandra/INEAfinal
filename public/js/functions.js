

//-------------------Datatables----------------------------


$(document).ready(function() {
    $('#TableRoles').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );


$(document).ready(function() {
    $('#TablePermissions').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );

$(document).ready(function() {
    $('#TableMenus').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );

$(document).ready(function() {
    $('#users-table').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );

$(document).ready(function() {
    $('#capitanias-table').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );

$(document).ready(function() {
    $('#auditables-table').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );
