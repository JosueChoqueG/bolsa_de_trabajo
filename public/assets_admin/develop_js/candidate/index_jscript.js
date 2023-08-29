//funciones
function loadFrmRegister(data)
{
    resetForm($('#frmRegister'));
    removeMsgValidation($('#frmRegister'));

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

   //CARGAMOS LA TABLA DE ESCUELAS (CARRERAS)
   //limpiamos la tabla
   $('#list_college').html('');
   //cargamos los datos 
   data.college_careers.forEach(function(element) 
   {
        tr_clone = $('#footer_template').find("tr:first").clone();

        tr_clone.find('select.item_carrera_id').prop('required',true);
        tr_clone.find('select.item_carrera_id').attr('name','item_carrera_id[]');
        tr_clone.find('input.item_codigo').prop('required',true);
        tr_clone.find('input.item_codigo').attr('name','item_codigo[]');
        // tr_clone.find('input.item_ingreso').prop('required',true);
        tr_clone.find('input.item_ingreso').attr('name','item_ingreso[]');
        // tr_clone.find('input.item_egreso').prop('required',true);
        tr_clone.find('input.item_egreso').attr('name','item_egreso[]');

        tr_clone.find('.item_carrera_id').val(element.id).change();
        tr_clone.find('.item_codigo').val(element.pivot.code);
        tr_clone.find('.item_situacion').val(element.pivot.academic_situation).change();
        tr_clone.find('.item_ingreso').val(element.pivot.admission_date);
        tr_clone.find('.item_egreso').val(element.pivot.egress_date);
        $('#list_college').append(tr_clone);
    });
  
}

function findCandidate(document)
{
    $.ajax({
        url      : base_url+'/admin/candidates/'+document+'/find',
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
    loadingButton(true);
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
           setTimeout(function(){ location.reload(); }, 1000);   
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

function verifyColleges()
{
  var cont = 0;
  $('#list_college tr').each(function()
  {
      cont++;
  }); 
  if(cont>0)
    return true;
  else
  {
    msgWarning('Debe ingresar Datos Académicos','Datos imcompletos');
    return false;
  } 
}

function verify_unique_college(college_id)
{
    var cont = 0;
    
    $('#list_college tr').each(function()
    {
        let id  = $(this).find('.item_carrera_id').val();
    
        if(id==college_id)
        cont++;
    });  

    if(cont>1)
    {
      msgWarning('La escuela seleccionada ya esta en uso','Advertencia'); 
    
      return false;
    }
    else
    {
      return true;
    }  
}






