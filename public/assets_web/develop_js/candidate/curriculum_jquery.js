jQuery(document).ready(function() {
    var $table_miTabla      = $('#miTabla');
    //menu active
    $('a#a_curriculum').siblings().removeClass('active');
    $('a#a_curriculum').addClass('active');
    


    $table_miTabla.DataTable(config_datatable());

    $table_miTabla.on('click','input.status',function(e){
        let id = $(this).parents('tr').attr('id') ;
        
        let route = base_url+'/candidate/curriculum/'+id+'/update';
        curriculumPost(route);
    });

    $table_miTabla.on('click','a.delete',function(e){
        var $row        = $(this).parents('tr');
        let id          = $row.attr('id');
        let message     = "¿Realmente desea eliminar su hoja de vida?";
        let route = base_url+'/candidate/curriculum/'+id+'/delete';
        let title = 'Eliminar registro'
        let type = 'warning'
        swal(swalConfirm(title,message,type),
        function(){
            swal.close();
            curriculumPost(route, $row);
        });
    });

});