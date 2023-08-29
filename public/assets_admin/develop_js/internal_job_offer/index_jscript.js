//funciones
function loadFrmRegister(data)
{
    resetForm($('#frmRegister'));
    removeMsgValidation($('#frmRegister'));
    
    $('#frmRegister').find("#title").val(data.title);
    $('#frmRegister').find("#title_complement").val(data.title_complement);
    CKEDITOR.instances['description'].setData(data.description);
    $('#frmRegister').find("select#category").val(data.category).change();
    $('#frmRegister').find("select#area_id").val(data.area_id).change();
    
    //seleccionar carreras
    let colleges = data.college_careers;
    colleges.forEach(function(element) {
        $('#college_'+element.id).prop('checked',true);
    });
    //seleccionar ubicacion
    $('#frmRegister').find('select#countrie_id option[value="'+data.countrie_id+'"]').attr('selected',true).trigger('change');
    if(data.countrie_id == 173 && data.geolocation_id != null){
        $('#frmRegister').find('select#department_code option[value="'+data.geolocation.department_code+'0000"]').attr('selected',true).trigger('change');
        if(data.geolocation.province_code != '00'){
            setTimeout(function(){ 
                $('#frmRegister').find('select#province_code option[value="'+data.geolocation.department_code+''+data.geolocation.province_code+'00"]').attr('selected',true).trigger('change');
                if(data.geolocation.province_code != '00'){
                    setTimeout(function(){ 
                        $('#frmRegister').find('select#district_code option[value="'+data.geolocation_id+'"]').attr('selected',true).trigger('change');
            
                    }, 600); 
                }
            }, 600); 
        }  
    }

    $('#frmRegister').find("select#workday").val(data.workday).change();
    $('#frmRegister').find('select#type_salary option[value="'+data.type_salary+'"]').attr('selected',true).change();
    $('#frmRegister').find('select#type_salary option[value="'+data.type_salary+'"]').trigger("click");
    $('#frmRegister').find("#salary_min").val(data.salary_min);
    $('#frmRegister').find("#salary_max").val(data.salary_max);
    $('#frmRegister').find("#vacancies").val(data.vacancies);
    $('#frmRegister').find("#validity_time").val(data.validity_time);
    $('#frmRegister').find("#finish_date").val(data.finish_date);
    $('#frmRegister').find("#status").val(data.status);
    $('#frmRegister').find("#introduction").text(data.introduction);
    if(data.path_logo != null){
        $('#frmRegister').find("#foto").attr('src',base_url+'/img/resource/image/'+data.path_logo);
    }
    else{
        $('#frmRegister').find("#foto").attr('src',base_url+'/img/resource/image/default.JPG');        
    }
    $('#frmRegister').find("#path_logo").val(data.path_logo);

    if(data.publication_date)
    $('#frmRegister').find("#publication_date").val(data.publication_date);
    else
    $('#frmRegister').find("#publication_date").val(today());


}

function findOffer(id,option)
{
    $.ajax({
       
        headers  : {'X-CSRF-TOKEN': csrf_token },
        url      : base_url+'/admin/internalJobOffers/'+id+'/find',
        type     : 'GET',
        datatype : 'json',
        timeout  : 10000,  
        success  : function(response)
        {
            if(option=='edit')
                loadFrmRegister(response.data);
            else
                loadEmails(response.data);
        },
        error: function(xhr, textStatus, thrownError)
        {    
            messagesXhr(xhr,textStatus);
        }
    });
}
// function sendEmails(id)
// {
//     loadingButton(true);
//     $.ajax({
       
//         headers  : {'X-CSRF-TOKEN': csrf_token },
//         url      : base_url+'/admin/internalJobOffers/'+id+'/sendEmails',
//         type     : 'POST',
//         datatype : 'json',
//         timeout  : 10000,  
//         success  : function(response)
//         {
//             if(response.status=='success'){
//                 msgSuccess(response.message);            }
//             else
//                 msgWarning(response.message);
//         },
//         error: function(xhr, textStatus, thrownError)
//         {    
//             messagesXhr(xhr,textStatus);
//         },
//         complete: function()
//         {    
//             loadingButton(false);
           
//         },
//     });
// }

function loadEmails(data)
{
    $('tbody#body_emails').html('');
    $('#title_job_offer').text(data.title);
    let status = data.status;
    if(status != 2)
        $('#btnSendEmails').prop('disabled',true);
    else{
        $('#btnSendEmails').prop('disabled',false);
    }
    data.emails.forEach(function(element) 
    {   
        tr_clone = $('#foot_emails').find('tr:first').clone();
       
        tr_clone.find('td.date').text(element.created_at);
        tr_clone.find('td.quantity').text(element.quantity);
        tr_clone.find('td.user').text(element.user.name+' '+ element.user.last_name);
       
        $('tbody#body_emails').append(tr_clone);   
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
            msgSuccess(response.message,'Proceso correcto'); 
            setTimeout(function(){ location.reload(); }, 1200);  
        },
        error: function(xhr, textStatus, thrownError)
        {    
            messagesXhr(xhr,textStatus);
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
        $('.btnSave').children('i').removeClass("fa fa-spinner fa-spin");
        $('.btnSave').attr("disabled", false);
    }
    else{
        $('.btnSave').children('i').addClass("fa fa-spinner fa-spin");
        $('.btnSave').attr("disabled", true);
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
        (day<10 ? '0' : '') + day
    return output;
}






