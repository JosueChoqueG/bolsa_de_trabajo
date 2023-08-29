//funciones
function loadFrmRegister(data)
{
    resetForm($('#frmRegister'));
    removeMsgValidation($('#frmRegister'));

   $('#frmRegister').find("#id").val(data.id);
   $('#frmRegister').find("#document").val(data.document);
   $('#frmRegister').find("#name").val(data.name);
   $('#frmRegister').find('#first_lastname').val(data.first_lastname);
   $('#frmRegister').find('#second_lastname').val(data.second_lastname);
   $('#frmRegister').find('#gender').val(data.gender).change();
   $('#frmRegister').find('#birthdate').val(data.birthdate);
   $('#frmRegister').find('#civil_status').val(data.civil_status).change();
   $('#frmRegister').find('#disability').val(data.disability);
   $('#frmRegister').find('#email').val(data.email);
   $('#frmRegister').find('#first_phone').val(data.first_phone);
   $('#frmRegister').find('#second_phone').val(data.second_phone);
   $('#frmRegister').find('#status').val(data.status).change();
   $('#frmRegister').find('#foto').attr('src',base_url+'/img/candidate/photo/'+data.path_photo);
  
}

function findCandidate(document)
{
    $.ajax({
        url      : base_url+'/candidates/'+document+'/find',
        headers  : {'X-CSRF-TOKEN': csrf_token },
        type     : 'GET',
        datatype : 'json',
        timeout  : 10000,  
        beforeSend: function( xhr ) {
            blockFromSearch(true);
        },
        success  : function(response)
        {
            let data = response.data;
            if(data != null)
                if(data.activity_date == null)
                loadFrmRegister(response.data);
                else
                msgWarning('Usted ya se encuentra registrado',''); 
            else
               msgWarning('No se encontraron coincidencias','');     
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
function blockFromSearch(value)
{
    if (value==false) {
        $('#document').attr('readonly',false);
        $('#btnSearch').children('i').removeClass("fa fa-spinner fa-spin");
        $('#btnSearch').children('i').addClass("fa fa-search");
        $('#btnSearch').attr("disabled", false);
    }
    else{
        $('#document').attr('readonly',true);
        $('#btnSearch').children('i').removeClass("fa fa-search");
        $('#btnSearch').children('i').addClass("fa fa-spinner fa-spin");
        $('#btnSearch').attr("disabled", true);
    }
}
function submitRegister(route,datos)
{
    loadingButton(true);
    $.ajax({
        url      : route,
        headers  : {'X-CSRF-TOKEN': csrf_token },
        type     : 'POST',
        datatype : 'json',
        data     : datos,
        timeout  : 10000,  
        success  : function(response)
        {
            msgSuccess(response.message,'Proceso correcto'); 
            swal("¡ Registro correcto !", "Para concluir con su registro  hemos enviado los datos de acceso a su correo electrónico");
            resetForm($('#frmRegister'));
           //setTimeout(function(){ location.reload(); }, 1200);   
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

function loadingData($selector)
{
  $selector.html('<div style="height: 200px; width: 100%; text-align: center; padding-top: 50px;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><p>Cargando Datos</p></div>');
}









