jQuery(document).ready(function() {
    var $table_miTabla      = $('#miTabla');
    //menu active
    $('a#a_postulation').siblings().removeClass('active');
    $('a#a_postulation').addClass('active');

    $table_miTabla.DataTable(config_datatable());

    $table_miTabla.on('click','a.delete',function(e){
        var $row        = $(this).parents('tr');
        let id          = $row.attr('id');
        let title_of    = $row.find('td.title').children('a').text();
        let message     = "¿Realmente desea su postulación a la oferta laboral: "+title_of+" ?";
        let route = base_url+'/candidate/postulation/'+id+'/delete';
        let title = 'Eliminar registro'
        let type = 'warning'
        swal(swalConfirm(title,message,type),
        function(){
            swal.close();
            postulationPost(route, $row);
        });
    });

});