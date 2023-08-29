jQuery(document).ready(function() 
{
    var $frmRegister        = $('#frmRegister');
    var $contentRegister    = $('#content_register');
    var $contentIndex       = $('#content_index');
    var $frmSearch          = $('#frmSearch');
    var $btnViewRegister    = $('#btnViewRegister');
    var $slcSearch          = $('select#slc_search');
    var $contentTable       = $('#content_table');
    var $list_college       = $('#list_college');
    var urlCandidate        = base_url+'/admin/candidates';


    $('button.btn-list').on('click', function(){
        $contentRegister.hide('fast'); 
        $contentIndex.show('fast'); 
         //limpiamos la tabla
        $('#list_college').html('');
    });

    $btnViewRegister.click(function()
    {
        resetForm($frmRegister);
        removeMsgValidation($frmRegister);
        $frmRegister.attr( 'action', urlCandidate+'/create' );
        $contentRegister.show('fast'); 
        $contentIndex.hide('fast'); 

    });

    $slcSearch.on('change',function()
    {
        let input = $(this).val();
        $('#parameter').attr('name',input);
    });

    $contentTable.on('click' ,'#list_candidates button.edit',function(e)
    {
        e.preventDefault();
        let id  = $(this).parents('tr').attr('id');
     
        $frmRegister.attr('action',urlCandidate+'/'+id+'/update');
        findCandidate(id);
      
        $contentRegister.show('fast');
        $contentIndex.hide('fast'); 
    });

    $contentTable.on('click' ,'#list_candidates button.delete',function(e)
    {
        e.preventDefault();
        let id  = $(this).parents('tr').attr('id');
        let route = urlCandidate+'/'+id+'/delete';
        let title = 'Eliminar registro'
        let type = 'warning'
        let message = 'Esta seguro(a) de eliminar al estudiante/egresado ?';
        swal(swalConfirm(title,message,type),
        function(){
            swal.close();
            submitDelete(route);
        });
    });

    $list_college.on('change',' .item_carrera_id', function(){
       let college_id = $(this).val();
       if(! verify_unique_college(college_id)){
          $(this).val(''); 
       }
    });

    $list_college.on('click','button.delete', function(){
        let $tr = $(this).parents('tr');
        let title = 'Eliminar registro'
        let type = 'warning'
        let college_name = $(this).parents('tr').find('.item_carrera_id  option:selected').text();
        let message = 'Esta seguro(a) de eliminar la escuela: '+college_name+' de la lista ?';
        swal(swalConfirm(title,message,type),
        function(){
            swal.close();
           $tr.remove();
        });
     });

    $frmRegister.on("submit", function(e)
    {
        e.preventDefault();
      
        
        removeMsgValidation($frmRegister);
        $('#alert_college').hide();
        $('#message_college').html();

        let data   = new FormData($frmRegister[0]);
        var route = $frmRegister.attr('action');
        if(verifyColleges()){
            submitRegister(route,data);
        }
        
    });
  

    $frmSearch.on('submit',function(e)
    {
        e.preventDefault();

        let route = $(this).attr('action');
        let data = $(this).serialize();
        
        listEmployers(route, data);
    });

    
    $("#photo").change(function(){
        mostrarImagen(this);
    });

    $('#addCollege').on('click', function(){
         
        tr_clone = $('#footer_template').find("tr:first").clone();

        tr_clone.find('select.item_carrera_id').prop('required',true);
        tr_clone.find('select.item_carrera_id').attr('name','item_carrera_id[]');
        tr_clone.find('input.item_codigo').prop('required',true);
        tr_clone.find('input.item_codigo').attr('name','item_codigo[]');
        // tr_clone.find('input.item_ingreso').prop('required',true);
        tr_clone.find('input.item_ingreso').attr('name','item_ingreso[]');
        // tr_clone.find('input.item_egreso').prop('required',true);
        tr_clone.find('input.item_egreso').attr('name','item_egreso[]');

        $list_college.append(tr_clone);
    });
   

});

