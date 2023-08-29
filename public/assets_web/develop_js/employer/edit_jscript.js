

function checkcountry($slc_countrie_id)
{
    
    if($slc_countrie_id.val() != '173')
    {
        $('select#department_code').parent('div.form-group').hide();
        $('select#province_code').parent('div.form-group').hide();
        $('select#district_code').parent('div.form-group').hide();
        
    }
    else
    {
        $('select#department_code').parent('div.form-group').show();
        $('select#province_code').parent('div.form-group').show();
        $('select#district_code').parent('div.form-group').show();
    }
}

function select($slc_type_salary,$slc_type_validity)
{
    if($slc_type_salary.val() == 'Fijo')
    fijo();
    
    if($slc_type_salary.val() == 'Rango')
    rango();

    if($slc_type_validity.val() == 'Definido')
    definido();
    else
    indefinido();
}

function fijo()
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
 
function a_tratar()
{
    $('div#div_salary_min').hide();
    $('#salary_min').attr('required',false);
    $('#salary_min').html('');
    $('div#div_salary_max').hide();
    $('#salary_max').attr('required',false);
    $('#salary_max').html('');

}

function rango()
{
    $('div#div_salary_min').show();
    $('div#div_salary_min').find('label').text('Monto Min.*');
    $('div#div_salary_min').attr('class','form-group col-md-6');
    $('#salary_min').attr('placeholder','');
    $('#salary_min').attr('required',true);

    $('div#div_salary_max').show();
    $('#salary_max').attr('required',true);
}

function definido()
{
    $('#validity_time').show();
    $('#validity_time').attr('required',true);
}

function indefinido()
{
    $('#validity_time').hide();
    $('#validity_time').html('');
    $('#validity_time').attr('required',false);
}