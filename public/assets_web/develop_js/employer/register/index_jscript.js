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
                $('#economic_activity').val(JSON.stringify(data.actEconomicas));  
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
            swal("¡ Registro correcto !", "Le enviamos un correo electrónico para que valide la información resgitrada.");
            resetForm($('#frmRegister'));
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






