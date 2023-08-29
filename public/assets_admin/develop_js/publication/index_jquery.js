jQuery(document).ready(function() 
{
    var $frmRegister                 = $('#frmRegister');
    var $contentRegister             = $('#content_register');
    var $contentIndex                = $('#content_index');
    var $btnViewRegister             = $('#btnViewRegister');
    var $contentTable                = $('#content_table');
    var $a_path_images               = $('#a_path_images');
    var $a_path_doc                  = $('#a_path_doc');
    var $a_path_pdf                  = $('#a_path_pdf');
    var $frmBuscarImage              = $('#frmBuscarImage');
    var $frmBuscarPdf                = $('#frmBuscarPdf');
    var $frmBuscarDoc                = $('#frmBuscarDoc');
    var $myTabContent                = $('#myTabContent');
    var $btn_usar                    = $('#btn_usar');
    var $btn_cancelar                = $('#btn_cancelar');
    var $slc_status                  = $('#status');
    var $type_path                   = $('input#type_path');
    var urlPublication               = base_url+'/admin/publications';

    CKEDITOR.replace('description');

    $('button.btn-list').on('click', function(){
        $contentRegister.hide('fast'); 
        $contentIndex.show('fast'); 
    });

  
    getSearch(base_url + '/admin/resources/search_image');
    getSearch(base_url + '/admin/resources/search_pdf');
    getSearch(base_url + '/admin/resources/search_doc');

    $btnViewRegister.click(function()
    {
        resetForm($frmRegister);
        CKEDITOR.instances['description'].setData('');
        removeMsgValidation($frmRegister);
        $frmRegister.attr( 'action', urlPublication +'/create' );
        $contentRegister.show('fast'); 
        $contentIndex.hide('fast'); 
        $("#publication_date").val(today());
    });

    $contentTable.on('click' ,'#table_body button.edit',function(e)
    {
        e.preventDefault();

        let id  = $(this).parents('tr').attr('id');
     
        $frmRegister.attr('action',urlPublication +'/'+id+'/update');

        findOffer(id);
    
        $contentRegister.show('fast');
        $contentIndex.hide('fast'); 
    });

    $contentTable.on( 'click', '#table_body button.delete', function (e)
    {
        e.preventDefault();

        var $row        = $(this).parents('tr');
        var rol_name    = $row.find('#td_title').text();
        var id          = $row.attr('id');
        var data        =  id;
        let message     = "¿Realmente desea eliminar la publicación: "+rol_name+' ?';
        let url         = base_url+'/admin/publications/'+id+'/delete';
        let title       = 'Eliminar registro'
        let type        = 'warning'
        swal(swalConfirm(title,message,type),
        function(){
            swal.close();
            submitRegister(url,data);
        });
    });

    $frmRegister.on("submit", function(e)
    {
        e.preventDefault();
        loadingButton(true);
        removeMsgValidation($frmRegister);
        let description = CKEDITOR.instances['description'].getData();
        $('#description').text(description);
        let data   = new FormData($frmRegister[0]);
        var route = $frmRegister.attr('action');
        submitRegister(route,data);
    });
  
    $a_path_images.on('click', function(e)
    {
        e.preventDefault();
        $('#modal_path_logo').modal('show');
        $('#nav_image').show();
        $('div#image').addClass('show active');
        $('div#pdf').removeClass('show active');
        $('div#doc').removeClass('show active');
        $('#nav_pdf').hide();
        $('#nav_doc').hide();
        $type_path.val('image');
        
        
    });

    $a_path_pdf.on('click', function(e)
    {
        e.preventDefault();
        $('#modal_path_logo').modal('show');
        $('#nav_image').hide();
        $('div#image').removeClass('show active');
        $('div#doc').removeClass('show active');

        $('div#pdf').addClass('show active');
        $('#nav_pdf').show();
        $('#nav_doc').show();
        $type_path.val('pdf');
        
    });

    $a_path_doc.on('click', function(e)
    {
        e.preventDefault();
        $('#modal_path_logo').modal('show');
        $('#nav_image').hide();
        $('div#image').removeClass('show active');
        $('div#doc').removeClass('show active');

        $('div#pdf').addClass('show active');
        $('#nav_pdf').show();
        $('#nav_doc').show();
        $type_path.val('doc');
        
    });

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

    $(document).on('click','.pagination li a', function(e){
        e.preventDefault();
        route = $(this).attr('href');
        getSearch(route);
    });
    
    $myTabContent.on('click','div.id', function(e){
        e.preventDefault();
        let name    = $(this).find('small.name').text();
        let path    = $(this).find('small.name').attr('id');
        let src     = $(this).find('img').attr('src');
        $('#name_modal').val(name);
        $('#id_modal').val(path);
        $('#id_modal').attr('class',src);
        
    });

    $btn_usar.on('click', function(e){
        e.preventDefault();
        let id      = $('#id_modal').val();
        let src     = $('#id_modal').attr('class');
        let type    = $type_path.val();
        let name    = $('#name_modal').val();
        $('label#name_'+type).text(name);
        $('input#path_'+type).val(id);
        if(type == 'image')
        {
            $('#foto').attr('src', src);
        }
        $('#name_modal').val('');
        $('#modal_path_logo').modal('hide');
    });
    
    $btn_cancelar.on('click', function(e){
        $('#modal_path_logo').modal('hide');
    });

    $slc_status.on('click', function(e){
        let  status = $(this).val();
        
        if(status == 2)
        $('#publication_date').attr('required', true); 
        else
        $('#publication_date').attr('required', false);

    });

});

