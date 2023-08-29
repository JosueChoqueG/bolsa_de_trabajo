function loadFrmRegister(data)
{
    resetForm($('#frmRegister'));
    removeMsgValidation($('#frmRegister'));

   $('#frmRegister').find("#ruc").val(data.ruc);
   $('#frmRegister').find("#name").val(data.name);
   $('#frmRegister').find('#tradename').val(data.tradename);
   $('#frmRegister').find('#address').val(data.address);
   $('#frmRegister').find('#email').val(data.email);
   $('#frmRegister').find('#sector_id').val(data.sector_id).change();
   $('#frmRegister').find('#status').val(data.status).change();
   $('#frmRegister').find('#description').val(data.description);
   $('#frmRegister').find('#web_page').val(data.web_page);
   $('#frmRegister').find('#contact_name').val(data.contact_name);
   $('#frmRegister').find('#contact_lastname').val(data.contact_lastname);
   $('#frmRegister').find('#contact_role').val(data.contact_role);
   $('#frmRegister').find('#contact_first_phone').val(data.contact_first_phone);
   $('#frmRegister').find('#contact_second_phone').val(data.contact_second_phone);
   if(data.path_logo != null){
   $('#frmRegister').find('#foto').attr('src',base_url+'/img/employer/logo/'+data.path_logo);

   }
  
}

function findEmployer(document)
{
    $.ajax({
        url      : base_url+'/admin/employers/'+document+'/find',
        headers  : {'X-CSRF-TOKEN': csrf_token },
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
        url      : route,
        headers  : {'X-CSRF-TOKEN': csrf_token },
        type     : 'POST',
        datatype : 'json',
        data     : datos,
        cache       : false,
        contentType : false,
        processData : false,
        timeout  : 10000,  
        success  : function(response)
        {
            msgSuccess(response.message,'Proceso correcto'); 
           
           //setTimeout(function(){ location.reload(); }, 1500);   
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






