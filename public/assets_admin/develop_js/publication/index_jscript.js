//funciones
function loadFrmRegister(data)
{
    resetForm($('#frmRegister'));
    removeMsgValidation($('#frmRegister'));
    
    $('#frmRegister').find("#title").val(data.title);
    CKEDITOR.instances['description'].setData(data.description);
    $('#frmRegister').find("select#type").val(data.type).change();
    $('#frmRegister').find("select#status").val(data.status).change();
    $('#frmRegister').find("#event_date").val(data.event_date);
    $('#frmRegister').find("#start_time").val(data.start_time);
    $('#frmRegister').find("#end_time").val(data.end_time);
    $('#frmRegister').find("#cost").val(data.cost);
    $('#frmRegister').find("#path_image").val(data.path_image);
    $('#frmRegister').find("#path_pdf").val(data.path_pdf);
    $('#frmRegister').find("#path_doc").val(data.path_doc);
    if(data.path_image)
    $('#frmRegister').find("#foto").attr('src',base_url+'/img/resource/image/'+data.path_image);
    if(data.path_pdf)
    $('#frmRegister').find("#foto").attr('src',base_url+'/img/resource/pdf/'+data.path_pdf);
    if(data.path_doc)
    $('#frmRegister').find("#foto").attr('src',base_url+'/img/resource/doc/'+data.path_doc);
    

}

function findOffer(id)
{
    $.ajax({
       
        headers  : {'X-CSRF-TOKEN': csrf_token },
        url      : base_url+'/admin/publications/'+id+'/find',
        type     : 'GET',
        datatype : 'json',
        timeout  : 10000,  
        success  : function(response)
        {
            loadFrmRegister(response.data);
        },
        error: function(xhr, textStatus, thrownError)
        {    
            messagesXhr(xhr,textStatus);
        }
    });
}

function submitRegister(route,datos)
{
    $.ajax({
        url         : route,
        headers     : {'X-CSRF-TOKEN'  : csrf_token },
        type        : 'POST',
        datatype    : 'json',
        data        : datos,
        cache       : false,
        contentType : false,
        processData : false,
        timeout     : 10000,  
        success     : function(response)
        {
            if(response.action != 'not_delete')
            msgSuccess(response.message,'Proceso correcto'); 

            else
            msgError(response.message,'Error'); 

            setTimeout(function(){ location.reload(); }, 1200); 

        },
        error: function(xhr, textStatus, thrownError)
        {    
            messagesXhr(xhr,textStatus);
        },
        complete: function()
        {    
            loadingButton(false);
           
        },

    });
}

function getResource(route, datos)
{
    $.ajax({
    url     	: route,
    headers 	: {'X-CSRF-TOKEN': csrf_token },
    type    	: 'GET',
    datatype    : 'json',
    data        : datos,
    success : function (response)
    {
        $('#'+response.type+'-tab').tab('show');
		$('#li_'+response.type).html(response.resources);
        $('#modal_path_logo').modal('show');
        $('div.id').attr('style','cursor:pointer;');
        
    },
    error: function(xhr, textStatus, thrownError)
    {
        messagesXhr( xhr, textStatus );
    }
    });
}

function getSearch(route)
{
    $.ajax({
    url     	: route,
    headers 	: {'X-CSRF-TOKEN': csrf_token },
    type    	: 'GET',
    datatype    : 'json',
    success : function (response)
    {

        $('#li_'+response.type).html(response.resources);
        $('div.div_delete').hide();
        $('div.id').attr('style','cursor:pointer;');
        
    },
    error: function(xhr, textStatus, thrownError)
    {
        messagesXhr( xhr, textStatus );
    }
    });
}

function loadingButton(estado,$btn)
{
    if (estado==false) {
        $('#btnSave').children('i').removeClass("fa fa-spinner fa-spin");
        $('#btnSave').attr("disabled", false);
    }
    else{
        $('#btnSave').children('i').addClass("fa fa-spinner fa-spin");
        $('#btnSave').attr("disabled", true);
    }
}

function blockFromSearch(value)
{
    if (value==false) {
        $('#search_ruc').attr('readonly',false);
        $('#btn_search_ruc').children('i').removeClass("fa fa-spinner fa-spin");
        $('#btn_search_ruc').children('i').addClass("fa fa-search");
        $('#btn_search_ruc').attr("disabled", false);
    }
    else{
        $('#search_ruc').attr('readonly',true);
        $('#btn_search_ruc').children('i').removeClass("fa fa-search");
        $('#btn_search_ruc').children('i').addClass("fa fa-spinner fa-spin");
        $('#btn_search_ruc').attr("disabled", true);
    }
}

function loadingData($selector)
{
  $selector.html('<div style="height: 200px; width: 100%; text-align: center; padding-top: 50px;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><p>Cargando Datos</p></div>');
}

function mostrarImagen(input) {
    if (input.files && input.files[0]) {
     var reader = new FileReader();
     reader.onload = function (e) {
      $('#foto').attr('src', e.target.result);
     }
     reader.readAsDataURL(input.files[0]);
    }
}

function today()
{
    let d       = new Date();
    let month   = d.getMonth()+1;
    let day     = d.getDate();

    let output = d.getFullYear() + '-' +
        (month<10 ? '0' : '') + month + '-' +
        (day<10 ? '0' : '') + day;
        console.log(output);
    return output;
}






