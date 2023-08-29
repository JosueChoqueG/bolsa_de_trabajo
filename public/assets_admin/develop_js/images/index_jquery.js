jQuery(document).ready(function() 
{
    var $a_path_logo                 = $('#a_path_logo');
    var $frmBuscarImage              = $('#frmBuscarImage');
    var $frmSubmit                   = $('#frmSubmit');
    var $btn_cancelar                = $('#btn_cancelar');
    var $myTabContent                = $('#myTabContent');
    var $liImage                     = $('.li_image');
    var urlImages                    = base_url+'/admin/publications';

    
   
    getSearch(base_url + '/admin/resources/search_image');
    $('button.btn-list').on('click', function(){
        window.location.href = urlImages;
    });
    $a_path_logo.on('click', function(e)
    { 
        e.preventDefault();
        let route = base_url + '/admin/resources';
        let data  = {'path_logo':'true'};
        getResource(route,data);
    });

    $frmBuscarImage.on('submit', function(e){
        e.preventDefault();
        let data   = $frmBuscarImage.serialize();
        let route = base_url + '/admin/resources/search_image';
        getResource(route,data);
    });
    $myTabContent.on('click','div.id', function(e){
        e.preventDefault();
        let id      = $(this).attr('id');
        let name    = $(this).find('small.name').text();
        $('#name_modal').val(name);
        $('#resource_id').val(id); 
    });

    $frmSubmit.on('submit', function(e){
        e.preventDefault();
        let id = $('#publication_id').val(); 
        let datos = $frmSubmit.serialize();
        let route = urlImages+'/'+id+'/images/create';
        submitRegister(route,datos);
        
    });
    
    $btn_cancelar.on('click', function(e){
        $('#modal_path_logo').modal('hide');
    });

    $(document).on('click','.pagination li a', function(e){
        e.preventDefault();
        route = $(this).attr('href');
        getSearch(route);
    });

    $liImage.on( 'click', 'button.delete_image', function (e)
    {
        e.preventDefault();
        var $row        = $(this).parents('div.id_image');
        var rol_name    = $row.find('h6.image_name').text();
        var id          = $row.attr('id');
        var data        =  id;
        let message     = "¿Realmente desea eliminar la imagen: "+rol_name+' ?';

        let url = urlImages+'/'+id+'/images/delete';

        let title = 'Eliminar registro'
        let type = 'warning'
        swal(swalConfirm(title,message,type),
        function(){
            swal.close();
            submitDelete(url)

        });
    });

});

