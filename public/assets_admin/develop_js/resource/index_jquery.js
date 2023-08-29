jQuery(document).ready(function() {
     var $a_add             = $('#a_add');
     var $frmResource       = $('#frmResource');
     var $frmBuscarImage    = $('#frmBuscarImage');
     var $frmBuscarPdf      = $('#frmBuscarPdf');
     var $frmBuscarDoc      = $('#frmBuscarDoc');
     var $liResource        = $('li.resource');
     var $btn_cancelar      = $('#btn_cancelar');
     

    $a_add.on('click', function(e){
        e.preventDefault();
        removeMsgValidation($frmResource);
        $('#modal_resource').modal('show');
    });
    
    getSearch(base_url + '/admin/resources/search_image');
    getSearch(base_url + '/admin/resources/search_pdf');
    getSearch(base_url + '/admin/resources/search_doc');

    // $frmResource.on('submit', function(e){
    //     e.preventDefault();

    //     let data   = new FormData($frmResource[0]);
    //     let route = base_url + '/admin/resources/create';
    //     postResource(route,data);
    // });

    $frmBuscarImage.on('submit', function(e){
        e.preventDefault();
        let data   = $frmBuscarImage.serialize();
        let route = base_url + '/admin/resources/search_image';
        getResource(route,data);
    });

    $frmBuscarPdf.on('submit', function(e){
        e.preventDefault();
        let data   = $frmBuscarPdf.serialize();
        let route = base_url + '/admin/resources/search_pdf';
        getResource(route,data);
    });

    $frmBuscarDoc.on('submit', function(e){
        e.preventDefault();

        let data    = $frmBuscarDoc.serialize();
        let route   = base_url + '/admin/resources/search_doc';
        getResource(route,data);
    });

    $liResource.on( 'click', 'button.delete', function (e)
    {
        e.preventDefault();
        var $row        = $(this).parents('div.id');
        var rol_name    = $row.find('small.name').text();
        var id          = $row.attr('id');
        var data        =  id;
        let message     = "¿Realmente desea eliminar el recurso: "+rol_name+' ?';

        let url = base_url+'/admin/resources/'+id+'/delete';

        let title = 'Eliminar registro'
        let type = 'warning'
        swal(swalConfirm(title,message,type),
        function(){
            swal.close();
            postResource(url,data);

        });
    });
    
    $(document).on('click','.pagination li a', function(e){
        e.preventDefault();
        route = $(this).attr('href');
        getSearch(route);
    });

    $("#path").change(function(){
        mostrarImagen(this);
    });

    $btn_cancelar.on('click', function(e){
        e.preventDefault();
        $('#modal_resource').modal('hide');
    });

  
});
  