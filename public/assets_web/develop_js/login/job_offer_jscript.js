function jobOfferGet(route)
{
    $.ajax({
        url      : route,
        type     : 'GET',
        datatype : 'json',
        timeout  : 5000,
       
        success: function(response)
        {
            if(response.action == 'show')
            {
                window.location.href = base_url+'/jobOffers/'+response.id+'/show';
            }
            else
            {
                $('div#modal_login').modal('show');
            }
        },
        error: function(xhr, textStatus, thrownError)
        {
            messagesXhr( xhr, textStatus);

        }
    })
}

function jobOfferPost(route,data)
{
    $.ajax({
        url      : route,
        headers  : {'X-CSRF-TOKEN': csrf_token },
        type     : 'POST',
        data     : data,
        datatype : 'json',
        timeout  : 10000,  
        success: function(response)
        {
            msgSuccess(response.message);
            $('#email').val(' ');
            $('#password').val(' ');
            $('div#modal_login').modal('hide');
        },
        error: function(xhr, textStatus, thrownError)
        {
            messagesXhr( xhr, textStatus);
        }
    })
}

function clean_form()
{
    $('#frmloginEstudent')[0].reset();
}