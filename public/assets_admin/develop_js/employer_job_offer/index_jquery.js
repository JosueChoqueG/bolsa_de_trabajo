jQuery(document).ready(function() 
{
    var $frmRegister                    = $('#frmRegister');
    var $contentRegister                = $('#content_register');
    var $contentIndex                   = $('#content_index');
    var $btnViewRegister                = $('#btnViewRegister');
    var $slc_countrie_id                = $('select#countrie_id');
    var $slc_department_code            = $('select#department_code');
    var $slc_province_code              = $('select#province_code');
    var $slc_district_code              = $('select#district_code');
    var $slc_type_salary                = $('select#type_salary');
    var $slc_type_validity              = $('select#type_validity');
    var $contentTable                   = $('#content_table');
    var $slc_status                     = $('#status');
    var $i_open_modal_introduction      = $('#i_open_modal_introduction');
    var urlJobOffer                     = base_url+'/admin/employerJobOffers';

    CKEDITOR.replace('description');
    $('#search_employer_id').select2();
    $('button.btn-list').on('click', function(){
        $contentRegister.hide('fast'); 
        $contentIndex.show('fast'); 
      
    });

    $('#i_open_modal').on('click',function(){
       $('#modal_example').modal('show'); 
    });

    $btnViewRegister.click(function()
    {
        resetForm($frmRegister);
        $('#college_id-error').text('');
        removeMsgValidation($frmRegister);
        $frmRegister.attr( 'action', urlJobOffer+'/create' );
        $contentRegister.show('fast'); 
        $contentIndex.hide('fast'); 
        $("#publication_date").val(today());
    });

    $contentTable.on('click' ,'#table_body button.edit',function(e)
    {
        e.preventDefault();

        let id  = $(this).parents('tr').attr('id');
     
        $frmRegister.attr('action',urlJobOffer+'/'+id+'/update');

        findOffer(id,'edit');
    
        $contentRegister.show('fast');
        $contentIndex.hide('fast'); 
    });

    $contentTable.on('click' ,'#table_body button.delete',function(e)
    {
        e.preventDefault();
        let id  = $(this).parents('tr').attr('id');
        let route = urlJobOffer+'/'+id+'/delete';
        let title = 'Eliminar registro'
        let type = 'warning'
        let message = 'Esta seguro(a) de eliminar esta oferta laboral ?';
        swal(swalConfirm(title,message,type),
        function(){
            swal.close();
            submitDelete(route);
        });
    });

    $contentTable.on('click' ,'#table_body button.send',function(e)
    {
        e.preventDefault();
        $('#modalEmail').modal('show') ;

        let id  = $(this).parents('tr').attr('id');
        $('#selected_job_offer_id').val(id);
        findOffer(id,'send_email');
    });
    
    $('#btnSendEmails').on('click',function(e)
    {
        e.preventDefault();
        let id =   $('#selected_job_offer_id').val();        
        $('#formSendEmail').attr('action',base_url+'/admin/employerJobOffers/'+id+'/sendEmails');
        
        let title = 'Confime el envio de correos';
        let type  = 'info';
        let message = '¿Estas seguro(a) de enviar correos masivos para esta oferta laboral. ?';
       
        swal(swalConfirm(title,message,type),
        function(){
            swal.close();
            loadingButton(true);
           $('#formSendEmail').submit();
        });
    });
    $frmRegister.on("submit", function(e)
    {
        e.preventDefault();
        loadingButton(true);
        $('#college_id-error').text('');
        removeMsgValidation($frmRegister);
        let description = CKEDITOR.instances['description'].getData();
        $('#description').text(description);
        let data   = new FormData($frmRegister[0]);
        var route = $frmRegister.attr('action');
        submitRegister(route,data);
    });
  
    $("#logo").change(function(){
        mostrarImagen(this);
    });
    
    $slc_countrie_id.on('change', function(e){
        let pais = $(this).val();
       
        if( pais != '173')
        {
            $slc_department_code.parent('div.form-group').hide();
            $slc_province_code.parent('div.form-group').hide();
            $slc_district_code.parent('div.form-group').hide();
            $slc_district_code.html('');
            $slc_province_code.html('');
            $slc_department_code.val('');
        }
        else
        {
           
            $slc_department_code.parent('div.form-group').show();
            $slc_province_code.parent('div.form-group').show();
            $slc_district_code.parent('div.form-group').show();
        }

    });



    $slc_department_code.on('change',function()
    {
        let geolocation_id = $(this).val();      
        if(geolocation_id != ""){
            $slc_district_code.html('');
            selected( base_url+'/geolocations/'+geolocation_id+'/getProvinces',  $slc_province_code );
        }
        else
        {
            $slc_province_code.removeClass("required");
        }
        
    });
    
    $slc_province_code.on('change',function()
    {
        let geolocation_id = $(this).val();
       
        if(geolocation_id != ""){
            selected( base_url+'/geolocations/'+geolocation_id+'/getDistricts',  $slc_district_code );
        }    
        else
        {
            $slc_district_code.removeClass("required");
        }
    });

    $slc_type_salary.on('click', function(e){
        e.preventDefault();
        if($(this).val() == 'Fijo')
        {
            $('div#div_salary_min').show();
            $('div#div_salary_min').find('label').text('Monto en soles');
            $('div#div_salary_min').attr('class','form-group col-md-12');
            $('#salary_min').attr('required',true);
            $('#salary_min').attr('placeholder','Salario');
            
            $('div#div_salary_max').hide();
            $('#salary_max').attr('required',false);
            $('#salary_max').html('');
        } 
        
        if($(this).val() == 'Rango')
        {
            $('div#div_salary_min').show();
            $('div#div_salary_min').find('label').text('Monto Min.*');
            $('div#div_salary_min').attr('class','form-group col-md-6');
            $('#salary_min').attr('placeholder','');
            $('#salary_min').attr('required',true);

            $('div#div_salary_max').show();
            $('#salary_max').attr('required',true);
        }

        if($(this).val() == 'A tratar')
        {
            $('div#div_salary_min').hide();
            $('#salary_min').attr('required',false);
            $('#salary_min').html('');
            $('div#div_salary_max').hide();
            $('#salary_max').attr('required',false);
            $('#salary_max').html('');
        }
    });

    $slc_type_validity.on('click', function(e){
        e.preventDefault();
        if($(this).val() == 'Definido')
        {
            $('#validity_time').show();
            $('#validity_time').attr('required',true);
        } 
        else
        {
            $('#validity_time').hide();
            $('#validity_time').html('');
            $('#validity_time').attr('required',false);
        }
    });


    $i_open_modal_introduction.on('click', function(e){
        console.log('hol');
        e.preventDefault();
        $('#modal_example_introduction').modal('show');

    });

    $slc_status.on('click', function(e){
        let  status = $(this).val();
        
        if(status == 2)
        $('#publication_date').attr('required', true); 
        else
        $('#publication_date').attr('required', false);

    });
});

