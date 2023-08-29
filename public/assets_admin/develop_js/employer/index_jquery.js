jQuery(document).ready(function() 
{
    var $frmRegister      = $('#frmRegister');
    var $contentRegister  = $('#content_register');
    var $contentIndex     = $('#content_index');
    var $frmSearch        = $('#frmSearch');
    var $btnViewRegister  = $('#btnViewRegister');
    var $slcSearch        = $('select#slc_search');
    var $contentTable     = $('#content_table');
    var urlEmployer       = base_url+'/admin/employers';

    
    $('button.btn-list').on('click', function(){
        $contentRegister.hide('fast'); 
        $contentIndex.show('fast'); 
        $('#frmQueryRuc').show();
    });

    $btnViewRegister.click(function()
    {
        
        resetForm($frmRegister);
        removeMsgValidation($frmRegister);
        $frmRegister.attr( 'action', urlEmployer+'/create' );
        $contentRegister.show('fast'); 
        $contentIndex.hide('fast'); 

    });

    $slcSearch.on('change',function()
    {
        let input = $(this).val();
        $('#parameter').attr('name',input);
    });

    $contentTable.on('click' ,'#list_employers button.edit',function(e)
    {
        e.preventDefault();
        let id  = $(this).parents('tr').attr('id');
     
        $frmRegister.attr('action',urlEmployer+'/'+id+'/update');
        findEmployer(id);
        $('#frmQueryRuc').hide();
        $contentRegister.show('fast');
        $contentIndex.hide('fast'); 
    });

    $contentTable.on('click' ,'#list_employers button.delete',function(e)
    {
        e.preventDefault();
        let id  = $(this).parents('tr').attr('id');
        let route = urlEmployer+'/'+id+'/delete';
        let title = 'Eliminar registro'
        let type = 'warning'
        let message = 'Esta seguro(a) de eliminar a este empleador ?';
        swal(swalConfirm(title,message,type),
        function(){
            swal.close();
            submitDelete(route);
        });
    });

    $frmRegister.on("submit", function(e)
    {
        e.preventDefault();
        loadingButton(true);
        
        removeMsgValidation($frmRegister);
        let data   = new FormData($frmRegister[0]);
        var route = $frmRegister.attr('action');
        submitRegister(route,data);
    });
    $('#frmQueryRuc').on('submit',function(e){
        e.preventDefault();
        let data = $(this).serialize();
        queryRuc(data);
    });

    $frmSearch.on('submit',function(e)
    {
        e.preventDefault();

        let route = $(this).attr('action');
        let data = $(this).serialize();
        
        listEmployers(route, data);
    });

    $("#logo").change(function(){
        mostrarImagen(this);
    });
});

