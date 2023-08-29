jQuery(document).ready(function() {
    
    var $table_miTabla      = $('#miTabla');
    var $form_delete        = $('#form_delete');
    //menu active
    $('a#a_list_job_offer').siblings().removeClass('active');
    $('a#a_list_job_offer').addClass('active');

    $table_miTabla.DataTable(config_datatable());

    $table_miTabla.on( 'click', 'a.delete', function (e)
    {
        e.preventDefault();

        var $row        = $(this).parents('tr');
        var rol_name    = $row.find('strong.title').text();
        var id          = $row.attr('id');
        let message     = "¿Realmente desea eliminar la oferta laboral: "+rol_name+' ?';

        let url = base_url+'/employers/'+id+'/delete';
        $form_delete.attr('action',url);

        let title = 'Eliminar registro'
        let type = 'warning'
        swal(swalConfirm(title,message,type),
        function(){
            swal.close();
            $form_delete.submit();
        });
    });

});