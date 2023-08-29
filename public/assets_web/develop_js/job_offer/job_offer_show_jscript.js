
function postulationPost(route,data)
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
            $('#modal_postular').modal('hide');
        },
        error: function(xhr, textStatus, thrownError)
        {
            messagesXhr( xhr, textStatus);
        }
    })
}

function postulationGet(route)
{
    $.ajax({
        url      : route,
        type     : 'GET',
        datatype : 'json',
        timeout  : 5000,
       
        success: function(response)
        {
            if (response.action == 'exists') 
            {
                msgWarning(response.message);
            }
            if (response.action == 'not_exists') 
            {
                $('#modal_postular').modal('show');
            }
        },
        error: function(xhr, textStatus, thrownError)
        {
            messagesXhr( xhr, textStatus);

        }
    })
}

