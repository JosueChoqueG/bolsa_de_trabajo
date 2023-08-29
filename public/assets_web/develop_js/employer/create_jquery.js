jQuery(document).ready(function() {
   var $i_open_modal                = $('#i_open_modal');
   var $i_open_modal_introduction   = $('#i_open_modal_introduction');
   var $i_open_modal                = $('#i_open_modal');
   var $slc_countrie_id             = $('select#countrie_id');
   var $slc_department_code         = $('select#department_code');
   var $slc_province_code           = $('select#province_code');
   var $slc_district_code           = $('select#district_code');
   var $slc_type_salary             = $('select#type_salary');
   var $slc_type_validity           = $('select#type_validity');
   var $frm_create_job_offer        = $('form#create_job_offer');
   var $btn_cancel                  = $('a#cancel');

   //menu active
    $('a#a_create_job_offer').siblings().removeClass('active');
    $('a#a_create_job_offer').addClass('active');

    CKEDITOR.replace('description');

    $i_open_modal.on('click', function(e){
        e.preventDefault();
        $('#modal_example').modal('show');

    });

    $i_open_modal_introduction.on('click', function(e){
        e.preventDefault();
        $('#modal_example_introduction').modal('show');

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
            $slc_province_code.attr("required", false);
            $slc_department_code.attr("required", false);
            $slc_district_code.attr("required", false);
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
            $slc_province_code.attr("required", false);
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
        fijo();

        if($(this).val() == 'Rango')
        rango();

        if($(this).val() == 'A tratar')
        a_tratar();
    });
    
    $slc_type_validity.on('click', function(e){
        e.preventDefault();
        if($(this).val() == 'Definido')
        definido();
        else
        indefinido();

    })
 
    $frm_create_job_offer.on('submit', function(e){
        e.preventDefault();  
        $('#college_id-error').text('');
        removeMsgValidation($frm_create_job_offer);
        let route       = base_url+'/employers/create';
        let description = CKEDITOR.instances['description'].getData();

        $('#description').text(description);
        
        let data  = $frm_create_job_offer.serialize();
        employerPost(route,data);
    });

    // $a_preview.on('click', function(e){

    //     e.preventDefault();
    //     let value_checked = [];
    //     $('.college_id:checked').each(function(){
    //         value_checked.push(this.text);
    //     });
    //     let formdata = $frm_create_job_offer.serializeArray();
    //     $(formdata ).each(function(index, obj){
            
    //         if(obj.name != 'college_id[]' || obj.name != 'academic_level[]')
    //         {
    //             $('#general_' + obj.name).text(obj.value);
    //             $('#description_' + obj.name).text(obj.value);
    //             $('#summary_' + obj.name).text(obj.value);
    //         }
    //     });
    //     $('#modal_preview').modal('show');
        
    // });
    $btn_cancel.on('click', function(e){

        window.location.href = base_url+'/employers';
    });

});