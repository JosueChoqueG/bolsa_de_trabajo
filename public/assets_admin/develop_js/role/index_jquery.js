jQuery(document).ready(function() {
    //variables
    var $table            = $('table#table_role');
    var $form_delete      = $('#form_delete');

    $table.DataTable(config_datatable());

    $table.on( 'click', 'button.delete', function (e)
    {
        e.preventDefault();

        var $row    = $(this).parents('tr');
        var rol_name = $row.find('td').eq(0).text();
        var id      = $row.attr('id');
        let message = "¿Realmente desea eliminar el rol "+rol_name+' ?';

        let url = base_url+'/admin/roles/'+id+'/delete';
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
  