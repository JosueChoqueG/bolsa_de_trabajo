//funciones
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
   $('#frmRegister').find('#foto').attr('src',base_url+'/img/employer/logo/'+data.path_logo);
   if(data.economic_activity)
   {
       let economic_activity = JSON.parse(data.economic_activity);
        $('ul#economic_activity').html('');
        economic_activity.forEach(element => {
            $('ul#economic_activity').append($('<li>').append($('<span>').text(element)
                            
            ));
        });
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

function queryRuc(data)
{
    $.ajax({
        url      : base_url+'/queryRuc',
        headers  : {'X-CSRF-TOKEN': csrf_token },
        type     : 'POST',
        data     : data,
        datatype : 'json',
        timeout  : 15000,  
        beforeSend: function( xhr ) {
            blockFromSearch(true);
        },
        success: function(response)
        {
            removeMsgValidation($('#frmQueryRuc'));
            let data = response.data;
            if(data != null){
                msgSuccess('Contribuyente encontrado');
                $('#ruc').val(data.ruc);
                $('#name').val(data.razonSocial);
                $('#tradename').val(data.nombreComercial);
                $('#address').val(data.direccion);
               
            }
            else{
                msgWarning('Contribuyente No encontrado');
            }
        },
        error: function(xhr, textStatus, thrownError)
        {    
            messagesXhr(xhr,textStatus);
        },
        complete: function(){
            blockFromSearch(false);
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
           setTimeout(function(){ location.reload(); }, 1500);   
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

function submitDelete(route)
{
    $.ajax({
        url      : route,
        headers  : {'X-CSRF-TOKEN': csrf_token },
        type     : 'POST',
        datatype : 'json',
        cache       : false,
        contentType : false,
        processData : false,
        timeout  : 10000,  
        success  : function(response)
        {
            if(response.action == 'delete')
                msgSuccess(response.message,'Proceso correcto'); 

            else
                msgError(response.message,'Proceso erroneo'); 

            setTimeout(function(){ location.reload(); }, 1200);  
        },
        error: function(xhr, textStatus, thrownError)
        {    
            messagesXhr(xhr,textStatus);
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






