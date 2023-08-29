function msgSuccess(message,title) {
    toastr.success(message,title,{
        "closeButton": true,
        "timeOut":10000,
        "progressBar": true,
        "showMethod": "fadeIn",
           "hideMethod": "fadeOut"

    })
}
function msgError(message,title) {
    toastr.error(message,title,{
        "closeButton": true,
        "timeOut":10000,
        "progressBar": true,
        "showMethod": "fadeIn",
           "hideMethod": "fadeOut"

    })
}
function msgInfo(message,title) {
    toastr.info(message,title,{
        "closeButton": true,
        "timeOut":10000,
        "progressBar": true,
        "showMethod": "fadeIn",
           "hideMethod": "fadeOut"

    })
}
function msgWarning(message,title) {
    toastr.warning(message,title,{
        "closeButton": true,
        "timeOut":10000,
        "progressBar": true,
        "showMethod": "fadeIn",
           "hideMethod": "fadeOut"

    })
}

function messagesXhr(xhr, textStatus = null) {
    switch (xhr.status) {
        case 0:
            msgWarning('No se pudo conectar con el servidor.');
            break;
        case 302:
            location.reload();
            msgWarning('Su sessión ha expirado.');
            break;
        case 408:
            msgWarning('El proceso excedio el limite de tiempo permitido.');
            break;
        case 403:
            msgWarning('No tiene permiso para realizar esta accion');
            break;  
        case 419:
            msgWarning('Su llave de seguridad ha expirado, intentelo otra vez.');
            location.reload();
            break;  
        case 422:
            addMsgValidation(xhr)
            break;
        case 500:
            msgWarning('No se pudo realizar la operación. inténtelo otra vez');
            break;
        case 588:
            msgWarning(xhr.responseJSON.message,'Proceso inconcluso');
            break;   
        default:
            msgError('ocurrio un error, intentelo otra vez.');
            location.reload;
            break;
    }

}

function addMsgValidation(xhr) {
    let messages = xhr.responseJSON.errors;

    msgError('Se encontraron errores, revice el formulario');

    $.each(messages, function (ind, elem) {
        let index = ind.split('.',1);
        //validacion de tabla
        if(index[0] == 'item_codigo' || index[0] == 'item_carrera_id' || index[0] == 'item_ingreso')
        {
            $('#alert_college').show();
            $('#msg_college').text(elem);
        }

        $('#' + ind).addClass('is-invalid');
        $('#' + ind + '-error').addClass('text-danger error');
        $('#' + ind + '-error').text(elem);
    });
}
function removeMsgValidation($selector) {
   
    $selector.find('input').removeClass('is-invalid');
    $selector.find('select').removeClass('is-invalid');
    $selector.find('textarea').removeClass('is-invalid');
    $selector.find('em.messages').text('');
}


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
            "lengthMenu": "Mostrar _MENU_ Entradas",
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
        ]


    }

    return config;
}
//funcion que caraga los datos en el dataTable
function loadDataTable(selector, url, columns) {
    selector.DataTable().destroy();

    let config = config_datatable();

    config.ajax = {
        url: url,
        type: 'GET',
        dataSrc: function (json) {
            console.log(json);
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

//funcion que caraga los datos en el dataTable con búsqueda
function loadDataTableSearch(selector, url, columns, params) {
    selector.DataTable().destroy();

    let config = config_datatable();
    
    config.ajax = {
        url: url,
        type: 'GET',
        dataType: "json",
        data: params,
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


function loadDataSelect2(route, $selector ,texto='Seleccione') {
    $selector.html('<option value="">'+texto+'</option>');
    $.ajax({
        url: route,
        headers: { 'X-CSRF-TOKEN': csrf_token },
        type: 'GET',
        timeout: 5000,
        async: false,
        success: function (response) {
            data = $.map(response.data, function (obj) {
                
                return tmp = {
                    'id': obj.id,
                    'text': obj.name
                };
            });

            $selector.select2('destroy');
            var config = {};
            config.data = data;
            $selector.select2(config);

        },
        error: function (xhr, textStatus, thrownError) {
            //messagesXhr(xhr, textStatus);
            console.log('error al cargar datos select2 ' + textStatus);
            // loadDataSelect2( $selector);
        }
    });
}

function resetForm($selector) {
    $selector[0].reset();
    removeMsgValidation($selector);

}


function swalConfirm(title,message,type){
    let data = {
        title: title,
        text: message,
        type: type,
        showCancelButton: true,
        confirmButtonClass: "btn-primary",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    } 
    return data;
}

function configHighcharts()
{
  Highcharts.setOptions({
		lang: {
            viewFullscreen: "Ver en pantalla completa",
            printChart: "Imprimir Gráfico",
            downloadPDF: "Descargar PDF",
            downloadJPEG: "Descargar JPEG",
            downloadPNG: "Descargar PNG",
            downloadSVG: "Descargar SVG",
            downloadXLS: "Descargar XLS",
            downloadCSV: "Descargar CSV",
            drillUpText: "◁ Volver a categorias",
            viewData: "Ver tabla",
            openInCloud: "Ver gráfico en la nube"
        }
    });
}

function selected(route,$selector)
{
    $.ajax({
        url      : route,
        type     : 'GET',
        datatype : 'json',
        timeout  : 10000,  
        async   : false,
        success  : function(response)
        {
             $selector.html('');
            $selector.append(
                $('<option>').append(
                    $('<span>').text('')
                ));
    
            for (let i in response.data) 
            {
                $selector.append(
                    $('<option>',
                    {
                        'value':response.data[i].id
                    }).text(response.data[i].name)
                );
            }
        },
        error: function(xhr, textStatus, thrownError)
        {    
            messagesXhr(xhr,textStatus);
        }
    }); 
} 