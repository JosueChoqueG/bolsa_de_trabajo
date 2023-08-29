function config_datatable() {

    let config = {
        language: {
            "decimal": ".",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            searchPlaceholder: "Buscar..."
        },
        buttons: [
            'copy', 'excel', 'pdf'
        ],
        "lengthMenu": [[10, 50,100, -1], [10, 50, 100, "Todos"]]


    }

    return config;
}

function loadDataTable(selector, url, columns) {
    selector.DataTable().destroy();

    let config = config_datatable();

    config.ajax = {
        url: url,
        type: 'GET',
        dataSrc: function (json) {
            return json.data;
        },
        error: function (xhr, textStatus, thrownError) {
            //loadDataTable( selector, url , columns);
        }
    }

    config.rowId = 'id';
    config.columns = columns;
    return selector.DataTable(config);
}