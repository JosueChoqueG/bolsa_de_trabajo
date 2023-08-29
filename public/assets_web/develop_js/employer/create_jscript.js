function employerPost(route, data)
{
    $.ajax({
        url      : route,
        headers  : {'X-CSRF-TOKEN': csrf_token },
        type     : 'POST',
        datatype : 'json',
        data     : data,
        timeout  : 5000,
       
        success: function(response)
        {
            msgSuccess(response.message);
            clean_form();
        },
        error: function(xhr, textStatus, thrownError)
        {
            messagesXhr( xhr, textStatus);
        }
    });
}

function clean_form()
{
    $('#create_job_offer')[0].reset();
 
    $('select#countrie_id').val('173');
    $('div#div_salary_max').hide();
    $('div#div_salary_min').hide();

    CKEDITOR.instances['description'].setData('');
    
    $('#department_code').parent('div.form-group').show();
    $('#province_code').parent('div.form-group').show();
    $('#district_code').parent('div.form-group').show();
    //$("input:checkbox").prop('checked', false);
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