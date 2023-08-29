jQuery(document).ready(function() {
   var $i_open_modal            = $('#i_open_modal');
   var $slc_countrie_id         = $('select#countrie_id');
   var $slc_department_code     = $('select#department_code');
   var $slc_province_code       = $('select#province_code');
   var $slc_district_code       = $('select#district_code');
   var $slc_type_salary         = $('select#type_salary');
   var $slc_type_validity       = $('select#type_validity');
   var $btn_cancel              = $('a#cancel');
   
     //menu active
     $('a#a_list_job_offer').siblings().removeClass('active');
     $('a#a_list_job_offer').addClass('active');

    CKEDITOR.replace('description');
    checkcountry($slc_countrie_id);
    select($slc_type_salary,$slc_type_validity);
    
    $i_open_modal.on('click', function(e){
        e.preventDefault();
        $('#modal_example').modal('show');

    });
    $slc_countrie_id.on('click', function(e){
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
    });
    
    $slc_province_code.on('change',function()
    {
        let geolocation_id = $(this).val();
       
        if(geolocation_id != ""){
            selected( base_url+'/geolocations/'+geolocation_id+'/getDistricts',  $slc_district_code );
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

    $btn_cancel.on('click', function(e){

        window.location.href = base_url+'/employers';
    });
});